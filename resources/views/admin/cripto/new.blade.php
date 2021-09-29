@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/cripto"><i class="fa fa-dashboard"></i> Criptodivisa</a></li>
            <li class="active">Nueva</li>
          </ol>
        </section>
        <section class="content">
        <form action="{{ url('admin/cripto') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12 control-label">name</label>

                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}">
                    <label for="img" class="col-md-12 control-label">img</label>

                    <div class="col-md-12">
                            <input type="file" name="img" class="form-control">
                            <!--
                        <input id="img" type="text" class="form-control" img="img" value="{{ old('img') }}" autofocus>
                            -->
                        @if ($errors->has('img'))
                            <span class="help-block">
                                <strong>{{ $errors->first('img') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="code" class="col-md-12 control-label">code</label>
    
                        <div class="col-md-12">
                            <input id="code" type="code" class="form-control" name="code" value="{{ old('code') }}" maxlength="4">
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('maker_fee') ? ' has-error' : '' }}">
                        <label for="maker_fee" class="col-md-12 control-label">maker_fee</label>
    
                        <div class="col-md-12">
                            <input id="maker_fee" type="number" class="form-control" name="maker_fee" value="{{ old('maker_fee') }}" max="30" step=".01">
                            @if ($errors->has('maker_fee'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('maker_fee') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('taker_fee') ? ' has-error' : '' }}">
                        <label for="taker_fee" class="col-md-12 control-label">taker_fee</label>
    
                        <div class="col-md-12">
                            <input id="taker_fee" type="number" class="form-control" name="taker_fee" value="{{ old('taker_fee') }}" max="30" step=".01">
                            @if ($errors->has('taker_fee'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('taker_fee') }}</strong>
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