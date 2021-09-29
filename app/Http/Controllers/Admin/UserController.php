<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAdminUsers;
use App\User;
use App\Currency;
use General;
use App\Crypto;
use App\CryptoWallet;
use App\Payment;
use App\Wallet;
use App\Payment_Wallet;
use App\ExternalWallet;
use Redirect;
//use App\DetailCurrency;
use DB;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy("created_at","desc")->paginate(25);
        return view('admin.users.index_user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idioma = 'es';//variable statica
        $password= str_random(30);
        $rols = DB::table('rols')->where('name','<>','administrator')->orderBy('name', 'asc')->pluck('name', 'id');
        $getCountry = DB::table('countries')->where('idioma', $idioma)->orderBy('name', 'asc')->pluck('name', 'id');
     
        return view('admin.users.create_user',compact('getCountry','password','rols'));
        //return "si";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $users = User::where('email',$request["email"])->paginate(1);
       
        if($users->total()>0){
            return view('admin.users.index_user',compact('users'));

        }else{

            $users = User::paginate(15);
            Session::flash('error','email no registrado');
            return view('admin.users.index_user',compact('users'));

        }

       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $cripto=Crypto::pluck();
       $states = DB::table('states')->pluck('name', 'id');
       $currencies = DB::table('currencies')->pluck('name', 'id');
       // $currencies = DB::table('currencies')->orderBy('name', 'asc')->pluck('name', 'id');
        $user=User::where('id',$id)->first();

        return view('admin.users.show_user',compact('user','currencies','states'));


    }

    public function history($id)
    {
       $user=User::where('id',$id)->first();
       return view('admin.users.show_user_history',compact('user'));

    }
    public function historyPayment($id)
    {
       $user=User::where('id',$id)->first();
       return view('admin.users.show_user_history_payment',compact('user'));

    }

    public function historyPaymentEdit($idUser,$idPayment)
    {
       $payment=Payment::where('id',$idPayment)->first();
       $user=User::where('id',$idUser)->first();
       $states = DB::table('states')->pluck('name', 'id');
       $currencies = DB::table('currencies')->pluck('name', 'id');
       $statusPayment=config("settings.statusPayment");
       //return $statusPayment;

       return view('admin.users.show_user_history_payment_edit',compact('payment','user','states','currencies','statusPayment'));

    }

    public function historyPaymentUpdate(Request $request,$id)
    {

        $payment=Payment::find($request->idPayment);
            $payment->user_id=$id;
            $payment->descripcion=$request->comments;
            $payment->status=$request->statusPayment;
        $payment->save();

        $statusP=$this->myStatusP($request->statusPayment);

        if($payment->paymentwallet){
            $wallet=Wallet::find($payment->paymentwallet->wallet->id);
            $wallet->status_user=$statusP;
            $wallet->save();

        }
        Session::flash('success','Payment Actualizado');
       return redirect("/admin/users-history-payment/".$id);
        //return $payment;

    }
    public function myStatusP($num){
        $status="Rechazado";
        if($num==1){
            $status="Aprobado";
        }
        return $status;

    }

    public function wallet($id)
    {
       $user=User::where('id',$id)->first();
       $cryptos = Crypto::orderBy('orden', 'asc')->orderBy('name', 'asc')->get();
        //mejorar luego estas condiconales
        $wallets=[];
       foreach($cryptos as $crypto){

             $amount = General::getCryptoUserNew($crypto->id,$user->id,config("settings.wallets.aprobado"));

             if ($amount>0){

                 $wallets[]=["crypto"=>$crypto,"amount"=>$amount];
             }
       }

       return view('admin.users.show_user_wallet',compact('user','wallets'));

    }

    public function retirar($idUser,$idCripto)
    {
        $user=User::where('id',$idUser)->first();

        $amount=0;

        if($user){

            $crypto = Crypto::where("id",$idCripto)->first();

            $amount = General::getCryptoUserNew($crypto->id,$user->id,config("settings.wallets.aprobado"));

            if($amount){

                if($amount>0){
                    return view('admin.users.show_user_retirar',compact('user','crypto','amount'));

                }
                else{
                    return "no found";
                }

            }else{
                return "no found";

            }

        }

        return "no found";





    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function processRetirar(Request $request){

        $this->validate($request, [
            'retiro' => 'required',
            'wallet_externo' => 'required',
            'idCrypto' => 'required',
            'idUser' => 'required',
        ]);

        $user=User::where('id',$request->idUser)->first();

        if($user){

            $crypto = Crypto::where("id",$request->idCrypto)->first();
            $amount = General::getCryptoUserNew($crypto->id,$user->id,config("settings.wallets.aprobado"));

            if($amount>=$request->retiro){
                DB::beginTransaction();
                try {

                    $criptowallet = new CryptoWallet;
                        $criptowallet->venta = $request->retiro;
                        $criptowallet->taker = 0;
                        $criptowallet->cripto_id = $crypto->id;
                        $criptowallet->status = 1;
                        $criptowallet->user()->associate($user);
                    $criptowallet->save();

                    $wallet = new ExternalWallet;
                        $wallet->retiro = $request->retiro;
                        $wallet->wallet_externo = $request->wallet_externo;
                        $wallet->status = 0;
                        $wallet->cryptowallet()->associate($criptowallet);
                    $wallet->save();

                    DB::commit();

                    Session::flash('success', "Retiro Procesado con exito");
                    return redirect("/admin/users-history/".$user->id);

                } catch (Exception $e) {
                    DB::rollback();
                    return Redirect::back()->with('error', "error");
                }
                

            }else{

                return Redirect::back()->with('error', "El monto a retirar es mayor que la wallet");


            }

            return $amount;



        }else{

            Session::flash('error', "not found");
            return Redirect::back()->with('error', "users not found");
        }

       




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createUser(RequestAdminUsers $request)
    {
        DB::beginTransaction();
        try {
           // $user = new User;

           // $user->create($request->all());

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'role_id' => 2,
                'lastName' => $request['lastName'],
                'country_id' => $request['country_id'],
                'role_id' => $request['role_id'],
                'password' => bcrypt($request['password']),
            ]);

            DB::commit();

             Session::flash('success', "Usuario Creado con exito");
            return redirect("/admin/users");

        } catch (Exception $e) {

            DB::rollback();
            
            return Redirect::back()->with('error','error');
        }

        
    }
    public function update(Request $request, $id)
    {

        //return "sii";
        $this->validate($request, [
            'metodo' => 'required',
            'currency' => 'required',
            'comments' => 'required',
            'comision' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:5',
            'monto' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);


        $user = User::find($id);
        $currency=Currency::find($request->currency);

        DB::beginTransaction();

        try {
            $amountComision=$this->deposit_fee($request->monto,$request->comision);//deposito fee
            
            $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $request->monto;
                $payment->pasarela = $request->metodo;
                $payment->descripcion = $request->comments;
                $payment->status = 1;
                $payment->currency()->associate($currency);
            $payment->save();

            $wallet = new Wallet;
                $wallet->abono = $amountComision;
                $wallet->status_user = "Aprobado";
                $wallet->currency()->associate($currency);
                $wallet->status = 1;//procesado
                $wallet->user()->associate($user);
            $wallet->save();

            $paymentwallet = new Payment_Wallet;
                $paymentwallet->payment()->associate($payment);
                $paymentwallet->wallet()->associate($wallet);
            $paymentwallet->save();

            DB::commit();

            General::email($payment->total, $currency->code, $user, "Direct Purchase");


            Session::flash('success', "Abono con exito");
            return redirect("/admin/users");

            return $wallet;
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('error', __('home_deposit.error_deposit'));
            return Redirect::back()->with('error', __('home_deposit.error_deposit'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deposit_fee($total,$comision){
        return round($total-($total*($comision/100)),2);
       // return $comision;
    }
}
