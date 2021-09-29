<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use General;
use App\Currency;
use App\Crypto;
use App\CryptoWallet;
use App\CryptoWalletWallet;
use App\Wallet;
use Auth;
use DB;
use Session;

class VenderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function vender($idCrypto=null,$idDivisa=null){
        
        $getCriptodefault=General::getCriptodefault($idCrypto);
        $getCurrencyUser=General::getCurrencyUser($idDivisa);
        $getCurrencies = DB::table('currencies')->pluck('name', 'id');//Currency::lists('name', 'id');
        $getCryptos = DB::table('cryptos')->pluck('name', 'id');

        $totalCrypto=General::getCryptoUser($getCriptodefault->id,config("settings.wallets.aprobado"));

        $totalCrypto=number_format($totalCrypto, 7, '.', ''); 
        //dd($totalCrypto);
        $comision=$getCriptodefault->taker_fee * $totalCrypto / 100;
       
        $comision=number_format($comision, 7, '.', ''); 
       // dd($comision);
        $venta=number_format($totalCrypto-$comision, 7, '.', ''); 
        //$totalCrypto=number_format($totalCrypto-$comision, 8, '.', ','); 
        $taker_fee=$getCriptodefault->taker_fee. "%";

        if ($totalCrypto==0){
            $conver=0;
        }else{
            $conver=General::getConverCrypto($getCurrencyUser->code,$getCriptodefault->code,$totalCrypto);
            $conver=number_format($conver, 2, '.', ''); 

        }

        //return $totalCrypto;
        $meta['title']=__('home_sell.titlee');
        $meta['key']=__('home_sell.key');
        $meta['descripcion']=__('home_sell.description');

     return view('home_usuario.vender',compact('getCriptodefault','getCurrencyUser','getCryptos','getCurrencies','totalCrypto','conver','comision','venta','taker_fee','meta'));
    }

    public function processventa(Request $request){

        $getTotalBackend=General::getCryptoUser($request['crypto'],config("settings.wallets.aprobado"));

        $getCurrencyUser=General::getCurrencyUser($request->currency,config("settings.wallets.aprobado"));

        $xx=$request['totaldivisa'];

        if($request['totalCrypto']>$getTotalBackend){
            return Redirect::back()->with('error', "no posee la cantida enviada disponible");
        }else{

        DB::beginTransaction();

            $getCriptodefault=General::getCriptodefault($request['crypto']);
            $totalCrypto=number_format($request['totalCrypto'], 7, '.', ''); 

            $totalFiat=General::getConverCrypto($getCurrencyUser->code,$getCriptodefault->code,$totalCrypto);
            
            $comision=$getCriptodefault->taker_fee * $totalFiat / 100;

            $comision=number_format($comision, 2, '.', ''); 

            $newTotal=number_format(($totalFiat-$comision),2,'.','');


        try{

        $criptowallet=new CryptoWallet;
            $criptowallet->venta=$request['totalCrypto'];
            $criptowallet->taker=$comision;
            $criptowallet->cripto_id=$request['crypto'];
            $criptowallet->status=1;
            $criptowallet->user()->associate(Auth::user());
        $criptowallet->save();

        $wallet=new Wallet;
            $wallet->abono=$newTotal;
            $wallet->currency_id=$request['currency'];
            $wallet->status=1;
            $wallet->user()->associate(Auth::user());
        $wallet->save();

        $pivotwallet=new CryptoWalletWallet;
            $pivotwallet->cripto_wallet()->associate($criptowallet);
            $pivotwallet->wallet()->associate($wallet);
        $pivotwallet->save();

        DB::commit();
        General::email($criptowallet->venta,$getCriptodefault->code,Auth::user(),"Sale");
        Session::flash('success',  __('home_sell.success_sell'));
                        
        return redirect('/home/'.$request['currency']);
       // return response()->json($criptowallet, 200);
        }
        catch (Exception $e) {
            
            DB::rollback();
            return Redirect::back()->with('error', "ha ocurrido un error un error ");
 
       }



        }


    }
}
