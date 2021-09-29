<?php

namespace App\Http\Controllers;

use App\AccountRecurly;
use App\AccountStripeUser;
use App\Country;
use App\Crypto;
use App\CryptoWallet;
use App\CryptoWalletPyment;
use App\CryptoWalletWallet;
use App\Currency;
use App\GatewayRecurly;
use App\Payment;
use App\Payment_Wallet;
use App\User;
use App\Wallet;
use Auth;
use DB;
use Exception;
use General;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Recurly_Account;
use Recurly_Adjustment;
use Recurly_BillingInfo;
use Recurly_Client;
use Recurly_Error;
use Recurly_Purchase;
use Recurly_ValidationError;
use Redirect;
use Session;

class RecurlyController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth', ['only' => 'compraRecurlyHome']);

        // $this->middleware('auth',['except' => 'compraindex','getStripeKey','paymentintent']);
    }

    public function miKeys()
    {
        //return "d4a0a3b6767a4ae3b09f6203da95fa04";//test
        return "ce7864215a684508b840129f8e683f20"; //produccion

    }

    public function compraRecurlyHome(Request $request)
    {

        $getTotal = $request['total'];

        $getTotal = General::aleatorio10($getTotal);
        //dd($getTotal);
        //return $getTotal;
        $idDivisa = $request['currency'];
        $idCrypto = $request['crypto'];
        $token = $request['token'];
        //return $getTotal;
        if ($request['wallet'] == 'true') {
            //verifico que tiene el monto en el wallet
            $getTotal = $request['total'];
            //return $getTotal;
            $idDivisa = $request['currency'];
            $idCrypto = $request['crypto'];
            //return $idDivisa;
            $getCriptodefault = General::getCriptodefault($idCrypto);
            $getCurrencyUser = General::getCurrencyUser($idDivisa);
            $getTotalDivisa = General::getCryptoWalettUser($idDivisa);
            // return $getTotalDivisa;
            if ($getTotalDivisa > $getTotal) { //saldo valido
                //capturo cuanta cripto puede comprar con el monto enviado
                $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                //return $getConvers;
                $getTotalCrypto = round(($getTotal / $getConvers), 8);
                $getTotalCrypto = number_format($getTotalCrypto, 7, '.', '');
                //$comision=
                //$getTotalCrypto=round(($totalx/$getConvers),8);
                //$getTotalCrypto=number_format($getTotalCrypto, 6, '.', ',');
                $comision = $getCriptodefault->maker_fee * $getTotalCrypto / 100;
                $comision = number_format($comision, 2, '.', '');
                $maker_fee = $getTotalCrypto - $comision;

                //descontar del walett
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
                    $criptowallet->taker = $maker_fee;
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
                    return redirect("/home/" . $idDivisa);
                } catch (Exception $e) {
                    //return $e;
                    DB::rollback();
                    return Redirect::back()->with('error', __('index.error_buy', ["error" => $e->getMessage()]));
                    // something went wrong
                }
            } else {
                Session::flash('error', __('home_buy.quanty_not_found'));
                return redirect("/buy/" . $request['crypto'] . "/" . $request['currency']);
                //return "sin saldo";
            }
        } else {
            $getCriptodefault = General::getCriptodefault($idCrypto);

            $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();

            // dd($getCurrencyUser->supportrecurly);
            $gateWayRecurly = null;
            if ($getCurrencyUser->supportrecurly) {
                $gateWayRecurly = $getCurrencyUser->supportrecurly;
            }

            $user = Auth::user();

            $total = $request['total'];

            $paymentRecurly = $this->processRecurly($total, $token, $getCurrencyUser, $user, $gateWayRecurly);

            if ($paymentRecurly->error == "true") {

                return Redirect::back()->with('error', __('index.error_buy', ["error" => $paymentRecurly->mensagge]));

            }
            if ($paymentRecurly->changeCurrency) {
                //si se ha cambiado la currency no soportada
                $getCurrencyUser = Currency::where(["code" => strtoupper($paymentRecurly->currency)])->first();
            }

            $recurly_id = $paymentRecurly->recurly_id;
            $status = $paymentRecurly->status;
            $totalx = $paymentRecurly->amount;
            $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
            $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
            $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
            $comision = number_format((($totalx - $descuento)), 2, '.', '');

            DB::beginTransaction();

            try {

                $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $totalx;
                $payment->pasarela = 'Recurly';
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

                if ($gateWayRecurly->default_conversion) {
                    $accountStripeUser = new AccountStripeUser;
                    $accountStripeUser->stripe_account_id = $gateWayRecurly->stripe_account_id;
                    $accountStripeUser->user_id = $user->id;
                    $accountStripeUser->save();
                }

                DB::commit();

                General::email($criptowallet->compra, $getCriptodefault->code, Auth::user(), "Purchase");

                Session::flash('success', __('index.success_buy'));
                return redirect("/home/" . $getCurrencyUser->id);

            } catch (Exception $e) {

                DB::rollback();

                return Redirect::back()->with('error', __('index.error_buy', ["error" => $e->getMessage()]));
                // something went wrong
            }

        }

    }

    public function processDepositRecurly(Request $request)
    {
        $currency = Currency::find($request->id);
        if ($currency) {
            $monto = $request->monto;
            $monto = General::aleatorio10($monto);
            $token = $request->token;
            $montoxx = "true";
            if ($montoxx) {

                // $getDivisaR=$this->getDivisaRecurly($currency->code);
                $gateWayRecurly = $currency->supportrecurly;

                //$total= $monto*General::getMulti($getDivisaR);

                $user = Auth::user();

                $paymentRecurly = $this->processRecurly($monto, $token, $currency, $user, $gateWayRecurly);

                if ($paymentRecurly->error == "true") {

                    return Redirect::back()->with('error', __('index.error_buy', ["error" => $paymentRecurly->mensagge]));

                }

                if ($paymentRecurly->changeCurrency) {
                    //si se ha cambiado la currency no soportada
                    $currency = Currency::where(["code" => strtoupper($paymentRecurly->currency)])->first();
                }

                $totalx = number_format((($paymentRecurly->amount)), 2, '.', '');
                $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
                $total = $totalx - $comision;

                DB::beginTransaction();
                try {
                    $payment = new Payment;
                    $payment->user()->associate(Auth::user());
                    $payment->total = $totalx;
                    $payment->pasarela = 'Recurly';
                    $payment->descripcion = "deposito";
                    $payment->status = 1;
                    $payment->currency()->associate($currency);
                    $payment->save();

                    $wallet = new Wallet;
                    $wallet->abono = $total;
                    $wallet->status_user = "Aprobado";
                    $wallet->currency()->associate($currency);
                    $wallet->status = 1;
                    $wallet->user()->associate(Auth::user());
                    $wallet->save();

                    $paymentwallet = new Payment_Wallet;
                    $paymentwallet->payment()->associate($payment);
                    $paymentwallet->wallet()->associate($wallet);
                    $paymentwallet->save();

                    if ($gateWayRecurly->default_conversion) {
                        $accountStripeUser = new AccountStripeUser;
                        $accountStripeUser->stripe_account_id = $gateWayRecurly->stripe_account_id;
                        $accountStripeUser->user_id = $user->id;
                        $accountStripeUser->save();
                    }

                    DB::commit();
                    General::email($wallet->abono, $currency->code, Auth::user(), "Deposit");
                    Session::flash('success', __('home_deposit.success_deposit'));
                    return redirect("/home/" . $currency->id);
                } catch (Exception $e) {
                    DB::rollback();
                    $body = $e->getJsonBody();
                    //return $body;
                    Session::flash('error', __('home_deposit.error_deposit'));
                    // return
                    return Redirect::back()->with('msg', $body["error"]["message"]);
                    //return json_encode($body["error"]["message"]);
                }

            } else {
                //monto no permitido
                //sin restriccion de monto
                Session::flash('error', __('home_deposit.error_deposit'));
                return Redirect::back()->with('msg', __('home_deposit.error_deposit'));

            }

        }
        //  return Redirect::back()->with('msg', __('home_deposit.currency_not_found'));

    }
    public function compraRecurly(Request $request)
    {

        $total = $request['total'];
        $total = General::aleatorio10($total);
        $idDivisa = $request['currency'];
        $idCrypto = $request['crypto'];
        $name = $request['name'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $pais = $request['country'];
        $token = $request["recurlyToken"];
        $country = Country::where('cod_iso2', $pais)->first();
        //dd($idCrypto);
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

        $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        $gateWayRecurly = $getCurrencyUser->supportrecurly;

        $paymentRecurly = $this->processRecurly($total, $token, $getCurrencyUser, $user, $gateWayRecurly);

        if ($paymentRecurly->error == "true") {

            return Redirect::back()->with('error', __('index.error_buy', ["error" => $paymentRecurly->mensagge]));

        }

        if ($paymentRecurly->changeCurrency) {
            //si se ha cambiado la currency no soportada
            $getCurrencyUser = Currency::where(["code" => strtoupper($paymentRecurly->currency)])->first();
        }

        $recurly_id = $paymentRecurly->recurly_id;
        $status = $paymentRecurly->status;
        $totalx = $paymentRecurly->amount; //General::getMulti($getCurrencyUser->code);
        $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
        $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
        $comision = number_format((($totalx - $descuento)), 2, '.', '');

        DB::beginTransaction();

        try {

            $payment = new Payment;
            $payment->user()->associate($user);
            $payment->total = $totalx;
            $payment->pasarela = 'Recurly';
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

            if ($gateWayRecurly->default_conversion) {
                $accountStripeUser = new AccountStripeUser;
                $accountStripeUser->stripe_account_id = $gateWayRecurly->stripe_account_id;
                $accountStripeUser->user_id = $user->id;
                $accountStripeUser->save();
            }

            DB::commit();
            $password = substr(md5(microtime()), 1, 8);

            $userx = User::find($user->id);
            //$userx->recurly_id=$recurly_id;
            $userx->password = bcrypt($password);
            $userx->save();
            //verifico que no este guardado el account recurly
            if (!$userx->accountrecurly) {
                $accounRecurly = new AccountRecurly;
                $accounRecurly->account_number = $recurly_id;
                $accounRecurly->user()->associate($userx);
                $accounRecurly->save();
            }

            General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);
            Session::flash('success', __('index.success_buy'));

            return redirect("/login");
        } catch (Exception $e) {

            DB::rollback();

            return Redirect::back()->with('error', __('index.error_buy', ["error" => $e->getMessage()]));
            // something went wrong
        }

        //dd($payment);

    }
    public function getDivisarecurly($currency)
    {
        //$currency="CLP";
        $soporteRecurly = ["USD", "ARS", "BRL", "CLP", "COP", "EUR", "GBP", "MNX"];

        if (in_array($currency, $soporteRecurly)) {
            return $currency;
        } else {
            return "USD";
        }
    }

    public function processRecurly($total, $token, $currency, $user, $gateWayRecurly)
    {

        $gateWay = false;

        $changeCurrency = false;

        // $newCodeCurrency=$currency->code;

        if ($gateWayRecurly) { //esta variable contiene la relacion
            if ($gateWayRecurly->default_conversion) { //consulto si es conversion yes
                //obtengo el gatewaycode
                $gatewayCode = GatewayRecurly::where(['currency_id' => $gateWayRecurly->currency_default, 'stripe_account_id' => $gateWayRecurly->stripe_account_id])->first();

                if ($gateWayRecurly->currency_default == $currency->id) {
                    //si es la misma divisa, proceso igual
                    $gateWay = true;
                    $newcodeGateway = $gatewayCode->gateway_code;
                    // $newcodeGateway="mdxyaxs3q8ve";//test comentar en produccion
                    $newTotal = $total * General::getMulti($currency->code);
                    $newCurrency = $currency->code;
                    // $newCurrency="USD";//test
                } else {
                    $gateWay = true;
                    $changeCurrency = true;
                    //si la divisa es difernte la convierto a la asignada en la gateway
                    $from = $currency->code; //currency origen
                    $to = $gateWayRecurly->currency2->code; //currency destino
                    //echo $total."--";
                    $amount = General::getConverFromTo($from, $to, $total);
                    //pendiente validacion si hay u error en la devolucion de la conversion es lo mas optimo
                    $newTotal = number_format((($amount)), 2, '.', '');
                    $newTotal = $newTotal * General::getMulti($to);
                    $newcodeGateway = $gatewayCode->gateway_code;
                    //dd($newcodeGateway);
                    //$newcodeGateway="mdxyaxs3q8ve";//test comentar en produccion
                    $newCurrency = $to; //nueva divisa convertida
                    //$newCodeCurrency=$currency->code;
                    // $newCurrency="USD";//test
                }

            } else {
                //no conversion
                $gateWay = false;
                $newTotal = $total * General::getMulti($currency->code);
                $newCurrency = $currency->code;
                // $newCurrency="USD";//test

            }
        } else {
            //no relation
            $gateWay = false;
            $newTotal = $total * General::getMulti($currency->code);
            $newCurrency = $currency->code;
            //$newCurrency="USD";//test

        }

        $r = new Recurly_Client($this->miKeys());

        if ($user->accountrecurly) {
            $recurly_id = $user->accountrecurly->account_number;
            $exist = $r->request('GET', '/accounts/' . $recurly_id);
        } else {
            $recurly_id = Str::random(40);

            $exist = $r->request('GET', '/accounts/' . $recurly_id);
        }
        // dd($recurly_id);
        $purchase = new Recurly_Purchase();
        $purchase->currency = $newCurrency;
        $purchase->collection_method = 'automatic';

        if ($gateWay) {
            //si el gateway esta activo paso el valor de lo contrario no
            $purchase->gateway_code = $newcodeGateway;

        }

        if ($exist->statusCode == 200) {
            $purchase->account = new Recurly_Account($recurly_id);
        } else {
            //$purchase->account = new Recurly_Account();
            //$purchase->account->account_code = $recurly_id;
            $purchase->account = new Recurly_Account($recurly_id, $r);
            $purchase->account->email = $user->email;
            $purchase->account->first_name = $user->name;
            $purchase->account->last_name = $user->lastName;
            $purchase->account->create();
        }

        $billing_info = new Recurly_BillingInfo();
        $billing_info->token_id = $token; //token
        $purchase->account->billing_info = $billing_info;

        $adjustment = new Recurly_Adjustment();
        $adjustment->unit_amount_in_cents = $newTotal;
        $adjustment->quantity = 1;

        $purchase->adjustments = array($adjustment);
        $response = new \stdClass();
        // Create a preview invoice collection
        try {

            $collection = Recurly_Purchase::invoice($purchase, $r);

            $response->error = "false";
            //$response->code=$;
            $response->status = $collection->charge_invoice->state;
            $response->id = $collection->charge_invoice->uuid;
            $response->amount = $collection->charge_invoice->total_in_cents / General::getMulti($newCurrency);
            $response->currency = $collection->charge_invoice->currency;
            $response->create = $collection->charge_invoice->created_at;
            $response->recurly_id = $recurly_id;
            $response->changeCurrency = $changeCurrency;

            return $response;

        } catch (Recurly_ValidationError $e) {

            $response->error = "true";
            $response->mensagge = $e->getMessage();

            return $response;
        } catch (Recurly_Error $e) {

            $response->error = "true";
            $response->mensagge = $e->errors[0]->description;

            return $response;

        } catch (Exception $e) {

            $response->error = "true";
            $response->mensagge = $e->getMessage();

            return $response;

        }

        //return $currency;

    }

    public function paymentIntentRecurly(Request $request)
    {

        $total = $request->total;
        $total = General::aleatorio10($total);
        $email = $request->email;
        $name = $request->name;
        $lastname = $request->lastname;
        $token = $request->tokenRecurly;
        $pais = $request->country;
        $idDivisa = $request['currency'];
        $idCrypto = $request['crypto'];
        $country = Country::where('cod_iso2', $pais)->first();

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

        $getCriptodefault = Crypto::where('id', $idCrypto)->filtrado();
        $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
        $gateWayRecurly = $getCurrencyUser->supportrecurly;
        session(['getCriptodefault' => $getCriptodefault]);
        session(['getCurrencyUser' => $getCurrencyUser]);
        session(['gateWayRecurly' => $gateWayRecurly]);

        $paymentRecurly = $this->createPaymentToken($total, $token, $getCurrencyUser, $user, $gateWayRecurly);

        if ($paymentRecurly->error == false) {

            if ($paymentRecurly->changeCurrency) {
                //si se ha cambiado la currency no soportada
                $getCurrencyUser = Currency::where(["code" => strtoupper($paymentRecurly->currency)])->first();
            }

            $recurly_id = $paymentRecurly->recurly_id;
            $status = $paymentRecurly->status;
            $totalx = $paymentRecurly->amount; //General::getMulti($getCurrencyUser->code);
            $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
            // dd($getConvers);
            $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
            $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
            $comision = number_format((($totalx - $descuento)), 2, '.', '');
            // dd($getTotalCrypto);
            DB::beginTransaction();

            try {
                $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $totalx;
                $payment->pasarela = 'Recurly';
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

                if ($gateWayRecurly->default_conversion) {
                    $accountStripeUser = new AccountStripeUser;
                    $accountStripeUser->stripe_account_id = $gateWayRecurly->stripe_account_id;
                    $accountStripeUser->user_id = $user->id;
                    $accountStripeUser->save();
                }

                DB::commit();
                $password = substr(md5(microtime()), 1, 8);

                $userx = User::find($user->id);
                $userx->password = bcrypt($password);
                $userx->save();
                //verifico que no este guardado el account recurly
                if (!$userx->accountrecurly) {
                    $accounRecurly = new AccountRecurly;
                    $accounRecurly->account_number = $recurly_id;
                    $accounRecurly->user()->associate($userx);
                    $accounRecurly->save();
                }

                General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);
                // Session::flash('success',__('index.success_buy'));
                $data = ["success" => true, "info" => __('index.success_buy')];

                echo json_encode($data);

            } catch (Exception $e) {

                DB::rollback();

                $data = ["success" => false, "info" => __('index.error_buy', ["error" => $e->getMessage()])];

                echo json_encode($data);

            }

        }

        if ($paymentRecurly->error == true) {

            if ($paymentRecurly->secure == true) {
                echo json_encode($paymentRecurly);
            }

            if ($paymentRecurly->secure == false) {
                $data = ["success" => "error", "info" => __('index.error_buy', ["error" => $paymentRecurly->mensaje])];
                echo json_encode($data);
                // echo "error normal";
            }

        }

    }

    public function processRecurlySecure(Request $request)
    {

        // $currency = $request->currency;
        // $total = $request->total;
        $email = $request->email;
        $name = $request->name;
        $lastname = $request->lastname;
        $token = $request->token;
        $tokenSecure = $request->tokenSecure;
        $account = $request->account;
        // $currency="USD";

        $user = User::where('email', $email)->first();

        $paymentRecurly = $this->processSecureR($token, $user, $tokenSecure);

        if ($paymentRecurly->error == true) {
            $data = ["success" => false, "info" => __('index.error_buy', ["error" => $paymentRecurly->info])];
            echo json_encode($data);

        }

        if ($paymentRecurly->error == false) {

            $getCriptodefault = session('getCriptodefault');
            $getCurrencyUser = session('getCurrencyUser');
            $gateWayRecurly = session('gateWayRecurly');

            $recurly_id = $paymentRecurly->recurly_id;
            $status = $paymentRecurly->status;
            $totalx = $paymentRecurly->amount;
            $getConvers = General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
            $descuento = General::getDescuento($totalx, $getCriptodefault->maker_fee);
            $getTotalCrypto = number_format(($descuento / $getConvers), 7, '.', '');
            $comision = number_format((($totalx - $descuento)), 2, '.', '');

            DB::beginTransaction();

            try {
                $payment = new Payment;
                $payment->user()->associate($user);
                $payment->total = $totalx;
                $payment->pasarela = 'Recurly';
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

                if ($gateWayRecurly->default_conversion) {
                    $accountStripeUser = new AccountStripeUser;
                    $accountStripeUser->stripe_account_id = $gateWayRecurly->stripe_account_id;
                    $accountStripeUser->user_id = $user->id;
                    $accountStripeUser->save();
                }

                DB::commit();
                $password = substr(md5(microtime()), 1, 8);

                $userx = User::find($user->id);
                //$userx->recurly_id=$recurly_id;
                $userx->password = bcrypt($password);
                $userx->save();
                //verifico que no este guardado el account recurly
                if (!$userx->accountrecurly) {
                    $accounRecurly = new AccountRecurly;
                    $accounRecurly->account_number = $recurly_id;
                    $accounRecurly->user()->associate($userx);
                    $accounRecurly->save();
                }

                General::emailindex($criptowallet->compra, $getCriptodefault->code, $userx, "Purchase", $password);
                // Session::flash('success',__('index.success_buy'));
                $data = ["success" => true, "info" => __('index.success_buy')];

                echo json_encode($data);

            } catch (Exception $e) {

                DB::rollback();

                $data = ["success" => false, "info" => __('index.error_buy', ["error" => $e->getMessage()])];

                echo json_encode($data);

                // return Redirect::back()->with('error', __('index.error_buy',["error"=>$e->getMessage()]) );
                // something went wrong
            }

        }

        // dd($tokenSecure3d);

    }

    public function processSecureR($token, $user, $tokenSecure)
    {
        $r = new Recurly_Client($this->miKeys());

        $purchase = new Recurly_Purchase();
        $purchase->currency = session('currency');
        $purchase->collection_method = 'automatic';

        if (session('gateway')) {
            //si el gateway esta activo paso el valor de lo contrario no
            $purchase->gateway_code = session('gatewayCode');

        }

        $purchase->account = new Recurly_Account(session('recurly_id'));

        $billing_info = new Recurly_BillingInfo();
        $billing_info->token_id = $token; //toquen
        $billing_info->three_d_secure_action_result_token_id = $tokenSecure;
        $purchase->account->billing_info = $billing_info;

        $adjustment = new Recurly_Adjustment();
        $adjustment->unit_amount_in_cents = session('amount');
        $adjustment->quantity = 1;
        $purchase->adjustments = array($adjustment);

        $response = new \stdClass();

        try {
            //$previewCollection = Recurly_Purchase::authorize($purchase);
            $collection = Recurly_Purchase::invoice($purchase, $r);
            //$collection = Recurly_Purchase::invoice($purchase);
            $response->error = false;
            $response->status = $collection->charge_invoice->state;
            $response->id = $collection->charge_invoice->uuid;
            $response->created = $collection->charge_invoice->created_at;
            $response->amount = $collection->charge_invoice->total_in_cents / General::getMulti(session('currency'));
            $response->currency = $collection->charge_invoice->currency;
            $response->recurly_id = session('recurly_id');
            $response->changeCurrency = false;

            return $response;

        } catch (Recurly_ValidationError $e) {

            $response->error = true;
            $response->info = $e->getMessage();

            return $response;
        }

    }

    public function createPaymentToken($total, $token, $currency, $user, $gateWayRecurly)
    {

        $gateWay = false;

        $changeCurrency = false;
        // return $currency;
        // $newCodeCurrency=$currency->code;

        if ($gateWayRecurly) { //esta variable contiene la relacion
            if ($gateWayRecurly->default_conversion) { //consulto si es conversion yes
                //obtengo el gatewaycode
                $gatewayCode = GatewayRecurly::where(['currency_id' => $gateWayRecurly->currency_default, 'stripe_account_id' => $gateWayRecurly->stripe_account_id])->first();

                if ($gateWayRecurly->currency_default == $currency->id) {
                    //si es la misma divisa, proceso igual
                    $gateWay = true;
                    $newcodeGateway = $gatewayCode->gateway_code;
                    //$newcodeGateway="mdxyaxs3q8ve";//test comentar en produccion
                    $newTotal = $total * General::getMulti($currency->code);
                    $newCurrency = $currency->code;
                    //$newCurrency="USD";//test
                } else {
                    $gateWay = true;
                    $changeCurrency = true;
                    //si la divisa es difernte la convierto a la asignada en la gateway
                    $from = $currency->code; //currency origen
                    $to = $gateWayRecurly->currency2->code; //currency destino
                    //echo $total."--";
                    $amount = General::getConverFromTo($from, $to, $total);
                    //pendiente validacion si hay u error en la devolucion de la conversion es lo mas optimo
                    $newTotal = number_format((($amount)), 2, '.', '');
                    $newTotal = $newTotal * General::getMulti($to);
                    $newcodeGateway = $gatewayCode->gateway_code;
                    //dd($newcodeGateway);
                    //$newcodeGateway="mdxyaxs3q8ve";//test comentar en produccion
                    $newCurrency = $to; //nueva divisa convertida
                    //$newCodeCurrency=$currency->code;
                    // $newCurrency="USD";//test
                }

            } else {
                //no conversion
                $gateWay = false;
                $newTotal = $total * General::getMulti($currency->code);
                $newCurrency = $currency->code;
                // $newCurrency="USD";//test

            }
        } else {
            //no relation
            $gateWay = false;
            $newTotal = $total * General::getMulti($currency->code);
            $newCurrency = $currency->code;
            // $newCurrency="USD";//test

        }
        //dd($newTotal);

        $r = new Recurly_Client($this->miKeys()); //test
        // $r = new Recurly_Client('ce7864215a684508b840129f8e683f20');//produccion

        if (!$user->recurly_id) {

            $recurly_id = Str::random(40);

            $exist = $r->request('GET', '/accounts/' . $recurly_id);
        } else {

            $recurly_id = $user->recurly_id;

            $exist = $r->request('GET', '/accounts/' . $user->recurly_id);
        }

        //dd($newTotal);

        $purchase = new Recurly_Purchase();
        $purchase->currency = $newCurrency;
        $purchase->collection_method = 'automatic';

        if ($gateWay) {
            //si el gateway esta activo paso el valor de lo contrario no
            $purchase->gateway_code = $newcodeGateway;
            session(["gateway" => true]);
            session(["gatewayCode" => $newcodeGateway]);
        }

        if ($exist->statusCode == 200) {
            $recurly_id = $user->recurly_id;
            $purchase->account = new Recurly_Account($recurly_id);
        } else {
            // $recurly_id = Str::random(40);
            $purchase->account = new Recurly_Account($recurly_id, $r);
            $purchase->account->email = $user->email;
            $purchase->account->first_name = $user->name;
            $purchase->account->last_name = $user->lastName;
            $purchase->account->create();
        }

        $billing_info = new Recurly_BillingInfo();
        $billing_info->token_id = $token; //toquen
        $purchase->account->billing_info = $billing_info;

        $adjustment = new Recurly_Adjustment();
        $adjustment->unit_amount_in_cents = $newTotal;
        $adjustment->quantity = 1;
        $purchase->adjustments = array($adjustment);

        $response = new \stdClass();

        try {

            $collection = Recurly_Purchase::invoice($purchase, $r);
            //$collection = Recurly_Purchase::invoice($purchase);

            $response->error = false;
            $response->code = $recurly_id;
            $response->status = $collection->charge_invoice->state;
            $response->id = $collection->charge_invoice->uuid;
            $response->created = $collection->charge_invoice->created_at;
            $response->amount = $collection->charge_invoice->total_in_cents / General::getMulti($newCurrency);
            $response->currency = $collection->charge_invoice->currency;
            $response->recurly_id = $recurly_id;
            $response->changeCurrency = $changeCurrency;

            return $response;

        } catch (Recurly_ValidationError $e) {
            //error de validacion
            if ($e->errors->transaction_error) {

                if ($e->errors->transaction_error->error_code == 'three_d_secure_action_required') {

                    session(['recurly_id' => $recurly_id]);
                    session(['amount' => $newTotal]);
                    session(['currency' => $newCurrency]);

                    $response->error = true;
                    $response->secure = true;
                    $response->account = $recurly_id;
                    $response->token_3d = $e->errors->transaction_error->three_d_secure_action_token_id;
                    $response->data = $e->getMessage();

                    return $response;

                }

            } else {
                $response->error = true;
                $response->secure = false;
                $response->mensaje = $e->getMessage();

                return $response;
            }

        } catch (Recurly_Error $e) {

            $response->error = true;
            $response->mensagge = $e->errors[0]->description;

            return $response;

        } catch (Exception $e) {

            $response->error = true;
            $response->mensagge = $e->getMessage();

            return $response;

        }

    }
}
