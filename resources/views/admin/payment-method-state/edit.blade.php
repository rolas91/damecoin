@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
    <section class="content-header">
      <h1>
          PaymentMethodState (Edit)
        <small></small>
      </h1>

    </section>        
    <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/limit"><i class="fa fa-dashboard"></i> Divisa</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">
        

        <div class="contaienr">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('admin/payment-method-state/'.$payment->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="row col-md-10">
                                
                                <label for="name" >Method :</label> 
                                <span >{{$payment->payment_method}}</span>

                            </div>
                                
                            <div class="row col-md-6" style="margin-bottom:20px">
                                
                                <label for="code">State</label>
                                {!!Form::select('state', [0 => 'Caido',1=>'Activo',], $payment->state, [
                                    'id' => 'state',
                                    'class' => 'form-control'
                                ])!!}                                 
                            </div>
                         
                            <div class="form-group" style="margin-top:20px">
                                    <div class="col-md-8">
                                        <a href="{{ route('payment-method-state.index') }}" class="btn btn-warning square">Back</a>
                                        <button type="submit" class="btn btn-primary">
                                            Guardar
                                        </button> 
                                    </div>
                            </div>
                    </form>  
                </div>
            </div>
        </div>
       
        </section>
</div>   

   
<!--section end -->
@endsection