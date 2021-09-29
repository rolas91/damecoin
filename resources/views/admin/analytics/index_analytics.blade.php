@extends('layouts.admin_new') 
@section('content')

<!-- daterangepicker -->


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
          Analytics
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/analytics"><i class="fa fa-dashboard"></i> Analytics</a></li>
        <li class="active">list</li>
      </ol>
    </section>
    <section class="content">
    

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

 <!--search  colocar fechas between-->

    <form action="{{ url('admin/analitycs') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div id="" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <label>Seleccione un Rango:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control pull-right"  name="range" id="range">
                </div>
                </div>
          </div>
           <div class="col-md-4">
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
               <label for="destinatary" class=" control-label">Pasarela</label>
               {!!Form::select('metodo', ["Todas"=>"Todas","PayU"=>"PayU","Paypal"=>"Paypal","WesternUnion"=>"WesternUnion","Transferencia"=>"Transferencia"], '', [
                                'id' => 'getCryptos',
                                'class' => 'form-control'
                            ])!!}
   
                </div>
             </div>

          <div class="col-md-2">
                <div class="form-group">
                    <div class="col-md-6">
                      <label></label>
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

                <th scope="col">Fecha</th>

                <th scope="col">User</th>

                <th scope="col">Status</th>

                <th scope="col">Pasarela</th>

                <th scope="col">Descripción</th>
                
                <th style="text-align: right">Total Original</th>
                
                <th style="text-align: right">Comisiones Original</th>

                <th style="text-align: right">Total USD</th>
                
                <th style="text-align: right">Comisiones USD</th>

            </tr>
        </thead>
        <tbody>
            <?php $cont=1;$totalUsd=0;$totalComision=0;$comision=0;$totalDevuelto=0?>
        @forelse ($payments as $payment)

        @if($payment->cryptowalletpayment)
        <tr>
             <td>
                  {{ $cont++ }}
             </td>

             <td>
               {{ $payment->created_at}}
             </td>

             <td>
              {{ $payment->user->email}}
            </td>

             <td>
               {{ General::getTypePayment($payment->status)}}
             </td>

             <td>
               {{ $payment->pasarela}}
             </td>

             <td>
               {{ substr($payment->descripcion,0,10)}}
             </td>

             <td style="text-align: right">
                {{ number_format($payment->total,2,'.',',')}}  {{ $payment->currency->code}}
             </td>

            <td style="text-align: right">
               @if($payment->paymentwallet)
                {{ number_format($payment->total - $payment->paymentwallet->wallet->abono,2,'.',',')}} {{ $payment->paymentwallet->wallet->currency->code}}
                @endif

                @if($payment->cryptowalletpayment)
                {{ number_format($payment->cryptowalletpayment->cripto_wallet->taker,2,'.',',')}} {{ $payment->currency->code}}
                @endif  
            </td>

			<td  style="text-align: right">
				@if($payment->status==1)
                	 <span style="color:red">+</span>
                	 {{ $z=General::analitycs($payment->currency->code,$payment->total) }} USD
					   <?php $totalUsd+=$z ?>
				@else
				{{ $x=General::analitycs($payment->currency->code,$payment->total) }} USD
				<?php $totalDevuelto+=$x ?>

		  		 @endif
		   
            </td>
            
            <td style="text-align: right">
              <span style="color:red">+</span>
               @if($payment->paymentwallet)
               {{ $comision=General::analitycs($payment->paymentwallet->wallet->currency->code,$payment->total - $payment->paymentwallet->wallet->abono)}} USD
               @endif

			   @if($payment->cryptowalletpayment)
			  		@if($payment->status==1)
						  {{ $comision=General::analitycs($payment->currency->code,$payment->cryptowalletpayment->cripto_wallet->taker)}} USD
						  <?php $totalComision+=$comision ?>
			  		@endif
			   @endif  
			   
              
            </td>       
      </tr>
      @endif
        @empty
                <p>No found Analitycs</p>
        @endforelse
       <!--wallets fiat-->
       <?php $z=0?>
        @forelse ($wallets as $wallet)

        <tr>

          <td>
               {{ $cont++ }}
          </td>

          <td>
            	{{ $wallet->created_at}}
      </td>

      <td>
        {{ $wallet->user->email}}
      </td>
		  <!--status-->
          <td>
            {{-- General::getTypePayment($wallet->status) --}}
            {{-- $wallet->paymenwallets->payment --}}
            @if($wallet->paymenwallets)
            {{ General::getTypePayment($wallet->paymenwallets->payment->status) }} 
			@endif
			@if($wallet->cryptowalletwallet)
			{{ General::getTypePayment($wallet->status) }} 

			@endif
          </td>
          <!--Pasarela-->
          <td>

			  @if($wallet->paymenwallets)
			  	{{ $wallet->paymenwallets->payment->pasarela }}
			  @endif

			  @if($wallet->cryptowalletwallet)
			    Fiat {{ $wallet->currency->code }}
		      @endif
           
          </td>
		     <!--Descripcion-->
          <td>

			@if($wallet->paymenwallets)
			  {{ $wallet->paymenwallets->payment->descripcion }}
			@endif

			@if($wallet->cryptowalletwallet)
				@if($wallet->abono)
					Venta
				@endif
				@if($wallet->retiro)
					Compra
		    	@endif
		    @endif
			
            
          </td>
		  <!-- Total original-->
		  <td style="text-align: right">
			
            @if($wallet->paymenwallets)
			  {{ $wallet->paymenwallets->payment->total }}  {{ $wallet->paymenwallets->payment->currency->code }}
			@endif

			@if($wallet->cryptowalletwallet)
                
				@if($wallet->abono)
					{{ $wallet->abono }} {{ $wallet->currency->code }}
				@endif
				@if($wallet->retiro)
					{{ $wallet->retiro }} {{ $wallet->currency->code }}
				@endif
				
		    @endif
          </td>
         <!--comisiones -->
		 <td style="text-align: right">

		  @if($wallet->paymenwallets)
		   	 @if($wallet->paymenwallets->payment->status==1)
				{{ $wallet->paymenwallets->payment->total - $wallet->abono }}  {{ $wallet->currency->code }}
			 @endif
		  @endif

		  @if($wallet->cryptowalletwallet)
				@if($wallet->abono)
					{{ $wallet->cryptowalletwallet->cripto_wallet->taker }} {{ $wallet->currency->code }}
				@endif
				@if($wallet->retiro)
					{{ $wallet->cryptowalletwallet->cripto_wallet->taker }} {{ $wallet->currency->code }}
				@endif
				
		    @endif
          
         </td>
		 <!--total USd-->
		 <td  style="text-align: right">
			

		  @if($wallet->paymenwallets)
			@if($wallet->paymenwallets->payment->status==1)
          		 <span style="color:red">+</span> {{ $z=General::analitycs($wallet->paymenwallets->payment->currency->code,$wallet->paymenwallets->payment->total)}} USD
				  <?php $totalUsd+=$z ?>
			@else
			<span style="color:red">-</span> {{ $x=General::analitycs($wallet->paymenwallets->payment->currency->code,$wallet->paymenwallets->payment->total)}} USD
			 <?php $totalDevuelto+=$x ?>
		  	@endif
		  @endif

		  @if($wallet->cryptowalletwallet)
			  @if($wallet->abono)
			  {{ General::analitycs($wallet->currency->code,$wallet->abono)}} USD
			  @endif
			  @if($wallet->retiro)
			      {{ General::analitycs($wallet->currency->code,$wallet->retiro)}} USD
			  @endif
		  @endif

          
         </td>
          <!--comisiones en USd-->
		 <td style="text-align: right">
     
			@if($wallet->paymenwallets)
				@if($wallet->paymenwallets->payment->status==1)
				<span style="color:red">+</span>
		    	{{ $comision=General::analitycs($wallet->currency->code,$wallet->paymenwallets->payment->total - $wallet->abono )}} USD
				@endif
			@endif

			 @if($wallet->cryptowalletwallet)
			 
				@if($wallet->abono)
				<span style="color:red">+</span>
				{{ $comision=General::analitycs($wallet->currency->code,$wallet->cryptowalletwallet->cripto_wallet->taker  )}} USD
				@endif

				@if($wallet->retiro)
				<span style="color:red">+</span>
				{{ $comision=General::analitycs($wallet->currency->code,$wallet->cryptowalletwallet->cripto_wallet->taker  )}} USD
	
	
		    	@endif
		     @endif

			
			<?php $totalComision+=$comision ?>
          
         </td>       
   </tr>

        @empty
        <p>No found Analitycs</p>

        @endforelse
        
          
        </tbody>


      </table>

      <h2>Total Entrante:{{ number_format($totalUsd,2,',','.') }} USD</h2>
	  <h2>Total Comision:{{ number_format($totalComision,2,',','.') }} USD</h2>
	  <hr>
	  <h2>Total Devuelto:{{ number_format($totalDevuelto,2,',','.') }} USD</h2>
  </section>
</div>
<script>
    //Date range picker with time picker
    $('#range').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'YYYY/MM/DD hh:mm:ss' }})
    //Date range as a button

</script>
<!--section end -->
@endsection