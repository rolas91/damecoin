<?php

namespace App\Http\Controllers\DashBoard;

use App\Crypto;
use App\CryptoWallet;
use App\CryptoWalletWallet;
use App\Currency;
use App\Http\Controllers\Controller;
use App\User;
use App\Wallet;
use Auth;
use Dashboard;
use DB;
use General;
use Illuminate\Http\Request;
use Redirect;
use Session;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCrypto = null, $idDivisa = null)
    {

        $user = Auth::user();

        $currencyDefault = Dashboard::getCurrencyDefault();

        $cryptoDefault = Dashboard::getCryptoDefault();

        $getCriptodefault = Crypto::where('id', $cryptoDefault)->first();
        $defaultCurrency = Currency::where('id', $currencyDefault)->first();

        $getCryptos = Crypto::select("id", "code", "name", "img")->orderBy('orden', 'asc')->orderBy('name', 'asc')->get();

        $getCurrencies = DB::table('currencies')->pluck('name', 'id');

        $totalCrypto = General::getCryptoUser($getCriptodefault->id, config("settings.wallets.aprobado"));

        $totalCrypto = number_format($totalCrypto, 7, '.', '');

        $comision = $getCriptodefault->taker_fee * $totalCrypto / 100;

        $comision = number_format($comision, 7, '.', '');

        $venta = number_format($totalCrypto - $comision, 7, '.', '');

        $taker_fee = $getCriptodefault->taker_fee . "%";

        if ($totalCrypto == 0) {
            $conver = 0;
        } else {
            $conver = General::getConverCrypto($defaultCurrency->code, $getCriptodefault->code, $totalCrypto);
            $conver = number_format($conver, 2, '.', '');
        }

        $default = Currency::find($idDivisa);

        //return $totalCrypto;
        $meta['title'] ="Damecoins | Sell";
        $meta['key'] = __('home_sell.key');
        $meta['descripcion'] = __('home_sell.description');
        $page = 'sell';

        return view('dashboard.vender', compact('getCriptodefault', 'defaultCurrency', 'getCryptos', 'getCurrencies', 'totalCrypto', 'conver', 'comision', 'venta', 'taker_fee', 'meta', 'page', 'default'));
    }

    public function sellCrypto($id)
    {

        if ($id) {

            $crypo = Crypto::find($id);

            if ($crypo) {

            }

            return Redirect::back();

        }

        return Redirect::back();
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
    public function sell(Request $request)
    {
        $totalCryptoR = $request->totalCripto;
        $idCrypto = $request->idCripto;
        $idCurrency = $request->idCurrency;

        $getTotalserver = Dashboard::getCryptoAprobado($idCrypto);

        if ($totalCryptoR > $getTotalserver) {
            return Redirect::back()->with('error', __('dash_sell.saldo_nofound'));
        } else {
            if ($totalCryptoR > 10) {

                $getCurrency = Currency::select('code', 'id')->where('id', $idCurrency)->first();
                if (!$getCurrency) {
                    return Redirect::back()->with('error', __('dash_sell.currency_error'));
                }

                $getCripto = Crypto::select('code', 'id', 'taker_fee')->where('id', $idCrypto)->first();

                if (!$getCripto) {
                    return Redirect::back()->with('error', "__('dash_sell.cripto_error')");
                }

                $totalCrypto = number_format($totalCryptoR, 7, '.', '');
                $totalFiat = General::getConverCrypto($getCurrency->code, $getCripto->code, $totalCrypto);
                $comision = $getCripto->taker_fee * $totalFiat / 100;
                $comision = number_format($comision, 2, '.', '');
                $newTotal = Dashboard::maker_fee($totalFiat, $getCripto->taker_fee);

                try {
                    DB::beginTransaction();
                    $criptowallet = new CryptoWallet;
                    $criptowallet->venta = $totalCryptoR;
                    $criptowallet->taker = $comision;
                    $criptowallet->cripto_id = $idCrypto;
                    $criptowallet->status = 1;
                    $criptowallet->user()->associate(Auth::user());
                    $criptowallet->save();

                    $wallet = new Wallet;
                    $wallet->abono = $newTotal;
                    $wallet->currency_id = $idCurrency;
                    $wallet->status = 1;
                    $wallet->user()->associate(Auth::user());
                    $wallet->save();

                    $pivotwallet = new CryptoWalletWallet;
                    $pivotwallet->cripto_wallet()->associate($criptowallet);
                    $pivotwallet->wallet()->associate($wallet);
                    $pivotwallet->save();

                    DB::commit();
                    General::email($criptowallet->venta, $getCripto->code, Auth::user(), "Sale");
                    Session::flash('success', __('home_sell.success_sell'));

                    return redirect("/dash/portfolio");
                } catch (Exception $e) {
                    DB::rollback();
                    return Redirect::back()->with('error', __('dash_sell.error_general'));
                }

            } else {
                return Redirect::back()->with('error', __('dash_sell.error_amount'));
            }

        }

    }

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
