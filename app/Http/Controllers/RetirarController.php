<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestRetiro;
use General;
use App\Currency;
use App\Wallet;
use App\BankAcount;
use App\PaymentLimit;
use DB;
use Auth;
use Session;
use Redirect;

class RetirarController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function retirar($idDivisa)
  {
    // $getCriptodefault=General::getCriptodefault($divisa);
    $getCurrencyUser = Currency::find($idDivisa);
    $getCurrencies = DB::table('currencies')->pluck('name', 'id'); //Currency::lists('name', 'id');
    $totalCurrency = General::getCryptoWalettUser($getCurrencyUser->id);

    //$totalCurrency=1;
    //return $divisa;
    $meta['title'] = __('home_retiro.title');
    $meta['key'] = __('home_retiro.key');
    $meta['descripcion'] = __('home_retiro.description');
    return view('home_usuario.retirar', compact('getCurrencyUser', 'getCurrencies', 'totalCurrency', 'meta'));

    //return view('home_usuario.vender',compact('getCriptodefault','getCurrencyUser','getCryptos','getCurrencies','totalCrypto','conver'));

  }

  public function processretiro(RequestRetiro $request)
  {
    $totalCurrency = General::getCryptoWalettUser($request['idCurrency']);
    $currency = Currency::find($request['idCurrency']);

    //dd($currency->detailCurrency->comision_retiro);
    //$total = $request['totalCurrency'];
    //$comision = ($total * $currency->detailCurrency->comision_retiro) / 100;

    //dd($total);

    if ($request['totalCurrency'] > $totalCurrency || $request['totalCurrency'] == 0) {
      return Redirect::back()->with('msg', __('home_retiro.quanty_not_found'));
    } else {

      $paymentLimit = PaymentLimit::find(1);

      //dd($paymentLimit);

      $endpoint = 'convert';
      $access_key = '27692546960c2e421da5a5513b76491d';
      $to = 'USD';
      $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $currency->code . '&to=' . $to . '&amount=' . $request->totalCurrency . '');

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // get the JSON data:
      $json = curl_exec($ch);
      curl_close($ch);
      $conversionResult = json_decode($json, true);
      $convertedamountVerify = $conversionResult['result'];

      // initialize CURL:
      $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $to . '&to=' . $currency->code . '&amount=' . $paymentLimit['bank_minimum'] . '');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // get the JSON data:
      $json = curl_exec($ch);
      curl_close($ch);
      $conversionResult = json_decode($json, true);
      $convertedamountMinimo = $conversionResult['result'];


      if ($convertedamountVerify < $paymentLimit['bank_minimum']) {
        # code...
        Session::flash('msg', __('home_retiro.minimum_retiro') . ' (' . number_format($convertedamountMinimo, 2, '.', '') . ' ' . $currency->code . ')');

        return back();
      }
      //return $request['totalCurrency'];
     
      DB::beginTransaction();
      try {
        $wallet = new Wallet;
        $wallet->retiro = $request['totalCurrency'];
        $wallet->currency()->associate($currency); //currency_id=$request['idCurrency'];
        $wallet->status = 1;
        $wallet->user()->associate(Auth::user());
        $wallet->save();
        $total = $request['totalCurrency'];

        $comision = ($total * $currency->detailCurrency->comision_retiro) / 100;
        $montoretiro= $total - $comision;
        $bank = new BankAcount;
        $bank->monto = $total - $comision;
        $bank->benefics = $request['beneficits'];
        $bank->name = $request['bankname'];
        $bank->country = $request['bankcountry'];
        $bank->addres = $request['bankaddress'];
        $bank->swit = $request['bankswit'];
        $bank->iban = $request['bankiban'];
        $bank->user()->associate(Auth::user());
        $bank->wallet()->associate($wallet);
        $bank->save();

        DB::commit();
        General::email($montoretiro, $currency->code, Auth::user(), "Bank withdrawal");

        //$request->session()->flash('status', 'Task was successful!');

        Session::flash('success', __('home_retiro.success_retiro'));
        return redirect("/retirar/" . $request['idCurrency']);
      } catch (Exception $e) {
        DB::rollback();
        return Redirect::back()->with('msg', __('home_retiro.error_retiro'));
      }
    }


    //return $totalCurrency;
    //return $request['totalCurrency'];

  }
}
