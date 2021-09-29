<?php

namespace App\Http\Controllers\Admin;

use App\AdminConfig;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class FlutterwaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privateKeys = AdminConfig::flutter('flutterPrivateKeys'); //privada

        $publicKeys = AdminConfig::flutter('flutterPublicKey');

        $encriptionKeys = AdminConfig::flutter('encriptionKeys');

        $flutterCurrency = AdminConfig::flutter('flutterCurrency');

        $flutterCountry= AdminConfig::flutter('flutterCountry');

        $fluttermensaje= AdminConfig::flutter('fluttermensaje');

        $flutterDivisaDefault= AdminConfig::flutter('flutterDivisaDefault');

       // return $flutterDivisaDefault;

        $getCurrencies = DB::table('currencies')->pluck('name', 'code');


    return view('admin.flutterwave.index_flutter', compact('flutterDivisaDefault','fluttermensaje','flutterCountry','getCurrencies','privateKeys', 'publicKeys', 'encriptionKeys', 'flutterCurrency'));

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
        $private = AdminConfig::flutter('flutterPrivateKeys'); //privada
        //return $config;
        $private->value = $request->privateKeys;
        $private->save();

        $public = AdminConfig::flutter('flutterPublicKey');
        $public->value = $request->publicKeys;
        $public->save();

        $encription = AdminConfig::flutter('encriptionKeys');
        $encription->value = $request->encriptionKeys;
        $encription->save();

        $flutterCurrency = AdminConfig::flutter('flutterCurrency');
        $flutterCurrency->value = $request->flutterCurrency;
        $flutterCurrency->save();

        $flutterCountry = AdminConfig::flutter('flutterCountry');
        $flutterCountry->value = strtoupper($request->flutterCountry);
        $flutterCountry->save();

        $fluttermensaje = AdminConfig::flutter('fluttermensaje');
        $fluttermensaje->value = $request->fluttermensaje;
        $fluttermensaje->save();


        
        $flutterDivisaDefault = AdminConfig::flutter('flutterDivisaDefault');
        $flutterDivisaDefault->value = $request->flutterDivisaDefault;
        $flutterDivisaDefault->save();




        Session::flash('success', 'Cuenta actualizada con exito');

        return redirect("/admin/flutterwave");
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
