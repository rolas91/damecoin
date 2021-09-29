<?php

namespace App\Http\Controllers\Admin;
use DB;
use Session;
use Exception;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\RequestAccountState;

use App\Http\Controllers\Controller;
use App\StripeAccountState;
use App\StripeAccount;




class StripeAccountStatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(RequestAccountState $request)
    {

        $detalis=StripeAccountState::create($request->all());
  
        $stripe = StripeAccount::findOrFail($request->stripe_account_id);

        $stripe->update(["status"=>$request->status]);
   
        // Session::flash('successgateway', 'Divisa añadido con exito a soporte Recurly');
 
         return Redirect::back()->with('successstate',"estado añadido correctamente");
 
         
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
