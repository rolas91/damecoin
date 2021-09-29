<?php

namespace App\Http\Controllers\DashBoard;

use App\Crypto;
use App\Currency;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use General;
use Dashboard;
use Illuminate\Http\Request;

//use App\H

class WalletController extends Controller
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

        $currencyDefault=Dashboard::getCurrencyDefault();

        $cryptoDefault=Dashboard::getCryptoDefault();

        $defaultCurrency=DB::table('currencies')->select("id","code","symbol")->where(["id"=>$currencyDefault])->first();

        $defaultCrypto=DB::table('cryptos')->select("id","code","name")->where(["id"=>$cryptoDefault])->first();
        
        $getCryptos = Crypto::where("status", 1)->orderBy('orden', 'asc')->orderBy('name', 'asc')->get();
        $currencies_list = DB::table('currencies')->where("status",1)->get();
        $getCurrencies = $currencies_list->pluck('name', 'id');
       // dd($currencies_list);
        $dataAmount = [];
        foreach ($getCryptos as $crypto) {

            $amount = General::getCryptoUser($crypto->id, config("settings.wallets.aprobado"));

            if ($amount > 0) {

                $dataAmount[] = ["crypto" => $crypto, "amount" => $amount, "conver" => General::getConverCrypto($defaultCurrency->code, $crypto->code, $amount)];

            } else {

                $dataCero[] = ["crypto" => $crypto, "amount" => $amount, "conver" => "0.00"];

            }

        }
        $getCryptos=$getCryptos->pluck("name","id");
        $cryptomonedas = array_merge($dataAmount, $dataCero);
        $unionCryptos = array_merge($dataAmount, $dataCero);

      

        $meta['title'] = "Damecoins | Wallets";
        $meta['key'] = __('home.key');
        $meta['descripcion'] = __('home.description');
        $page = 'wallets';

        return view('dashboard.wallets', compact('unionCryptos','defaultCurrency','defaultCrypto', 'cryptomonedas','getCryptos', 'getCurrencies', 'meta', 'user', 'paymentAcount', 'page', 'currencies_list'));

    }

    /*
    public function index($idDivisa=null)
    {

    $user = Auth::user();

    $paymentAcount = $user->payments->count();

    if($idDivisa==null){
    $idDivisa=General::getDivisaDefault();
    }

    $default=Currency::find($idDivisa);

    $cryptos = Crypto::orderBy('orden', 'asc')->orderBy('name', 'asc')->get();

    //$idCrypto=
    $dataAmount=[];
    foreach($cryptos as $crypto){

    $amount = General::getCryptoUser($crypto->id);

    if ($amount>0){

    $dataAmount[]=["crypto"=>$crypto,"amount"=>$amount,"conver"=>General::getConverCrypto($default->code,$crypto->code,$amount)];

    }else{

    $dataCero[]=["crypto"=>$crypto,"amount"=>$amount,"conver"=>"0.00"];

    }

    }

    $cryptomonedas=array_merge($dataAmount, $dataCero);

    //dd($unionCryptos);

    $getCurrencies = DB::table('currencies')->pluck('name', 'id');

    $meta['title']=__('home.title');
    $meta['key']=__('home.key');
    $meta['descripcion']=__('home.description');

    return view('dashboard.users.wallet',compact('cryptomonedas','getCurrencies','default','meta', 'user', 'paymentAcount'));
    }
     */

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
