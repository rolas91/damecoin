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

        <form action="{{ url('admin/country') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-12 ">name</label>
    
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-12 ">code</label>
        
                            <div class="col-md-12">
                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" maxlength="3">
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-12 ">bandera</label>
        
                            <div class="col-md-12">
                                <input id="bandera" type="file" name="bandera" value="" maxlength="3">
                                @if ($errors->has('bandera'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bandera') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group {{ $errors->has('idioma') ? ' has-error' : '' }}">
                            <label class="col-md-12 ">idioma</label>
                            <div class="col-md-12">
                                    {!!Form::select('idioma', config('idioma.es'),"es",  [
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