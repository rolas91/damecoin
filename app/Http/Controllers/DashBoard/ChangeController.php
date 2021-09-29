<?php

namespace App\Http\Controllers\DashBoard;

use App\Crypto;
use App\Currency;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use General;
use Dashboard;
use Illuminate\Http\Request;

class ChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $currencyDefault=Dashboard::getCurrencyDefault();

        $cryptoDefault=Dashboard::getCryptoDefault();

        $cryptoDefault = Crypto::where('id', $cryptoDefault)->first();
        $defaultCurrency = Currency::where('id', $currencyDefault)->first();

        $getCurrencies = DB::table('currencies')->pluck('name', 'id'); //Currency::lists('name', 'id');
        $getCryptos = DB::table('cryptos')->pluck('name', 'id');
        $totalCrypto = General::getCryptoUser($cryptoDefault->id, config("settings.wallets.aprobado"));

        $totalCrypto = number_format($totalCrypto, 7, '.', '');
        //dd($totalCrypto);
        $comision = $cryptoDefault->taker_fee * $totalCrypto / 100;

        $comision = number_format($comision, 7, '.', '');
        // dd($comision);
        $venta = number_format($totalCrypto - $comision, 7, '.', '');
        //$totalCrypto=number_format($totalCrypto-$comision, 8, '.', ',');
        $taker_fee = $cryptoDefault->taker_fee . "%";

        if ($totalCrypto == 0) {
            $conver = 0;
        } else {
            $conver = General::getConverCrypto($defaultCurrency->code, $cryptoDefault->code, $totalCrypto);
            $conver = number_format($conver, 2, '.', '');

        }

        $paymentAcount = $user->payments->count();

        $cryptos = Crypto::orderBy('orden', 'asc')->orderBy('name', 'asc')->get();

        //$idCrypto=
        $dataAmount = [];
        foreach ($cryptos as $crypto) {

            $amount = General::getCryptoUser($crypto->id, config("settings.wallets.aprobado"));

            if ($amount > 0) {

                $dataAmount[] = ["crypto" => $crypto, "amount" => $amount, "conver" => General::getConverCrypto($defaultCurrency->code, $crypto->code, $amount)];

            } else {

                $dataCero[] = ["crypto" => $crypto, "amount" => $amount, "conver" => "0.00"];

            }

        }

        $unionCryptos = array_merge($dataAmount, $dataCero);

        //return $totalCrypto;
        $meta['title'] = "Damecoins | change";
        $meta['key'] = __('home_sell.key');
        $meta['descripcion'] = __('home_sell.description');
        $page = 'change';

        return view('dashboard.change', compact('unionCryptos', 'cryptoDefault', 'getCryptos', 'getCurrencies', 'totalCrypto', 'conver', 'comision', 'venta', 'taker_fee', 'meta', 'page', 'defaultCurrency'));
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
