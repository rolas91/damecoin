@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Wallet
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/wallets"><i class="fa fa-dashboard"></i> wallet</a></li>
        <li class="active">list</li>
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

     <!--search-->
     <form action="{{ url('admin/wallets') }}" method="POST">
      {{ csrf_field() }}
      <div class="row">
          <div class="col-md-1">
              <label for="destinatary" class=" control-label">Email</label>
          </div>
          <div class="col-md-4">
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
  
                  <input
                      id="email"
                      type="text"
                      style=""
                      class="form-control"
                      required="required"
                      name="email"
                      value="{{ old('email') }}"
                      autofocus="autofocus">
                      @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
  
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary">
                              Buscar
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
    <!--search-->    
    
    <table class="table table-striped">
        <thead class="">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">Fecha</th>
            <th scope="col">Saldo</th>
            <th scope="col">Divisa</th>
            <th scope="col">Tipo</th>
            <th scope="col">Status</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <?php $cont=1 ?>
        <tbody>
            @forelse ($wallets as $wallet)
            <tr id="{{ $wallet->state->name }}">
            <th scope="row">{{ $cont++ }}</th>
            <td>{{ $wallet->user->email }}<br>{{ $wallet->user->name }} {{ $wallet->user->lastName }}</td>
            <td>{{ $wallet->created_at }}</td>
            <td>{{ General::getAbonoRetiro($wallet->abono,$wallet->retiro)}} </td>
            <td>{{ $wallet->currency->code }}</td>
            <td>{{ General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)}}</td>
           
            <td>{{ General::getTypePayment($wallet->status) }}</td>
           
            <td><a href="{{ url('admin/wallets/'.$wallet->id.'/edit') }}" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
            </tr>
            @empty
                    <p>No wallet</p>
            @endforelse
              
            </tbody>
          </table>
          {{ $wallets->links() }}

        </section>
    </div>


<!--section end -->
@endsection