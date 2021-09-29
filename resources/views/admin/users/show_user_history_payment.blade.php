@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Usuarios history General
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/users"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">list</li>
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
          <h2> {{ $user->email }} {{ $user->firsName }} {{ $user->lastName }} </h2>

          <table class="table table-striped">
                    <thead class="">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>     
                        <th scope="col">Pasarela</th>
                        <th scope="col">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $index=1;
                    ?>
                    @forelse ($user->payments as $payment)
                        <tr>
							<td>{{ $index++ }}</td>
							<td>{{ $payment->created_at }}</td>
							<td>{{ General::getTypePayment($payment->status) }}</td>
							<td>{{ $payment->total }} {{ $payment->currency->code }}</td>
							<td>{{ $payment->pasarela }}</td>
                         	<td>
                              <a href="{{ url('admin/users-history-payment-edit/'.$user->id.'/'.$payment->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @empty
                            <p>No user wallets registrado</p>
                    @endforelse
                      
                    </tbody>
                  </table>
          

       

      </section>


  
</div>
    
<!--section end -->
@endsection