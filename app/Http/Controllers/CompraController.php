<?php namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Redirect;
use Session;
use Stripe\Charge as StripeCharge;
use Stripe\Customer as StripeCustomer;
use Stripe\PaymentIntent as PaymentIntent;
use Stripe\Refund as StripeRefund; //as Stripe;
use Stripe\Stripe;
use Stripe\Token as StripeToken;

class CompraController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth', ['only' => 'compraInterna', 'compraInternaTest', 'processcomprax', 'wechatCharge']);

        // $this->middleware('auth',['except' => 'compraindex','getStripeKey','paymentintent']);
    }

    public function getStripeKey()
    {
        $privateKey = AdminConfig::privatek();
        return $privateKey->value; //config('services.stripe.secret');
    }
    public function paymentintent(Request $request)
    {
        try {
            $ip=$_SERVER['REMOTE_ADDR'];
            if(General::getLogUserIp($ip)=="false"){
                $error=["error"=>"true","type"=>__('home_buy.max_error')];
                return json_encode($error);
               
             }
    
             if(General::getLogUserError(Auth::user()->id)=="false"){
                $error=["error"=>"true","type"=>__('home_buy.max_error')];
                return json_encode($error);
               
             }

            Stripe::setApiKey($this->getStripeKey());
            $currency = $request->currency;
            $newamount = $request->total;
            $email = Auth::user()->email;
            $name = Auth::user()->name." ".Auth::user()->lastName;
            $stripeToken = $request->stripeToken;
            $multi = 100;
            if (($currency == "CLP") || ($currency == "PYG")) {
                $multi = 1;
            }
            try {
                $options = array(
                    "description" => "Pago3035",
                    "email" => $email,
                    "source" => $stripeToken,
                    "name" => $name,
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
                    //'statement_descriptor' => '488 Web money'
                ]);
                $data = array(
                    "client_secret" => $result->client_secret,
                );
                return json_encode($data);
            } catch (Stripe\Error\Card $e) {
                $body = $e->getJsonBody();
                $error = array(
                    "error" => "true",
                    "type" => $body['error']["message"],
                );
                return json_encode($error);
            }
        } catch (Exception $e) {
            $body = $e->getJsonBody();
            $error = array(
                "error" => "true",
                "type" => $body['error']["message"],
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

    public function compraindex(Request $request)
    {
        $ip=$_SERVER['REMOTE_ADDR'];
  
        if(General::getLogUserIp($ip)=="false"){
            $response=["error"=>"true","code"=>__('home_buy.max_error')];
            return Redirect::back()->with('error', __('home_buy.max_error'));
         }
         $useragent="useragent";
         if($request->header('User-Agent')){
            $useragent=$request->header('User-Agent');
         }
         
         $url=url()->current();

        $total = $request['total'];
        $idDivisa = $request['currency'];
        $idCrypto = $request['crypto'];
        $name = $request['name'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $pais = $request['country'];
        $country = Country::where('cod_iso2', $pais)->first();
        //registro de usuario
        try {
            $user = User::create([
                'name' => $name,
                'lastName' => $lastname,
                'country_id' => $country->id,
                'role_id' => 2,
                'email' => $email,
                'password' => bcrypt('123'),
            ]);
        } catch (Exception $e) {
            //exepcion usuario ya registrado
            if ($e->errorInfo[1] == 1062) {
                //echo "usuario registrado";
                $user = User::where('email', $email)
                    ->first();
            }
        }
        
                              
        //return $user;
        $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
        //return $getCriptodefault;
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        if (isset($request["secure"])) {
            //  echo "mantenimiento";die();
            $secret = $request["secret"];
            $result = $request["result"];
            Stripe::setApiKey($this->getStripeKey());
            $intent = PaymentIntent::retrieve($result);
            if ($intent->status == "succeeded") {
                // $amount=$intent->amount/$divi;
                $status = $intent->status;
                $totalx = $intent->amount / General::getMulti($getCurrencyUser->code);
/*
                $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
                $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
                $comision = number_format((($totalx - $descuento)), 2, '.', '');
*/
                $totalDeposit=$this->deposit_fee($totalx,$idDivisa);//deposito fee
                $newTotal=$this->maker_fee($totalDeposit,$getCriptodefault->maker_fee);
                //return $newTotal;
                $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                //$descuento=General::getDescuento();
                $getTotalCrypto=number_format(($newTotal/$getConvers), 7, '.', ''); 
                $comision=number_format((($totalx-$newTotal)), 2, '.', ''); 

                DB::beginTransaction();

                try {

                    $payment = new Payment;
                    $payment->user()->associate($user);
                    $payment->total = $totalx;
                    $payment->pasarela = 'Stripe';
                    $payment->descripcion = "compra";
                    $payment->status = 1;
                    $payment->currency_id = $getCurrencyUser->id;
                    $payment->save();

                    $criptowallet = new CryptoWallet;
                    $criptowallet->compra = $getTotalCrypto;
                    $criptowallet->taker = $comision;
                    $criptowallet->cripto_id = $getCriptodefault->id;
                    $criptowallet->status = 1;
                    $criptowallet->user()->associate($user);
                    $criptowallet->save();

                    $critowalletpaymet = new CryptoWalletPyment;
                    $critowalletpaymet->payment()->associate($payment);
                    $critowalletpaymet->cripto_wallet()->associate($criptowallet);
                    $critowalletpaymet->save();
                    //return "si";

                    DB::commit();
                    $password = substr(md5(microtime()), 1, 8);
                    $userx = User::find($user->id);
                    $userx->password = bcrypt($password);
                    $userx->save();
                    //return $userx;
                    General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);

                    Session::flash('success', __('index.success_buy'));
                    return redirect("/login");
                } catch (Exception $e) {
                    // return $e;

                    DB::rollback();
                    return Redirect::back()->with('error', __('index.error_buy'));
                    // return $e;
                    // something went wrong
                }
            } else {
                General::logs($ip,"error",$url,"get",$user->id,$useragent);
                return Redirect::back()->with('error', __('index.error_buy'));
            }
        } else {
            //echo "mantenimiento2";die();
            $options = array(
                "description" => "Pago2030",
                "email" => $user->email,
                "source" => $request['stripeToken'],
                "name" => $user->name." ".$user->lastName,
            );
            try {
                $customer = StripeCustomer::create(
                    $options,
                    $this->getStripeKey()
                );
                try {
                    $options = array(
                        "amount" => $total * General::getMulti($getCurrencyUser->code),
                        "currency" => $getCurrencyUser->code,
                        "customer" => $customer->id,
                    );
                    $charges = StripeCharge::create($options, ['api_key' => $this->getStripeKey()]);

                    $status = $charges->status;
                    $totalx = $charges->amount / General::getMulti($getCurrencyUser->code);
                    $totalDeposit=$this->deposit_fee($totalx,$idDivisa);//deposito fee
                    $newTotal=$this->maker_fee($totalDeposit,$getCriptodefault->maker_fee);
                    //return $newTotal;
                    $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    //$descuento=General::getDescuento();
                    $getTotalCrypto=number_format(($newTotal/$getConvers), 7, '.', ''); 
                    $comision=number_format((($totalx-$newTotal)), 2, '.', ''); 
                    /*
                    $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    //return $totalx;
                    $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
                    $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
                    // $getTotalCrypto=number_format($getTotalCrypto, 6, '.', ',');
                    $comision = number_format((($totalx - $descuento)), 2, '.', '');
                    */
                    //return $getTotalCrypto;
                    DB::beginTransaction();

                    try {

                        $payment = new Payment;
                        $payment->user()->associate($user);
                        $payment->total = $totalx;
                        $payment->pasarela = 'Stripe';
                        $payment->descripcion = "compra";
                        $payment->status = 1;
                        $payment->currency_id = $getCurrencyUser->id;
                        $payment->save();

                        $criptowallet = new CryptoWallet;
                        $criptowallet->compra = $getTotalCrypto;
                        $criptowallet->taker = $comision;
                        $criptowallet->cripto_id = $getCriptodefault->id;
                        $criptowallet->status = 1;
                        $criptowallet->user()->associate($user);
                        $criptowallet->save();

                        $critowalletpaymet = new CryptoWalletPyment;
                        $critowalletpaymet->payment()->associate($payment);
                        $critowalletpaymet->cripto_wallet()->associate($criptowallet);
                        $critowalletpaymet->save();
                        //return "si";
                        DB::commit();
                        $password = substr(md5(microtime()), 1, 8);
                        $userx = User::find($user->id);
                        $userx->password = bcrypt($password);
                        $userx->save();
                        General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);
                        Session::flash('success', __('index.success_buy'));
                        return redirect("/login");
                    } catch (Exception $e) {
                        //return $e;
                        General::logs($ip,"error",$url,"get",$user->id,$useragent);
                        DB::rollback();
                        return Redirect::back()->with('error', __('index.error_buy'));
                        //return $e;
                        // something went wrong
                    }
                } catch (Exception $e) {
                    //return $e;
                    General::logs($ip,"error",$url,"get",$user->id,$useragent);
                    return Redirect::back()->with('error', __('index.error_buy'));
                }
            } catch (Exception $e) {
                //return $e;
                General::logs($ip,"error",$url,"get",$user->id,$useragent);
                return Redirect::back()->with('error', __('index.error_buy'));
            }
        }
    }

    public function deposit_fee($total,$idDivisa){
        $getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
        return ($total-($total*($getCurrencyUser->detailCurrency->comision_abono/100)));
    }

    function maker_fee($total, $desc) {
		$totalx = ($total - ($total * $desc / 100));
		return number_format($totalx, 2, '.', '');
	}

    public function compraInterna($idCrypto = null, $idDivisa = null)
    {

        $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
        $paypal_state = PaypalGatewayLink::first();
        $where = "buy";

        /** New */
        
            $email = Auth::user()->email;

            $email = explode("@", $email);

            $concept = substr($email[0], 0, 8);

            $default = Currency::find($idDivisa); //General::getCurrencyUser($idDivisa);
            // $banks = Bank::all(); //General::getCurrencyUser($idDivisa);
            $banks = Bank::where("status",1)->get(); 
            $paymentLimit = PaymentLimit::where('id','>=',1)->first();
            $limit = $paymentLimit['bank_deposit_minimum'];
            
        /** End New */
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $validaBuyStripe="false";
        $validaBuyStripe=General::validaBuyStripe(Auth::user()->id,$clientIP);
        $getCriptodefault = Crypto::where('id', $idCrypto)->first();
        $getCurrencyUser = Currency::where('id', $idDivisa)->first();
        $getCurrencies = DB::table('currencies')->pluck('name', 'id'); //Currency::lists('name', 'id');
        //$getCryptos = DB::table('cryptos')->pluck('name', 'id');
        $getCountry = DB::table('countries')->orderBy('name', 'asc')->pluck('name', 'cod_iso2', 'id');
        $getCryptos= Crypto::where('status', 1)->cryptos();
        $getCryptos= $getCryptos->pluck('name', 'id');
        //dd($getCryptos);
        $totalCrypto=0;

        $getTotalDivisa = General::getCryptoWalettUser($idDivisa);
        $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        if ($getConvers) {
            if ($getConvers>0) {
                $getPanel = General::getPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
                //return $getPanel;
                //$defaultValor = General::getDescuento($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
                $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);
                $default["cryptox"] = number_format(($defaultValor / $getConvers), 7, '.', ''); //round(100/$conver,4),
                $xxvalor = $getCurrencyUser->detailCurrency->max_deposito * 2;
                $xxvalor1 = General::getDescuento($xxvalor, $getCriptodefault->maker_fee);
                $default["pay"] = number_format(($xxvalor), 2, '.', '');
                $default["recibe"] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $default["prueba"] = number_format(($xxvalor1 * $getConvers), 7, '.', '');

                $meta['key'] = __('index.key');
                $meta['title'] = __('index.title', ["cripto" => $getCriptodefault->name, "currency" => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.description', ["currency" => $getCurrencyUser->name]);
                //dd($getCriptodefault->id);
                return view('home_usuario.comprar', compact('getCriptodefault', 'getCountry','getCurrencyUser', 'getCryptos', 'getCurrencies', 'totalCrypto', 'getTotalDivisa', 'getPanel', 'default', 'meta', 'payment_state', 'paypal_state','paymentLimit','banks','concept','limit','validaBuyStripe', 'where'));
            }else{
                //log dummy
                General::logs("127.0.0.1","error","buy","crypto_not_found",Auth::user()->id,"useragent");
                Session::flash('error', __('home_buy.crypto_not_found'));
               // $disableCripto=General::disabledCripto($getCriptodefault);
                return redirect("/home");
            }
        }else{
            General::logs("127.0.0.1","error","buy","crypto_not_found",Auth::user()->id,"useragent");
            Session::flash('error', __('home_buy.crypto_not_found'));
            //$disableCripto=General::disabledCripto($getCriptodefault);
            return redirect("/home");
        }

    }
   

    public function processcomprax(Request $request)
    {
        $getTotal = $request['total'];
        $idDivisa = $request['currency'];
        $idCrypto = $request['crypto'];
        if ($request['wallet'] == 'true') {
            //verifico que tiene el monto en el wallet
            $getTotal = $request['total'];
            $idDivisa = $request['currency'];
            $idCrypto = $request['crypto'];
            //return $idCrypto;
            $getCriptodefault = General::getCriptodefault($idCrypto);
            $getCurrencyUser = General::getCurrencyUser($idDivisa);
            $getTotalDivisa = General::getCryptoWalettUser($idDivisa);
            // return $getTotalDivisa;
            if ($getTotalDivisa >= $getTotal) {
              //saldo valido
                //capturo cuanta cripto puede comprar con el monto enviado
                $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                //return $getConvers;
               // return $getCriptodefault->maker_fee;
                $comision = $getCriptodefault->maker_fee * $getTotal / 100;
                $comision = number_format($comision, 2, '.', '');
                //return $comision;
                $newTotal = $getTotal - $comision;
                //return $maker_fee;
                $getTotalCrypto = round(($newTotal / $getConvers), 7);
                $getTotalCrypto = number_format($getTotalCrypto, 7, '.', '');
                DB::beginTransaction();
                try {
                    $user = Auth::user();
                        $wallet = new Wallet;
                        $wallet->retiro = $getTotal;
                        $wallet->currency_id = $getCurrencyUser->id;
                        $wallet->status = 1;
                        $wallet->comments = "";
                        $wallet->user()->associate($user);
                    $wallet->save();
                    $criptowallet = new CryptoWallet;
                        $criptowallet->compra = $getTotalCrypto;
                        $criptowallet->taker = $comision;
                        $criptowallet->cripto_id = $getCriptodefault->id;
                        $criptowallet->status = 1;
                        $criptowallet->user()->associate($user);
                    $criptowallet->save();
                    $critowallwallet = new CryptoWalletWallet;
                        $critowallwallet->wallet()->associate($wallet);
                        $critowallwallet->cripto_wallet()->associate($criptowallet);
                    $critowallwallet->save();
                    DB::commit();
                    General::email($criptowallet->compra, $getCriptodefault->code, Auth::user(), "Purchase");
                    // General::emailCompra($criptowallet->compra,$getCriptodefault->code);
                    Session::flash('success', __('index.success_buy'));
                    return redirect("/home/".$idDivisa);
                } catch (Exception $e) {
                    //return $e;
                    DB::rollback();
                    return Redirect::back()->with('error', __('index.error_buy'));
                    // something went wrong
                }
            } else {
                Session::flash('error', __('home_buy.quanty_not_found'));
                //return $e;
                return redirect("/buy/".$request['crypto']."/".$request['currency']);
                //return "sin saldo";
            }
        } else {
        $ip=$_SERVER['REMOTE_ADDR'];
        //validacion del lado del server
        if(General::getLogUserIp($ip)=="false"){
            $response=["error"=>"true","code"=>__('home_buy.max_error')];
            return Redirect::back()->with('error', __('home_buy.max_error'));
         }

         if(General::getLogUserError(Auth::user()->id)=="false"){
            $response=["error"=>"true","code"=>__('home_buy.max_error')];
            return Redirect::back()->with('error', __('home_buy.max_error'));
         }
 

         $useragent="useragent";
         if($request->header('User-Agent')){
            $useragent=$request->header('User-Agent');
         }
         
         $url=url()->current();

            $getCriptodefault = General::getCriptodefault($idCrypto);
            $getCurrencyUser = General::getCurrencyUser($idDivisa);
            $user = Auth::user();
            if (isset($request["secure"])) {
                $secret = $request["secret"];
                $result = $request["result"];
                Stripe::setApiKey($this->getStripeKey());
                $intent = PaymentIntent::retrieve($result);
                if ($intent->status == "succeeded") {
                    $status = $intent->status;
                    $totalx = $intent->amount / General::getMulti($getCurrencyUser->code);
                    $totalDeposit=$this->deposit_fee($totalx,$idDivisa);//deposito fee
                    $newTotal=$this->maker_fee($totalDeposit,$getCriptodefault->maker_fee);
                    //return $newTotal;
                    $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    //$descuento=General::getDescuento();
                    $getTotalCrypto=number_format(($newTotal/$getConvers), 7, '.', ''); 
                    $comision=number_format((($totalx-$newTotal)), 2, '.', ''); 
                   
                    DB::beginTransaction();
                    try {
                        $payment = new Payment;
                        $payment->user()->associate($user);
                        $payment->total = $totalx;
                        $payment->pasarela = 'Stripe';
                        $payment->descripcion = "compra";
                        $payment->status = 1;
                        $payment->currency_id = $getCurrencyUser->id;
                        $payment->save();

                        $criptowallet = new CryptoWallet;
                        $criptowallet->compra = $getTotalCrypto;
                        $criptowallet->taker = $comision;
                        $criptowallet->status_user = 1;
                        $criptowallet->cripto_id = $getCriptodefault->id;
                        $criptowallet->status = 1;
                        $criptowallet->user()->associate($user);
                        $criptowallet->save();

                        $critowalletpaymet = new CryptoWalletPyment;
                        $critowalletpaymet->payment()->associate($payment);
                        $critowalletpaymet->cripto_wallet()->associate($criptowallet);
                        $critowalletpaymet->save();
                        DB::commit();
                        General::email($criptowallet->compra, $getCriptodefault->code, Auth::user(), "Purchase");
                        Session::flash('success', __('index.success_buy'));
                        return redirect("/home/".$idDivisa);
                    } catch (Exception $e) {
                        DB::rollback();
                        General::logs($ip,"error_buy",$url,"error_buy",Auth::user()->id,$useragent);     
                        return Redirect::back()->with('error', __('index.error_buy'));
                        // something went wrong
                    }
                }else{
                    General::logs($ip,"error_buy",$url,"error_buy",Auth::user()->id,$useragent);
                    return Redirect::back()->with('error', __('index.error_buy'));
                                     
                }
            } else {
                $total = $request['total'];
                // return $total;

                $options = array(
                    "description" => "Pago3730",
                    "email" => $user->email,
                    "source" => $request['stripeToken'],
                    "name" => $user->name." ".$user->lastName,

                );
                try {
                    $customer = StripeCustomer::create(
                        $options,
                        $this->getStripeKey()
                    );
                    try {
                        $options = array(
                            "amount" => $total * General::getMulti($getCurrencyUser->code),
                            "currency" => $getCurrencyUser->code,
                            "customer" => $customer->id,
                        );
                        $charges = StripeCharge::create($options, ['api_key' => $this->getStripeKey()]);
                        $status = $charges->status;
                        $totalx = $charges->amount / General::getMulti($getCurrencyUser->code);
                        $totalDeposit=$this->deposit_fee($totalx,$idDivisa);//deposito fee
                        $newTotal=$this->maker_fee($totalDeposit,$getCriptodefault->maker_fee);
                        //return $newTotal;
                        $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                        //$descuento=General::getDescuento();
                        $getTotalCrypto=number_format(($newTotal/$getConvers), 7, '.', ''); 
                        $comision=number_format((($totalx-$newTotal)), 2, '.', ''); 

                        DB::beginTransaction();

                        try {

                            $payment = new Payment;
                            $payment->user()->associate($user);
                            $payment->total = $totalx;
                            $payment->pasarela = 'Stripe';
                            $payment->descripcion = "compra";
                            $payment->status = 1;
                            $payment->currency_id = $getCurrencyUser->id;
                            $payment->save();

                            $criptowallet = new CryptoWallet;
                            $criptowallet->compra = $getTotalCrypto;
                            $criptowallet->taker = $comision;
                            $criptowallet->cripto_id = $getCriptodefault->id;
                            $criptowallet->status = 1;
                            $criptowallet->user()->associate($user);
                            $criptowallet->save();

                            $critowalletpaymet = new CryptoWalletPyment;
                            $critowalletpaymet->payment()->associate($payment);
                            $critowalletpaymet->cripto_wallet()->associate($criptowallet);
                            $critowalletpaymet->save();
                            //return "si";
                            DB::commit();
                            General::email($criptowallet->compra, $getCriptodefault->code, Auth::user(), "Purchase");
                            // return Auth::user();

                            Session::flash('success', __('index.success_buy'));
                            //return redirect("/home");
                            return redirect("/home/".$idDivisa);
                        } catch (Exception $e) {
                            DB::rollback();
                            General::logs($ip,"error_buy",$url,"error_buy",Auth::user()->id,$useragent);
                           
                            return Redirect::back()->with('error', __('index.error_buy'));
                            // something went wrong
                        }
                    } catch (Exception $e) {
                        General::logs($ip,"error_buy",$url,"error_buy",Auth::user()->id,$useragent);
                        return Redirect::back()->with('error', __('index.error_buy'));
                    }
                } catch (Exception $e) {
                    General::logs($ip,"error_buy",$url,"error_buy",Auth::user()->id,$useragent);
                    return Redirect::back()->with('error', __('index.error_buy'));
                }
            }
        }
    }

    public function faster(Request $request)
    {
        $total = $request->total;
        $idDivisa = $request->idCurrency;
        $cryptoid = $request->idCrypto;

        $token = str_random(25);
        $currencyCode = strtoupper($request->currency);

        // URL
        if (env("APP_ENV") === 'local') {
            $base_url = 'https://megacursos.test/damecoins/genpayurl';
        } else {
            $base_url = 'https://megacursos.com/damecoins/genpayurl';
        }
        $base_url = 'https://megacursos.com/damecoins/genpayurl';
        $user = Auth::user();

        //return $user;
        PaymentWallTransaction::create([
            'user_id' => $user->id,
            'currency_id' => $idDivisa,
            'crypto_id' => $cryptoid,
            'token' => $token,
            'amount' => $total,
            "direct" => $request->direct,
            'status' => 'pending',
        ]);

        $post = array(
            'uid' => $user->id,
            'email' => $user->email,
            'token' => $token,
            'amount' => $total,
            'currencyCode' => $currencyCode,
        );

        $post = json_encode($post);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:'.curl_error($ch);
        }
        curl_close($ch);

        // echo $result["success"];
        //dd($result);
        // $result = htmlentities($result);
        $result = json_decode($result, true);
        // dd($result);
        return $result;
    }

    public function wechatCharge(Request $request)
    {

        $source = $request->source['source'];
        $idCrypto = $request->crypto;
        $idDivisa = $request->currency_form;
        $amount = $request->amount;
        $user = Auth::user();

        $getCriptodefault = General::getCriptodefault($idCrypto);
        $getCurrencyUser = General::getCurrencyUser($idDivisa);

        $options = array(
            "description" => "Pago3030",
            "email" => $user->email,
            "name" => $user->name." ".$user->lastName,
        );

        $customer = StripeCustomer::create(
            $options,
            $this->getStripeKey()
            // $options, 'sk_test_tjeBXUhmznGLVKr0jGwvTWsp00O7tLswHd'
        );

        \Stripe\Stripe::setApiKey($this->getStripeKey());
        // \Stripe\Stripe::setApiKey('sk_test_tjeBXUhmznGLVKr0jGwvTWsp00O7tLswHd');
        $charge = \Stripe\Charge::create([
            'amount' => $source['amount'],
            'currency' => $source['currency'],
            'source' => $source['id'],
            'customer' => $customer->id,
            'description' => 'Pago3030',

        ]);

        try {

            $totalx = $amount / General::getMulti($getCurrencyUser->code);
            $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
            $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
            $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
            $comision = number_format((($totalx - $descuento)), 2, '.', '');

            DB::beginTransaction();

            try {
                $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $totalx;
                $payment->pasarela = 'WeChat';
                $payment->descripcion = "compra";
                $payment->status = 1;
                $payment->currency_id = $getCurrencyUser->id;
                $payment->save();

                $criptowallet = new CryptoWallet;
                $criptowallet->compra = $getTotalCrypto;
                $criptowallet->taker = $comision;
                $criptowallet->cripto_id = $getCriptodefault->id;
                $criptowallet->status = 1;
                $criptowallet->user()->associate($user);
                $criptowallet->save();

                $critowalletpaymet = new CryptoWalletPyment;
                $critowalletpaymet->payment()->associate($payment);
                $critowalletpaymet->cripto_wallet()->associate($criptowallet);
                $critowalletpaymet->save();
                DB::commit();
                General::email($criptowallet->compra, $getCriptodefault->code, Auth::user(), "Purchase");

                return 'ok';
            } catch (Exception $e) {
                DB::rollback();
                // return Redirect::back()->with('error', __('index.error_buy'));
                return $e;
            }
        } catch (Exception $e) {
            // return Redirect::back()->with('error', __('index.error_buy'));
            return $e;
        }
    }

    public function wechatChargeIndex(Request $request)
    {

        $source = $request->source['source'];
        $idCrypto = $request->crypto;
        $idDivisa = $request->currency_form;
        $amount = $request->amount;

        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $country = Country::where('cod_iso2', $pais)->first();

        //registro de usuario
        try {
            $user = User::create([
                'name' => $name,
                'lastName' => $lastname,
                'country_id' => $country->id,
                'role_id' => 2,
                'email' => $email,
                'password' => bcrypt('123'),
            ]);
        } catch (Exception $e) {
            //exepcion usuario ya registrado
            if ($e->errorInfo[1] == 1062) {
                //echo "usuario registrado";
                $user = User::where('email', $email)
                    ->first();
            }
        }

        $getCriptodefault = General::getCriptodefault($idCrypto);
        $getCurrencyUser = General::getCurrencyUser($idDivisa);

        $options = array(
            "description" => "Pago3030",
            "email" => $user->email,
            "name" => $user->name." ".$user->lastName,
        );

        $customer = StripeCustomer::create(
            $options,
            $this->getStripeKey()

            // $options, 'sk_test_tjeBXUhmznGLVKr0jGwvTWsp00O7tLswHd'
        );

        \Stripe\Stripe::setApiKey($this->getStripeKey());

        $charge = \Stripe\Charge::create([
            'amount' => $source['amount'],
            'currency' => $source['currency'],
            'source' => $source['id'],
            'customer' => $customer->id,
            'description' => 'Pago3130',

        ]);

        try {

            $totalx = $amount / General::getMulti($getCurrencyUser->code);
            $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
            $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
            $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
            $comision = number_format((($totalx - $descuento)), 2, '.', '');

            DB::beginTransaction();

            try {
                $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $totalx;
                $payment->pasarela = 'WeChat';
                $payment->descripcion = "compra";
                $payment->status = 1;
                $payment->currency_id = $getCurrencyUser->id;
                $payment->save();

                $criptowallet = new CryptoWallet;
                $criptowallet->compra = $getTotalCrypto;
                $criptowallet->taker = $comision;
                $criptowallet->cripto_id = $getCriptodefault->id;
                $criptowallet->status = 1;
                $criptowallet->user()->associate($user);
                $criptowallet->save();

                $critowalletpaymet = new CryptoWalletPyment;
                $critowalletpaymet->payment()->associate($payment);
                $critowalletpaymet->cripto_wallet()->associate($criptowallet);
                $critowalletpaymet->save();
                DB::commit();

                $password = substr(md5(microtime()), 1, 8);
                $userx = User::find($user->id);
                $userx->password = bcrypt($password);
                $userx->save();

                General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);

                return 'ok';
            } catch (Exception $e) {
                DB::rollback();
                // return Redirect::back()->with('error', __('index.error_buy'));
                return $e;
            }
        } catch (Exception $e) {
            // return $e;
            // return Redirect::back()->with('error', __('index.error_buy'));
            return $e;
        }

        // return $charge;
    }

    public function changeDivisaHKD(Request $request)
    {

        $endpoint = 'convert';
        $access_key = '27692546960c2e421da5a5513b76491d';
        $to = 'HKD';

        $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$request->currency.'&to='.$to.'&amount='.$request->amount.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);

        $convertedamount = $conversionResult['result'];

        return $convertedamount;
    }

    public function cambiarDivisa(Request $request){
        try {
            $currency = Currency::where('code', $request->currency)->first();
            session(['idDivisa' => $currency->id]);
            return ["success" => true];
        
        } catch (Exception $e) {
            return ['type' => 'card', "data" => "true"];
        }
    } 


    public function calculatePayPalMinimunFaster(Request $request)
    {
        $card = $request->card;
        $currency = $request->currency;
        $amount = $request->amount;
        $limit = PaymentLimit::first();
       
        try {
            $toUsd="USD";
            $convertedAmountUSD=General::getConverFromTo($currency, $toUsd, $amount);

            if ($card == 'true') {
                if (($convertedAmountUSD >= $limit->card_minimum) && ($convertedAmountUSD <= $limit->card_maximum)) {
                    return ['type' => 'card', "data" => "true"];
                } else {
                    if($currency==$toUsd){
                        return ['type' => 'card', "min" => $limit->card_minimum." ".$toUsd, "max" => $limit->card_maximum." ".$toUsd, "data" => "false"];
                  
                    }else{
                        $minCurrency=General::getConverFromTo($toUsd, $currency, $limit->card_minimum);
                        $minCurrency=$minCurrency." ".$currency;
                        $maxCurrency=General::getConverFromTo($toUsd, $currency, $limit->card_maximum);
                        $maxCurrency=$maxCurrency." ".$currency;
                        return ['type' => 'card', "min" => $limit->card_minimum." ".$toUsd."(".$minCurrency.")", "max" => $limit->card_maximum." ".$toUsd."(".$maxCurrency.")", "data" => "false"];
                    }
                }
            }

        } catch (Exception $e) {
            return ['type' => 'card', "data" => "true"];

        }

    }

    public function compraInternaTest($idCrypto = null, $idDivisa = null)
    {
        
        $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
        $paypal_state = PaypalGatewayLink::first();
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
                $meta['title'] = __('index.title', ["cripto" => $getCriptodefault->name, "currency" => $getCurrencyUser->name]);
                $meta['descripcion'] = __('index.description', ["currency" => $getCurrencyUser->name]);
                
                return view('home_usuario.comprar_test', compact('getCriptodefault', 'getCountry','getCurrencyUser', 'getCryptos', 'getCurrencies', 'totalCrypto', 'getTotalDivisa', 'getPanel', 'default', 'meta', 'payment_state', 'paypal_state','paymentLimit','banks','concept','limit','validaBuyStripe'));
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


    }

    public function updateImagenAlipayQr(Request $request, $id){
        try{
            if($request->ajax()){
                if($request->hasFile('file')){
                    $file = $request->file('file');
                    $name = time().$file->getClientOriginalName();

                    $imagen = PaymentLimit::findOrFail($id);
                    unlink(public_path().'/methodpayQR/'.$imagen->qr_alipay);
                    $imagen->qr_alipay = $name;
                    $imagen->save();
    
                    $file->move(public_path().'/methodpayQR', $name );
                } 
            }
            return response()->json(["success" => true, "data" => 'true', 'message' => null, 'code' => 200]);
        }catch(\Exception $e){
            return response()->json(["success" => false, "data" => $e->getMessage(), 'code' => 500]);
        }
    }

    public function updateImagenWechatQr(Request $request, $id){
        try{
            if($request->ajax()){
                if($request->hasFile('file')){
                    $file = $request->file('file');
                    $name = time().$file->getClientOriginalName();

                    $imagen = PaymentLimit::findOrFail($id);
                    unlink(public_path().'/methodpayQR/'.$imagen->qr_wechat);
                    $imagen->qr_wechat = $name;
                    $imagen->save();
    
                    $file->move(public_path().'/methodpayQR', $name );
                } 
            }
            return response()->json(["success" => true, "data" => 'true', 'message' => null, 'code' => 200]);
        }catch(\Exception $e){
            return response()->json(["success" => false, "data" => $e->getMessage(), 'code' => 500]);
        }
    }
    
    
}
