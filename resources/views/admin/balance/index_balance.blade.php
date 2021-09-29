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
        <li><a href="/admin/balance"><i class="fa fa-dashboard"></i> Balance</a></li>
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

 <!--search-->
    <form action="{{ url('admin/balance') }}" method="POST">
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
                <th scope="col">Total Pagado</th>
                <th scope="col">Total Acreditado</th>
                <th scope="col">Comision</th>
                <th scope="col">Fiat post Comisiones</th>
                <th scope="col">Cripto acreditada</th>
                <th scope="col">Cripto debitada</th>
                <th scope="col">Pago</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php $cont=1 ?>
        @forelse ($balances as $balance)
        <tr id="{{ $balance->state->name }}" class="tipo-{{General::getTipoCompraVenta($balance->compra,$balance->venta)}}">
        <th scope="row"> {{ $cont++ }}</th>
        <td>{{ $balance->user->email }}<br>{{ $balance->user->name }} {{ $balance->user->lastName }}</td>
        <td>{{ $balance->created_at }}</td>
       
        <td>
         @if($balance->cryptowalletpayment)
         {{ $balance->cryptowalletpayment->payment->total }} {{ $balance->cryptowalletpayment->payment->currency->code }}
          @endif
          @if($balance->cryptowalletwallet)
		@if (General::getTipoCompraVenta($balance->compra,$balance->venta)=="Buy")
            {{ $balance->cryptowalletwallet->wallet->retiro }}  {{ $balance->cryptowalletwallet->wallet->currency->code }}
	     @endif
	  @endif
       </td>

	  <td>
	  @if($balance->cryptowalletwallet)
		@if (General::getTipoCompraVenta($balance->compra,$balance->venta)=="Sell")
            {{ $balance->cryptowalletwallet->wallet->abono }}  {{ $balance->cryptowalletwallet->wallet->currency->code }}
	     @endif
	 @endif
	  </td>
       <td>
			@if($balance->externals)

			@else
		   		{{ $balance->taker }}
           		@if($balance->cryptowalletpayment)
           		{{ $balance->cryptowalletpayment->payment->currency->code }}
           		@endif
		   		@if($balance->cryptowalletwallet)
		   		{{ $balance->cryptowalletwallet->wallet->currency->code }} 
		   		@endif
		   @endif
       
        </td>
        <td>
        @if($balance->cryptowalletpayment)
           {{ $balance->cryptowalletpayment->payment->total - $balance->taker }} {{ $balance->cryptowalletpayment->payment->currency->code }} 
           @endif

        </td>

       <td>
	 	@if (General::getTipoCompraVenta($balance->compra,$balance->venta)=="Buy")
	 	{{ General::getCompraVenta($balance->compra,$balance->venta)}} {{ $balance->crypto->code }}</td>
	 	@endif
	  <td>
	     @if (General::getTipoCompraVenta($balance->compra,$balance->venta)=="Sell")
		{{ General::getCompraVenta($balance->compra,$balance->venta)}} {{ $balance->crypto->code }}
		@endif
	  </td>

       <td>
       @if($balance->cryptowalletpayment)
         {{ $balance->cryptowalletpayment->payment->pasarela }}
       @endif
       @if($balance->cryptowalletwallet)
          @if (General::getTipoCompraVenta($balance->compra,$balance->venta)=="Buy")
             fiat {{ $balance->cryptowalletwallet->wallet->currency->code }} 
          @endif
       @endif

       </td>
	 
        
        <td>{{ $balance->state->name }} </td>

        <td>
            @if($balance->cryptowalletpayment)
			   {{ General::getTipoCompraVenta($balance->compra,$balance->venta)}}
            @endif
            @if($balance->cryptowalletwallet)
			   {{ General::getTipoCompraVenta($balance->compra,$balance->venta)}}
			@endif
			@if($balance->externals)
			wallets
		    @endif

          {{-- 
          {{ General::getTipoCompraVenta($balance->compra,$balance->venta)}}
          --}}
    
        </td>

        <td>
            @if($balance->externals)
            <a href="{{ url('admin/balance/'.$balance->id.'/edit') }}" class="btn btn-success"><i class="fa fa-google-wallet"></i></a>

			@else
          
			 <a href="{{ url('admin/balance/'.$balance->id.'/edit') }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
			@endif
			</td>
		
	    </tr>
        @empty
                <p>No balance</p>
        @endforelse
          
        </tbody>
      </table>
      {{ $balances->links() }}


  </section>
</div>

<!--section end -->
@endsection