<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentLimit;
use Illuminate\Http\Request;

class PaymentLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $limits = PaymentLimit::paginate(20);
    
        return view('admin.payment-limit.index',compact('limits'));
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
        $limit = PaymentLimit::findOrFail($id);

        return view('admin.payment-limit.edit', compact('limit'));
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
        
        $limit = PaymentLimit::findOrFail($id);
        $limit->wechat_minimum = $request->wechat_minimum;
        $limit->card_minimum = $request->card_minimum;
        $limit->card_maximum = $request->card_maximum;
        $limit->bank_minimum = $request->bank_minimum;
        $limit->paypal_minimum = $request->paypal_minimum;
        $limit->payoneer_minimum = $request->payoneer_minimum;
        $limit->skrill_minimum = $request->skrill_minimum;
        $limit->alipay_minimum = $request->alipay_minimum;
        $limit->alipay_maximum = $request->alipay_maximum;
        $limit->wechatpay_minimum = $request->wechatpay_minimum;
        $limit->mercadopago_minimum = $request->mercadopago_minimum;
        $limit->wechatpay_maximum = $request->wechatpay_maximum;
        $limit->bank_deposit_minimum = $request->bank_deposit_minimum;
        $limit->cuenta_alipay = $request->cuenta_alipay;
        $limit->cuenta_wechatpay = $request->cuenta_wechatpay;
        $limit->paypal_email = $request->paypal_email;
        $limit->payoneer_email = $request->payoneer_email;
        $limit->skrill_email = $request->skrill_email;
        $limit->comision = floatval($request->comision);
     
        $limit->save();

        return redirect('admin/payment-limit');
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
