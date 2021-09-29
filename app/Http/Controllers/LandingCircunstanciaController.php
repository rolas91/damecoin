<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Crypto;
use App\PaymentMethoState;
use App\Currency;
use General;
use DB;

use App\PaymentMethods;
use App\PaypalGatewayLink;
use App\PaymentLimit;

class LandingCircunstanciaController extends Controller
{

    public function indexEs($idCrypto = null, $circunstancia = null)
    {

        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexEn($idCrypto = null, $circunstancia = null)
    {
        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexAe($idCrypto = null, $circunstancia = null)
    {

        $lang = 'ae';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexCh($idCrypto = null, $circunstancia = null)
    {

        $lang = 'ch';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexCz($idCrypto = null, $circunstancia = null)
    {

        $lang = 'cz';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexDe($idCrypto = null, $circunstancia = null)
    {

        $lang = 'de';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexFr($idCrypto = null, $circunstancia = null)
    {

        $lang = 'fr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexHi($idCrypto = null, $circunstancia = null)
    {

        $lang = 'hi';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexIt($idCrypto = null, $circunstancia = null)
    {

        $lang = 'it';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexJp($idCrypto = null, $circunstancia = null)
    {

        $lang = 'jp';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }


    public function indexKr($idCrypto = null, $circunstancia = null)
    {

        $lang = 'kr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexPt($idCrypto = null, $circunstancia = null)
    {

        $lang = 'pt';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexRu($idCrypto = null, $circunstancia = null)
    {

        $lang = 'ru';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexSe($idCrypto = null, $circunstancia = null)
    {

        $lang = 'se';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }

    public function indexTh($idCrypto = null, $circunstancia = null)
    {

        $lang = 'th';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->Circunstancias($idCrypto, $circunstancia, $lang);
    }


    public function Circunstancias($idCrypto = null, $circunstancia = null,$idioma)
    // public function Circunstancias($idCrypto = null,  $idDivisa = null, $metodo = null, $lang = null, $pais=null)
    {
        try {
            $limit_pay        = PaymentLimit::where('id',1)->get();
            $idDivisa = null;
            $varCircunstancia = \App\Circumstance::where('slug', $circunstancia)
                                                    ->where('idioma', $idioma)
                                                    ->first();
            if(!$varCircunstancia){
                return view('errors.404');
            }

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

                //$default['conversor'] = General::getConverFromTo($toUsd, $ToDIvisa, $data->amount);
                $default['pay'] = number_format(($xxvalor), 2, '.', '');
                $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                $meta['title'] = __('index.titleCircunstancia', ['cripto' => $getCriptodefault->name, 'circunstancia' => $varCircunstancia->name]);
                $meta['descripcion'] = $varCircunstancia->description;

                $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

                $getCryptos = $getCryptos->pluck('name', 'code');
                $symbol = $getCurrencyUser->symbol;
                $recurly = true;
                // Return view with vars
                $fiat = self::CurrencyType($getCurrencyUser->code);
                return view('landing.circunstancia', compact(
                    'meta',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
                    'default',
                    'getCountry',
                    'symbol',
                    'recurly',
                    'pricesCryptos',
                    'fiat',
                    'paypal_state',
                    'varCircunstancia',
                    'limit_pay'
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
