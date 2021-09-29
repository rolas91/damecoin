<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use General;
use App\Crypto;
use App\Currency;
use DB;
use App\PaymentMethoState;
use App\PaymentMethods;
use App\PaymentLimit;
use App\PaypalGatewayLink;
use App\Http\Controllers\Conversor\ConversorController;

class MetodoController extends Controller
{

    public function indexEs($idCrypto = null, $idDivisa = null, $metodo = null)
    {
        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexEn($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexAe($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'ae';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }
    public function indexJp($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'jp';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexCh($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'ch';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexCz($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'cz';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexDe($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'de';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexFr($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'fr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexHi($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'hi';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexIt($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'it';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexKr($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'kr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexPt($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'pt';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexRu($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'ru';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexSe($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'se';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function indexTh($idCrypto = null, $idDivisa = null, $metodo = null)
    {

        $lang = 'th';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->metodo($idCrypto, $idDivisa,$metodo, 'en');
    }

    public function metodo($idCrypto = null,  $idDivisa = null, $metodo = null,$idioma){

        try {

            if($metodo == 'westerUnion')
            {
                $metodo = 'Western Union';
            }
            if($metodo == 'wechat'){
                $metodo = 'WeChat';
            }
            if($metodo =='alipay')  {
                $metodo = 'AliPay';
            } 

            $data = PaymentMethods::where('name',$metodo)->first(); 

            if(!$data){
                return view('errors.404');
            }

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

            $from = 'CNY';
            $limit = PaymentLimit::first();
            $to = $getCurrencyUser->code;

           

            $result = null;

            if($metodo == 'AliPay'){
                $conversor = new ConversorController();
                $result = $conversor->convertAlipay($limit, $from, $to);                
            }
            if($metodo == 'WeChat'){
                $conversor = new ConversorController();
                $result = $conversor->convertWechat($limit, $from, $to);
            }
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
                
                $default['conversor'] = General::getConverFromTo($toUsd, $ToDIvisa, $data->amount);
                $default['pay'] = number_format(($xxvalor), 2, '.', '');
                $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');
                
                $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos             
                $resultData = $this->returnTitleAndDescription(strtolower($metodo));
                $meta['key'] = __('index.key');
                $meta['title'] = __($resultData['title'], ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
                $meta['descripcion'] = __($resultData['description'], ['currency' => $getCurrencyUser->name]);
                $getCryptos = $getCryptos->pluck('name', 'code');
                $symbol = $getCurrencyUser->symbol;
            
                $paypal_state = PaypalGatewayLink::first();
                return view('landing.metodo', compact(
                    'data',
                    'meta',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
                    'default',
                    'getCountry',
                    'metodo',
                    'symbol',
                    'limit_pay',
                    'paypal_state',
                    'pricesCryptos',
                    'result'
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

    public function returnTitleAndDescription($metodo)
    {
        $data = null;

        if($metodo == 'paypal'){
            $data = [
                'title' => 'index.titlePaypal',
                'description' => 'index.descriptionPaypal'
            ];
        }

        if($metodo == 'skrill'){
            $data = [
                'title' => 'index.titleSkrill',
                'description' => 'index.descriptionSkrill'
            ];
        }

        if($metodo == 'bizum'){
            $data = [
                'title' => 'index.titleBizum',
                'description' => 'index.descriptionBizum'
            ];
        }

        if($metodo == 'western union'){
            $data = [
                'title' => 'index.titleWester',
                'description' => 'index.descriptionWester'
            ];
        }
        // En esta uso la description de paypal porque estuve viendo y dicen lo mismo, 
        // para evitar traducir lo mismo en distinta variable.
        if($metodo == 'wechat'){
            $data = [
                'title' => 'index.titleWeChat',
                'description' => 'index.descriptionPaypal'
            ];
        }

        if($metodo == 'wechatpay'){
            $data = [
                'title' => 'index.titlePaypal',
                'description' => 'index.descriptionPaypal'
            ];
        }if($metodo == 'alipay'){
            $data = [
                'title' => 'index.titleAliPay',
                'description' => 'index.descriptionPaypal'
            ];
        }

        return $data;
    }
    
}
