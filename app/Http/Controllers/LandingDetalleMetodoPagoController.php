<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Country;
use App\Crypto;
use App\PaymentMethoState;
use App\Currency;
use General;
use DB;
use App\PaypalGatewayLink;

use App\PaymentMethods;

class LandingDetalleMetodoPagoController extends Controller
{
    public function index($crypto = null,$divisa = null, $lang = null,  $metodo = null, $pais=null)
    {
        try {
            if($lang == null)
            {
                $lang = 'en';
            }
            
            \App::setLocale($lang);
            
            if($metodo == null)
            {
                $data = PaymentMethods::all();
            }else{
                $data = PaymentMethods::where('name',$metodo)->get();
            }

            if($crypto == null)
            {
                $idrypto = General::getCryptoDefault('BTC');
            }else{
                $idrypto = General::getCryptoDefault(strtoupper($crypto));
            }

            if($divisa == null)
            {
                $iddivisa = General::getDivisaDefault();
            }else{
                $idivisa = Currency::where('code', $divisa)->filtrado();
                $iddivisa = $idivisa->id;
            }
            $paypal_state = PaypalGatewayLink::first();

            $getCriptodefault = Crypto::where('id', $idrypto)->filtrado();

            $getCurrencyUser = Currency::where('id', $iddivisa)->filtrado();

            $getCurrencies = DB::table('currencies')->where('status',1)->pluck('name', 'code');
            
            $getCryptos = DB::table('cryptos')->where('status',1)->pluck('name', 'code');

            $getCountry = DB::table('countries')->where("idioma",'es')->orderBy("name","asc")->pluck('name', 'cod_iso2','id');
            
            $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);

            $getPanel = General::getPanel($getConvers,$getCurrencyUser->id,$getCriptodefault->id,$getCurrencyUser,$getCriptodefault);

            $defaultValor = General::getDescuento($getCurrencyUser->detailCurrency->max_deposito,$getCriptodefault->maker_fee);

            $getConvers = number_format($getConvers, 2, '.', '');

            $default["cryptox"] = number_format(($defaultValor/$getConvers), 7, '.', '');

            $xxvalor = $getCurrencyUser->detailCurrency->max_deposito*2;

            $xxvalor1 = General::getDescuento($xxvalor,$getCriptodefault->maker_fee);

            $default["pay"] = number_format(($xxvalor), 2, '.', '');

            $default["recibe"] = number_format(($xxvalor1/$getConvers), 7, '.', '');

            $default["prueba"] = number_format(($xxvalor1*$getConvers), 7, '.', '');

            $meta['key'] = __('index.key');

            $meta['title'] = __('index.title',["cripto"=> $getCriptodefault->name ,"currency"=> $getCurrencyUser->name ]);

            $meta['descripcion'] = __('index.description',["currency"=> $getCurrencyUser->name ]); 

            return view('landing.conversorTemporal',compact(
                'data',
                'meta',
                'getCriptodefault',
                'getCurrencyUser',
                'getCryptos',
                'getCurrencies',
                'getPanel',
                'default',
                'getCountry',
                'pais',
                'paypal_state'
            ));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
