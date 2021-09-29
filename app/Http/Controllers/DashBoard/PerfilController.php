<?php

namespace App\Http\Controllers\DashBoard;

use App;
use App\Crypto;
use App\Currency;
use App\Http\Controllers\Controller;
use App\PreferenceUsers;
use App\User;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;
use Redirect;
use Session;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $getCountry = DB::table('countries')->pluck('name', 'id');
        $getCurrencies = DB::table('currencies')->where('status', 1)->pluck('name', 'id');
        $getCryptos = DB::table('cryptos')->where('status', 1)->pluck('name', 'id');

        $user = User::find(Auth::user()->id);

        if ($user->preference) {
            $currency = $user->preference->fiat_wallet_default;
            $crypto = $user->preference->crypto_wallet_default;
            $defaultCurrency = Currency::find($currency);

        } else {
            $currency = Currency::select('id')->where('code', config("settings.default.currency"))->first();
            $defaultCurrency = $currency;
            $currency = $currency->id;
            $crypto = Crypto::select('id')->where('code', config("settings.default.crypto"))->first();
            $crypto = $crypto->id;

            //return $crypto->id;
        }
        //return $divisa;
        // return $user;
        $meta['title']="Damecoins | Profile";

        $page = "profile";
        return view('dashboard.profile', compact('user','meta', 'getCountry', 'page', 'getCryptos', 'getCurrencies', 'currency', 'crypto', 'defaultCurrency'));

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
        try {

            DB::beginTransaction();

            $user = User::find(Auth::user()->id);
            $user->name = ucfirst($request->name);
            $user->lastName = ucfirst($request->lastName);
            $user->country_id = ucfirst($request->country_id);
            $user->phone = ucfirst($request->phone);
            $user->save();

            DB::commit();
            Session::flash('success', __('dashboard_perfil.datos_success_save'));
            return redirect('/dash/profile');

        } catch (Exception $e) {

            DB::rollback();
            return Redirect::back()->with('error', __('dashboard_perfil.datos_error_save'));

        }

    }

    public function setting(Request $request, $id)
    {

        //empleo el mismo metodo para create y update y lo valido por el controllers
        $getPref = PreferenceUsers::where('user_id', Auth::user()->id)->first();

        try {

            DB::beginTransaction();

            if ($getPref) {
                //update
                $setting = PreferenceUsers::find($getPref->id);
                $setting->user()->associate(Auth::user());
                $setting->fiat_wallet_default = $request->currency;
                $setting->crypto_wallet_default = $request->crypto;
                $setting->locate = $request->idioma;
                $setting->save();
            } else {
                //create
                $setting = new PreferenceUsers;
                $setting->user()->associate(Auth::user());
                $setting->fiat_wallet_default = $request->currency;
                $setting->crypto_wallet_default = $request->crypto;
                $setting->locate = $request->idioma;
                $setting->save();
            }
            App::setLocale($request->idioma);

            session(['lang' => $request->idioma]);
            DB::commit();
            Session::flash('success', __('dashboard_perfil.setting_success_save'));
            return redirect('/dash/profile');

        } catch (Exception $e) {
            //return $e;
            DB::rollback();
            return Redirect::back()->with('error', __('dashboard_perfil.setting_error_save'));

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
