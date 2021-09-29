@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/cripto"><i class="fa fa-dashboard"></i> Criptodivisa</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url('admin/cripto/'.$cripto->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                    <div class="col-md-12">
                                    <label for="name" class="col-md-12 ">Name</label>
                                        <input id="name" type="name" class="form-control" value="{{ $cripto->name }}" name="name" value="{{ old('name') }}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('orden') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                <label for="name" class="col-md-12 ">Orden</label>
                                    <input id="orden" type="text" class="form-control" value="{{ $cripto->orden }}" name="orden" value="{{ old('orden') }}">
                                    @if ($errors->has('orden'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('orden') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </div>
                                <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}">
                                    <label for="img" class="col-md-12 ">img</label>
                                    <div class="col-md-12">
                                        <img src="{{ asset('uploads/img') }}/{{ $cripto->img }}" alt=""><br><br>
                                        <input type="file" name="img" class="form-control">

                                        @if ($errors->has('img'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('img') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                        <label for="code" class="col-md-12 ">code</label>
                    
                                        <div class="col-md-12">
                                            <input id="code" type="code" class="form-control" name="code" value="{{ $cripto->code }}" value="{{ old('code') }}" maxlength="3">
                                            @if ($errors->has('code'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                                <div class="form-group {{ $errors->has('maker_fee') ? ' has-error' : '' }}">
                    
                                     <div class="col-md-12">
                                        <label for="maker_fee" class="">maker_fee</label>
                                            <input id="maker_fee" type="text" class="form-control" name="maker_fee"  value="{{ $cripto->maker_fee }}"value="{{ old('maker_fee') }}" maxlength="4">
                                            @if ($errors->has('maker_fee'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('maker_fee') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                                <div class="form-group{{ $errors->has('taker_fee') ? ' has-error' : '' }}">
                    
                                        <div class="col-md-12">
                                        <label for="taker_fee" class="">taker_fee</label>
                                            <input id="taker_fee" type="text" class="form-control" name="taker_fee" value="{{ $cripto->taker_fee  }}" value="{{ old('taker_fee') }}" maxlength="4">
                                            @if ($errors->has('taker_fee'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('taker_fee') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                                <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                                <label for="status" class="">status</label><br>
                                                <div style="margin-left: 10px">
                                                    {!! Form::checkbox('status', 1,$cripto->status) !!}
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
                </div>
            </div> 
        </section>
</div>   

   
<!--section end -->
@endsection