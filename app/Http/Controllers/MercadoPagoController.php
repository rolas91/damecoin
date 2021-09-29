<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\AdminConfig;
use App\Country;
use App\Crypto;
use App\CryptoWallet;
use App\CryptoWalletPyment;
use App\CryptoWalletWallet;
use App\Currency;
use App\Payment;
use App\PaymentLimit;
use App\PaymentMethoState;
use App\PaymentWallTransaction;
use App\PaypalGatewayLink;
use App\User;
use App\Wallet;
use Auth;
use DB;
use App\Bank;
use Exception;
use General;
use Redirect;
use Session;

class MercadoPagoController extends Controller
{
    
    public function index($metodo, $idCrypto = null, $idDivisa = null){
        $limit_pay        = PaymentLimit::where('id',1)->get();
        $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
        $paypal_state = PaypalGatewayLink::first();

        $metodoSearch = \DB::table('mercadopago')->where('slug', $metodo)->first();
        if(!$metodoSearch){
            return view('errors.404');
        }

        $nameMetodo = $metodoSearch->nombre;

        $email = Auth::user()->email;
        $email = explode("@", $email);
        $concept = substr($email[0], 0, 8);
        $default = Currency::find($idDivisa); 
        $banks = Bank::where("status",1)->get(); 
        $paymentLimit = PaymentLimit::where('id','>=',1)->first();
        $limit = $paymentLimit['bank_deposit_minimum'];
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $validaBuyStripe="false";
        $validaBuyStripe=General::validaBuyStripe(Auth::user()->id,$clientIP);
        $getCriptodefault = Crypto::where('id', $idCrypto)->first();
        $getCurrencyUser = Currency::where('id', $idDivisa)->first();
        $getCurrencies = DB::table('currencies')->pluck('name', 'id'); //Currency::lists('name', 'id');
        $getCountry = DB::table('countries')->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');
        $getCryptos= Crypto::where('status', 1)->cryptos();
        $getCryptos= $getCryptos->pluck('name', 'id');
        $totalCrypto=0;
        $where = "deposit";
        $getTotalDivisa = General::getCryptoWalettUser($idDivisa);
        $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        if ($getConvers) {
            if ($getConvers>0) {
                $getPanel = General::getPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
                $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
                $default["cryptox"] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
                $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
                $xxvalor1 = General::getDescuento($xxvalor, $getCriptodefault->maker_fee);
                $default["pay"] = number_format(($xxvalor), 2, '.', '');
                $default["recibe"] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default["prueba"] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                $meta['title'] = __('index.title_mp', ["cripto" => $getCriptodefault->name, "currency" => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.description_new_mp', ["currency" => $getCurrencyUser->name]);
                
                return view('home_usuario.comprar_test_mp', compact('getCriptodefault', 'getCountry','getCurrencyUser', 'getCryptos', 'getCurrencies', 'totalCrypto', 'getTotalDivisa', 'getPanel', 'default', 'meta', 'payment_state', 'paypal_state','paymentLimit','banks','concept','limit','validaBuyStripe', 'where', 'limit_pay', 'nameMetodo', 'metodo'));
            }else{
               
                General::logs("127.0.0.1","error","buy","crypto_not_found",Auth::user()->id,"useragent");
                Session::flash('error', __('home_buy.crypto_not_found'));
               // $disableCripto=General::disabledCripto($getCriptodefault);
                return redirect("/home");
            }
        }else{
            General::logs("127.0.0.1","error","buy","crypto_not_found",Auth::user()->id,"useragent");
            Session::flash('error', __('home_buy.crypto_not_found'));
           // $disableCripto=General::disabledCripto($getCriptodefault);
            return redirect("/home");
        }
        
        return view('home_usuario.comprar_test_mp', compact('default', 'getCurrencyUser', 'where'));

 
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

    public function indexBuy($metodo, $idCrypto = null, $idDivisa = null){
        $payment_state = PaymentMethoState::where('payment_method', 'mercadopago')->first();
        $limit_pay        = PaymentLimit::where('id',1)->get();
        $paypal_state = PaypalGatewayLink::first();

        $metodoSearch = \DB::table('mercadopago')->where('slug', $metodo)->first();
        if(!$metodoSearch){
            return view('errors.404');
        }

        $nameMetodo = $metodoSearch->nombre;

        $email = Auth::user()->email;
        $email = explode("@", $email);
        $concept = substr($email[0], 0, 8);
        $default = Currency::find($idDivisa); 
        $banks = Bank::where("status",1)->get(); 
        $paymentLimit = PaymentLimit::where('id','>=',1)->first();
        $limit = $paymentLimit['bank_deposit_minimum'];
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $validaBuyStripe="false";
        $validaBuyStripe=General::validaBuyStripe(Auth::user()->id,$clientIP);
        $getCriptodefault = Crypto::where('id', $idCrypto)->first();
        $getCurrencyUser = Currency::where('id', $idDivisa)->first();
        $getCurrencies = DB::table('currencies')->pluck('name', 'id'); //Currency::lists('name', 'id');
        $getCountry = DB::table('countries')->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');
        $getCryptos= Crypto::where('status', 1)->cryptos();
        $getCryptos= $getCryptos->pluck('name', 'id');

        $getConversNew = General::getConversNew($getCurrencyUser->code, $getCryptos);

        $totalCrypto=0;
        $where = "buy";
        $getTotalDivisa = General::getCryptoWalettUser($idDivisa);
        $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        if ($getConvers) {
            if ($getConvers>0) {
                $getPanel = General::getPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
                $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
                $default["cryptox"] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
                $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
                $xxvalor1 = General::getDescuento($xxvalor, $getCriptodefault->maker_fee);
                $default["pay"] = number_format(($xxvalor), 2, '.', '');
                $default["recibe"] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default["prueba"] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                $meta['title'] = __('index.title_mp', ["cripto" => $getCriptodefault->name, "currency" => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.description_new_mp', ["currency" => $getCurrencyUser->name]);
                
                return view('home_usuario.comprar_test_buy_mp', compact('getCriptodefault', 'getCountry','getCurrencyUser', 'getCryptos', 'getCurrencies', 'totalCrypto', 'getTotalDivisa', 'getPanel', 'default', 'meta', 'payment_state', 'paypal_state','paymentLimit','banks','concept','limit','validaBuyStripe', 'where', 'limit_pay', 'nameMetodo', 'metodo'));
            }else{
               
                General::logs("127.0.0.1","error","buy","crypto_not_found",Auth::user()->id,"useragent");
                Session::flash('error', __('home_buy.crypto_not_found'));
               // $disableCripto=General::disabledCripto($getCriptodefault);
                return redirect("/home");
            }
        }else{
            General::logs("127.0.0.1","error","buy","crypto_not_found",Auth::user()->id,"useragent");
            Session::flash('error', __('home_buy.crypto_not_found'));
           // $disableCripto=General::disabledCripto($getCriptodefault);
            return redirect("/home");
        }
        return view('home_usuario.comprar_test_buy_mp', compact('default', 'getCurrencyUser', 'where'));

        /*$preference = new \MercadoPago\Preference();
        // Crea un ítem en la preferencia
        $item = new \MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 90;

        $preference->items = array($item);
        $preference->save();

        $preference->back_urls = array(
            "success" => "https://damecoins.com/success",
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );

        return view('mercadopago', compact('preference'));*/
    }

    public function indexMainEn($idCrypto = null, $metodo)
    {
        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainEs($idCrypto = null, $metodo)
    {
        $lang = 'es';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainaleman($idCrypto = null, $metodo)
    {
        $lang = 'de';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainarabe($idCrypto = null, $metodo)
    {
        $lang = 'ae';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainhindi($idCrypto = null, $metodo)
    {
        $lang = 'hi';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainportuguez($idCrypto = null, $metodo)
    {
        $lang = 'pt';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMaincoreano($idCrypto = null, $metodo)
    {
        $lang = 'kr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainitalian($idCrypto = null, $metodo)
    {
        //return "";
        $lang = 'it';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMaincheco($idCrypto = null, $metodo)
    {
        //return "";
        $lang = 'cz';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainjapan($idCrypto = null, $metodo)
    {
        $lang = 'jp';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        //return "sss";

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMaintailandian($idCrypto = null, $metodo)
    {
        $lang = 'th';
        session(['lang' => $lang]);
        \App::setLocale($lang);
        //return "sss";

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainenglish($idCrypto = null, $metodo)
    {
        $lang = 'en';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainfr($idCrypto = null, $metodo)
    {
        $lang = 'fr';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainru($idCrypto = null, $metodo)
    {
        $lang = 'ru';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }

    public function indexMainch($idCrypto = null, $metodo)
    {
        $lang = 'ch';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }
    public function indexMainsuecia($idCrypto = null, $metodo)
    {
        //return "";
        $lang = 'se';
        session(['lang' => $lang]);
        \App::setLocale($lang);

        return $this->indexMain($idCrypto, $metodo, $lang);
    }


    public function indexMain($idCrypto = null, $metodo, $idioma = null, $idDivisa = null){
        $limit_pay        = PaymentLimit::where('id',1)->get();
        $payment_state = PaymentMethoState::where('payment_method', 'mercadopago')->first();
        //$paypal_state = PaypalGatewayLink::where('id', 1)->first();
        
        $paypal_state = PaypalGatewayLink::first();
        $metodoSearch = \DB::table('mercadopago')->where('slug', $metodo)->first();
        if(!$metodoSearch){
            return view('errors.404');
        }

        $nameMetodo = $metodoSearch->nombre;

        if ($idCrypto == null) {
            $idCrypto = General::getCryptoDefault('BTC');
        } else {
            $idCrypto = General::getCryptoDefault($idCrypto);
        }
        if ($idDivisa == null) {
            $idDivisa = 5;
        } 

        if(session()->has('idDivisa')){
            $idDivisa = session('idDivisa');
        }else{
            session(['idDivisa' => '5']);
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
            $meta['title'] = __('index.title_mp', ['cripto' => $getCriptodefault->name, "metodo" => $nameMetodo]);
            $meta['descripcion'] = __('index.description_new_mp');
            // Load crypto list for currency
            // dd($pricesCryptos);
            $pricesCryptos = $this->cryptoList($getConversNew, $getCryptos); //recibe las covers generales y las cryptos
            $getCryptos = $getCryptos->pluck('name', 'code');
            $symbol = $getCurrencyUser->symbol;
            $recurly = true;
            // Return view with vars
            $fiat = self::CurrencyType($getCurrencyUser->code);
            
            return view(
                'home_usuario.comprar_test_index_mp',
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
                    'payment_state',
                    'paypal_state',
                    'fiat',
                    'limit_pay',
                    'pricesCryptos',
                    'nameMetodo',
                    'metodo'
                )
            );
        }
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

    public function processPayment(Request $request){
            //request
        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = Auth::user()->name;
        $lastname = Auth::user()->lastName;
        $email = Auth::user()->email;
        $pais = Auth::user()->country_id;
        $currency = $request->currency;
        $ciudad=$request->ciudad;
        $phone=$request->phone;
        $direccion = $request->direccion;
        $postal=$request->postal;
        $country = Country::where('id', $pais)->first();
        $isoCode=strtoupper($country->cod_iso2);
        $comision = PaymentLimit::first()->comision;

         //capturando ip
         $ip = $_SERVER['REMOTE_ADDR'];

          //log de envio
        $log=  DB::table('logs')->insert(
            [
            'ipaddress' =>  $request->ip(),
            'useragent' => 2,
            'url' => "envio a ",
            'description' => "error_buy",
            'tipo' => "error_buy",
            'user_id' => Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s'),
            ]
        );

        //return $isoCode;

         //user error
        //validaciones de intentos
         /*if (General::getLogUserError(Auth::user()->id) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }
        //user ip
        if (General::getLogUserIp($ip) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }

        //max error diario
        if (General::getLogMaxError() == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }*/

        //update user
        $updateuser = DB::table('users')->where('id',  Auth::user()->id)
        ->update(['ciudad' => $ciudad,'postal' => $postal,'phone' => $phone,'direccion' => $direccion]);

        //validar soporte pasarela
        $soporteRevolt  = ["ARS"];
          
        if (in_array($currency, $soporteRevolt)) {
            $idDivisa = $idDivisa;
            $totalPay =$totalCompra;
            $currencyPay = $currency;
        }
        else{
            $idDivisa = 5;//divisa por default
            $totalPay = General::conversTotalNew($totalCompra, $currency, "ARS");
            $currencyPay = "ARS";//"COP";
        }

        /*$calculateComision = $totalPay*($comision/100);
        $totalPay = $totalPay + $calculateComision;*/

        //usuario logueado
        $user = Auth::user();
        
        //informacion local de pago estatus pendiente
        $token = str_random(30);
        $transaction = PaymentWallTransaction::create([
            'user_id' => $user->id,
            'direct' =>$request->direct,
            'currency_id' => $idDivisa,
            'crypto_id' => $idCrypto,
            'token' => $token,
            'amount' => $totalPay,
            'status' => 'pending',
        ]);

       
       // $ip="193.252.45.218";//francia
       $location=General::getCountryCode($ip);

      // if($location["countryCode"];

       if($location=="-"){
           $location=$isoCode;
       }

      // return $location;

      $getCriptodefault = Crypto::where('id', $idCrypto)->first();
       
        //preparando la data para el envio
        $post = [
            "user_id"=>$user->id,
            "token"=>$token,
            "currency"=> $currencyPay,
            "amount" => $totalPay,
            "email"=> $email,
            "phone_number"=> $phone,
            "fullname" => $name . " " . $lastname,
            "city"=>$ciudad,
            "address"=>$direccion,
            "location"=>$location,
            "postal"=>$postal,
            "crypto" => "Compra segura DC",
            "comision" => $comision,
        ];

        //preparanado url para envio

        $base_url = config('payment.APP_BASE_URL_MP');
        $post = json_encode($post);
        //enviando informacion con curl
        $idGetInfo = General::logsx($user->id, $post, "envio", "envio");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

       // dd($result);

        $result = json_decode($result, true);
       
        return $result;

    }

    public function processPaymentBuy(Request $request){
        //request
    $total = $request->total;
    $totalCompra = $request->total;
    $idDivisa = $request->idCurrency;
    $idCrypto = $request->idCrypto;
    $name = Auth::user()->name;
    $lastname = Auth::user()->lastName;
    $email = Auth::user()->email;
    $pais = Auth::user()->country_id;
    $currency = $request->currency;
    $ciudad=$request->ciudad;
    $phone=$request->phone;
    $direccion = $request->direccion;
    $postal=$request->postal;
    $country = Country::where('id', $pais)->first();
    $isoCode=strtoupper($country->cod_iso2);
    $comision = PaymentLimit::first()->comision;

     //capturando ip
     $ip = $_SERVER['REMOTE_ADDR'];

      //log de envio
    $log=  DB::table('logs')->insert(
        [
        'ipaddress' =>  $request->ip(),
        'useragent' => 2,
        'url' => "envio a ",
        'description' => "error_buy",
        'tipo' => "error_buy",
        'user_id' => Auth::user()->id,
        'created_at'=>date('Y-m-d H:i:s'),
        ]
    );

    //return $isoCode;

     //user error
    //validaciones de intentos
     /*if (General::getLogUserError(Auth::user()->id) == "false") {
        $response = ["error" => "true", "code" => __('home_buy.max_error')];
        return $response;
    }
    //user ip
    if (General::getLogUserIp($ip) == "false") {
        $response = ["error" => "true", "code" => __('home_buy.max_error')];
        return $response;
    }

    //max error diario
    if (General::getLogMaxError() == "false") {
        $response = ["error" => "true", "code" => __('home_buy.max_error')];
        return $response;
    }*/

    //update user
    $updateuser = DB::table('users')->where('id',  Auth::user()->id)
    ->update(['ciudad' => $ciudad,'postal' => $postal,'phone' => $phone,'direccion' => $direccion]);

    //validar soporte pasarela
    $soporteRevolt  = ["ARS"];
      
    if (in_array($currency, $soporteRevolt)) {
        $idDivisa = $idDivisa;
        $totalPay =$totalCompra;
        $currencyPay = $currency;
    }
    else{
        $idDivisa = 5;//divisa por default
        $totalPay = General::conversTotalNew($totalCompra, $currency, "ARS");
        $currencyPay = "ARS";//"COP";
    }
    /*$calculateComision = $totalPay*($comision/100);
    $totalPay = $totalPay + $calculateComision;*/

    //usuario logueado
    $user = Auth::user();
    
    //informacion local de pago estatus pendiente
    $token = str_random(30);
    $transaction = PaymentWallTransaction::create([
        'user_id' => $user->id,
        'direct' =>$request->direct,
        'currency_id' => $idDivisa,
        'crypto_id' => $idCrypto,
        'token' => $token,
        'amount' => $totalPay,
        'status' => 'pending',
    ]);

   
   // $ip="193.252.45.218";//francia
   $location=General::getCountryCode($ip);

  // if($location["countryCode"];

   if($location=="-"){
       $location=$isoCode;
   }

  // return $location;

  $getCriptodefault = Crypto::where('id', $idCrypto)->first();
   
    //preparando la data para el envio
    $post = [
        "user_id"=>$user->id,
        "token"=>$token,
        "currency"=> $currencyPay,
        "amount" => $totalPay,
        "email"=> $email,
        "phone_number"=> $phone,
        "fullname" => $name . " " . $lastname,
        "city"=>$ciudad,
        "address"=>$direccion,
        "location"=>$location,
        "postal"=>$postal,
        "crypto" => "Compra segura DC",
        "comision" => $comision,
    ];

    //preparanado url para envio
    $base_url = config('payment.APP_BASE_URL_MP');
    $post = json_encode($post);
    //enviando informacion con curl
    $idGetInfo = General::logsx($user->id, $post, "envio", "envio");

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $base_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

   // dd($result);

    $result = json_decode($result, true);
   
    return $result;

}

    public function processPaymentIndex(Request $request){
        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $currency = $request->currency;
        $ciudad=$request->ciudad;
        $phone=$request->phone;
        $direccion = $request->direccion;
        $postal=$request->postal;
        $comision = PaymentLimit::first()->comision;

        $country = Country::where('cod_iso2', $pais)->first();
        try {
            $user = User::create([
                'name' => $name,
                'lastName' => $lastname,
                'country_id' => $country->id,
                'role_id' => 2,
                'email' => $email,
                'postal' => $postal,
                'ciudad' => $ciudad,
                'phone' => $phone,
                'direccion' => $direccion,
                'password' => bcrypt(str_random(8)),
            ]);
        } catch (Exception $e) {
            if ($e->errorInfo[1] == 1062) {
                $user = User::where('email', $email)
                    ->first();
            }
        }

        $isoCode=strtoupper($country->cod_iso2);
         //capturando ip
         $ip = $_SERVER['REMOTE_ADDR'];

          //log de envio
        $log=  DB::table('logs')->insert(
            [
            'ipaddress' =>  $request->ip(),
            'useragent' => 2,
            'url' => "envio a ",
            'description' => "error_buy",
            'tipo' => "error_buy",
            'user_id' =>$user->id,
            'created_at'=>date('Y-m-d H:i:s'),
            ]
        );


        //return $isoCode;

         //user error
        //validaciones de intentos
        /* if (General::getLogUserError($user->id) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }
        //user ip
        if (General::getLogUserIp($ip) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }

        //max error diario
        if (General::getLogMaxError() == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }*/

        //update user
        $updateuser = DB::table('users')->where('id',  $user->id)
        ->update(['ciudad' => $ciudad,'postal' => $postal,'phone' => $phone,'direccion' => $direccion]);

        //validar soporte pasarela
        $soporteRevolt  = ["ARS"];
          
        if (in_array($currency, $soporteRevolt)) {
            $idDivisa = $idDivisa;
            $totalPay =$totalCompra;
            $currencyPay = $currency;
        }
        else{
            $idDivisa = 5;//divisa por default
            $totalPay = General::conversTotalNew($totalCompra, $currency, "ARS");
            $currencyPay = "ARS";//"COP";
           
        }
        
        /*$calculateComision = $totalPay*($comision/100);
        $totalPay = $totalPay + $calculateComision;*/

        //usuario logueado
       // $user = Auth::user();
        
        //informacion local de pago estatus pendiente
        $token = str_random(30);
        $transaction = PaymentWallTransaction::create([
            'user_id' => $user->id,
            'direct' =>$request->direct,
            'currency_id' => $idDivisa,
            'crypto_id' => $idCrypto,
            'token' => $token,
            'amount' => $totalPay,
            'status' => 'pending',
        ]);
       
       // $ip="193.252.45.218";//francia
       $location=General::getCountryCode($ip);

      // if($location["countryCode"];

       if($location=="-"){
           $location=$isoCode;
       }

      // return $location;
      $getCriptodefault = Crypto::where('id', $idCrypto)->first();
    
        //preparando la data para el envio
        $post = [
            "user_id"=>$user->id,
            "token"=>$token,
            "currency"=> $currencyPay,
            "amount" => $totalPay,
            "email"=> $email,
            "phone_number"=> $phone,
            "fullname" => $name . " " . $lastname,
            "city"=>$ciudad,
            "address"=>$direccion,
            "location"=>$location,
            "postal"=>$postal,
            "crypto" => "Compra segura DC",
            "comision" => $comision,
        ];
        /*$preference = new \MercadoPago\Preference();
        // Crea un ítem en la preferencia
        $item = new \MercadoPago\Item();
        $item->title = $idCrypto;
        $item->quantity = 1;
        $item->unit_price = $totalPay;

        $preference->items = array($item);
        $preference->save();

        $payer = new \MercadoPago\Payer();
        $payer->name = $name;
        $payer->surname = $lastname;
        $payer->email = $email;
        $payer->date_created = "2018-06-02T12:58:41.425-04:00";
        $payer->phone = array(
            "area_code" => $postal,
            "number" => $phone
        );
        
        $payer->identification = array(
            "type" => "",
            "number" => ""
        );
        
        $payer->address = array(
            "street_name" => $direccion,
            "street_number" => $location,
            "zip_code" => "11020"
        );
        $preference->payer = $payer;

        $preference->back_urls = array(
            "success" => "https://damecoins.com/success",
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "https://damecoins.com/success"
        );
        $preference->auto_return = "approved";*/

        //return response()->json(['success' => true, 'preference' => $preference->id]);        
            //preparanado url para envio
        $base_url = config('payment.APP_BASE_URL_MP');

        $post = json_encode($post);
        //enviando informacion con curl
        $idGetInfo = General::logsx($user->id, $post, "envio", "envio");
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

       // dd($result);

        $result = json_decode($result, true);
       
        return $result;
    }
}
