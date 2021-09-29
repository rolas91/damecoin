@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/bank"><i class="fa fa-dashboard"></i> Cuenta Bancaria</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                        <strong>!</strong> {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif

        <form action="{{ url('admin/bank/'.$bank->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-12 control-label">Titulo</label>
    
                        <div class="col-md-12">
                            <input id="title" type="text" class="form-control" value="{{ $bank->title }}" name="title" value="{{ old('title') }}" autofocus>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group{{ $errors->has('destinatary') ? ' has-error' : '' }}">
                        <label for="destinatary" class="col-md-12 control-label">destinatario</label>
    
                        <div class="col-md-12">
                            <input id="destinatary" type="text" class="form-control" value="{{ $bank->destinatary }}" name="destinatary" value="{{ old('destinatary') }}" autofocus>
                            @if ($errors->has('destinatary'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('destinatary') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12 control-label">banco</label>

                    <div class="col-md-12">
                        <input id="name" type="name" class="form-control" value="{{ $bank->name }}" name="name" value="{{ old('name') }}" >
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-md-12 control-label">Pais</label>
    
                        <div class="col-md-12">
                            <input id="country" type="text" class="form-control" name="country" value="{{ $bank->country }}" value="{{ old('country') }}" >
                            @if ($errors->has('country'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group{{ $errors->has('addres') ? ' has-error' : '' }}">
                        <label for="addres" class="col-md-12 control-label">Direccion</label>
    
                        <div class="col-md-12">
                            <input id="addres" type="text" class="form-control" name="addres" value="{{ $bank->addres }}" value="{{ old('addres') }}" >
                            @if ($errors->has('addres'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('addres') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <div class="form-group{{ $errors->has('swift') ? ' has-error' : '' }}">
                        <label for="swift" class="col-md-12 control-label">Swift</label>
                        <div class="col-md-12">
                            <input id="swift" type="text" class="form-control" name="swift" value="{{ $bank->swift }}" value="{{ old('swift') }}" >
                            @if ($errors->has('swift'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('swift') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <div class="form-group{{ $errors->has('numero_cuenta') ? ' has-error' : '' }}">
                        <label for="numero_cuenta" class="col-md-12 control-label">numero_cuenta</label>
    
                        <div class="col-md-12">
                            <input id="numero_cuenta" type="text" class="form-control" name="numero_cuenta" value="{{ $bank->numero_cuenta }}" value="{{ old('numero_cuenta') }}" >
                            @if ($errors->has('numero_cuenta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('numero_cuenta') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="control-label">status</label>
    
                        <div class="">
                        {!!Form::select('status', [0 => 'No',1=>'Yes'],$bank->status, [
                                            'id' => 'status',
                                            'class' => 'form-control'
                                        ])!!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
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