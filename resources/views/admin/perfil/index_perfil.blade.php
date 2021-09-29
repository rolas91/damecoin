@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/currency"><i class="fa fa-dashboard"></i> perfil</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> !</h4>
                    {{ Session::get('success') }}
                  </div>
        
                @endif

        <form action="{{ url('admin/perfil') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
               
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12 control-label">name</label>

                    <div class="col-md-12">
                        <input id="name" type="name" class="form-control" value="{{ $user->name }}" name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label for="lastname" class="col-md-12 control-label">lastname</label>
                        <div class="col-md-12">
                            <input id="lastname" type="text" class="form-control" name="lastname"  value="{{ $user->lastName }}"value="{{ old('lastname') }}" maxlength="20">
                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
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