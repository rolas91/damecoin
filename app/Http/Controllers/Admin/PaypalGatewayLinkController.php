<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaypalGatewayLink;
use Illuminate\Http\Request;

class PaypalGatewayLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paypal_account = PaypalGatewayLink::where('id', 1)->first();
        return view('admin.paypal-gateway-links.index', compact('paypal_account'));
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
     * @param  \App\PaypalGatewayLink  $paypalGatewayLink
     * @return \Illuminate\Http\Response
     */
    public function show(PaypalGatewayLink $paypalGatewayLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaypalGatewayLink  $paypalGatewayLink
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paypal_account = PaypalGatewayLink::findOrFail($id);

        return view('admin.paypal-gateway-links.edit', compact('paypal_account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaypalGatewayLink  $paypalGatewayLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paypal_account = PaypalGatewayLink::findOrFail($id);
        $paypal_account->status = $request->status;
        $paypal_account->url = $request->url;
        $paypal_account->target = $request->target;
        $paypal_account->save();

        return redirect()->back()->with('status', '¡Modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaypalGatewayLink  $paypalGatewayLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaypalGatewayLink $paypalGatewayLink)
    {
        //
    }
}
