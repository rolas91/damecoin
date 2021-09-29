@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/currency"><i class="fa fa-dashboard"></i> Divisa</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">

        <form action="{{ url('admin/currency/'.$currency->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12      ">name</label>

                    <div class="col-md-12">
                        <input id="name" type="name" class="form-control" value="{{ $currency->name }}" name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="code" class="col-md-12      ">code</label>
    
                        <div class="col-md-12">
                            <input id="code" type="code" class="form-control" name="code" value="{{ $currency->code }}" value="{{ old('code') }}" maxlength="3">
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('symbol') ? ' has-error' : '' }}">
                        <label for="symbol" class="col-md-12      ">symbol</label>
    
                        <div class="col-md-12">
                            <input id="symbol" type="text" class="form-control" name="symbol"  value="{{ $currency->symbol }}"value="{{ old('symbol') }}" maxlength="20">
                            @if ($errors->has('symbol'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('symbol') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('isocode') ? ' has-error' : '' }}">
                        <label for="isocode" class="col-md-12      ">isocode</label>
                        <div class="col-md-12">
                            <input id="isocode" type="text" class="form-control" name="isocode" value="{{ $currency->isoCountry  }}" value="{{ old('isocode') }}" maxlength="2">
                            @if ($errors->has('isocode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('isocode') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('min_deposito') ? ' has-error' : '' }}">
                        <label for="min_deposito" class="col-md-12      ">Deposito minimo</label>
                        <div class="col-md-12">
                            <input id="min_deposito" type="text" class="form-control" name="min_deposito" value="{{ $currency->detailCurrency->min_deposito  }}" value="{{ old('min_deposito') }}" >
                            @if ($errors->has('min_deposito'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('min_deposito') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('max_deposito') ? ' has-error' : '' }}">
                        <label for="max_deposito" class="col-md-12      ">Deposito maximo</label>
                        <div class="col-md-12">
                            <input id="max_deposito" type="text" class="form-control" name="max_deposito" value="{{ $currency->detailCurrency->max_deposito  }}" value="{{ old('max_deposito') }}" >
                            @if ($errors->has('max_deposito'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('max_deposito') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('comision_abono') ? ' has-error' : '' }}">
                        <label for="comision_abono" class="col-md-12      ">Comision de deposito en %</label>
                        <div class="col-md-12">
                            <input id="comision_abono" type="text" class="form-control" name="comision_abono" value="{{ $currency->detailCurrency->comision_abono  }}" value="{{ old('comision_abono') }}" >
                            @if ($errors->has('comision_abono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comision_abono') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('comision_retiro') ? ' has-error' : '' }}">
                        <label for="comision_retiro" class="col-md-12      ">Comision de retiro en %</label>
                        <div class="col-md-12">
                            <input id="comision_retiro" type="text" class="form-control" name="comision_retiro" value="{{ $currency->detailCurrency->comision_retiro  }}" value="{{ old('comision_retiro') }}" >
                            @if ($errors->has('comision_retiro'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comision_retiro') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label for="status" class="col-md-12">status</label>
                        <div class="col-md-12">
                                <input type="checkbox" name="status" <?php if($currency->status == 1){ echo 'checked="checked"'; }?>/>
                        </div>
                </div>
                <div class="form-group {{ $errors->has('secure') ? ' has-error' : '' }}">
                    <label for="secure" class="col-md-12">secure3D</label>
                    <div class="col-md-12">
                        <input type="checkbox" name="secure" <?php if($currency->secure == 1){ echo 'checked="checked"'; }?>/>
                    </div>
            </div>
                <div class="form-group {{ $errors->has('idioma') ? ' has-error' : '' }}">
                        <label class="col-md-12 ">idioma</label>
                        <div class="col-md-12">
                                {!!Form::select('idioma', config('idioma.es'),$currency->idioma,  [
                                    'id' => 'getCryptos',
                                    'class' => 'form-control'
                                ])!!}
                            @if ($errors->has('idioma'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idioma') }}</strong>
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
       
        </section>
</div>   

   
<!--section end -->
@endsection