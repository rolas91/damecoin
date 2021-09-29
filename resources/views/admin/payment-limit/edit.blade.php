@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/payment-limit"><i class="fa fa-dashboard"></i> Divisa</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">
        

        <div class="contaienr">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('admin/payment-limit/'.$limit->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-12">Wechat Limit</label>

                                <div class="col-md-4">
                                    <input id="wechat_minimum" type="wechat_minimum" class="form-control" value="{{ $limit->wechat_minimum }}" name="wechat_minimum" value="{{ old('wechat_minimum') }}" autofocus>
                                    @if ($errors->has('wechat_minimum'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wechat_minimum') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Card Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="code" class="form-control" name="card_minimum" value="{{ $limit->card_minimum }}" value="{{ old('card_minimum') }}">
                                        @if ($errors->has('card_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('card_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>

                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Card Maximun</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="code" class="form-control" name="card_maximum" value="{{ $limit->card_maximum }}" value="{{ old('card_maximum') }}">
                                        @if ($errors->has('card_maximum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('card_maximum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                         
                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Bank Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="code" class="form-control" name="bank_minimum" value="{{ $limit->bank_minimum }}" value="{{ old('bank_minimum') }}">
                                        @if ($errors->has('bank_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bank_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            
                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-12">Bank Deposit Limit</label>
                            
                                <div class="col-md-4">
                                    <input id="code" type="code" class="form-control" name="bank_deposit_minimum"
                                        value="{{ $limit->bank_deposit_minimum }}" value="{{ old('bank_deposit_minimum') }}">
                                    @if ($errors->has('bank_deposit_minimum'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bank_deposit_minimum') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('paypal_minimum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Paypal Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="paypal_minimum" value="{{ $limit->paypal_minimum }}" value="{{ old('bank_minimum') }}">
                                        @if ($errors->has('paypal_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('paypal_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('paypal_minimum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Payoneer Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="payoneer_minimum" value="{{ $limit->payoneer_minimum }}" value="{{ old('bank_minimum') }}">
                                        @if ($errors->has('payoneer_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('payoneer_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('skrill_minimum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Skrill Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="skrill_minimum" value="{{ $limit->skrill_minimum }}" value="{{ old('bank_minimum') }}">
                                        @if ($errors->has('skrill_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('skrill_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('wechatpay_minimum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">WechatPay Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="wechatpay_minimum" value="{{ $limit->wechatpay_minimum }}" value="{{ old('bank_minimum') }}">
                                        @if ($errors->has('wechatpay_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alipay_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>

                            <div class="form-group {{ $errors->has('wechatpay_maximum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">WechatPay Maximum</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="wechatpay_maximum" value="{{ $limit->wechatpay_maximum }}" value="{{ old('bank_maximum') }}">
                                        @if ($errors->has('wechatpay_maximum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alipay_maximum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            
                            <div class="form-group {{ $errors->has('skrill_minimum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Alipay Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="alipay_minimum" value="{{ $limit->alipay_minimum }}" value="{{ old('bank_minimum') }}">
                                        @if ($errors->has('alipay_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alipay_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>

                            <div class="form-group {{ $errors->has('alipay_maximum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Alipay Maximum</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="alipay_maximum" value="{{ $limit->alipay_maximum }}" value="{{ old('bank_maximum') }}">
                                        @if ($errors->has('alipay_maximum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alipay_maximum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('mercadopago_minimum') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Mercadopago Limit</label>
                
                                    <div class="col-md-4">
                                        <input id="code" type="text" class="form-control" name="mercadopago_minimum" value="{{ $limit->mercadopago_minimum }}" value="{{ old('bank_minimum') }}">
                                        @if ($errors->has('mercadopago_minimum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mercadopago_minimum') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('cuenta_alipay') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Cuenta Alipay</label>
                
                                    <div class="col-md-6">
                                        <input id="code" type="text" class="form-control" name="cuenta_alipay" value="{{ $limit->cuenta_alipay }}" value="{{ old('cuenta_alipay') }}">
                                        @if ($errors->has('cuenta_alipay'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cuenta_alipay') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('cuenta_wechatpay') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Cuenta Wechat Pay</label>
                
                                    <div class="col-md-6">
                                        <input id="code" type="text" class="form-control" name="cuenta_wechatpay" value="{{ $limit->cuenta_wechatpay }}" value="{{ old('cuenta_wechatpay') }}">
                                        @if ($errors->has('cuenta_wechatpay'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cuenta_wechatpay') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('paypal_email') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Paypal Email</label>
                
                                    <div class="col-md-6">
                                        <input id="code" type="text" class="form-control" name="paypal_email" value="{{ $limit->paypal_email }}" value="{{ old('paypal_email') }}">
                                        @if ($errors->has('paypal_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('paypal_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('payoneer_email') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Payoneer Email</label>
                
                                    <div class="col-md-6">
                                        <input id="code" type="text" class="form-control" name="payoneer_email" value="{{ $limit->payoneer_email }}" value="{{ old('payoneer_email') }}">
                                        @if ($errors->has('payoneer_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('payoneer_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('skrill_email') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Skrill Email</label>
                
                                    <div class="col-md-6">
                                        <input id="code" type="text" class="form-control" name="skrill_email" value="{{ $limit->skrill_email }}" value="{{ old('skrill_email') }}">
                                        @if ($errors->has('skrill_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('skrill_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group {{ $errors->has('comision') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-12">Commission</label>
                
                                    <div class="col-md-6">
                                        <input id="code" type="text" class="form-control" name="comision" value="{{ $limit->comision }}" value="{{ old('comision') }}">
                                        @if ($errors->has('comision'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('comision') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">
                                            Guardar
                                        </button> 
                                    </div>
                            </div>
                    </form>  
                </div>
            </div>
        </div>
       
        </section>
</div>   

   
<!--section end -->
@endsection