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
        <form action="{{ url('admin/stripe') }}" method="POST" class="form-horizontal">
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
                        <input id="name" type="publicKeys" class="form-control" required value="{{ $publicKeys->value }}" name="publicKeys" value="{{ old('publicKeys') }}" >
                        @if ($errors->has('publicKeys'))
                            <span class="help-block">
                                <strong>{{ $errors->first('publicKeys') }}</strong>
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
