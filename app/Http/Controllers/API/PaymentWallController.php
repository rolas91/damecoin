<?php

namespace App\Http\Controllers\API;

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

class PaymentWallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $idDivisa = $request->idCurrency;
        $cryptoid = $request->idCrypto;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $token = str_random(25);
        $currencyCode = strtoupper($request->currency);
        //return $request->direct;
        // URL
        if (env("APP_ENV") === 'local') {
            $base_url = 'https://megacursos.test/damecoins/genpayurl';
        } else {
            $base_url = 'https://megacursos.com/damecoins/genpayurl';
        }

        $countryID = Country::where('cod_iso2', $pais)->firstOrFail();
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'role_id' => 2,
                'lastName' => $lastname,
                'country_id' => $countryID->id,
                'password' => bcrypt('12345678'),
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
        $transaction = PaymentWallTransaction::create([
            'user_id' => $user->id,
            'direct' => $request->direct,
            'currency_id' => $idDivisa,
            'crypto_id' => $cryptoid,
            'token' => $token,
            'amount' => $total,
            'status' => 'pending',
        ]);

        $log = DB::table('logs')->insert(
            [
                'ipaddress' => $request->ip(),
                'useragent' => 2,
                'url' => "envio a megacursos",
                'description' => "envio a megacursos",
                'tipo' => "envio a megacursos",
                'user_id' => $user->id,
            ]
        );

        $post = array(
            'uid' => $user->id,
            'email' => $email,
            'token' => $token,
            'amount' => $total,
            'currencyCode' => $currencyCode,
            'transaction_id' => $transaction->id,
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
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        // echo $result["success"];
        //dd($result);
        // $result = htmlentities($result);
        $result = json_decode($result, true);
        // dd($result);
        return $result;
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
            if ($request->success == 'true') {

                try {

                    $payment = DB::table('payment_wall_transactions')->where([
                        ['token', '=', $request->token],
                        ['user_id', '=', $request->user_id],
                        ['status', '=', 'pending'],
                    ])->update(['status' => 'approved']);

                    if ($payment) {

                        $info = DB::table('payment_wall_transactions')
                            ->where(
                                [
                                    ['token', '=', $request->token],
                                    ['user_id', '=', $request->user_id],
                                    ['status', '=', 'approved'],
                                ])
                            ->first();
                            

                        $idDivisa = $info->currency_id;
                        $idCripto = $info->crypto_id;
                        $total = $info->amount;
                        $direct = $info->direct;
                        $user = User::find($request->user_id);
                       
                        $tipo = "compra";
                        $metodo = "flutterwave";
                        if (($direct == "index") || ($direct == "buy")) {

                        $process = $this->createProcessFaster($idDivisa, $idCripto, $total, $user, $tipo, $metodo, $direct);
                           
                            if ($process["success"] == "true") {
                                  return response()->json(['success' => 'true', 'message' => 'Pago confirmado exitosamente'], 200);
                            }
                        }
                        if (($direct == "deposit")) {

                            $process = $this->createProcessDepositFaster($idDivisa, $total, $user, $tipo, $metodo, $direct);

                            if ($process["success"] == "true") {
                                $crm = new CrmAgile();
                                $infxxo = $crm->sendAgile($user, ['dc_desde_dccom', 'dc_desde_dccom_deposit', 'dc_p_aprobado']);
                                return response()->json(['success' => 'true', 'message' => 'Pago confirmado exitosamente'], 200);
                            }
                        }

                    } else {

                        return response()->json(['success' => "false"], 200);

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
                  return $response; 
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
                $crm = new CrmAgile();
                $infoxx = $crm->sendAgile($user,['dc_desde_dccom','dc_desde_dccom_index','dc_p_aprobado']);
                               
                General::emailindex($criptowallet->compra,$getCriptodefault->code,$user,"Purchase",$password);
                $response = ["success" => "true", "tipo" => "index"];
                return $response;

            }
            if ($direct == "buy") {
                //ya esta logueado el usuario
                $crm = new CrmAgile();
                $infoxx = $crm->sendAgile($user,['dc_desde_dccom','dc_desde_dccom_buy','dc_p_aprobado']);
                               
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
}
