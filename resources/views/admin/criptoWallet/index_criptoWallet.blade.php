@extends('layouts.admin_new') 
@section('content')
<style>
.tipo-Buy{
	border:solid 1px green!important;
	background:#D8D8D8!important;
}
</style>
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Criptodivisa
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/criptoWallet"><i class="fa fa-dashboard"></i> Cripto Wallet</a></li>
        <li class="active">list</li>
      </ol>
    </section>
    <section class="content">
    <h2>Balance</h2>

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>!</strong> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> !</h4>
        {{ Session::get('error') }}
      </div>
    @endif

 
    <table class="table table-striped">
        <thead class="">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total a retirar</th>
                <th scope="col">Divisa a depositar</th>
                <th scope="col">Cuenta a depositar</th>
                <th scope="col">Wallet </th>
                <th scope="col">Estado</th>       
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody> <?php $cont=1 ?>
          @forelse ($wallet as $wallet)
          <tr>
          <th scope="row"> {{ $cont++ }}</th>
          <td>{{ $wallet->nombreUsuario }}<br>{{ $wallet->lastName }}<br>{{ $wallet->email }} </td>
          <td>{{ $wallet->created_at }}</td>
          <td>{{ $wallet->venta }} {{ $wallet->cryptoCode }}</td>
          <td>{{ $wallet->codigo }}</td>
          <td>{{ $wallet->account }} </td>
          <td>{{ $wallet->plataforma }}</td>
          <td>{{ $wallet->state }}</td>
          <td> 
            <a href="{{ url('admin/criptoWallet/'.$wallet->id.'/edit') }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
            </td>
          </tr>
          @empty
          <h1>No hay balances disponibles</h1>
          @endforelse
        </tbody>

    </table>
    


  </section>
</div>

<!--section end -->
@endsection