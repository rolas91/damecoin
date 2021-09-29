<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\Currency;
use App\Payment;
use App\PaymentWallTransaction;
use App\User;
use Auth;
use DB;
use Exception;
use General;

class UniPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buy(Request $request)
    {
        $total = $request->total;
        $totalCompra = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        $currency = $request->currency;
        $name = Auth::user()->name;
        $lastname = Auth::user()->lastName;
        $email = Auth::user()->email;
        //capturando ip
        $ip = $_SERVER['REMOTE_ADDR'];

        //log de envio
        $log = DB::table('logs')->insert(
            [
                'ipaddress' => $request->ip(),
                'useragent' => 2,
                'url' => "envio a unipay ",
                'description' => "error_buy",
                'tipo' => "error_buy",
                'user_id' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        /*
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

*/
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

        
        //preparando la data para el envio
        $post = [
            "user_id" => $user->id,
            "token" => $token,
            "currency" => $currencyPay,
            "amount" => $totalPay,
            "email" => $email,
            "fullname" => $name . " " . $lastname,

        ];

        //preparanado url para envio

        $base_url = env("APP_BASE_URL_UNITPAY");
        $base_url .= "/api/v1/payment-unit-pay";

        $post = json_encode($post);
        //enviando informacion con curl
        $idGetInfo = General::logsx($user->id, $post, "envio unit pay", "envio unit pay" );

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

        $result = json_decode($result, true);
      
     
        return $result;

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
