@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/stripe"><i class="fa fa-dashboard"></i> StripeKey</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">
<!--
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                        <strong>!</strong> {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif
-->
        <form action="{{ url('admin/flutterwave') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('privateKeys') ? ' has-error' : '' }}">
                        <label for="destinatary" class=" control-label">Private Keys</label>
    
                        <div class="col-md-12">
                            <input id="privateKeys" type="text" class="form-control" required value="{{ $privateKeys->value }}" name="privateKeys" value="{{ old('privateKeys') }}" autofocus>
                            @if ($errors->has('privateKeys'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('privateKeys') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <div class="form-group{{ $errors->has('publicKeys') ? ' has-error' : '' }}">
                    <label for="name" class=" control-label">Public Keys</label>

                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control" required value="{{ $publicKeys->value }}" name="publicKeys" value="{{ old('publicKeys') }}" >
                        @if ($errors->has('publicKeys'))
                            <span class="help-block">
                                <strong>{{ $errors->first('publicKeys') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('encriptionKeys') ? ' has-error' : '' }}">
                        <label for="name" class=" control-label">Encription Keys</label>
    
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" required value="{{ $encriptionKeys->value }}" name="encriptionKeys" value="{{ old('encriptionKeys') }}" >
                            @if ($errors->has('encriptionKeys'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('encriptionKeys') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <div class="form-group{{ $errors->has('fluttermensaje') ? ' has-error' : '' }}">
                        <label for="name" class=" control-label">Mensaje en Formulario</label>
    
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" required value="{{ $fluttermensaje->value }}" name="fluttermensaje" value="{{ old('fluttermensaje') }}" >
                            @if ($errors->has('fluttermensaje'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fluttermensaje') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <div class="form-group{{ $errors->has('flutterCountry') ? ' has-error' : '' }}">
                        <label for="name" class=" control-label">Flutter Country Iso Code</label>
    
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" maxlength="2" required value="{{ $flutterCountry->value }}" name="flutterCountry" value="{{ old('flutterCountry') }}" >
                            @if ($errors->has('flutterCountry'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('flutterCountry') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <div class="form-group {{ $errors->has('flutterDivisaDefault') ? ' has-error' : '' }}">
                    <label class="col-md-12 ">Force Currency Default</label>
                    <div class="col-md-12">
                            {!!Form::select('flutterDivisaDefault',[0 => 'No',1=>'Si'] , $flutterDivisaDefault->value,  [
                                'id' => 'flutterDivisaDefault',
                                'class' => 'form-control'
                            ])!!}
                        @if ($errors->has('flutterDivisaDefault'))
                            <span class="help-block">
                                <strong>{{ $errors->first('flutterDivisaDefault') }}</strong>
                            </span>
                        @endif
                    </div>
             </div>

                <div class="form-group {{ $errors->has('flutterCurrency') ? ' has-error' : '' }}">
                        <label class="col-md-12 ">Currency Default</label>
                        <div class="col-md-12">
                                {!!Form::select('flutterCurrency', $getCurrencies, $flutterCurrency->value,  [
                                    'id' => 'flutterCurrency',
                                    'class' => 'form-control'
                                ])!!}
                            @if ($errors->has('flutterCurrency'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('flutterCurrency') }}</strong>
                                </span>
                            @endif
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
       -
        </section>
</div>   

   
<!--section end -->
@endsection
