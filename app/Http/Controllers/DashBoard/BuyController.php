<?php

namespace App\Http\Controllers\DashBoard;

use App\Crypto;
use App\CryptoWallet;
use App\CryptoWalletPyment;
use App\CryptoWalletWallet;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestDashBuy;
use App\Payment;
use App\PaymentLimit;
use App\PaymentMethods;
use App\Receipt;
use App\SendPhoneCode;
use App\User;
use App\Wallet;
use Auth;
use Dashboard;
use DB;
use Exception;
use General;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Twilio\Rest\Client;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCrypto = null, $idDivisa = null)
    {
        $paymentMethods = PaymentMethods::all();

        // return $paymentMethods;

        $user = Auth::user();

        $currencyDefault = Dashboard::getCurrencyDefault();

        $cryptoDefault = Dashboard::getCryptoDefault();

        $getCriptodefault = Crypto::where('id', $cryptoDefault)->first();
        $getCurrencyUser = Currency::where('id', $currencyDefault)->first();

        $getCurrencies = DB::table('currencies')->pluck('name', 'id');

        $limit = PaymentLimit::first();
        $mintransfe = $limit->bank_deposit_minimum;
        $convertBank = General::getConverFromToNew("USD", $getCurrencyUser->code, $mintransfe);
        $minBank = round($convertBank, 2) . " " . $getCurrencyUser->code;
        // return $minBank;

        $totalCrypto = 0;
        $getTotalDivisa = General::getCryptoWalettUser($currencyDefault);

        $getCryptos = Crypto::select("id", "code", "name", "img")->orderBy('orden', 'asc')->orderBy('name', 'asc')->get();

        // $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        $getConvers = General::getConversNew($getCurrencyUser->code, $getCryptos);
        //return $getConvers;
        if ($getConvers) {
            if ($getConvers > 0) {
                $getConvers = $getConvers[$getCriptodefault->code];
                $getPanel = General::newGetPanel($getConvers, $getCurrencyUser->id, $getCriptodefault->id, $getCurrencyUser, $getCriptodefault);
                //return $getPanel;
                $defaultValor = General::getDescuentoSinComision($getCurrencyUser->detailCurrency->max_deposito, $getCriptodefault->maker_fee);

                $getConvers = number_format($getConvers, 2, '.', '');
                $valorPersonPay = $getCurrencyUser->detailCurrency->max_deposito * 2;
                $xxvalor1 = General::getDescuentoSinComision($valorPersonPay, $getCriptodefault->maker_fee);
                $person['pay'] = number_format(($valorPersonPay), 2, '.', '');
                $person['recibe'] = number_format(($xxvalor1 / $getConvers), 7, '.', '');
                $meta['key'] = __('dash_general.key');
                $meta['title'] = __('dash_general.title', ["cripto" => $getCriptodefault->name, "currency" => $getCurrencyUser->name]);
                $meta['descripcion'] = __('dash.description', ["currency" => $getCurrencyUser->name]);
                $page = 'buy';

                $defaultCurrency = $getCurrencyUser; //para veriicar donde se utiliza en el layot porque no es necesaria

                $wallet = true;
                return view('dashboard.buy', compact('wallet', 'minBank', 'paymentMethods', 'person', 'getCryptos', 'getCriptodefault', 'getCurrencyUser', 'getCryptos', 'getCurrencies', 'totalCrypto', 'getTotalDivisa', 'getPanel', 'defaultCurrency', 'meta', 'page'));

            } else {
                //log dummy

            }
        } else {

        }
    }
    /**
     * Show buy express
     *
     * @return \Illuminate\Http\Response
     */

    public function buyUserWallet(Request $request)
    {
        //verifico que tiene el monto en el wallet
        $getTotal = $request->total;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCrypto;
        try {
            $getCriptodefault = General::getCriptodefault($idCrypto);
            $getCurrencyUser = General::getCurrencyUser($idDivisa);
            $getTotalDivisa = General::getCryptoWalettUser($idDivisa);
            if ($getTotalDivisa >= $getTotal) {
                //saldo valido
                //capturo cuanta cripto puede comprar con el monto enviado
                $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                $comision = $getCriptodefault->maker_fee * $getTotal / 100;
                $comision = number_format($comision, 2, '.', '');
                $newTotal = $getTotal - $comision;
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
                    // General::email($criptowallet->compra, $getCriptodefault->code, Auth::user(), "Purchase");

                    $data = [
                        "success" => "true",
                        "mensaje" => __('index.success_buy'),
                    ];

                    return response()->json($data);

                } catch (Exception $e) {

                    DB::rollback();
                    return Redirect::back()->with('error', __('index.error_buy'));
                    // something went wrong
                }
            } else {
                $data = [
                    "success" => "false",
                    "mensaje" => __('home_buy.quanty_not_found'),
                ];
                return response()->json($data);
                //return "sin saldo";
            }
        } catch (Exception $e) {

            $data = [
                "success" => "false",
                "mensaje" => $e->getMessage(),
            ];
            return response()->json($data);

        }

    }
    public function buyExpress()
    {

        $currencies = Currency::select('id', 'name')->where('status', 1)->get();

        $cryptos = Crypto::where('status', 1)->select('id', 'name')->get();

        $user = User::find(Auth::user()->id);

        if ($user->preference) {
            $currency = $user->preference->fiat_wallet_default;
            $getCurrencyUser = Currency::select('code', 'id')->where('id', $currency)->first();
            $crypto = $user->preference->crypto_wallet_default;
            $getCriptodefault = Crypto::select('code', 'id')->where('id', $crypto)->first();

        } else {
            $getCurrencyUser = Currency::select('id', 'code')->where('code', config("settings.default.currency"))->first();
            $getCriptodefault = Crypto::select('id', 'code')->where('code', config("settings.default.crypto"))->first();
        }

        $getConversNew = General::getConversNew($getCurrencyUser->code, $cryptos);

        if ($getConversNew) {

            $getConvers = $getConversNew[$getCriptodefault->code];

            $data = [
                "currencies" => $currencies,
                "currencyPerson" => $getCurrencyUser,
                "cryptos" => $cryptos,
                "cryptoPerson" => $getCriptodefault,
                'change' => number_format($getConvers, 2, '.', ''),
            ];

            return response()->json($data);

        }

    }

    public function getConvert(Request $request)
    {

        $currency = $request->currency;
        $crypto = $request->crypto;

        $amountCrypto = number_format($request->totalCrypto, 7, '.', '');

        $cryptos = General::getCryptos();

        $getConversNew = General::getConversNew($currency, $cryptos);

        // return $getConversNew;

        if ($getConversNew) {

            if ($request->cry == "true") {
                $convertOriginal = number_format($getConversNew[$crypto], 2, '.', '');
                $convert = $amountCrypto * $convertOriginal;
            } else {
                $convertOriginal = number_format($getConversNew[$crypto], 8, '.', '');
                $convert = $amountCrypto / $convertOriginal;

            }

            $data = [
                "success" => "true",
                "currency" => $currency,
                "crypto" => $crypto,
                "amountCrypto" => $amountCrypto,
                'converCrypto' => $convert,
                "convertOriginal" => $convertOriginal,
            ];

            return response()->json($data);

        }

        // return $amountCrypto;
        /*

    $getCurrencyUser = Currency::select('code', 'id')->where('id', $currency)->first();
    $getCriptodefault = Crypto::select('code', 'id')->where('id', $crypto)->first();

    $getConversNew = General::getConversNew($getCurrencyUser->code, $cryptos);

    if ($getConversNew) {

    $getConvers = $getConversNew[$getCriptodefault->code];

    $data = [
    "currencyPerson" => $getCurrencyUser,
    "cryptoPerson" => $getCriptodefault,
    'change' => number_format($getConvers, 2, '.', ''),
    ];

    return response()->json($data);

    }
     */

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
    public function buy(RequestDashBuy $request)
    {
        //validar las divisas
        $getTotal = $request->amount;
        $idDivisa = $request->idCurrency;
        $idCrypto = $request->idCripto;
        $idPasarela = $request->selectPayment;
        $file = $request->receipt;

        try {
            //validar la data por si envian basura en los inputs
            $getCripto = Crypto::select("id", "name", "code")->find($idCrypto);
            $getCurrency = Currency::select("id", "name", "code")->find($idDivisa);
            $pasarela = PaymentMethods::select("name")->find($idPasarela);

            $totalPayment = Dashboard::deposit_fee($getTotal, $getCurrency->detailCurrency->comision_abono); //deposito fee
            $newTotal = Dashboard::maker_fee($totalPayment, $getCripto->maker_fee);
            $getConvers = General::getConvers($getCurrency->code, $getCripto->code);
            $getTotalCrypto = number_format(($newTotal / $getConvers), 7, '.', '');
            $comision = number_format((($getTotal - $newTotal)), 2, '.', '');

            $user = User::find(Auth::user()->id);

            DB::beginTransaction();

            try {

                $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $getTotal;
                $payment->pasarela = $pasarela->name;
                $payment->descripcion = "compra pendiente";
                $payment->status = 1;
                $payment->status_payment = "Pendiente"; //nuevo valor para no interferir con producction
                $payment->currency_id = $getCurrency->id;
                $payment->save();

                $criptowallet = new CryptoWallet;
                $criptowallet->compra = $getTotalCrypto;
                $criptowallet->taker = $comision;
                $criptowallet->cripto_id = $getCripto->id;
                $criptowallet->status = 1;
                $criptowallet->status_user = "Pendiente";
                $criptowallet->user()->associate($user);
                $criptowallet->save();

                $critowalletpaymet = new CryptoWalletPyment;
                $critowalletpaymet->payment()->associate($payment);
                $critowalletpaymet->cripto_wallet()->associate($criptowallet);
                $critowalletpaymet->save();

                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $file->move('uploads/comprobante/', $filename);

                $receipt = new Receipt;
                $receipt->payment()->associate($payment);
                $receipt->receipt = $filename;
                $receipt->save();

                General::email($criptowallet->compra, $getCripto->code, Auth::user(), "Pending Purchase");

                DB::commit();

                Session::flash('success', __('index.success_buy'));
                return redirect("/dash/portfolio");

            } catch (Exception $e) {

                DB::rollback();
                return $e;
                return Redirect::back()->with('error', __('index.error_buy'));

            }

        } catch (Exception $e) {

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
    public function validPhone(Request $request)
    {
        $codeDatabase = SendPhoneCode::where("user_id", Auth::user()->id)->orderBy("created_at", "desc")->first();
        if ($codeDatabase) {

            $code = $request->code;

            if ($codeDatabase->code == $code) {
                $payment = DB::table('users')->where([
                    ['id', '=', Auth::user()->id],
                ])->update(['verified' => 1]);
                $response = ["success" => "true", "code" => "valid"];
                return $response;
            } else {
                $response = ["error" => "true", "code" => "invalid code "];
                return $response;

            }
        } else {
            $response = ["error" => "true", "code" => "invalid code "];
            return $response;
        }
    }
    public function getCode(Request $request)
    {

        // return SendPhoneCode::where("user_id",Auth::user()->id)->orderBy("created_at","desc")->first();
        try {
            $phone = $request->phone;
            $codigo = $this->generarCodigo(6);
            $code = new SendPhoneCode;
            $code->code = $codigo;
            $code->user_id = Auth::user()->id;
            $code->save();
            $this->sendNotificacion($codigo, $phone);
            $response = ["success" => "true"];

            return $response;

            //return $code;
        } catch (Exception $e) {

            $response = ["success" => "false"];

            return $response;

        }

        /*
        $idTemporal     = \CI::ApiUsers()->saveTemporal($code, $phone, $idUser);
        $telef["valid"] = 0; //status del valid
        $p              = $this->updatePhoneagiles(0, $telef);
        $save           = \CI::ApiUsers()->savephone($telef);
        $billing        = \CI::Twilox()->sendNotificacion($code, $phone);
         */

        //return "si";
        //return $this->sendNotificacion($code, $phone);
    }

    public function sendNotificacion($code, $phone)
    {
        $sid = 'ACe045d8326ba81a2d65d344299b48dbce';
        $token = '56b769196675ed1fabdbccf18310329d';
        $client = new Client($sid, $token);
        // Use the client to do fun stuff like send text messages!
        $mensaje = "Damecoins.com" . " " . $code . " " . "¡!";
        $client->messages->create(
            // the number you'd like to send the message to
            //'+5804248970434',
            $phone,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+34960160722',
                // the body of the text message you'd like to send
                'body' => $mensaje,
            )
        );
        return $client;
    }
    public function generarCodigo($longitud)
    {
        $key = '';
        $pattern = '123467890';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++) {
            $key .= $pattern{
                mt_rand(0, $max)};
        }
        return $key;
    }
}
