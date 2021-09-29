<?php

namespace App\Http\Controllers\DashBoard;

use App\Crypto;
use App\Currency;
use App\Http\Controllers\Controller;
use Auth;
use Dashboard;
use DB;
use General;
use Illuminate\Http\Request;

class PortafolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        // return "si";
        return redirect()->route('dashPortfolio');
    }

    public function get($idDivisa = null)
    {
        $user = Auth::user();

        $currencyDefault=Dashboard::getCurrencyDefault();

        $cryptoDefault=Dashboard::getCryptoDefault();

        $defaultCurrency=DB::table('currencies')->select("id","code","symbol")->where(["id"=>$currencyDefault])->first();

        $defaultCrypto=DB::table('cryptos')->select("id","code","name")->where(["id"=>$cryptoDefault])->first();
        
        $getCryptos = Crypto::where("status", 1)
                    ->select("id","name","code","img")
                    ->orderBy('orden', 'asc')
                    ->orderBy('name', 'asc')
                    ->get();

        $getCurrencies = DB::table('currencies')->pluck('name', 'id');

        $getCryptoPrice = Dashboard::getCryptoPrices();
       // dd($getCryptoPrice);

        $prices = Dashboard::getPrices($defaultCurrency->code);
        //dd($prices);
        $list = Dashboard::getList($getCryptoPrice, $prices,$getCryptos);

       // dd($list);

        $getCryptos=$getCryptos->pluck("name","id");

        $meta['title'] = "Damecoins | Portfolio";
        $meta['key'] = __('home.key');
        $meta['descripcion'] = __('home.description');
        $page = 'portfolio';

        return view('dashboard.portafolio', compact('getCurrencies','getCryptos', 'defaultCurrency','defaultCrypto', 'meta', 'user', 'page', 'list'));

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
