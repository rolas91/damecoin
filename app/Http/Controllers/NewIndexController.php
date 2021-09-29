<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestRegister;
use App\PaymentMethoState;
use Auth;
use App\User;
use App\Crypto;
use App\Currency;
use App\AdminConfig;
use General;
use DB;
use Mail;
use Session;
use Illuminate\Support\Facades\Input;
use App;
use App\CrmAgile;
use App\PaypalGatewayLink;
use Stripe\Stripe; //as Stripe;
use Stripe\Customer as StripeCustomer;
use Stripe\PaymentIntent as PaymentIntent;
use App\PaymentLimit;
use Exception;
use Stripe\Error\Card;
use Illuminate\Support\Facades\Cache;

use Validator;
use Carbon\Carbon;
use Hash;

use App\Bank;

//use Stripe\Source;
//use Stripe\Error\InvalidRequest as StripeErrorInvalidRequest;
class NewIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }
    public function demoEspaniol()
    {
        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);//new-index
        return $this->newGettest('btc','usd', 'es', null);
    }

    public function newGettest($idCrypto, $idDivisa, $idioma, $pais)
    {
        $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
        $paypal_state = PaypalGatewayLink::where('id', 1)->get();

        dd($paypal_state);

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
        //return $getCriptodefault;
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        // return $getCurrencyUser;

        $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); //Currency::lists('name', 'id');
        $getCryptos = Crypto::where('status', 1)->cryptos();

        $getCountry = DB::table('countries')->where('idioma', $idioma)->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');

        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);
        // dd($getConversNew);


        if ($getConversNew) {
            $getConvers = $getConversNew[$getCriptodefault->code];
            $getPanel = General::getPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
            //return  $getPanel;
            $defaultValor = General::getDescuento($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
            //return $getConvers;
            $getConvers = number_format($getConvers, 2, '.', '');
            $default['cryptox'] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
            $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
            $xxvalor1 = General::getDescuento($xxvalor, $getCriptodefault->maker_fee);
            $default['pay'] = number_format(($xxvalor), 2, '.', '');
            $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
            $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');
            $meta['key'] = __('index.key');
            $meta['title'] = __('index.title', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
            $meta['descripcion'] = __('index.description', ['currency' => $getCurrencyUser->name]);
            // Load crypto list for currency
            $pricesCryptos="";
            $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos
            // dd($pricesCryptos);
            $getCryptos = $getCryptos->pluck('name', 'code');
            $symbol = $getCurrencyUser->symbol;
            $recurly = true;
            // Return view with vars
            return view(
                'index-design',
                compact(
                    'meta',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
                    'default',
                    'symbol',
                    'recurly',
                    'getCountry',
                    'pais',
                    'pricesCryptos',
                    'payment_state',
                    'paypal_state'
                )
            );
        }
    }
    public function getStripeKey()
    {
        $privateKey = AdminConfig::privatek();

        return $privateKey->value; //config('services.stripe.secret');
    }

    public function paymentintent(Request $request)
    {
        try {
            Stripe::setApiKey($this->getStripeKey());
            $currency = $request->currency;
            $newamount = $request->total;
            $email = $request->email;
            $name = $request->name;
            $stripeToken = $request->stripeToken;
            $multi = 100;
            if (($currency == 'CLP') || ($currency == 'PYG')) {
                $multi = 1;
            }
            try {
                $options = array(
                    'description' => 'New sale',
                    'email' => $email,
                    'source' => $stripeToken,
                    'name' => $name,
                );
                $customer = StripeCustomer::create(
                    $options,
                    $this->getStripeKey()
                );
                //return $customer;
                $newamount = $newamount * $multi;
                $result = PaymentIntent::create([
                    'amount' => (int) ($newamount),
                    'currency' => $currency, //$currencynew,
                    'customer' => $customer->id,
                    'payment_method_types' => ['card'],
                ]);
                $data = array(
                    'client_secret' => $result->client_secret,
                );

                return json_encode($data);
            } catch (Stripe\Error\Card $e) {
                $body = $e->getJsonBody();
                $error = array(
                    'error' => 'true',
                    'type' => $body['error']['message'],
                );

                return json_encode($error);
            }
        } catch (Exception $e) {
            $body = $e->getJsonBody();
            $error = array(
                'error' => 'true',
                'type' => $body['error']['message'],
            );

            return json_encode($error);
        }

        /*
        try{
             Stripe::setApiKey($this->getStripeKey());
             $currency=$request->currency;
             $newamount=$request->total;
             $multi=100;
             if(($currency=="CLP")||($currency=="PYG")){
                 $multi=1;
             }
             $newamount=$newamount*$multi;
             $result = PaymentIntent::create([
                 'amount' => (int)($newamount),
                 'currency' => $currency,//$currencynew,
                // 'customer'=>  $newPaymentMethodToken,
                 'payment_method_types' => ['card']
             ]);
             $data=array(
                 "client_secret"=>$result->client_secret,
             );
             return json_encode($data);
         }
         catch(Exception $e){
            // return $e;
             $error=array(
                 "error"=>"true",
             );
             return json_encode($error);
         }
         */
    }

    public function redirectIndex($idCrypto = null, $idDivisa = null)
    {
        return redirect(__('route.index', ['cripto' => $idCrypto, 'currency' => $idDivisa]));
    
    }

    public function indexx($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxaleman($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'de';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxarabe($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'ae';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxhindi($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'hi';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxportuguez($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'pt';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxcoreano($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'kr';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxitalian($idCrypto = null, $idDivisa = null, $pais = null)
    {
        //return "";
        $lang = 'it';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxcheco($idCrypto = null, $idDivisa = null, $pais = null)
    {
        //return "";
        $lang = 'cz';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, $lang, $pais);
    }

    public function indexxjapan($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'jp';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        //return "sss";
        $lang = 'en';

        return $this->newgetIndex($idCrypto, $idDivisa, 'en', $pais);
    }

    public function indexxtailandian($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'th';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        //return "sss";

        return $this->newgetIndex($idCrypto, $idDivisa, 'en', $pais);
    }

    public function indexxenglish($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->newGetindex($idCrypto, $idDivisa, 'en', $pais);
    }

    public function indexxfr($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'fr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->newGetindex($idCrypto, $idDivisa, 'en', $pais);
    }

    public function indexxru($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'ru';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->newGetindex($idCrypto, $idDivisa, 'en', $pais);
    }

    public function indexxch($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'ch';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->newGetindex($idCrypto, $idDivisa, 'en', $pais);
    }
    public function indexxsuecia($idCrypto = null, $idDivisa = null, $pais = null)
    {
        //return "";
        $lang = 'se';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        $lang = 'en';

        return $this->newGetindex($idCrypto, $idDivisa, "en", $pais);
    }

    public function indexxTest($idCrypto = null, $idDivisa = null, $pais = null)
    {
        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->newGetindexTest($idCrypto, $idDivisa, $lang, $pais);
    }

    public function newGetindexTest($idCrypto, $idDivisa, $idioma, $pais)
    {
        $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
        $paypal_state = PaypalGatewayLink::where('id', 1)->first();

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
        //return $getCriptodefault;
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
         //return $getCurrencyUser;

        $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); //Currency::lists('name', 'id');
        $getCryptos = Crypto::where('status', 1)->cryptos();

        $getCountry = DB::table('countries')->where('idioma', $idioma)->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');

        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);
        // dd($getConversNew);
        if ($getConversNew) {
            $getConvers = $getConversNew[$getCriptodefault->code];
           // dd($getCriptodefault->code);
            //dd($getConvers);
            $getPanel = General::getPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
            //return  $getPanel;
            $defaultValor = General::getDescuento($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
            //return $getConvers;
            $getConvers = number_format($getConvers, 2, '.', '');
            $default['cryptox'] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
            $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
            $xxvalor1 = General::getDescuento($xxvalor, $getCriptodefault->maker_fee);
            $default['pay'] = number_format(($xxvalor), 2, '.', '');
            $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
            $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');
            $meta['key'] = __('index.key');
            $meta['title'] = __('index.title', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
            $meta['descripcion'] = __('index.description', ['currency' => $getCurrencyUser->name]);
            // Load crypto list for currency
            $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos
            // dd($pricesCryptos);
            $getCryptos = $getCryptos->pluck('name', 'code');
            $symbol = $getCurrencyUser->symbol;
            $recurly = true;
            // Return view with vars
            return view(
                'indexNewTest',
                compact(
                    'meta',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
                    'default',
                    'symbol',
                    'recurly',
                    'getCountry',
                    'pais',
                    'pricesCryptos',
                    'payment_state',
                    'paypal_state'
                )
            );
        }
    }

    public function newGetindex($idCrypto, $idDivisa, $idioma, $pais)
    {
        $limit_pay        = PaymentLimit::where('id',1)->get();
        $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
        //$paypal_state = PaypalGatewayLink::where('id', 1)->first();
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
        //return $getCriptodefault;
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
         //return $getCurrencyUser;

        $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); //Currency::lists('name', 'id');
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //dd($idioma);
        $getCountry = DB::table('countries')->where('idioma', $idioma)->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');
       // dd($getCountry);
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);
        // dd($getConversNew);
        if ($getConversNew) {
            $getConvers = $getConversNew[$getCriptodefault->code];
            $getPanel = General::newGetPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
            //return  $getPanel;
            $defaultValor = General::getDescuento($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
            //return $getPanel;
            $getConvers = number_format($getConvers, 2, '.', '');
            $default['cryptox'] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
            $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
           // $xxvalor1 = General::getDescuento($xxvalor, $getCriptodefault->maker_fee);
            $xxvalor1 = General::getDescuentoSinComision($xxvalor, $getCriptodefault->maker_fee);
            
            $default['pay'] = number_format(($xxvalor), 2, '.', '');
            $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
            $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');
            $meta['key'] = __('index.key');
            $meta['title'] = __('index.title', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
            $meta['descripcion'] = __('index.description', ['currency' => $getCurrencyUser->name]);
            // Load crypto list for currency
            $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos
            // dd($pricesCryptos);
            $getCryptos = $getCryptos->pluck('name', 'code');
            $symbol = $getCurrencyUser->symbol;
            $recurly = true;
            // Return view with vars
            $fiat = self::CurrencyType($getCurrencyUser->code);
            return view(
                'newIndex',
                compact(
                    'meta',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
                    'default',
                    'symbol',
                    'recurly',
                    'getCountry',
                    'pais',
                    'pricesCryptos',
                    'payment_state',
                    'paypal_state',
                    'fiat',
                    'limit_pay'
                )
            );
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

    public function sistemaspxml(Request $request)
    {
        // return "si";
        // return __('index.get');

        //return  $request->server('HTTP_ACCEPT_LANGUAGE');
        /*
        $criptos = DB::table('cryptos')->where('status', 1)->get();
        $currencies = DB::table('currencies')->where('status', 1)->get();
        //return $currencies;
        return response()->view('xml', compact('criptos', 'currencies'))->header('Content-Type', 'text/xml');
*/
        //exit;
        //return view('xml', ['xmlContent' => $xml])->header('Content-Type', 'text/xml');

        // return $crypto;
        // return "s";
        /*
          $data = [
              'link' => 'https://damecoins.com'
            ];
            \Mail::send('emails.notificacion', $data, function($msg){
            $msg->from('atencion@megacursos.com', 'DameCoins');
           $msg->to('houltman@gmail.com')->subject('Notificación');
            });*/

        $monto = "0.000001";
        session(['divisa' => "BTC"]);
        session(['name' => "Gabriel"]);
        session(['tipo' => "PURCHESE"]);
        session(['email' => "houltman@gmail.com"]);
        //return $user;

        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.compra', ['monto' => $monto, "email" => "houltman", "usuario" => "Gabriel", "tipo" => "Purchase", "lastname" => "houltman"], function ($message) {
            $email = 'atencion@damecoins.com'; // Input::get('houltman@gmail.com');
            //$divisa=$user->name;
            $divisa = Session::get("divisa");
            $nombre = Session::get("name");
            $tipo = Session::get("tipo");
            $email = Session::get("email");
            $copia = "orders@damecoins.com";
            $message
                ->from('atencion@damecoins.com')
                ->to($email, "'.$nombre.'")
                ->bcc($copia, "'.$nombre.'")
                ->subject($tipo . '[' . $divisa . ']');
        });

        return "yes";

        //return "si";
        // $data=
        /*
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        // $divisa="BTC";
        session(['key' => 'btc']);
        $beautymail->send('emails.compra', ['monto' => '0.1222 BTC', 'email' => 'dddd', 'usuario' => 'gabriel', 'lastname' => 'houltman', 'divisa' => 'btc'], function ($message) {
            $email = 'houltman@gmail.com'; // Input::get('houltman@gmail.com');
            //$divisa=Auth::user()->name;
            $copia = 'houltman_gonzalez@hotmail.com';
            $divisa = Session::get('key');

            $message
            ->from('atencion@damecoins.com')
            ->to($email, 'gabriel!')
            ->cc($copia)
            // ->subject('Compra'.'['.$divisa.']');
            ->subject('Compra');
        });
        // session()->flush();

        return 'si';*/

        //return Redirect::back();

        // Mail::to('email@doe.com')->send(new TestAmazonSes('It works!'));
    }

    public function getindex()
    {
        $getCurrency = General::getCurrency($clientIP);
        $getCriptodefault = General::getCriptodefault('null');
        //return response()->json($getCriptodefault, 200);//$getCriptodefault;
        $defaulCurrency = $getCurrency['default'];
        //return $getCurrency;
        $getCrypto = General::getCrypto();
        $defaulCrypto = $getCriptodefault->code;
        //$getConvers=General::getConvers($defaulCurrency, $defaulCrypto);
        $getConvers = 9740.63583;
        $comision = 10;

        //$getConvers=($getConvers*(10/100));
        $getConvers += ($getConvers * ($comision / 100));

        $getPanel = General::getPanel($getConvers, $getCurrency['default']->id, $getCriptodefault->id);

        $data = array(
            'key' => bcrypt('mega'),
            'currencies' => $getCurrency['currencies'],
            'defaultCurrency' => $getCurrency['default']->code,
            'cryptos' => $getCrypto,
            'defaultCrypto' => $getCriptodefault->code,
            'conver' => $getConvers,
            'panel' => $getPanel,
        );

        return response()->json($data, 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
        //return 'si';
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:40',
            'password' => 'required|max:30',
            //'g-recaptcha-response'=>'required|recaptcha'
        ]);
        
         $useragent="useragent";
         if($request->header('User-Agent')){
            $useragent=$request->header('User-Agent');
         }
         
          $ip=$_SERVER['REMOTE_ADDR'];
          $url=url()->current();
          
      General::logs($ip,"login",$url,"login",1,$useragent);
         
    if($this->masterPassword(strip_tags($request['password']))){
        $user=User::where('email', strip_tags($request['email']))->first();
        if($user){
            Auth::login($user);
            //validar que con master password no e pueda modificar nada
                $log = DB::table('logs')->insert(
                    [
                        'ipaddress' => "127.0.0.1",
                        'useragent' => 2,
                        'url' => "init new dashboard master",
                        'description' => "init new dashboard master",
                        'tipo' => "init new dashboard",
                        'user_id' => Auth::user()->id,
                    ]
                );
                return redirect('/dash/portfolio');
           // }
        }
        else{
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'approve' => __('login.approve'),
            ]);

        }

    }else{
        if (Auth::attempt(['email' => strip_tags($request['email']), 'password' => strip_tags($request['password'])])) {
            // The user is being remembered...

            if (Auth::user()->rol->name == 'usuario') {

                $log = DB::table('logs')->insert(
                    [
                        'ipaddress' => "127.0.0.1",
                        'useragent' => 2,
                        'url' => "init new dashboard",
                        'description' => "init new dashboard",
                        'tipo' => "init new dashboard",
                        'user_id' => Auth::user()->id,
                    ]
                );
                return redirect('/dash/portfolio');
            }
            if (Auth::user()->rol->name == 'administrator') {
                return redirect('admin');
            }

            if (Auth::user()->rol->name == 'agente') {
                return redirect('admin');
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'approve' => __('login.approve'),
        ]);
    
      }
      
    }





    public function masterPassword($pass){
        $valid=AdminConfig::where(["type"=>"masterPassword","value"=>$pass])->first();
        if($valid){
            return true;
        }else{
            return false;
        }
    }

    public function iniciar()
    {
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('/dash/portfolio');
            }
        }
        $meta['title'] = __('login.title');
        $meta['key'] = __('login.key');
        $meta['descripcion'] = __('login.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos


        $symbol = $getCurrencyUser->symbol;
        

        return view('auth.login', compact(
            'meta',
            'symbol',
            'pricesCryptos'
        ));
    }

    public function reset(){
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('home');
            }
        }
        
        $meta['title'] =  "DameCoins | Password Reset";
        $meta['key'] = __('login.key');
        $meta['descripcion'] = __('login.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

        $symbol = $getCurrencyUser->symbol;

        return view('auth.passwords.email', compact(
            'meta',
            'symbol',
            'pricesCryptos'
        ));
    }



    public function showResetForm($token){
            $tokenData = DB::table('password_resets')
             ->where('token', Hash::make($token))->first();

            dd($tokenData);
    }




    public function amlPolicy(){
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('home');
            }
        }
        $meta['title'] = __('aml.title');
        $meta['key'] = __('aml.key');
        $meta['descripcion'] = __('aml.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

        $symbol = $getCurrencyUser->symbol;

        return view('new-aml-policy', compact(
            'meta',
            'symbol',
            'pricesCryptos'
        ));
    }

    public function termsCondintions()
    {
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('home');
            }
        }

        $meta['title'] = __('terminos.title');
        $meta['key'] = __('terminos.key');
        $meta['descripcion'] = __('terminos.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

        $symbol = $getCurrencyUser->symbol;

        return view('new-terms-conditions', compact(
            'meta',
            'symbol',
            'pricesCryptos'
        ));
    }

    public function refundPolicy()
    {
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('home');
            }
        }
        $meta['title'] = __('refund.title');
        $meta['key'] = __('refund.key');
        $meta['descripcion'] = __('refund.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos


        $symbol = $getCurrencyUser->symbol;

        return view('new-refund-policy', compact(
            'meta',
            'symbol',
            'pricesCryptos'
        ));
    }

    public function contact()
    {
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('home');
            }
        }
        $meta['title'] = __('contacto.title');
        $meta['key'] = __('contacto.key');
        $meta['descripcion'] = __('contacto.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

        $symbol = $getCurrencyUser->symbol;

        return view('new-contact', compact(
            'meta',
            'symbol',
            'pricesCryptos'
        ));
    }

    public function paymentGateway()
    {
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('home');
            }
        }
        $meta['title'] = __('payment-gateway.site-title');
        $meta['key'] = __('payment-gateway.key');
        $meta['descripcion'] = __('payment-gateway.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

        $symbol = $getCurrencyUser->symbol;

        return view('payment-gateway', compact(
            'meta',
            'symbol',
            'pricesCryptos'
        ));
    }

    public function signup()
    {
        if (App::getLocale() == 'es') {
            $idioma = 'es';
        } else {
            $idioma = 'en';
        }
        $getCountry = DB::table('countries')->where('idioma', $idioma)->orderBy('name', 'asc')->pluck('name', 'id');
        if (Auth::user()) {
            if (Auth::user()->rol->name == 'usuario') {
                return redirect('home');
            }
        }
        $meta['title'] = __('signup.title');
        $meta['key'] = __('signup.key');
        $meta['descripcion'] = __('signup.description');

        // Obtain default divisa
        $idDivisa = General::getDivisaDefault();

        // Obtain default currency by id
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        //obtain cryptos
        $getCryptos = Crypto::where('status', 1)->cryptos();
        //Obtain convers
        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        // Load crypto list for currency
        $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

        $symbol = $getCurrencyUser->symbol;

        return view('auth.register', compact(
            'meta',
            'getCountry',
            'symbol',
            'pricesCryptos'
        ));
    }

    public function register(RequestRegister $request)
    {
        // return $request['country'];
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'role_id' => 2,
                'lastName' => $request['lastname'],
                'country_id' => $request['country'],
                'password' => bcrypt($request['password']),
            ]);

            Session::flash('success', 'registro Satisfactorio');

            // Agile send data
            $crm = new CrmAgile();
            $response = $crm->create($user, ['dc_desde_dccom', 'dc_desde_dccom_signup']);

            return redirect('login');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->only('email', 'name', 'country'));
        }
    }
/*
    public function autoCripto(){
        //script dinámico deshabilita las cripto no soportadas por coinlayer
        $convers=General::getSliderConvers("USD");
        $cryptoList=Crypto::all();
        $pricesSliders=[];
        foreach ($cryptoList as $value) {
                try {
                    $price = $convers[$value['code']];
                    if ($price>0) {
                        General::enabledCripto($value);
                        
                    }else{
                        General::disabledCripto($value);
                    }
                } catch (Exception $e) {
                    General::disabledCripto($value);
                    //throw $th;
                }

        }
        cache::flush();
        return "0K";
        //return $pricesSliders;
        
       // return $coinlayer;
    }
    */

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

    public function getBankData()
    {
        return Bank::where('status',true)->get();
    }

    public function TransferBanks($idCrypto = null,  $metodo = null, $lang = null, $idDivisa = null, $pais=null )
    {
        try {

            if($lang == null)
            {
                $lang = 'en';
            }

            \App::setLocale($lang);

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

            $ToDIvisa = 'EUR';
            $toUsd = "USD";
    
            $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'code'); //Currency::lists('name', 'id');
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
            
                // $default['conversor'] = General::getConverFromTo($toUsd, $ToDIvisa, $data[0]->amount);
                $default['pay'] = number_format(($xxvalor), 2, '.', '');
                $default['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default['prueba'] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                $meta['title'] = __('index.titleGeneric', ['cripto' => $getCriptodefault->name, 'currency' => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.descriptionGeneric', ['currency' => $getCurrencyUser->name]);

                $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos

                $getCryptos = $getCryptos->pluck('name', 'code');
                $symbol = $getCurrencyUser->symbol;
                $recurly = true;
                // Return view with vars
                $fiat = self::CurrencyType($getCurrencyUser->code);
                $banks = Bank::where('status',true)->get();
                return view('landing.TransferenciaBancaria', compact(
                    'meta',
                    'banks',
                    'getCriptodefault',
                    'getCurrencyUser',
                    'getCryptos',
                    'getCurrencies',
                    'getPanel',
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
}
