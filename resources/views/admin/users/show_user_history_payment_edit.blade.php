@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Usuarios
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/users"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">list</li>
      </ol>
    </section>

    <section class="content">
          
        <form action="{{ url('admin/users-history-payment-edit/'.$user->id) }}" method="POST" class="form-horizontal" style="padding: 30px">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
            <div class="row">
              <div class="col-md-6">
                <label for="name" class="">Usuario:</label>
                <label for="name" class="">{{$user->email}},{{$user->name}} {{$user->lastName}}</label>
              </div>
             </div>
                {{-- 
            <div class="row">
              <div class="form-group{{ $errors->has('Divsa') ? ' has-error' : '' }}">
               
                <div class="col-md-5">
                    <label for="name" class="control-label">Divisa</label>
                        {!!Form::select('currency', $currencies, $payment->currency_id, [
                            'id' => 'getCryptos',
                            'class' => 'form-control',
                           
                        ])!!}
                   
                </div>
              </div>
            </div>
            --}}
                
            <div class="row">
                <div class="form-group {{ $errors->has('monto') ? ' has-error' : '' }}">
                    <div class="col-md-5">
                      <label for="monto" class="control-label">Monto</label>
                      <input disabled id="monto" disable type="text" class="form-control" name="monto" value="{{ $payment->total }}" maxlength="">
                      @if ($errors->has('monto'))
                          <span class="help-block">
                              <strong>{{ $errors->first('monto') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-5">
                      <input id="idPayment"  type="hidden" class="form-control" name="idPayment" value="{{ $payment->id }}" maxlength="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group{{ $errors->has('metodo') ? ' has-error' : '' }}">
                        <div class="col-md-5">
                         <label for="name" class="control-label">Status de pago</label>
                        {!!Form::select('statusPayment', $statusPayment, $payment->status, [
                            'id' => 'getCryptos',
                            'class' => 'form-control'
                        ])!!}
                       </div>
                </div>
             </div>
            {{-- 
            <div class="row">
                <div class="form-group {{ $errors->has('comision') ? ' has-error' : '' }}">        
                    <div class="col-md-5">
                       <label for="comision" class="control-label">Comisión</label>
                       <input id="comision" type="text" class="form-control" name="comision" value="{{ old('comision') }}" maxlength="">
                       @if ($errors->has('comision'))
                           <span class="help-block">
                               <strong>{{ $errors->first('comision') }}</strong>
                           </span>
                       @endif
                    </div>
                </div>
            </div>
            --}}
            {{--
            <div class="row">
               <div class="form-group{{ $errors->has('metodo') ? ' has-error' : '' }}">
                       <div class="col-md-5">
                        <label for="name" class="control-label">Método de pago</label>
                       {!!Form::select('metodo', ["PayU"=>"PayU","Paypal"=>"Paypal","WesternUnion"=>"WesternUnion","Transferencia"=>"Transferencia","FasterPay"=>"FasterPay"], $payment->pasarela, [
                           'id' => 'getCryptos',
                           'class' => 'form-control'
                       ])!!}
                      </div>
               </div>
            </div>
            --}}

            <div class="row">
                <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                        <div class="col-md-5">
                            <label for="name" class="control-label">comments</label>
    
                                <textarea style="margin:0" class="form-control" name="comments"   rows="3">
                                        {{ $payment->descripcion }}
                                    </textarea>
                                    @if ($errors->has('comments'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                           
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                        <div class="col-md-5 justify-content-center">
                            <button type="submit" class="btn btn-primary" style="">
                                Actualizar
                            </button> 
                        </div>
                </div>
            </div>
              
        </form>
       

      </section>


  
</div>
    
<!--section end -->
@endsection