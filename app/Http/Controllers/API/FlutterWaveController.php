<?php

namespace App\Http\Controllers\API;

use App\AdminConfig;
use App\Country;
use App\CrmAgile;
use App\Crypto;
use App\CryptoWallet;
use App\CryptoWalletPyment;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Payment;
use App\PaymentWallTransaction;
use App\Payment_Wallet;
use App\User;
use App\Wallet;
use Exception;
use General;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlutterWaveController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {

    }
    public function store(Request $request)
    {

        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $currency = $request->currency;

        // $dni=$request->dni;
        $ciudad = $request->ciudad;
        //$postal=$request->postal;
        $phone = $request->phone;
        // $direccion = $request->direccion;

        $ip = $_SERVER['REMOTE_ADDR'];
        $url = url()->current();
        $country = Country::where('cod_iso2', $pais)->first();

        $isoCode = strtoupper($country->cod_iso2);

        try {
            $user = User::create([
                'name' => $name,
                'lastName' => $lastname,
                'country_id' => $country->id,
                'role_id' => 2,
                'email' => $email,
                //'dni' => $dni,
                //'postal' => $postal,
                'ciudad' => $ciudad,
                'phone' => $phone,
                // 'direccion' => $direccion,
                'password' => bcrypt('123'),
            ]);
            // Agile send data

        } catch (Exception $e) {
            if ($e->errorInfo[1] == 1062) {
                $user = User::where('email', $email)
                    ->first();
            }
        }

        $crm = new CrmAgile();
        $info = $crm->sendAgile($user, ['dc_desde_index']);

        $useragent = "useragent";
        if ($request->header('User-Agent')) {
            $useragent = $request->header('User-Agent');
        }

        $base_url = env("APP_BASE_URL_SHARE"); // 'https://sharedetect.com/api/v1/payment-share';

        // $soporteRecurly  = ["ZAR"];
        $flutterPublickey = AdminConfig::flutter('flutterPublickey');

        $flutterPublickey = $flutterPublickey->value;

        $flutterDivisaDefault = AdminConfig::flutter('flutterDivisaDefault');
        if ($flutterDivisaDefault->value) {
            $flutterCurrency = AdminConfig::flutter('flutterCurrency');
            $currencyPay = "ZAR";
            if ($flutterCurrency) {
                $currencyPay = $flutterCurrency->value;
            }

            $idDivisa = $this->divisaDefault($currencyPay); //divisa por default
            $totalPay = $this->conversTotalNew($totalCompra, $currency, $currencyPay);
     
            $flutterCountry = AdminConfig::flutter('flutterCountry');
            $flutterCountry = $flutterCountry->value;

        } else {

            $soporteRecurly = ["ZAR", "GBP", "USD", "EUR", "MXN", "NGN"];
            //$flutterCountry=$user->country?$user->country->cod_iso2:"ES";
            //$flutterCountry=strtoupper($flutterCountry);
            $flutterCountry = AdminConfig::flutter('flutterCountry');
            $flutterCountry = $flutterCountry->value;
            if (in_array($currency, $soporteRecurly)) {
                $idDivisa = $idDivisa;
                $totalPay = $totalCompra;
                $currencyPay = $currency;
            } else {
                $idDivisa = $this->divisaDefault("USD"); //divisa por default
                $totalPay = $this->conversTotalNew($totalCompra, $currency, "USD");
                $currencyPay = "USD";

            }

        }

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

        if (General::getLogMaxPayment() == "false") {
            $response = ["error" => "true", "code" => "errorMaxpayment"];
            return $response;
        }
        //forzar 3 intentos por usuarios
        General::logs($ip, "error_buy", $url, "error_buy", $user->id, $useragent);

        $token = str_random(30);
        $transaction = PaymentWallTransaction::create([
            'user_id' => $user->id,
            'direct' => $request->dir,
            'currency_id' => $idDivisa,
            'crypto_id' => $idCrypto,
            'token' => $token,
            'amount' => $totalPay,
            'status' => 'pending',
        ]);

        $log = DB::table('logs')->insert(
            [
                'ipaddress' => $request->ip(),
                'useragent' => 2,
                'url' => "envio a sharedetect",
                'description' => "envio a sharedetect",
                'tipo' => "envio a sharedetect",
                'user_id' => $user->id,
            ]
        );

        $post = [
            "user_id" => $user->id,
            "token" => $token,
            "publicKey" => $flutterPublickey,
            "countryFlutter" => $flutterCountry,
            "currency" => $currencyPay,
            "amount" => $totalPay,
            "email" => $email,
            "phone_number" => $phone,
            "fullname" => $name . " " . $lastname,
            'ip' => $ip,
            "tx_ref" => $token . "-" . $user->id, // should be unique for every transaction
            "redirect_url" => "https://sharedetect.com/rave/callback",
        ];

        $post = json_encode($post);

   //     return $post;

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
            $info = [
                "success" => "false",
                "code" => "fail",
            ];
            return response($info, 200);
        }
        curl_close($ch);

        $result = json_decode($result, true);

        return $result;

    }

    public function divisaDefault($currency)
    {
        $curre = Currency::select("id")->where("code", $currency)->first();
        if ($curre) {
            return $curre->id;
        } else {
            return 41; //divisa zar
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentWallTransaction $transaction)
    //public function update(Request $request,$id,Log $log)
    {

        $idx = 1;
        $log = DB::table('logs')->insert(
            [
                'ipaddress' => $request->ip(),
                'useragent' => 2,
                'url' => "get a megacursos",
                'description' => "get a megacursos",
                'tipo' => "get a megacursos",
                'user_id' => $idx,
            ]
        );

        try {
            // dd($request);
            if ($request->type === '0') {

                try {
                    $payment = DB::table('payment_wall_transactions')->where([
                        ['token', '=', $request->token],
                        ['status', '=', 'pending'],
                    ])->update(['status' => 'approved']);

                    $info = DB::table('payment_wall_transactions')->where('token', $request->token)->first();

                    $idDivisa = $info->currency_id;
                    $idCripto = $info->crypto_id;
                    $total = $info->amount;
                    $direct = $info->direct;
                    //$user=DB::table('users')->where('id',$request->uid )->first();
                    $user = User::find($request->uid);

                    $tipo = "compra";
                    $metodo = "FasterPay";
                    if (($direct == "index") || ($direct == "buy")) {
                        $process = $this->createProcessFaster($idDivisa, $idCripto, $total, $user, $tipo, $metodo, $direct);
                        // return json_encode($process);
                        if ($process["success"] == "true") {
                            return response()->json(['success' => 'true', 'message' => 'Pago confirmado exitosamente'], 200);
                        }
                    }
                    if (($direct == "deposit")) {

                        $process = $this->createProcessDepositFaster($idDivisa, $total, $user, $tipo, $metodo, $direct);
                        if ($process["success"] == "true") {
                            return response()->json(['success' => 'true', 'message' => 'Pago confirmado exitosamente'], 200);
                        }
                        //return response()->json(['success' => 'true', 'message' => $process], 200);
                        //return response()->json(['success' => 'true', 'message' => 'Pago confirmado exitosamente'], 200);
                    }

                } catch (Exception $ex) {
                    //throw $th;
                    if (!config('app.debug')) {
                        return response()->json('Ocurrió un error inesperado, intente nuevamente más tarde', 500);
                    }
                    return response()->json($ex->getMessage(), 500);
                }

            } else {
                $payment = DB::table('payment_wall_transactions')->where([
                    ['token', '=', $request->token],
                    ['status', '=', 'pending'],
                ])->update(['status' => 'declined']);
                return response()->json(['success' => 'true', 'message' => 'Su pago fue rechazado'], 200);
            }
        } catch (QueryException $ex) {
            //throw $th;
            if (!config('app.debug')) {
                return response()->json('Ocurrió un error inesperado, intente nuevamente más tarde', 500);
            }
            return response()->json($ex->getMessage(), 500);
        }

    }

    public function createProcessDepositFaster($idDivisa, $total, $user, $tipo, $metodo, $direct)
    {
        //return $idDivisa;
        $currency = Currency::find($idDivisa);

        $totalx = $total;

        if ($currency) {

            $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
            $total = $totalx - $comision;
            DB::beginTransaction();

            try {
                $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $totalx;
                $payment->pasarela = $metodo;
                $payment->descripcion = "deposito";
                $payment->status = 1;
                $payment->currency()->associate($currency);
                $payment->save();

                $wallet = new Wallet;
                $wallet->abono = $total;
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
    public function createProcessFaster($idDivisa, $idCrypto, $total, $user, $tipo, $metodo, $direct)
    {
        $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        $status = "Success"; //$paymentRecurly->status;
        $totalx = $total; //General::getMulti($getCurrencyUser->code);
        $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
        $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
        $comision = number_format((($totalx - $descuento)), 2, '.', '');

        // return $getTotalCrypto;

        DB::beginTransaction();

        try {

            $payment = new Payment;
            $payment->user()->associate($user);
            $payment->total = $totalx;
            $payment->pasarela = $metodo;
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
            if ($direct == "index") {
                //envio el password
                $password = substr(md5(microtime()), 1, 8);
                $userx = User::find($user->id);
                $userx->password = bcrypt($password);
                $userx->save();
                General::emailindex($criptowallet->compra, $getCriptodefault->code, $user, "Purchase", $password);
                // Session::flash('success',__('index.success_buy'));
                $response = ["success" => "true", "tipo" => "index"];
                return $response;

            }
            if ($direct == "buy") {
                //ya esta logueado el usuario
                General::email($criptowallet->compra, $getCriptodefault->code, $user, "Purchase");
                $response = ["success" => "true", "tipo" => "buy"];
                return $response;
            }

        } catch (Exception $e) {

            DB::rollback();
            $response = ["success" => "false"];
            return $response;

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
