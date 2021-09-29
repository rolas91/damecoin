@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
    <section class="content-header">
      <h1>
          PaymentMethodState (Create)
        <small></small>
      </h1>

    </section>        
    <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/limit"><i class="fa fa-dashboard"></i> Divisa</a></li>
            <li class="active">Crear</li>
          </ol>
        </section>
        <section class="content">
          
          <div class="contaienr">
            <div class="row">
              <div class="col-6">
                @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> !</h4>
                    {{ Session::get('success') }}
                  </div>
                @endif

                @if(Session::has('danger'))
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> !</h4>
                    {{ Session::get('danger') }}
                  </div>
                @endif
              </div>
            </div>      
            <div class="row">
                <div class="col-md-6">
                  {!! Form::open(['route' => 'payment-method-state.store', 'method' => 'POST', 'files' => true]) !!}
                    {!! Form::token() !!}
                    @include('admin.payment-method-state.partials.form')
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
       
        </section>
</div>   

   
<!--section end -->
@endsection