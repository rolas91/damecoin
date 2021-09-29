@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<style>
.show-border{
  border:solid 1px #ccc;
  margin:10px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Stripe Account
        <small>{{$stripe->stripe_id}}</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="/admin/stripe-account"><i class="fa fa-dashboard"></i> stripeAcounts</a></li>
            <li class="active">Actualizar</li>
          </ol>
    </section>

  
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('success') }}
          </div>
        @endif
    <section class="content">
      <div class="row">
        <!--gateway-->
        <div class="col-md-12 show-border" >
          <h4>Gatewaycode</h4>
          <div class="row">
          <div class="col-md-4" style="border:solid 1px blue">
             @include('admin.stripe-account.partials.gateway')
          </div>
          <div class="col-md-6"  style="border:solid 1px red">
          @forelse ($stripe->gateways as $gateway)
            <div class="col-md-3" style="border:solid 1px #ccc;padding:5px;margin:3px;display:flex;flex-direction:column">
             <span> {{$gateway->currency->code}}</span>
            <span>  {{$gateway->gateway_code}}</span>

            <form method="POST" action="{{url('admin/gateway-recurly/'.$gateway->id.'')}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <div class="form-group">
                  <input type="submit" class="btn btn-danger delete" value="X">
                  </div>
              </form>

            </div>

          @empty
                               
          @endforelse
          </div>
          </div>
          
        </div>
        <!--stados-->
        <div class="col-md-12 show-border">
          <h4>Actualizar estados</h4>
              <div class="row">
              <div class="col-md-4">
               @include('admin.stripe-account.partials.states')
             </div>
             <div class="col-md-6">
              @forelse ($stripe->states as $state)
                <div class="col-sm-12" style="border:solid 1px #ccc;padding:5px;margin:3px">
                  {{$state->status === 0 ? 'Inactivo' : 'Activo'}} 
                  {{$state->descripcion}}
                  {{ Carbon\Carbon::parse($state->created_at)->format('d-m-Y') }}
                  
                </div>

              @empty

              @endforelse
              </div>
              </div>
           
        </div>
        <!--details-->
        <div class="col-md-12 show-border" style="border:solid 1px purple">
          <h4>Detalles</h4>
          <div class="row">
              <div class="col-md-4">
                 @include('admin.stripe-account.partials.details')
              </div>

              <div class="col-md-6">
              @forelse ($stripe->details as $detail)
                <div class="col-sm-12" style="border:solid 1px #ccc;padding:5px;margin:3px">
                  {{$detail->retencions === 0 ? 'Inactivo' : 'Activo'}} 
                  {{$detail->mounts}}
                  {{$detail->bank->name}}
                </div>

              @empty

              @endforelse
              </div>
              </div>
            
        </div>


      </div>
        
    </section>
</div>
<script>
    $('.delete').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('confirma eliminar?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>
<!--section end -->
@endsection