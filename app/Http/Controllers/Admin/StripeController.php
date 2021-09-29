<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminConfig;
use Session;

class StripeController extends Controller
{
    public function index()
    {
        //$bank=Bank::find(1);
        
        $privateKeys=AdminConfig::privatek();
       
        $publicKeys=AdminConfig::publick();
        //return $publicKeys;
        return view('admin.stripe.index_stripe',compact('privateKeys','publicKeys'));
        
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
        $private=AdminConfig::privatek();
        //return $config;
        $private->value=$request->privateKeys;
        $private->save();
        $public=AdminConfig::publick();
        $public->value=$request->publicKeys;
        $public->save();

    Session::flash('success', 'Cuenta actualizada con exito');

    return redirect("/admin/stripe");
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
