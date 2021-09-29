<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CryptoWallet;
use App\SendCryptoWallet;
use App\Currency;
use App\User;
use App\Crypto;
use General;
use Illuminate\Support\Facades\Auth;
use App\CryptoWalletPyment;
use DB;
use Session;

class BalanceController extends Controller
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
       $balances=Cryptowallet::orderBy('id','desc')->paginate(20);
       // $balances=Cryptowallet::paginate(10);
       
        
        return view('admin.balance.index_balance',compact('balances'));
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

            $balances=Cryptowallet::where('user_id',$user->id)->orderBy('id','desc')->paginate(30);          
            return view('admin.balance.index_balance',compact('balances'));

        }else{

            $balances=Cryptowallet::orderBy('id','desc')->paginate(20);
            Session::flash('error','email no registrado');
            return view('admin.balance.index_balance',compact('balances'));

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function sendCryptoToWallet(Request $request){
        
        $send_balance = new CryptoWallet();
        $send_transfer = new SendCryptoWallet();

        $currency = Currency::where('code', $request->getCurrencies)->filtrado();
        $comission = ($request->montoCrypto * ($request->comission/100));
        $envio = $request->montoCrypto - $comission;
        $idCrypto = $idCrypto = General::getCryptoDefault($request->getCryptosss);
   
        $send_balance->compra = 0;
        $send_balance->venta = $envio;
        $send_balance->taker = $comission;
        $send_balance->status = 1;
        $send_balance->user_id =Auth::user()->id;
        $send_balance->cripto_id = $idCrypto;
       
        $send_balance->save();
       
        $send_transfer->account = $request->cuenta;
         $send_transfer->crypto_wallets_id = $send_balance->id;
         $send_transfer->platform = $request->platform;
         $send_transfer->currencies_id = $currency->id;

         $send_transfer->save();
         Session::flash('success', 'Success');
         return redirect()->back()->with('success','Transaccion exitosa');

    }
    public function showSendTransfer(){
       

        $wallet = DB::table('send_crypto_wallets')
        ->join('currencies','currencies.id','send_crypto_wallets.currencies_id')
        ->join('crypto_wallets','crypto_wallets.id','send_crypto_wallets.crypto_wallets_id')
        ->join('users','users.id','crypto_wallets.user_id')
        ->join('cryptos','cryptos.id','crypto_wallets.cripto_id')
        ->join('states','states.id','crypto_wallets.status')
        ->select('users.name as nombreUsuario','users.email','users.lastName','send_crypto_wallets.created_at',
        'crypto_wallets.venta','crypto_wallets.taker','cryptos.name as nombreCrypto','cryptos.code as cryptoCode',
        'states.name as state','crypto_wallets.id','send_crypto_wallets.account','crypto_wallets.comments',
        'send_crypto_wallets.platform as plataforma','currencies.code as codigo')->get();
  
        return view('admin.criptoWallet.index_criptoWallet', compact(
            'wallet',
            
            ));
    }

    public function editSend($id){
        
        $send_transfer = SendCryptoWallet::where('crypto_wallets_id',$id)->first();
        $cryptoWall = CryptoWallet::where('id',$id)->first();
        $currency = Currency::where('id',$send_transfer->currencies_id)->first();
        $states = DB::table('states')->pluck('name', 'id');
       

       return view('admin.criptoWallet.edit_criptoWallet', compact(
           'send_transfer',
           'cryptoWall',
           'currency',
           'states'
        ));
    }
    public function editSendToWallet(Request $request, $id){
        
        $wallet = CryptoWallet::find($id);
        
            $wallet->status =$request["state"];
            $wallet->comments =trim($request["comments"]);
        $wallet->save();


        Session::flash('success', 'Operacion actualizada con exito');
        return redirect('admin/criptoWallet');
    }




    public function edit($id)
    {
        $balance=Cryptowallet::where('id',$id)->first();
       
        //return $balance->cryptowalletwallet->wallet->currency;
       //return  $balance->cryptowalletpayment->payment->currency;
        $states = DB::table('states')->pluck('name', 'id');
        //return $data;
        return view('admin.balance.edit_balance',compact('balance','states'));
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
       // return $request["state"];
       //return $id;
       //return $request["comments"];
        $cripto = Cryptowallet::find($id);
            $cripto->status =$request["state"];
            $cripto->comments =trim($request["comments"]);
        $cripto->save();
        Session::flash('success', 'Operacion actualizada con exito');
        return redirect('admin/balance');
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
