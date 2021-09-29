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
                        <th scope="col">Tipo</th>
                        
                        <th scope="col">Cripto</th>
                        <!--<th scope="col">rol</th>-->
                        <th scope="col">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $index=1;
                    ?>
                    @forelse ($user->cryptowallets as $crypto)
                         <tr>
                            <td scope="row">{{ $index++ }}</td>
                            <td>{{  $crypto->created_at }}</td>
                            <td>{{  $crypto->status }}</td>
                         <td>
                         	 @if($crypto->cryptowalletpayment)
                          		{{ General::getTipoCompraVenta($crypto->compra,$crypto->venta)}}
                             @endif
                             @if($crypto->cryptowalletwallet)
                          			{{ General::getTipoCompraVenta($crypto->compra,$crypto->venta)}}
                      		 @endif
                      		 @if($crypto->externals)
                      		 	wallets externo
                        	 @endif
                         </td>
                         <td>{{ General::getCompraVenta($crypto->compra,$crypto->venta)}} {{ $crypto->crypto->code }} </td>
                         <td>{{--  {{ $crypto}}--}}</td>
                         

                         <td>
                              <a href="{{ url('admin/users/'.$user->id.'') }}" class="btn btn-warning"><i class="fa fa-dollar"></i></a>
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