<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crypto;
use App\Currency;
use General;
use DB;
use Auth;

class HomeUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home($idDivisa=null){
        
        $user = Auth::user();
        
        $paymentAcount = $user->payments->count();

        $bandera=false;

        if($idDivisa==null){

            $currencies=Currency::select('id')->where('status',1)->get();
            $current=[];
            $bandera=false;
            foreach ($currencies as $currency) {
                $saldo=General::getCryptoWalettUser($currency->id); 
                
                $current[]=[
                    'saldo'=>$saldo,
                    'id'=>$currency->id,
                ];
                $idDivisa=$currency->id;
    
                if ($saldo>0){
                    $bandera=true;
                    break;
                }
            }

            if ($bandera==true)  {

                $default=Currency::find($idDivisa);
    
            }else{
                    $idDivisa=General::getDivisaDefault();
                    $default=Currency::find($idDivisa);
                
            } 

        }else{

            $default=Currency::find($idDivisa);

        }


        $cryptos = Crypto::where("status",1)->orderBy('orden', 'asc')->orderBy('name', 'asc')->get();

        //$idCrypto=
        $dataAmount=[];
        foreach($cryptos as $crypto){

            $amount = General::getCryptoUser($crypto->id,config("settings.wallets.aprobado"));


            if ($amount>0){

                $dataAmount[]=["crypto"=>$crypto,"amount"=>$amount,"conver"=>General::getConverCrypto($default->code,$crypto->code,$amount)];

            }else{

                $dataCero[]=["crypto"=>$crypto,"amount"=>$amount,"conver"=>"0.0000000"];

            }

        }

        $unionCryptos=array_merge($dataAmount, $dataCero);

        //dd($unionCryptos);

        $getCurrencies = DB::table('currencies')->pluck('name', 'id');

        $meta['title']=__('home.title');
        $meta['key']=__('home.key');
        $meta['descripcion']=__('home.description');
        $portfolio = true;
        return view('home_usuario.index',compact('unionCryptos','getCurrencies','default','meta', 'user', 'paymentAcount', 'portfolio'));
        
    }
}

