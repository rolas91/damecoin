@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Gateway Recurly 
        <small></small>
      </h1>
    </section> 

    <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/gateway-recurly"><i class="fa fa-dashboard"></i> gateway Recurly</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>

        <section>
        <div class="container" style="margin:30px!important;">
        @if(Session::has('error'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('error') }}
          </div>

        @endif
       
        <form action="{{ url('admin/gateway-recurly/'.$gateway->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('default_conversion') ? ' has-error' : '' }}">
                    <label class="control-label">Divisa</label>
                    <div class="">
                    {!!Form::select('currency_id', $currencies, $gateway->currency_id, [
                    'id' => 'currency_id',
                    'class' => 'form-control'
                ])!!}
                        @if ($errors->has('currency_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('currency_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label">name</label>

                    <div class="">
                    <input id="name" type="text" class="form-control" value='{{$gateway->name}}' name="name" value="{{ old('name') }}">
               
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('stripe_id') ? ' has-error' : '' }}">
                    <label class="control-label">Stripe</label>

                    <div class="">
                    <input id="stripe_id" type="text" class="form-control" value="{{ $gateway->stripe_id }}"  name="stripe_id" value="{{ old('stripe_id') }}">
               
                        @if ($errors->has('stripe_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stripe_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
             </div>  

              <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('gateway_code') ? ' has-error' : '' }}">
                    <label class="control-label">GatewayCode</label>

                    <div class="">
                    <input id="gateway_code" type="text" class="form-control"  value="{{ $gateway->gateway_code }}" name="gateway_code" value="{{ old('gateway_code') }}">
               
                        @if ($errors->has('gateway_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gateway_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
             </div>    

               
             

            
             
           
                
                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button> 
                        </div>
                </div>
        </form>
        </div>
       
        </section>
   

   
<!--section end -->
@endsection