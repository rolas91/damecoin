<?php

namespace App\Http\Controllers\Payment;

use App\Country;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Payment;
use App\PaymentWallTransaction;
use App\User;
use Auth;
use DB;
use Exception;
use General;
use Illuminate\Http\Request;
use App\AdminConfig;

class RevoController extends Controller
{
    public function process(Request $request)
    {
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
        $ciudad = $request->ciudad;
        $phone = $request->phone;
        $direccion = $request->direccion;
        $postal = $request->postal;
        $country = Country::where('id', $pais)->first();
        $isoCode = strtoupper($country->cod_iso2);

        //capturando ip
        $ip = $_SERVER['REMOTE_ADDR'];

        //log de envio
        $log = DB::table('logs')->insert(
            [
                'ipaddress' => $request->ip(),
                'useragent' => 2,
                'url' => "envio a ",
                'description' => "error_buy",
                'tipo' => "error_buy",
                'user_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        //return $isoCode;

        //user error
        //validaciones de intentos
        if (General::getLogUserError(Auth::user()->id) == "false") {
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

        //update user
        $updateuser = DB::table('users')->where('id', Auth::user()->id)
            ->update(['ciudad' => $ciudad, 'postal' => $postal, 'phone' => $phone, 'direccion' => $direccion]);

        //validar soporte pasarela
        $soporteRevolt = ["USD", "EUR", "GBP"];

        if (in_array($currency, $soporteRevolt)) {
            $idDivisa = $idDivisa;
            $totalPay = $totalCompra;
            $currencyPay = $currency;
        } else {
            $idDivisa = 1; //divisa por default
            $totalPay = General::conversTotalNew($totalCompra, $currency, "USD");
            $currencyPay = "USD"; //"COP";

        }

        //usuario logueado
        $user = Auth::user();

        //informacion local de pago estatus pendiente
        $token = str_random(30);
        $transaction = PaymentWallTransaction::create([
            'user_id' => $user->id,
            'direct' => $request->direct,
            'currency_id' => $idDivisa,
            'crypto_id' => $idCrypto,
            'token' => $token,
            'amount' => $totalPay,
            'status' => 'pending',
        ]);

        // $ip="193.252.45.218";//francia
        $location = General::getCountryCode($ip);

        // if($location["countryCode"];

        if ($location == "-") {
            $location = $isoCode;
        }

        // return $location;

        //preparando la data para el envio
        $post = [
            "user_id" => $user->id,
            "token" => $token,
            "currency" => $currencyPay,
            "amount" => $totalPay,
            "email" => $email,
            "phone_number" => $phone,
            "fullname" => $name . " " . $lastname,
            "city" => $ciudad,
            "address" => $direccion,
            "location" => $location,
            "postal" => $postal,
        ];

        //preparanado url para envio

        $base_url = env("APP_BASE_URL_REVO");
        $base_url .= "api/v1/payment-revo";

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
    public function processIndex(Request $request)
    {
        //request
        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $currency = $request->currency;
        $ciudad = $request->ciudad;
        $phone = $request->phone;
        $direccion = $request->direccion;
        $postal = $request->postal;
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

        $isoCode = strtoupper($country->cod_iso2);

        //capturando ip
        $ip = $_SERVER['REMOTE_ADDR'];

        //log de envio
        $log = DB::table('logs')->insert(
            [
                'ipaddress' => $request->ip(),
                'useragent' => 2,
                'url' => "envio a ",
                'description' => "error_buy",
                'tipo' => "error_buy",
                'user_id' => $user->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        //user error
        //validaciones de intentos
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

        //update user
        $updateuser = DB::table('users')->where('id', $user->id)
            ->update(['ciudad' => $ciudad, 'postal' => $postal, 'phone' => $phone, 'direccion' => $direccion]);

        //validar soporte pasarela
        $soporteRevolt = ["USD", "EUR", "GBP"];

        if (in_array($currency, $soporteRevolt)) {
            $idDivisa = $idDivisa;
            $totalPay = $totalCompra;
            $currencyPay = $currency;
        } else {
            $idDivisa = 1; //divisa por default
            $totalPay = General::conversTotalNew($totalCompra, $currency, "USD");
            $currencyPay = "USD"; //"COP";

        }

        //usuario logueado
        // $user = Auth::user();

        //informacion local de pago estatus pendiente
        $token = str_random(30);
        $transaction = PaymentWallTransaction::create([
            'user_id' => $user->id,
            'direct' => $request->direct,
            'currency_id' => $idDivisa,
            'crypto_id' => $idCrypto,
            'token' => $token,
            'amount' => $totalPay,
            'status' => 'pending',
        ]);

        // $ip="193.252.45.218";//francia
        $location = General::getCountryCode($ip);

        // if($location["countryCode"];

        if ($location == "-") {
            $location = $isoCode;
        }

        // return $location;

        //preparando la data para el envio
        $post = [
            "user_id" => $user->id,
            "token" => $token,
            "currency" => $currencyPay,
            "amount" => $totalPay,
            "email" => $email,
            "phone_number" => $phone,
            "fullname" => $name . " " . $lastname,
            "city" => $ciudad,
            "address" => $direccion,
            "location" => $location,
            "postal" => $postal,
        ];

        //preparanado url para envio

        $base_url = env("APP_BASE_URL_REVO");
        $base_url .= "api/v1/payment-revo";

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

    public function paymentsharebuy(Request $request)
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
        // $ciudad = $request->ciudad;
        $phone = $request->phone;
        $direccion = $request->direccion;
        // $postal = $request->postal;
        $country = Country::where('id', $pais)->first();
        $isoCode = strtoupper($country->cod_iso2);

        $ip = $_SERVER['REMOTE_ADDR'];
        $url = url()->current();
        $country = Country::where('id', $pais)->first();

        $isoCode = strtoupper($country->cod_iso2);

        $useragent = "useragent";
        if ($request->header('User-Agent')) {
            $useragent = $request->header('User-Agent');
        }

        //update user
        $updateuser = DB::table('users')->where('id', Auth::user()->id)
            ->update(['phone' => $phone, 'direccion' => $direccion]);

        $base_url = env("APP_BASE_URL_SHARE"); // 'https://sharedetect.com/api/v1/payment-share';

     
        $flutterPublickey = AdminConfig::flutter('flutterPublickey');

        $flutterPublickey = $flutterPublickey->value;

        $user = Auth::user();

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
        //usuario logueado
      
        //user error
        if (env("APP_ENV") == "production") {
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
        }

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
            "publicKey"=>$flutterPublickey,
            "countryFlutter"=>$flutterCountry,
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

      //  return $post;

        $idGetInfo = General::logsx($user->id, $post, "envio", "envio");
        try {

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

        } catch (Exception $e) {
            $info = [
                "success" => "false",
                "code" => "fail",
            ];
            return response($info, 200);
        }

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

    public function divisaDefault($currency)
    {
        $curre = Currency::select("id")->where("code", $currency)->first();
        if ($curre) {
            return $curre->id;
        } else {
            return 26; //divisa GBP
        }

    }
}
