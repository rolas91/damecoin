<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\GatewayRecurly;

use App\StripeAccount;



class ApiGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gatewaycode["gateway"]=[
            "currency"=>"USD",
            "code"=>Str::random(10),
        ];

        //return $gatewaycode;
    }
    public function code()
    {
        //$gateway=GatewayRecurly::where("currency_id",1)->first();
        //return $gateway;
        $gateway=StripeAccount::where("user_by",'Kujira')->first();

        //return $gateway;
        
        $gatewaycode["gateway"]=[
            "currency"=>"USD",
            "code"=>$gateway->gateways()->where(['stripe_account_id'=>$gateway->id,'currency_id'=>1])->first()->gateway_code,
        ];

        return $gatewaycode;
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
