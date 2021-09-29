<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wallet;
use App\User;
use App\CryptoWalletPyment;
use DB;
use Session;
use General;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Currency;
use App\SendCryptoWallet;

class WalletController extends Controller
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
         //return "si";
         $wallets = Wallet::orderBy('id','desc')->paginate(10);
         //return $wallets;
         return view('admin.wallets.index_wallet',compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $user = User::where('email',$request->email)->first();

        if($user){

            $wallets=Wallet::where('user_id',$user->id)->orderBy('id','desc')->paginate(30);
            
            return view('admin.wallets.index_wallet',compact('wallets'));

        }else{

            $wallets = Wallet::orderBy('id','desc')->paginate(10);
            Session::flash('error','email no registrado');
            return view('admin.wallets.index_wallet',compact('wallets'));


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function sendCryptoToWallet(Request $request){
        
         $wallet = new Wallet();
         $send_transfer = new SendCryptoWallet();
         
         $currency = Currency::where('code', $request->getCurrencies)->filtrado();
 
         $wallet->abono = 0;
         $wallet->retiro = $request->montoCrypto;
         $wallet->status = 1;
         $wallet->status_user = "Pendiente";
         $wallet->user_id = Auth::user()->id;
         $wallet->currency_id = $currency->id;
         $wallet->save();
         
         $send_transfer->account = $request->cuenta;
         $send_transfer->wallets_id = $wallet->id;
         $send_transfer->platform = $request->platform;
         $send_transfer->comission = $request->comission;
         $send_transfer->save();
         Session::flash('success', 'Success');

        if(Auth::user()->role_id == 3){
            return view('admin.criptoWallet.index_criptoWallet', compact(
                'wallet',
                'account',
                'comission',
                'name',
                'lastname',
                'email'              
            ));
        }else{
            return redirect()->back()->with('success','Transaccion exitosa');
        } 
     }

     public function showSendTransfer(){

        $wallet = DB::table('send_crypto_wallets')
        ->join('wallets','wallets.id','send_crypto_wallets.wallets_id')
        ->join('users','users.id','wallets.user_id')
        ->join('currencies','currencies.id','wallets.currency_id')
    ->select('users.name as nombreUsuario','users.email','users.lastName','send_crypto_wallets.created_at',
    'wallets.retiro','wallets.id','send_crypto_wallets.comission','send_crypto_wallets.account',
    'send_crypto_wallets.platform as plataforma' ,'wallets.status_user','currencies.code as codigo')->get();
  
        return view('admin.criptoWallet.index_criptoWallet',compact('wallet'));
    }
    public function editSend($id){

        $wallet = DB::table('send_crypto_wallets')
        ->join('wallets','wallets.id','send_crypto_wallets.wallets_id')
        ->join('users','users.id','wallets.user_id')
        ->join('currencies','currencies.id','wallets.currency_id')->where('wallets.id',$id)
    ->select('users.name as nombreUsuario','users.email','users.lastName','send_crypto_wallets.created_at',
    'wallets.retiro','wallets.id','send_crypto_wallets.comission','send_crypto_wallets.account','wallets.comments',
    'send_crypto_wallets.platform as plataforma' ,'wallets.status_user','currencies.code as codigo')->get();
    /*    $wallet = Wallet::find($id);
        $status = DB::table('wallets')->pluck('status_user');
       $user = User::find($wallet->user_id);
       $transfer = DB::table('send_crypto_wallets')->where('wallets_id',$wallet->id)->get();*/
     // return $wallet[0]->comments;

     $totalTransfer = $wallet[0]->retiro - ($wallet[0]->retiro * ($wallet[0]->comission/100));
     
       
        return view('admin.criptoWallet.edit_criptoWallet', compact('wallet','totalTransfer'));

    }
    public function editSendToWallet(Request $request, $id){
        return "hola";
        $wallet = Wallet::find($id);
        $wallet->status =$request["state"];
        $wallet->comments =trim($request["comments"]);
        $wallet->status_user = "Aprobado";
        $wallet->save();
        Session::flash('success', 'Operacion actualizada con exito');
        return back();
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wallet=Wallet::where('id',$id)->first();
        //return $wallets;
        $states = DB::table('states')->pluck('name', 'id');
        //return $data;
        return view('admin.wallets.edit_wallet',compact('wallet','states'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $wallet = Wallet::find($id);
        $wallet->status =$request["state"];
        $wallet->comments =trim($request["comments"]);
        if($request->status_user){
            $wallet->status_user =$request->status_user;
            
        }
        $wallet->save();
        Session::flash('success', 'Operacion actualizada con exito');
        return redirect('admin/wallets');
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
}
