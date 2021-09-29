<?php

namespace App\Http\Controllers;

use App\AdminConfig;
use App\Bank;
use App\Currency;
use App\Http\Requests\RequestTransfe;
use App\Payment;
use App\PaymentMethoState;
use App\Payment_Wallet;
use App\PaymentLimit;
use App\PaypalGatewayLink;
use App\Transference;
use App\Wallet;
use Auth;
use DB;
use Exception;
use General;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Redirect;
use Session;
use Stripe\BankAccount as StripeBankAccount;
use Stripe\Charge as StripeCharge;
use Stripe\Customer as StripeCustomer;
use Stripe\Error\InvalidRequest as StripeErrorInvalidRequest;
use Stripe\Invoice as StripeInvoice;
use Stripe\InvoiceItem as StripeInvoiceItem;
use Stripe\PaymentIntent as PaymentIntent;
use Stripe\Refund as StripeRefund;
use Stripe\Stripe; //as Stripe;
use Stripe\Token as StripeToken;



class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($idDivisa)
    {

        $payment_state = PaymentMethoState::where('payment_method', 'recurly')->first();
        $paypal_state = PaypalGatewayLink::where('id','>=',1)->first();

        $email = Auth::user()->email;

        $email = explode("@", $email);

        $concept = substr($email[0], 0, 8);
        $where = "deposit";
        // dd($concept);

        $default = Currency::find($idDivisa); //General::getCurrencyUser($idDivisa);
        $getCurrencyUser = $default;
        $banks = Bank::where("status",1)->get(); //General::getCurrencyUser($idDivisa);
        $paymentLimit = PaymentLimit::where('id','>=',1)->first();
        $limit = $paymentLimit['bank_deposit_minimum'];
        $getCurrencies = DB::table('currencies')->pluck('name', 'id');
        $meta['title'] = __('home_deposit.title');
        $meta['key'] = __('home_deposit.key');
        $meta['descripcion'] = __('home_deposit.description');
        //$default=$getCurrency["default"];

        // dd($default->detailCurrency->comision_abono);
        return view('home_usuario.deposit', compact('getCurrencies', 'default', 'banks', 'meta', 'payment_state', 'concept', 'limit', 'paypal_state','getCurrencyUser', 'where'));
    }
    public function getStripeKey()
    {
        //return config('services.stripe.secret');
        $privateKey = AdminConfig::privatek();
        return $privateKey->value; //config('services.stripe.secret');
    }
    public function processdeposit(Request $request)
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

       
        $currency = Currency::find($request->id);
        if ($currency) {
            //divisa permitida
            //return $currency->detailCurrency;
            $monto = $request->monto;
            // $monto=10000;
            $min = $currency->detailCurrency->min_deposito;
            $max = $currency->detailCurrency->max_deposito;
            $montoxx = "true";
            if ($montoxx) {

                //monto permitido
                $options = array(
                    "description" => "Deposit3030",
                    "email" => Auth::user()->email,
                    "source" => $request->stripeToken,
                );
                try {
                    if ($currency->secure == 0) {
                        $customer = StripeCustomer::create(
                            $options,
                            $this->getStripeKey()
                        );
                        $optionsx = array(
                            "amount" => $monto * General::getMulti($currency->code),
                            "currency" => $currency->code,
                            "customer" =>  $customer->id,
                        );
                    }
                    try {
                        if ($currency->secure == 1) {
                            try {
                                Stripe::setApiKey($this->getStripeKey());
                                $intent = PaymentIntent::retrieve($request->stripeToken); //el id del payment
                                if ($intent->status == "succeeded") {
                                    //return $intent;
                                    $status = $intent->status;
                                    $totalx = $intent->amount / General::getMulti($currency->code);
                                    $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
                                    $total = $totalx - $comision;
                                } else {
                                    General::logs($ip,"error",$url,"get",Auth::user()->id,$useragent);
                                    Session::flash('error', __('home_deposit.error_deposit'));
                                    return Redirect::back()->with('error',  __('home_deposit.error_deposit'));
                                }
                            } catch (Exception $e) {
                                //return $e;
                                General::logs($ip,"error",$url,"get",Auth::user()->id,$useragent);
                                Session::flash('error', __('home_deposit.error_deposit'));
                                return Redirect::back();
                            }
                        } else {
                            $charges = StripeCharge::create($optionsx, ['api_key' => $this->getStripeKey()]);
                            $status = $charges->status;
                            $totalx = $charges->amount / General::getMulti($currency->code);
                            $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
                            $total = $totalx - $comision;
                        }

                        DB::beginTransaction();
                        try {
                            $payment = new Payment;
                            $payment->user()->associate(Auth::user());
                            $payment->total = $totalx;
                            $payment->pasarela = 'Stripe';
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

                            DB::commit();
                            General::email($wallet->abono, $currency->code, Auth::user(), "Deposit");
                            Session::flash('success', __('home_deposit.success_deposit'));
                            return redirect("/home/" . $currency->id);

                            return $wallet;
                        } catch (Exception $e) {
                            General::logs($ip,"error",$url,"get",Auth::user()->id,$useragent);
                            DB::rollback();
                            Session::flash('error', __('home_deposit.error_deposit'));
                            return Redirect::back()->with('error', __('home_deposit.error_deposit'));
                        }
                    } catch (Exception $e) {
                        General::logs($ip,"error",$url,"get",Auth::user()->id,$useragent);
                        $body = $e->getJsonBody();
                        Session::flash('error', __('home_deposit.error_deposit'));
                        return Redirect::back()->with('error', $body["error"]["message"]);
                        //return json_encode($body["error"]["message"]);
                    }
                    //return $optionsx;
                } catch (Exception $e) {
                    General::logs($ip,"error",$url,"get",Auth::user()->id,$useragent);
                    $body = $e->getJsonBody();
                    //return $body;
                    Session::flash('error', __('home_deposit.error_deposit'));
                    // return 
                    return Redirect::back()->with('msg', $body["error"]["message"]);
                    //return json_encode($body["error"]["message"]);
                }
                //return $options;  
            } else {
                //monto no permitido
                //sin restriccion de monto
                General::logs($ip,"error",$url,"get",Auth::user()->id,$useragent);
                Session::flash('error', __('home_deposit.error_deposit'));
                return Redirect::back()->with('msg', __('home_deposit.error_deposit'));
            }
        }
        return Redirect::back()->with('msg', __('home_deposit.currency_not_found'));
        //return redirect->back->with('status', 'Profile updated!');
    }
    public function  processtransfe(RequestTransfe $request)
    {
        $currency = Currency::find($request->id);

        $paymentLimit = PaymentLimit::find(1);

        $endpoint = 'convert';
        $access_key = '27692546960c2e421da5a5513b76491d';
        $to = 'USD';
        // initialize CURL:
        $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $to . '&to=' . $currency->code . '&amount=' . $paymentLimit['bank_deposit_minimum'] . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);
        $convertedamountMinimo = $conversionResult['result'];

        if($request->montot < 1) {
            Session::flash('msg', __('home_deposit.minimum_deposit', ['amount' => $paymentLimit['bank_deposit_minimum']]) . ' (' . number_format($convertedamountMinimo, 2, '.', '') . ' ' . $currency->code . ')');

            return back();
        }
        
        $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $currency->code . '&to=' . $to . '&amount=' . $request->montot . '');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);
        $convertedamountVerify = $conversionResult['result'];

        if ($convertedamountVerify < $paymentLimit['bank_deposit_minimum']) {
            # code...
            Session::flash('msg', __('home_deposit.minimum_deposit', ['amount' => $paymentLimit['bank_deposit_minimum']]) . ' (' . number_format($convertedamountMinimo, 2, '.', '') . ' ' . $currency->code . ')');

            return back();
        }

        if ($currency) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/comprobante/', $filename);
            $totalx = $request->montot;
            $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
            $total = $totalx - $comision;
            DB::beginTransaction();
            try {
                $wallet = new Wallet;
                $wallet->abono = $total;
                $wallet->status_user = "Pendiente";
                $wallet->currency()->associate($currency);
                $wallet->status = 1;
                $wallet->user()->associate(Auth::user());
                $wallet->save();

                $transfe = new Transference;
                $transfe->user()->associate(Auth::user());
                $transfe->total = $totalx;
                $transfe->pasarela = 'banco';
                $transfe->descripcion = "Transferencia";
                $transfe->img = $filename;
                $transfe->status = 1;
                $transfe->wallet()->associate($wallet);
                $transfe->currency()->associate($currency);
                $transfe->save();

                DB::commit();
                General::email($wallet->abono, $currency->code, Auth::user(), "Transfer");

                Session::flash('success', __('home_deposit.success_transfe'));
                return redirect("/home/" . $currency->id);
            } catch (Exception $e) {
                // return $e;
                DB::rollback();
                return Redirect::back()->with('msg', __('home_deposit.error_transfe'));
            }
        } else {
            return Redirect::back()->with('msg', __('home_deposit.error_transfe'));
        }
    }


    public function wechatChargeDeposit(Request $request)
    {

        $source =  $request->source['source'];

        $currency = Currency::find($request->currency);

        if ($currency) {
            //divisa permitida
            //return $currency->detailCurrency;
            $monto = $request->amount;
            // $monto=10000;
            $min = $currency->detailCurrency->min_deposito;
            $max = $currency->detailCurrency->max_deposito;

            $montoxx = "true";

            if ($montoxx) {
                //monto permitido

                $options = array(
                    "description" => "Deposit3030",
                    "email" => Auth::user()->email,
                    "name" => Auth::user()->name . " " . Auth::user()->lastName,
                );

                $customer = StripeCustomer::create(
                    // $options, $this->getStripeKey()
                    $options,
                    $this->getStripeKey()
                );

                // \Stripe\Stripe::setApiKey($this->getStripeKey());
                \Stripe\Stripe::setApiKey($this->getStripeKey());
                $charge = \Stripe\Charge::create([
                    'amount' => $source['amount'],
                    'currency' => $source['currency'],
                    'source' => $source['id'],
                    'customer' => $customer->id,
                    'description' => 'Deposit3030',

                ]);


                try {

                    $new_monto = $monto * General::getMulti($currency->code);

                    $totalx = $new_monto / General::getMulti($currency->code);
                    $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
                    $total = $totalx - $comision;
                    DB::beginTransaction();
                    try {
                        $payment = new Payment;
                        $payment->user()->associate(Auth::user());
                        $payment->total = $totalx;
                        $payment->pasarela = 'WeChat';
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

                        DB::commit();
                        General::email($wallet->abono, $currency->code, Auth::user(), "Deposito");
                        // Session::flash('success', __('home_deposit.success_deposit'));
                        // return redirect("/home/".$currency->id);

                        return $wallet;
                    } catch (Exception $e) {
                        DB::rollback();
                        return $e;
                    }
                } catch (Exception $e) {
                    $body = $e->getJsonBody();
                    return $e;
                    //return json_encode($body["error"]["message"]);
                }
            } else {
                return 'monto no procesado';
            }
        }
        return 'no found';
    }
}
//clave luiskjk
