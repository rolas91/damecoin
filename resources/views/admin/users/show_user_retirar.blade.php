@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Usuarios Wallets Externo
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/users"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">list</li>
      </ol>
    </section>

    <section class="content">

          <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            @if (session('error'))
                            <div class="alert alert-error alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('error') }}
                            </div>
                            @endif
                            
                            <form action="{{ url('admin/users-retirar-wallets') }}" method="POST"
                                class="form-horizontal">
                                {{ csrf_field() }}
                                

                                <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                                    <label for="url" class="col-md-12">Direccion wallet</label>
        
                                    <div class="col-md-12">
                                        <input id="wallet_externo" type="text" class="form-control" name="wallet_externo"
                                            value="" value="{{ old('wallet_externo') }}">
                                        @if ($errors->has('wallet_externo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wallet_externo') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                                       
            
                                        <div class="col-md-12">
                                            <input id="idCrypto" type="hidden" class="form-control" name="idCrypto"
                                                value="{{ $crypto->id }}">
                                                <input id="idUser" type="hidden" class="form-control" name="idUser"
                                                value="{{ $user->id }}">   
                                            
                                        </div>
                                    </div>

                                <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                                        <label for="url" class="col-md-12">Cripto a enviar {{ $crypto->code }}</label>
            
                                        <div class="col-md-12">
                                            <input id="retiro" type="text" class="form-control" name="retiro"
                                                value="{{ $amount }}" value="{{ old('retiro') }}">
                                            @if ($errors->has('retiro'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('retiro') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                </div>

                               

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">
                                            Procesar
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