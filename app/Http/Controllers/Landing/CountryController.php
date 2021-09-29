<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use General;
use App\Crypto;
use App\Currency;
use App\Country;
use DB;
use App\PaymentMethoState;
use App\PaymentMethods;
use App\PaymentLimit;
use App\PaypalGatewayLink;

class CountryController extends Controller
{
    public function indexEs($idCrypto = null, $country = null)
    {
        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'es');
    }

    public function indexEn($idCrypto = null, $country = null)
    {

        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'en');
    }

    public function indexAe($idCrypto = null, $country = null)
    {

        $lang = 'ae';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'ae');
    }

    public function indexCh($idCrypto = null, $country = null)
    {

        $lang = 'ch';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'ch');
    }

    public function indexCz($idCrypto = null, $country = null)
    {

        $lang = 'cz';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'cz');
    }

    public function indexDe($idCrypto = null, $country = null)
    {

        $lang = 'de';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'de');
    }

    public function indexFr($idCrypto = null, $country = null)
    {

        $lang = 'fr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'fr');
    }

    public function indexHi($idCrypto = null, $country = null)
    {

        $lang = 'hi';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'hi');
    }

    public function indexIt($idCrypto = null, $country = null)
    {

        $lang = 'it';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'it');
    }

    public function indexKr($idCrypto = null, $country = null)
    {

        $lang = 'kr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'kr');
    }

    public function indexPt($idCrypto = null, $country = null)
    {

        $lang = 'pt';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'pt');
    }

    public function indexRu($idCrypto = null, $country = null)
    {

        $lang = 'ru';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'ru');
    }

    public function indexSe($idCrypto = null, $country = null)
    {

        $lang = 'se';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'se');
    }

    public function indexTh($idCrypto = null, $country = null)
    {

        $lang = 'th';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->country($idCrypto, $country, 'th');
    }

    public function country($idCrypto = null, $country = null, $idioma){
        
        try {

            $idDivisa = null;
            $ip = $_SERVER['REMOTE_ADDR'];
            $records = \IP2LocationLaravel::get($ip);
            $countryIp = ucfirst(strtolower($records['countryName']));

            $pais = DB::table('countries')->where('name', $country)->where('idioma', $idioma)->pluck('name')->first();
            $bandera = DB::table('countries')->where('name', $country)->where('idioma', $idioma)->pluck('ico')->first();

            $reg = DB::table('landing_countries')->where('name', $country)->where('idioma', $idioma)->pluck('bandera')->first();
            
            
          

            $cod_iso2 = DB::table('countries')->where('name', $country)->where('idioma', $idioma)->pluck('cod_iso2')->first();
            $paisIp = DB::table('countries')->where('name', $countryIp)->where('idioma', $idioma)->pluck('name')->first();    
                 
            $cod_iso2Ip = DB::table('countries')->where('name', $countryIp)->where('idioma', $idioma)->pluck('cod_iso2')->first(); 
            
            if(!$pais){
                return view('errors.404');
            }
            /*foreach($paises as $pais){
                if($pais === $country){
                    return "si";
                }
            }*/

            if ($idCrypto == null) {
                $idCrypto = General::getCryptoDefault('BTC');
            } else {
                $idCrypto = General::getCryptoDefault($idCrypto);
            }

            if(session()->has('idDivisa')){
                $idDivisa = session('idDivisa');
            }else{
                session(['idDivisa' => '1']);
            }
            /*if ($idDivisa == null) {
                $idDivisa = General::getDivisaDefault();
            } else {
                $idDivisa = Currency::where('code', $idDivisa)->filtrado();
                $idDivisa = $idDivisa->id;  
            }*/
            $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
            $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        
            $select="en";

            if($idioma=="es"){
                $select="es";
            }

            $ToDIvisa = 'EUR';
            $toUsd = "USD";
            $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); 
            $getCryptos = Crypto::where('status', 1)->cryptos();
            $getCountry = DB::table('countries')->where('idioma', $select)->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');
            $limit_pay = PaymentLimit::where('id',1)->get();
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
                $meta['title'] = __('index.titlePaypal', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.descriptionPaypal', ['currency' => $getCurrencyUser->name]);
                $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

                $getCryptos = $getCryptos->pluck('name', 'code');
                $symbol = $getCurrencyUser->symbol;
                $paypal_state = PaypalGatewayLink::first();
                return view('landing.country', compact(
                    'meta',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
                    'default',
                    'getCountry',
                    'symbol',
                    'limit_pay',
                    'paypal_state',
                    'pais',
                    'countryIp',
                    'pricesCryptos',
                    'cod_iso2',
                    'paisIp',
                    'cod_iso2Ip',
                    'bandera',
                    'reg'
                ));
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function cryptoList($convers, $cryptoList)
    {
        // dd($cryptoList);
        $pricesSliders = array();
        foreach ($cryptoList as $value) {

            // Verificar aqui pasa algo

            if ($value['code'] != 'SILVER' && $value['code'] != 'USDC' && $value['code'] != 'ATOM') {
                if(isset($convers[$value['code']])){
                    $price = $convers[$value['code']];
                    $pricesSliders[] = [
                        "price" => number_format($price, 2, '.', ''),
                        "code" => $value['code'],
                       "img" => $value['img'],
                   ];
                } 
            }
        }
        return $pricesSliders;
    }
}
