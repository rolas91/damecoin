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
use App\PaymentLimit;

class LandingPaymentController extends Controller
{
    public function indexEs($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        
        

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexEn($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexAe($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'ae';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexCh($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'ch';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexCz($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'cz';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexDe($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'de';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexFr($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'fr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexHi($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'hi';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexIt($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'it';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }
    public function indexJp($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'jp';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexKr($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'kr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexPt($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'pt';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexRu($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'ru';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexSe($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'se';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }
    

    public function indexTh($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'th';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodosDepago($idCrypto, $idDivisa,$metodo, 'en');
    }


    public function metodosDepago($idCrypto = null,  $idDivisa = null, $metodo = null,$idioma)
    {
        
        try {
            if($metodo == null)
            {
                $data = PaymentMethods::all();

            }else{
                $data = PaymentMethods::where('name',$metodo)->get();
               
            }
            if($metodo == 'westerUnion' || $metodo == 'westerunion' || $metodo == 'westernunion' || $metodo == 'western union')
            {
                $metodo = 'Western Union';
            }

            
            $limit_pay        = PaymentLimit::where('id',1)->get();
            $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
            $paypal_state = PaypalGatewayLink::first();
    
            if ($idCrypto == null) {
                $idCrypto = General::getCryptoDefault('BTC');
            } else {
                $idCrypto = General::getCryptoDefault($idCrypto);
            }
            
            if ($idDivisa == null) {
                $idDivisa = General::getDivisaDefault();
            } else {
                $idDivisa = Currency::where('code', $idDivisa)->filtrado();
                $idDivisa = $idDivisa->id;
            }

            $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
            $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
            $select="en";
            if($idioma=="es"){
                $select="es";
            }
            
            $metodos = PaymentMethods::all();
            
            


            $ToDIvisa = 'EUR';
            $toUsd = "USD";
    
            $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); 
            $getCryptos = Crypto::where('status', 1)->cryptos();
            $getCountry = DB::table('countries')->where('idioma', $select)->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');
            $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);
            $paypal_state = PaypalGatewayLink::first();
           

            if ($getConversNew) {
                $getConvers = $getConversNew[$getCriptodefault->code];
                $getPanel = General::newGetPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
                $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
                $getConvers = number_format($getConvers, 2, '.', '');
                $default['cryptox'] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
                $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
                $xxvalor1 = General::getDescuentoSinComision($xxvalor, $getCriptodefault->maker_fee);
            
                $default['conversor'] = General::getConverFromTo($toUsd, $ToDIvisa, $data[0]->amount);
                $default['pay'] = number_format(($xxvalor), 2, '.', '');
                $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                $meta['title'] = __('index.titleMetodosPago', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.descriptionMetodosPago', ['currency' => $getCurrencyUser->name]);

                $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

                $getCryptos = $getCryptos->pluck('name', 'code');
                $symbol = $getCurrencyUser->symbol;
                $recurly = true;
                // Return view with vars
                $fiat = self::CurrencyType($getCurrencyUser->code);
                $pais = null;
                return view('landing.buy-payment-method', compact(
                    'data',
                    'meta',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
                    'metodos',
                    'default',
                    'getCountry',
                    'pais',
                    'metodo',
                    'limit_pay',
                    'symbol',
                    'recurly',
                    'pricesCryptos',
                    'payment_state',
                    'paypal_state',
                    'fiat',
                ));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function LandingCountry($idCrypto, $country = null, $idDivisa = null, $lang = null, $pais = null)
    {
        try
        {
            if($country == null)
            {
                $country = 'Estados Unidos de América';
            }

            if($lang == null)
            {
                $lang = 'en';
            }

            \App::setLocale($lang);

            $pais = DB::table('countries')->where('name', $country)->get();

            $limit_pay = PaymentLimit::where('id',1)->get();

            $data = PaymentMethods::all();

            $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();

            $paypal_state = PaypalGatewayLink::first();
    
            if ($idCrypto == null) {

                $idCrypto = General::getCryptoDefault('BTC');

            } else {

                $idCrypto = General::getCryptoDefault($idCrypto);

            }
            
            if ($idDivisa == null) {

                $idDivisa = General::getDivisaDefault();

            } else {

                $idDivisa = Currency::where('code', $idDivisa)->filtrado();

                $idDivisa = $idDivisa->id;

            }

            $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();

            $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();

            $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code');

            $getCryptos = Crypto::where('status', 1)->cryptos();

            $getCountry = DB::table('countries')->where('idioma', $lang)->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');

            $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);
            
            if ($getConversNew) {
                
                $getConvers = $getConversNew[$getCriptodefault->code];
                
                $getPanel = General::newGetPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
                
                $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
                
                $getConvers = number_format($getConvers, 2, '.', '');
                
                $default['cryptox'] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
                
                $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
                
                $xxvalor1 = General::getDescuentoSinComision($xxvalor, $getCriptodefault->maker_fee);
                            
                $default['pay'] = number_format(($xxvalor), 2, '.', '');
                
                $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                
                $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                
                $meta['title'] = __('index.titleMetodosPago', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
                
                $meta['descripcion'] = __('index.descriptionMetodosPago', ['currency' => $getCurrencyUser->name]);

                $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

                $getCryptos = $getCryptos->pluck('name', 'code');
                
                $symbol = $getCurrencyUser->symbol;
                
                $recurly = true;

                $fiat = self::CurrencyType($getCurrencyUser->code);

                return view('landing.pais', compact(
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
                    'limit_pay',
                    'symbol',
                    'recurly',
                    'pricesCryptos',
                    'payment_state',
                    'paypal_state',
                    'fiat',
                ));
            }
        }catch(\Throwable $th)
        {
            throw $th;
        }
    }

    public function cryptoList($convers, $cryptoList)
    {
        // dd($cryptoList);
        $pricesSliders = array();

        foreach ($cryptoList as $value) {

            // if ($value['code'] != 'SILVER' && $value['code'] != 'USDC' && $value['code'] != 'ATOM') {
            //     $price = $convers[$value['code']];
            //     $pricesSliders[] = [
            //         "price" => number_format($price, 2, '.', ''),
            //         "code" => $value['code'],
            //         "img" => $value['img'],
            //     ];
            // }
        }
        return $pricesSliders;
    }

    public function CurrencyType($codeCurrency){
        
        if($codeCurrency == 'COP' ||
           $codeCurrency == 'CLP' ||
           $codeCurrency == 'ARS' ||
           $codeCurrency == 'PEN' ||
           $codeCurrency == 'BOB' ||
           $codeCurrency == 'CRC' ||
           $codeCurrency == 'GTQ' ||
           $codeCurrency == 'HNL' ||
           $codeCurrency == 'NIO' ||
           $codeCurrency == 'PYG' ||
           $codeCurrency == 'DOP' ||
           $codeCurrency == 'UYU' ||
           $codeCurrency == 'CKK' ||
           $codeCurrency == 'IDR' ||
           $codeCurrency == 'ZAR' ||
           $codeCurrency == 'TRY' ||
           $codeCurrency == 'KRW' ||
           $codeCurrency == 'AED' ||
           $codeCurrency == 'CNY'){
            return 'USD';   
        }else{
            return $codeCurrency;
        }
    }
}
