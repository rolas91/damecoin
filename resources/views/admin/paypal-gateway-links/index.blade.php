@extends('layouts.admin_new')
@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Paypal Account
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/paypal-gateway-links"><i class="fa fa-dashboard"></i> Paypal Account</a></li>
        </ol>
    </section>
    <section class="content">
        
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    <form action="{{ url('admin/paypal-gateway-links/'.$paypal_account->id) }}" method="POST"
                        class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12">Estado</label>

                            <div class="col-md-12">
                                <select name="status" class="form-control">
                                    <option value="1" {{ ($paypal_account->status === 1) ? 'selected' : '' }}>Activo
                                    </option>
                                    <option value="0" {{ ($paypal_account->status === 0) ? 'selected' : '' }}>Inactivo
                                    </option>
                                </select>
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-md-12">Enlace</label>

                            <div class="col-md-12">
                                <input id="url" type="text" class="form-control" name="url"
                                    value="{{ $paypal_account->url }}" value="{{ old('url') }}">
                                @if ($errors->has('url'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('target') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12">Estado</label>
                        
                            <div class="col-md-12">
                                <select name="target" class="form-control">
                                    <option value="_blank" {{ ($paypal_account->target === '_blank') ? 'selected' : '' }}>Abrir en otra página
                                    </option>
                                    <option value="_self" {{ ($paypal_account->target === '_self') ? 'selected' : '' }}>Abrir en la misma página
                                    </option>
                                </select>
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Modificar
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