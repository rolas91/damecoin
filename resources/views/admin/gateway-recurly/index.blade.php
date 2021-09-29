@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         GateWay Recurly
        <small></small>
      </h1>

    </section>
    <section class="content">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('success') }}
          </div>
        @endif

        <a href="{{ url('admin/gateway-recurly/create') }}"> Nueva Gateway</a>
                <table class="table table-striped mt-4">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                        
                            <th scope="col">Curency</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Stripe</th>
                            <th scope="col">GatewayCode</th>
                            <th scope="col">Actions<th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse ($gateways as $gateway)
                          <tr>
                          <th scope="row">1</th>
                          <td>{{$gateway->currency->name}} </td>
                          <td>{{$gateway->name}} </td>
                          <td>{{$gateway->stripe_id}} </td>
                          <td>{{$gateway->gateway_code}} </td>
                          <td>
                              <a href="{{ url('admin/gateway-recurly/'.$gateway->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                          </td>
                          </tr>
                        @empty
                               
                        @endforelse
                        
                          
                        </tbody>
                      </table>
                      {{ $gateways->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection