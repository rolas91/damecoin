@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<style>
.bordered{
  border:solid 1px #ccc;
  margin:0px;
  padding:1px;
}
.list-group{
  max-height:250px;
  overflow-y: scroll;
}
.flexx{
  display:flex;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Stripe Account
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

        <a href="{{ url('admin/stripe-account/create') }}"> Nueva Stripe Account</a>
       
        <br>
        @forelse ($stripes as $stripe)
            <div class="row">
              <div class="col-md-12">
              <div class="panel panel-primary">
              <div class="panel-footer ">
              <div class="row flexx">
              <div class="name col-md-2">
                Stripe:{{$stripe->stripe_id}} 
                </div>
                <div class="defaultConversion col-md-9">
                <p> Status => {{$stripe->status === 0 ? 'Inactivo' : 'Activo'}}  </p>
                </div>
                <div class="dropdown pull-right">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Options
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="{{ url('admin/stripe-account/'.$stripe->id.'/edit') }}">Editar</a></li>
                    <li><a href="#">Agregar Gateway Code</a></li>
                    <li><a href="#">Agregar status</a></li>
                    <li><a href="#">Ver usuarios</a></li>
                    <li><a  href="{{ url('admin/stripe-account/'.$stripe->id) }}">Ver</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Agregar retiros</a></li>
                  </ul>
                </div>
                </div>
              </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="list-group">
                          <p  class="list-group-item active">
                            gatewaycode
                          </p>
                      @forelse ($stripe->gateways as $gateway)
                         <div class="list-group-item">
                           <p> {{$gateway->currency->code}} =>
                          {{$gateway->gateway_code}}</p>

                          </div>
                    
                     @empty
                     <div class="list-group-item">
                               sin gatewaycode
                             </div>

                     @endforelse
                     </div>
                    </div>
                    <div class="col-md-4 ">
                       <div class="list-group">
                          <p  class="list-group-item active">
                            status
                          </p>

                       @forelse ($stripe->states as $state)
                       <div class="list-group-item">
                        {{$state->status === 0 ? 'Inactivo' : 'Activo'}} 
                        {{$state->descripcion}}
                        {{ Carbon\Carbon::parse($state->created_at)->format('d-m-Y') }}
                       </div>
                       @empty
                       <div class="list-group-item">
                               sin estados
                             </div>

                       @endforelse

                       </div>
                    </div>
                    <div class="col-md-4">
                       <div class="list-group">
                            <p  class="list-group-item active">
                            retiros
                            </p>
                            @forelse ($stripe->details as $detail)
                              <div class="list-group-item">
                                 {{$detail->retencions === 0 ? 'No retencion' : 'Retencion'}} 
                                 {{$detail->mounts}}
                                 {{$detail->bank->name}}
                               </div>

                             @empty
                             <div class="list-group-item">
                               sin retiros
                             </div>

                             @endforelse

 
</div>

                      
                    </div>
                  </div>
                </div>
                <div class="panel-footer">secure_3d=>{{$stripe->secure_3d === 0 ? 'NO' : 'Yes'}}      Created_at {{$stripe->created_at}}</div>
              </div>
          
                </div>
               
            </div>
                        @empty
                               
                        @endforelse

                      {{ $stripes->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection