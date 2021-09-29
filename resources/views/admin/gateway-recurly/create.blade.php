@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/gateway-recurly"><i class="fa fa-dashboard"></i> Recurly gateway</a></li>
            <li class="active">Nueva</li>
          </ol>
        </section>
        <section class="content">
        <div class="container">
        @if(Session::has('error'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('error') }}
          </div>

        @endif
        <form action="{{ url('admin/gateway-recurly') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('currency_id') ? ' has-error' : '' }}">
                    <label class="control-label">Divisa</label>

                    <div class="">
                    {!!Form::select('currency_id', $currencies, '', [
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
                    <input id="name" type="text" class="form-control"  name="name" value="{{ old('name') }}">
               
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
                    <input id="stripe_id" type="text" class="form-control"  name="stripe_id" value="{{ old('stripe_id') }}">
               
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
                    <input id="gateway_code" type="text" class="form-control"  name="gateway_code" value="{{ old('gateway_code') }}">
               
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

    </div>

<!--section end -->
@endsection