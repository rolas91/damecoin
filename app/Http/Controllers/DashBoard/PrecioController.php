<?php

namespace App\Http\Controllers\DashBoard;

use App\Crypto;
use App\Http\Controllers\Controller;
use Auth;
use Dashboard;
use DB;
use General;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idDivisa = null)
    {
        $user = Auth::user();

        $paymentAcount = $user->payments->count();

        $currencyDefault = Dashboard::getCurrencyDefault();

        $cryptoDefault = Dashboard::getCryptoDefault();

        $defaultCurrency = DB::table('currencies')->select("id", "code", "symbol")->where(["id" => $currencyDefault])->first();

        $defaultCrypto = DB::table('cryptos')->select("id", "code", "name")->where(["id" => $cryptoDefault])->first();

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

        $cryptomonedas = array_merge($dataAmount, $dataCero);
        $unionCryptos = array_merge($dataAmount, $dataCero);
        $getCryptoPrice = Dashboard::getCryptoPrices();
        $prices = Dashboard::getPrices($defaultCurrency->code);
        $list = Dashboard::getList($getCryptoPrice, $prices,$cryptos);

        $getCurrencies = DB::table('currencies')->pluck('name', 'id');
        $currencies_list = DB::table('currencies')->get();
        $getCryptos = $cryptos->pluck("name", "id");
        $meta['title'] = "Damecoins | Prices";
        $meta['key'] = __('home.key');
        $meta['descripcion'] = __('home.description');
        $page = 'prices';

        return view('dashboard.prices', compact('unionCryptos', 'getCryptos', 'defaultCurrency', 'defaultCrypto', 'cryptomonedas', 'getCurrencies', 'meta', 'user', 'paymentAcount', 'page', 'currencies_list', 'list'));

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
