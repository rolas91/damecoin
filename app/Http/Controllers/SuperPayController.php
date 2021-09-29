<?php

namespace App\Http\Controllers;

use App\Country;
use App\CrmAgile;
use App\Crypto;
use App\CryptoWallet;
use App\CryptoWalletPyment;
use App\Currency;
use App\Http\Requests\RequestSuperPay;
use App\Http\Requests\RequestSuperPayHome;
use App\Payment;
use App\Payment_Wallet;
use App\User;
use App\Wallet;
use Auth;
use DB;
use Exception;
use General;
use Illuminate\Http\Request;
use PayUpayment;
use Response;
use Session;

//use Omnipay\Omnipay;
//use Omnipay\Common\CreditCard;

class SuperPayController extends Controller
{
    public function testpayu()
    {
        $cc = "4097440000000004";
        $yy = "2020/12";
        $type_card = "VISA";
        $name = "Gabriel Houltman";
        $cv = "321";
        $email = "houltman@gmail.com";
        $currency = "COP";
        $iso_code = "co";
        $is_test = 0;
        $ip = "127.0.0.0";
        $total = "120000";
        return PayUpayment::processPayMTest($total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test);
    }

    public function agileCrmTags($user, $create, $update)
    {

        $crm = new CrmAgile();

        $data = $crm->search($user);

        //return json_encode($data);

        if ($data) {

            $crm = new CrmAgile();
            $response = $crm->add_agiletags($user->email, $update);

            $crm = new CrmAgile();
            $response = $crm->create($user, $create);

        }

        //return json_encode($data);
    }
    //public function process(RequestSuperPay $request){

    public function process(Request $request)
    {

        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $pais = $request->country;
        $currency = $request->currency;
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = url()->current();
        $country = Country::where('cod_iso2', $pais)->first();
        $totalCompra = $request->amount;
        $email = $request->email;

        try {

            $user = User::create([
                'name' => $request->name,
                'lastName' => $request->surname,
                'country_id' => ($country) ? $country->id : 1,
                'role_id' => 2,
                'email' => $email,
                'password' => bcrypt('123'),
            ]);

        } catch (Exception $e) {
            //return $e;
            //exepcion usuario ya registrado
            if ($e->errorInfo[1] == 1062) {
                //echo "usuario registrado";
                $user = User::where('email', $email)
                    ->first();
            }
        }

        $useragent = "useragent";
        if ($request->header('User-Agent')) {
            $useragent = $request->header('User-Agent');
        }

        $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();

        $totalDeposit = $this->deposit_fee($totalCompra, $idDivisa);
        $newTotal = $this->maker_fee($totalDeposit, $getCriptodefault->maker_fee);
        $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);

        #
        $getTotalCrypto = number_format(($newTotal / $getConvers), 7, '.', '');
        #
        $comision = number_format((($totalCompra - $newTotal)), 2, '.', '');

        DB::beginTransaction();
        $payment = new Payment;
        $payment->user()->associate($user);
        $payment->total = $request->amount;
        $payment->pasarela = 'PayPal';
        $payment->descripcion = "compra";
        $payment->status = 1;
        $payment->currency_id = 1;
        $payment->save();

        $criptowallet = new CryptoWallet;
        $criptowallet->compra = $getTotalCrypto;
        $criptowallet->taker = $comision;
        $criptowallet->cripto_id = $getCriptodefault->id;
        $criptowallet->status = 1;
        $criptowallet->comments = 'Paypal';
        $criptowallet->user()->associate($user);
        $criptowallet->save();

        $critowalletpaymet = new CryptoWalletPyment;
        $critowalletpaymet->payment()->associate($payment);
        $critowalletpaymet->cripto_wallet()->associate($criptowallet);
        $critowalletpaymet->save();

        DB::commit();

        $password = substr(md5(microtime()), 1, 8);
        //$password="12345678";
        $userx = User::find($user->id);
        //$userx->recurly_id=$recurly_id;
        $userx->password = bcrypt($password);
        $userx->save();

        General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);

        Session::flash('success', __('index.success_buy'));
        General::logs($ip, "process", $url, "process", $user->id, $useragent);

        return Response::json(['status' => 1]);

        /*$gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('sami2_api1.suotta.com');
        $gateway->setPassword('A7CZ5R5D6LDYWJ4Z');
        $gateway->setSignature('AU2lsYKisafM.mgwMRvgMv3I7KxDABc3flRJvlV-QpbDGmdNMoXe8knT');
        $gateway->setTestMode('false');

        $gateway->initialize(array(
        'clientId' => 'AbFEs_YXWaJT26GJpzQwiFcqV9YNqKc2JCacSdu2XAzERAbqpYQ3sP6MPZAYiEZqXCGHwQ98fwxGBE9c',
        'secret'   => 'EJIKeSdInnPZohm2_GsWsnvhPyN99QUsGe5bqelQ3lmSRU5Bso0fSmJwfVxM-w7uCR2dreikW9L1bDMM',
        'testMode' => false, // Or false when you are ready for live transactions

        ));

        $card = new CreditCard(array(
        'firstName' => 'wedson',
        'lastName' => 'francois',
        'number' => '4137350272612034',
        'expiryMonth'           => '09',
        'expiryYear'            => '2025',
        'cvv'                   => '321',
        'billingAddress1'       => '1 Scrubby Creek Road',
        'billingCountry'        => 'AU',
        'billingCity'           => 'Scrubby Creek',
        'billingPostcode'       => '4999',
        'billingState'          => 'QLD',
        ));

        $transaction = $gateway->authorize(array(
        'amount'        => '1',
        'currency'      => 'USD',
        'description'   => 'This is a test authorize transaction.',
        'card'          => $card,
        'returnUrl' => 'https://www.example.com/return',
        'cancelUrl'             => 'https://lo.com'
        ));
        $response = $transaction->send();
        if ($response->isSuccessful()) {
        echo "Authorize transaction was successful!\n";
        // Find the authorization ID
        $auth_id = $response->getTransactionReference();
        dd($auth_id);
        }

        dd($response->getMessage());
        //dd($gateway);*/

        //$total=General::aleatorio10($request->total);
        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $currency = $request->currency;
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = url()->current();
        $country = Country::where('cod_iso2', $pais)->first();
        if ($currency == "ARS") {
            //procesar por divisa argentina
            $totalPay = $total;
            $currencyPay = "ARS";
            $isoPay = "ar";

        } else {
            $totalPay = $this->conversTotal($total, $currency);
            $currencyPay = "PEN";
            $isoPay = "pe";
        }

        //return $total;

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
            //return $e;
            //exepcion usuario ya registrado
            if ($e->errorInfo[1] == 1062) {
                //echo "usuario registrado";
                $user = User::where('email', $email)
                    ->first();
            }
        }

        $useragent = "useragent";
        if ($request->header('User-Agent')) {
            $useragent = $request->header('User-Agent');
        }

        $post = [
            'total' => $totalPay,
            'cv' => $request->cv,
            'yy' => date("y") . $request->yy . "/" . $request->mm,
            'cc' => $request->cc,
            'type_card' => $request->card_type,
            'name' => $name . " " . $lastname,
            'is_test' => 0,
            'email' => $email, //substr($email, 1, 200),
            'currency' => $currencyPay,
            'iso_code' => $isoPay,
            //'currency'=>$request->currency,
            'ip' => $ip,
        ];

        $post = json_encode($post);

        $idGetInfo = General::logsx($user->id, $post, "envio", "envio");

        //user error

        if (General::getLogUserError($user->id) == "false") {
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
        }
        //return General::getLogMaxPayment();
        //max approved diario
        if (General::getLogMaxPayment() == "false") {
            $response = ["error" => "true", "code" => "errorMaxpayment"];
            return $response;
        }

        //return $idGetInfo;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://megacursos.com/checkout/payx'); //live
        //curl_setopt($ch, CURLOPT_URL, 'https://megacursos.com/checkout/payxtest');//test
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

        // $resultx = htmlentities($result);
        $result = json_decode($result, true);

        // return $result;

        if ($result["success"]) {
            General::logs($ip, "get", $url, "get", $user->id, $useragent);
            if ($result["data"]["success"]) {
                //evaluar el fluho de la transacion

                if ($result["data"]["response"]["transactionResponse"]["state"] == "DECLINED") {
                    // $msg= $result["data"]["response"]["transactionResponse"]["paymentNetworkResponseErrorMessage"];
                    $msg = "DECLINED";
                    General::logsx($user->id, $post, "DECLINED", $msg);
                    General::logs($ip, "error", $url, "decline", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_index', 'dc_p_declined'];
                    $update = "['dc_p_declined','dc_p_index']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }

                if ($result["data"]["response"]["transactionResponse"]["state"] == "PENDING") {
                    $msg = $result["data"]["response"]["transactionResponse"]["pendingReason"];
                    General::logsx($user->id, $post, "PENDING", $msg);
                    General::logs($ip, "error", $url, "pending", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_index', 'dc_p_pending'];
                    $update = "['dc_p_pending','dc_p_index']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }
                if ($result["data"]["response"]["transactionResponse"]["state"] == "APPROVED") {
                    // dd($result);
                    General::logsx($user->id, $post, "APPROVED", "APPROVED");
                    General::logs($ip, "approved", $url, "approved", $user->id, $useragent);
                    $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
                    $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
                    // $recurly_id=$paymentRecurly->recurly_id;
                    $status = "Success"; //$paymentRecurly->status;
                    $totalDeposit = $this->deposit_fee($totalCompra, $idDivisa); //deposito fee

                    //return $totalx;
                    // $totalx=$total;//General::getMulti($getCurrencyUser->code);
                    $newTotal = $this->maker_fee($totalDeposit, $getCriptodefault->maker_fee);

                    //return $newTotal;
                    $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    //$descuento=General::getDescuento();
                    $getTotalCrypto = number_format(($newTotal / $getConvers), 7, '.', '');
                    $comision = number_format((($totalCompra - $newTotal)), 2, '.', '');

                    DB::beginTransaction();

                    try {

                        $payment = new Payment;
                        $payment->user()->associate($user);
                        $payment->total = $totalCompra;
                        $payment->pasarela = 'PayU';
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
                        //$password="12345678";
                        $userx = User::find($user->id);
                        //$userx->recurly_id=$recurly_id;
                        $userx->password = bcrypt($password);

                        $userx->save();

                        General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);
                        Session::flash('success', __('index.success_buy'));
                        General::logs($ip, "process", $url, "process", $user->id, $useragent);

                        $new = ['dc_desde_dccom', 'dc_desde_dccom_index', 'dc_p_aprobado_index', 'dc_p_aprobado'];
                        $update = "['dc_p_aprobado','dc_p_aprobado_index']";

                        $misTag = $this->agileCrmTags($user, $new, $update);
                        $response = ["success" => "true"];

                        return $response;

                        // return redirect("/login");
                    } catch (Exception $e) {

                        DB::rollback();
                        General::logs($ip, "processerror", $url, "processerror", $user->id, $useragent);
                        $response = ["error" => "true", "code" => $e->getMessage()];

                        return $response;

                        //return Redirect::back()->with('error', __('index.error_buy',["error"=>$e->getMessage()]));
                        // something went wrong
                    }
                    //$response=["error"=>"true","code"=>$result["data"]["response"]["transactionResponse"]["paymentNetworkResponseErrorMessage"]];
                    //return $response;
                }

            } else {
                General::logs($ip, "error", $url, "error", $user->id, $useragent);
                $response = ["error" => "true", "code" => $result["data"]["code"]];
                return $response;
            }

        } else {
            General::logs($ip, "error", $url, "error", $user->id, $useragent);
            $response = ["error" => "true", "code" => "error"];
            return $response;
        }

    }

    public function maker_fee($total, $desc)
    {
        $totalx = ($total - ($total * $desc / 100));
        return number_format($totalx, 2, '.', '');
    }
    public function processIndex(RequestSuperPay $request)
    {

        //$total=General::aleatorio10($request->total);
        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $currency = $request->currency;

        $dni=$request->dni;
        $ciudad=$request->ciudad;
        $postal=$request->postal;
        $phone=$request->phone;
        $direccion = $request->direccion;

        $ip = $_SERVER['REMOTE_ADDR'];
        $url = url()->current();
        $country = Country::where('cod_iso2', $pais)->first();

        $isoCode=strtoupper($country->cod_iso2);

        $to = "COP"; //divisa a convertir en este caso pesos colombianos
        $totalPay = $this->conversTotalNew($total, $currency, $to);
        $currencyPay = "COP";
        $isoPay = "co";

        try {
            $user = User::create([
                'name' => $name,
                'lastName' => $lastname,
                'country_id' => $country->id,
                'role_id' => 2,
                'email' => $email,
                'dni' => $dni,
                'postal' => $postal,
                'ciudad' => $ciudad,
                'phone' => $phone,
                'direccion' => $direccion,
                'password' => bcrypt('123'),
            ]);
        } catch (Exception $e) {
            //return $e;
            //exepcion usuario ya registrado
            if ($e->errorInfo[1] == 1062) {
                //echo "usuario registrado";
                $user = User::where('email', $email)
                    ->first();
            }
        }


        $useragent = "useragent";
        if ($request->header('User-Agent')) {
            $useragent = $request->header('User-Agent');
        }

        $post = [
            'total' => $totalPay,
            'cv' => $request->cv,
            'yy' => date("y") . $request->yy . "/" . $request->mm,
            'cc' => $request->cc,
            'type_card' => $request->card_type,
            'name' => $name . " " . $lastname,
            'is_test' => 0,
            'email' => $email,
            'currency' => $currencyPay,
            'iso_code' => $isoPay,
            'ip' => $ip,
            'dni'=>$dni,
            'ciudad'=>$ciudad,
            'postal'=>$postal,
            'phone'=>$phone,
            'direccion'=>$direccion,
        ];
        $cc = $request->cc;
        $yy = date("y") . $request->yy . "/" . $request->mm;
        $type_card = $request->card_type;
        $name = $name . " " . $lastname;
        $cv = $request->cv;
        $email = $email;
        $currency = "COP";
        $iso_code = "co";
        $is_test = 1; //0 test 1 live
        $ip = $ip;
        $total = $totalPay;
        $origen="A";

        $post = json_encode($post);
        //return $post;

        $idGetInfo = General::logsx($user->id, $post, "envio", "envio");

        //user error

        if (General::getLogUserError($user->id) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }
        //user ip
        if (General::getLogUserIp($ip) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }

        //max error diario
        /*
        if(General::getLogMaxError()=="false"){
        $response=["error"=>"true","code"=>__('home_buy.max_error')];
        return $response;
        }
         */
        //return General::getLogMaxPayment();
        //max approved diario
        /*
        if(General::getLogMaxPayment()=="false"){
        $response=["error"=>"true","code"=>"errorMaxpayment"];
        return $response;
        }
         */

        $result = PayUpayment::processPayUIndex($origen,$total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test,$dni,$postal,$ciudad,$phone,$direccion,$isoCode);

        if ($result["success"]) {
            General::logs($ip, "get", $url, "get", $user->id, $useragent);
            if ($result["success"]) {
                //evaluar el fluho de la transacion

                if ($result["response"]->transactionResponse->state == "DECLINED") {
                    // $msg= $result["response"]["transactionResponse"]["paymentNetworkResponseErrorMessage"];
                    $msg = "DECLINED";
                    General::logsx($user->id, $post, "DECLINED", $msg);
                    General::logs($ip, "error_buy", $url, "error_buy", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_index', 'dc_p_declined'];
                    $update = "['dc_p_declined','dc_p_index']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }

                if ($result["response"]->transactionResponse->state == "PENDING") {
                    $msg = $result["response"]["transactionResponse"]["pendingReason"];
                    General::logsx($user->id, $post, "PENDING", $msg);
                    General::logs($ip, "error", $url, "pending", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_index', 'dc_p_pending'];
                    $update = "['dc_p_pending','dc_p_index']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }
                if ($result["response"]->transactionResponse->state == "APPROVED") {
                    General::logsx($user->id, $post, "APPROVED", "APPROVED");
                    General::logs($ip, "approved", $url, "approved", $user->id, $useragent);
                    $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
                    $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
                    $status = "Success"; //$paymentRecurly->status;
                    $totalDeposit = $this->deposit_fee($totalCompra, $idDivisa); //deposito fee

                    //return $totalx;
                    // $totalx=$total;//General::getMulti($getCurrencyUser->code);
                    $newTotal = $this->maker_fee($totalDeposit, $getCriptodefault->maker_fee);

                    //return $newTotal;
                    $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    //$descuento=General::getDescuento();
                    $getTotalCrypto = number_format(($newTotal / $getConvers), 7, '.', '');
                    $comision = number_format((($totalCompra - $newTotal)), 2, '.', '');

                    DB::beginTransaction();

                    try {

                        $payment = new Payment;
                        $payment->user()->associate($user);
                        $payment->total = $totalCompra;
                        $payment->pasarela = 'PayU';
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
                        //$password="12345678";
                        $userx = User::find($user->id);
                        //$userx->recurly_id=$recurly_id;
                        $userx->password = bcrypt($password);

                        $userx->save();

                        General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);
                        Session::flash('success', __('index.success_buy'));
                        General::logs($ip, "process", $url, "process", $user->id, $useragent);

                        $new = ['dc_desde_dccom', 'dc_desde_dccom_index', 'dc_p_aprobado_index', 'dc_p_aprobado'];
                        $update = "['dc_p_aprobado','dc_p_aprobado_index']";

                        $misTag = $this->agileCrmTags($user, $new, $update);
                        $response = ["success" => "true"];

                        return $response;

                        // return redirect("/login");
                    } catch (Exception $e) {

                        DB::rollback();
                        General::logs($ip, "processerror", $url, "processerror", $user->id, $useragent);
                        $response = ["error" => "true", "code" => $e->getMessage()];

                        return $response;

                        //return Redirect::back()->with('error', __('index.error_buy',["error"=>$e->getMessage()]));
                        // something went wrong
                    }
                    //$response=["error"=>"true","code"=>$result["data"]["response"]["transactionResponse"]["paymentNetworkResponseErrorMessage"]];
                    //return $response;
                }

            } else {
                General::logs($ip, "error", $url, "error", $user->id, $useragent);
                $response = ["error" => "true", "code" => $result["code"]];
                return $response;
            }

        } else {
            General::logs($ip, "error", $url, "error", $user->id, $useragent);
            $response = ["error" => "true", "code" => "error"];
            return $response;
        }

    }

    public function processHome(RequestSuperPayHome $request)
    {

        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = Auth::user()->name;
        $lastname = Auth::user()->lastName;
        $email = Auth::user()->email;
        $pais = Auth::user()->country_id;
        $currency = $request->currency;
        $dni=$request->dni;
        $ciudad=$request->ciudad;
        $postal=$request->postal;
        $phone=$request->phone;
        $direccion = $request->direccion;

        $updateuser = DB::table('users')->where('id',  Auth::user()->id)
        ->update(['dni' => $dni,'ciudad' => $ciudad,'postal' => $postal,'phone' => $phone,'direccion' => $direccion]);
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = url()->current();
        $country = Country::where('id', $pais)->first();
        $isoCode=strtoupper($country->cod_iso2);
        $to = "COP"; //divisa a convertir en este caso pesos colombianos
        $currencyPay = "COP";
        $totalPay = $this->conversTotalNew($total, $currency, $currencyPay);
       
        $isoPay = "co";

        $user = Auth::user();

        $useragent = "useragent";
        if ($request->header('User-Agent')) {
            $useragent = $request->header('User-Agent');
        }

        $post = [
            'total' => $totalPay,
            'cv' => $request->cv,
            //'mm'=>$request->mm,
            'yy' => date("y") . $request->yy . "/" . $request->mm,
            'cc' => $request->cc,
            'type_card' => $request->card_type,
            'name' => $name . " " . $lastname,
            'is_test' => 0,
            'email' => $email, //substr($email, 1, 200),
            'currency' => $currencyPay,
            'iso_code' => $isoPay,
            'ip' => $ip,
            'dni'=>$dni,
            'ciudad'=>$ciudad,
            'postal'=>$postal,
            'phone'=>$phone,
            'direccion'=>$direccion,
        ];
        $post = json_encode($post);

        $cc = $request->cc;
        $yy = date("y") . $request->yy . "/" . $request->mm;
        $type_card = $request->card_type;
        $name = $name . " " . $lastname;
        $cv = $request->cv;
        $email = $email;
        $currency = "COP";
        $iso_code = "co";
        $is_test = 1;//0 test 1 live
        $ip = $ip;
        $total = $totalPay;
        $origen="B";//index

        $idGetInfo = General::logsx($user->id, $post, "enviohome", "enviohome");
        //user error
        if (General::getLogUserError($user->id) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            // return $response;
        }
        //user ip
        if (General::getLogUserIp($ip) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }

        //max error diario

        if (General::getLogMaxError() == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            // return $response;
        }
        
        $result = PayUpayment::processPayUIndex($origen,$total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test,$dni,$postal,$ciudad,$phone,$direccion,$isoCode);
        //la funcion se llama index porque era diferente el index pero ahora es generica
       // $result = PayUpayment::processPayU($total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test);
        if ($result["success"]) {
            General::logs($ip, "get", $url, "get", $user->id, $useragent);
            if ($result["success"]) {
                //evaluar el fluho de la transacion

                if ($result["response"]->transactionResponse->state == "DECLINED") {
                    // $msg= $result["response"]["transactionResponse"]["paymentNetworkResponseErrorMessage"];
                    $msg = "DECLINED";
                    General::logsx($user->id, $post, "DECLINED", $msg);
                    General::logs($ip, "error_buy", $url, "error_buy", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_buy', 'dc_p_declined'];
                    $update = "['dc_p_declined','dc_p_buy']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }

                if ($result["response"]->transactionResponse->state == "PENDING") {
                    $msg = $result["response"]["transactionResponse"]["pendingReason"];
                    General::logsx($user->id, $post, "PENDING", $msg);
                    General::logs($ip, "error", $url, "pending", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_buy', 'dc_p_pending'];
                    $update = "['dc_p_pending','dc_p_buy']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }

                if ($result["response"]->transactionResponse->state == "APPROVED") {
                    General::logsx($user->id, $post, "APPROVED", "APPROVED");
                    General::logs($ip, "approved", $url, "approved", $user->id, $useragent);
                    $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
                    $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
                    $status = "Success"; //$paymentRecurly->status;
                    $totalDeposit = $this->deposit_fee($totalCompra, $idDivisa); //deposito fee
                    $newTotal = $this->maker_fee($totalDeposit, $getCriptodefault->maker_fee);

                    // $totalx=$total;//General::getMulti($getCurrencyUser->code);
                    $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    //$descuento=General::getDescuento($totalx,$getCriptodefault->maker_fee);
                    $getTotalCrypto = number_format(($newTotal / $getConvers), 7, '.', '');
                    $comision = number_format((($totalCompra - $newTotal)), 2, '.', '');
                    DB::beginTransaction();

                    try {

                        $payment = new Payment;
                        $payment->user()->associate($user);
                        $payment->total = $totalCompra;
                        $payment->pasarela = 'PayU';
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
                        Session::flash('success', __('index.success_buy'));
                        General::logs($ip, "process", $url, "process", $user->id, $useragent);

                        $new = ['dc_desde_dccom', 'dc_desde_dccom_buy', 'dc_p_aprobado_buy', 'dc_p_aprobado'];
                        $update = "['dc_p_aprobado','dc_p_aprobado_buy']";

                        $misTag = $this->agileCrmTags($user, $new, $update);

                        $response = ["success" => "true"];

                        return $response;

                    } catch (Exception $e) {

                        DB::rollback();
                        General::logs($ip, "processerror", $url, "processerror", $user->id, $useragent);
                        $response = ["error" => "true", "code" => $e->getMessage()];

                        return $response;

                    }

                }

            } else {
                General::logs($ip, "error", $url, "error", $user->id, $useragent);
                $response = ["error" => "true", "code" => $result["code"]];
                return $response;
            }

        } else {
            General::logs($ip, "error", $url, "error", $user->id, $useragent);
            $response = ["error" => "true", "code" => "error"];
            return $response;
        }

    }
    public function processDepositPayU(Request $request)
    {

        $total = $request->total;
        $amount = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = Auth::user()->name;
        $lastname = Auth::user()->lastName;
        $email = Auth::user()->email;
        $pais = Auth::user()->country_id;
        $currency = $request->currency;
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = url()->current();
        $country = Country::where('id', $pais)->first();

        $isoCode=strtoupper($country->cod_iso2);
        $currencyPay = "COP";
        $isoPay = "co";

        $dni=$request->dni;
        $ciudad=$request->ciudad;
        $postal=$request->postal;
        $phone=$request->phone;
        $direccion = $request->direccion;

        $updateuser = DB::table('users')->where('id',  Auth::user()->id)
        ->update(['dni' => $dni,'ciudad' => $ciudad,'postal' => $postal,'phone' => $phone,'direccion' => $direccion]);
        
        $totalPay = $this->conversTotalNew($total, $currency,$currencyPay);
       
        $user = Auth::user();

        $useragent = "useragent";
        if ($request->header('User-Agent')) {
            $useragent = $request->header('User-Agent');
        }

        $post = [
            'total' => $totalPay,
            'cv' => $request->cv,
            'yy' => date("y") . $request->yy . "/" . $request->mm,
            'cc' => $request->cc,
            'type_card' => $request->card_type,
            'name' => $name . " " . $lastname,
            'is_test' => 0,
            'email' => $email,
            'currency' => $currencyPay,
            'iso_code' => $isoPay,
            'ip' => $ip,
            'dni'=>$dni,
            'ciudad'=>$ciudad,
            'postal'=>$postal,
            'phone'=>$phone,
            'direccion'=>$direccion,
        ];

        $cc = $request->cc;
        $yy = date("y") . $request->yy . "/" . $request->mm;
        $type_card = $request->card_type;
        $name = $name . " " . $lastname;
        $cv = $request->cv;
        $email = $email;
        $currency = "COP";
        $iso_code = "co";
        $is_test = 1;
        $ip = $ip;
        $total = $totalPay;
        $origen="C";//index

        $post = json_encode($post);


        // return $post;

        $idGetInfo = General::logsx($user->id, $post, "enviodeposit", "enviodeposit");
        //user error

        if (General::getLogUserError($user->id) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            // return $response;
        }
        //user ip
        if (General::getLogUserIp($ip) == "false") {
            $response = ["error" => "true", "code" => __('home_buy.max_error')];
            return $response;
        }

        $result = PayUpayment::processPayUIndex($origen,$total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test,$dni,$postal,$ciudad,$phone,$direccion,$isoCode);
        //la funcion se llama index porque era diferente el index pero ahora es generica

       // $result = PayUpayment::processPayU($total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test);
        if ($result["success"]) {
            General::logs($ip, "get", $url, "get", $user->id, $useragent);
            if ($result["success"]) {
                //evaluar el fluho de la transacion

                if ($result["response"]->transactionResponse->state == "DECLINED") {
                    $msg = "DECLINED";
                    General::logsx($user->id, $post, "DECLINED", $msg);
                    General::logs($ip, "error_buy", $url, "error_buy", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_deposit', 'dc_p_declined'];
                    $update = "['dc_p_declined','dc_p_deposit']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }

                if ($result["response"]->transactionResponse->state == "PENDING") {
                    $msg = $result["response"]["transactionResponse"]["pendingReason"];
                    General::logsx($user->id, $post, "PENDING", $msg);
                    General::logs($ip, "error", $url, "pending", $user->id, $useragent);

                    $new = ['dc_desde_dccom', 'dc_desde_dccom_deposit', 'dc_p_pending'];
                    $update = "['dc_p_pending','dc_p_deposit']";
                    $misTag = $this->agileCrmTags($user, $new, $update);

                    $response = ["error" => "true", "code" => $msg];
                    return $response;
                }

                if ($result["response"]->transactionResponse->state == "APPROVED") {
                    General::logsx($user->id, $post, "APPROVED", "APPROVED");
                    General::logs($ip, "approved", $url, "approved", $user->id, $useragent);
                    $currency = Currency::find($idDivisa);

                    $metodo = "PayU";

                    if ($currency) {

                        $totalDeposit = $this->deposit_fee($amount, $idDivisa); //deposito fee
                        $comision = number_format((($amount * $totalDeposit)), 2, '.', '');
                        //$total = $totalx - $comision;
                        DB::beginTransaction();

                        try {
                            $payment = new Payment;
                            $payment->user()->associate($user);
                            $payment->total = $amount;
                            $payment->pasarela = $metodo;
                            $payment->descripcion = "deposito";
                            $payment->status = 1;
                            $payment->currency()->associate($currency);
                            $payment->save();

                            $wallet = new Wallet;
                            $wallet->abono = $totalDeposit;
                            $wallet->status_user = "Aprobado";
                            $wallet->currency()->associate($currency);
                            $wallet->status = 1;
                            $wallet->user()->associate($user);
                            $wallet->save();

                            $paymentwallet = new Payment_Wallet;
                            $paymentwallet->payment()->associate($payment);
                            $paymentwallet->wallet()->associate($wallet);
                            $paymentwallet->save();

                            DB::commit();
                            General::email($wallet->abono, $currency->code, $user, "Deposit");

                            $new = ['dc_desde_dccom', 'dc_desde_dccom_deposit', 'dc_p_aprobado_deposit', 'dc_p_aprobado'];
                            $update = "['dc_p_aprobado','dc_p_aprobado_deposit']";

                            $misTag = $this->agileCrmTags($user, $new, $update);

                            $response = ["success" => "true", "tipo" => "deposit"];
                            return $response;
                            // return $wallet;
                        } catch (Exception $e) {
                            DB::rollback();
                            $response = ["success" => "false"];
                            return $response;
                        }

                    }
                }

            } else {
                General::logs($ip, "error", $url, "error", $user->id, $useragent);
                $response = ["error" => "true", "code" => $result["code"]];
                return $response;
            }

        } else {
            General::logs($ip, "error", $url, "error", $user->id, $useragent);
            $response = ["error" => "true", "code" => "error"];
            return $response;
        }

    }
    public function deposit_fee($total, $idDivisa)
    {
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        return ($total - ($total * ($getCurrencyUser->detailCurrency->comision_abono / 100)));
    }

    public function conversTotal($amount, $currency)
    {
        //return $total;
        $endpoint = 'convert';
        $access_key = config('services.fixer.key');
        $to = 'PEN';
        $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $currency . '&to=' . $to . '&amount=' . $amount . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);

        $convertedamount = $conversionResult['result'];

        return $convertedamount;

    }

    public function conversTotalNew($amount, $currency, $to)
    {

        $endpoint = 'convert';
        $access_key = config('services.fixer.key');
        $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $currency . '&to=' . $to . '&amount=' . $amount . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);
        $convertedamount = $conversionResult['result'];

        return $convertedamount;

    }

}
