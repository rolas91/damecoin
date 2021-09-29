<?php

namespace App\Http\Controllers\Landing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\Crypto;
use App\PaymentMethoState;
use App\Currency;
use General;
use DB;
use App\PaypalGatewayLink;

use App\PaymentMethods;
use App\PaymentLimit;

class ConverterController extends Controller
{
    public function indexEs($idCrypto = null, $idDivisa = null)
    {

        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexEn($idCrypto = null, $idDivisa = null)
    {

        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }
    public function indexJp($idCrypto = null, $idDivisa = null)
    {

        $lang = 'jp';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexAe($idCrypto = null, $idDivisa = null)
    {

        $lang = 'ae';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexCh($idCrypto = null, $idDivisa = null)
    {

        $lang = 'ch';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexCz($idCrypto = null, $idDivisa = null)
    {

        $lang = 'cz';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexDe($idCrypto = null, $idDivisa = null)
    {

        $lang = 'de';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexFr($idCrypto = null, $idDivisa = null)
    {

        $lang = 'fr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexHi($idCrypto = null, $idDivisa = null)
    {

        $lang = 'hi';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexIt($idCrypto = null, $idDivisa = null)
    {

        $lang = 'it';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexKr($idCrypto = null, $idDivisa = null)
    {

        $lang = 'kr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexPt($idCrypto = null, $idDivisa = null)
    {

        $lang = 'pt';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexRu($idCrypto = null, $idDivisa = null)
    {

        $lang = 'ru';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexSe($idCrypto = null, $idDivisa = null)
    {

        $lang = 'se';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }

    public function indexTh($idCrypto = null, $idDivisa = null)
    {

        $lang = 'th';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->LandingConvert($idCrypto, $idDivisa, 'en');
    }
    
    public function LandingConvert($idCrypto = null,  $idDivisa = null,$idioma)
    {
        try {
           
           // return $idDivisa;
            $getCriptodefault = Crypto::where('code', $idCrypto)->first();
            $getCurrencyUser = Currency::where('code', $idDivisa)->first();

    
            $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); //Currency::lists('name', 'id');
            $getCryptos = Crypto::where('status', 1)->cryptos();
            $getCountry = DB::table('countries')->where('idioma', $idioma)->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');
            
            $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

           
            $data = PaymentMethods::all(); 
            
            if ($getConversNew) {

               $getConvers = $getConversNew[$getCriptodefault->code];
               
                $getPanel = General::newGetPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
                $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
                $getConvers = number_format($getConvers, 2, '.', '');
                $default['cryptox'] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
                $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
                $xxvalor1 = General::getDescuentoSinComision($xxvalor, $getCriptodefault->maker_fee);
                
            
               // $default['conversor'] = General::getConverFromTo($toUsd, $ToDIvisa, $data[0]->amount);
                $default['pay'] = number_format(($xxvalor), 2, '.', '');
                $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                $meta['title'] = __('index.titleConvert', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.descriptionConvert', ['currency' => $getCurrencyUser->name]);
                
                
                

                $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

                $getCryptos = $getCryptos->pluck('name', 'code');
                $symbol = $getCurrencyUser->symbol;
                $paypal_state = PaypalGatewayLink::first();
                return view('landing.converttem',compact(
                    'getCriptodefault',
                    'getCryptos',
                    'getCountry',
                    'getCurrencies',
                    'paypal_state',
                    'getConvers',
                    'data',
                    'getPanel',
                    'meta',
                    'default',
                    'getCurrencyUser',)
                );
             
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function convert($crypto = null, $currency = null, $defaultCrypto, $defaultCurrency)
    {
        try {
            
            if($crypto == null)
            {
                $idrypto = General::getCryptoDefault($defaultCrypto);
            }else{
                $idrypto = General::getCryptoDefault(strtoupper($defaultCrypto));
            }
    
            if($defaultCurrency == null)
            {
                $iddivisa = General::getDivisaDefault();
            }else{
                $idivisa = Currency::where('code', $defaultCurrency)->filtrado();
                $iddivisa = $idivisa->id;
            }
            $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); //Currency::lists('name', 'id');
            
            $getCryptos = Crypto::where('status', 1)->cryptos();

            $getCriptodefault = Crypto::where('id', $idrypto)->filtrado();
    
            $getCurrencyUser = Currency::where('id', $iddivisa)->filtrado();
        
            $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito,$getCriptodefault->maker_fee);
        
            $xxvalor = $getCurrencyUser->detailCurrency->max_deposito*2;
            
            $xxvalor1 = General::getDescuentoSinComision($xxvalor,$getCriptodefault->maker_fee);
            $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);
            $getConvers = $getConversNew[$getCriptodefault->code];
                    
            $default["cryptox"] = number_format(($defaultValor/$getConvers), 7, '.', '');
            $default["pagar"] = number_format(($xxvalor), 2, '.', '');
            $default["recibe"] = number_format(($xxvalor1/$getConvers), 7, '.', '');
    
            return $default;

        } catch (\Throwable $th) {
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
