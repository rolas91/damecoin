@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/country"><i class="fa fa-dashboard"></i> Country</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">

        <div class="mb-5">
            <span>Bandera:</span>
            <img width="60px" src="{{asset('banderas/'.$country->bandera)}}" alt="">
        </div>

        <form action="{{ url('admin/country/'.$country->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12      ">name</label>

                    <div class="col-md-12">
                        <input id="name" type="name" class="form-control" value="{{ $country->name }}" name="name" value="{{ old('name') }}" autofocus>
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
                            <input id="code" type="code" class="form-control" name="code" value="{{ $country->cod_iso2 }}" value="{{ old('code') }}" maxlength="3">
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div>
                        <label for="bandera" class="col-md-12">bandera</label>
    
                        <div class="col-md-12">
                            <input id="bandera" type="file" name="bandera"  maxlength="20">
                        </div>
                </div>
                
                <div class="form-group {{ $errors->has('idioma') ? ' has-error' : '' }}">
                        <label class="col-md-12 ">idioma</label>
                        <div class="col-md-12">
                                {!!Form::select('idioma', config('idioma.es'),$country->idioma,  [
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