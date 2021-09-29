@extends('layouts.admin_new') 
@section('content')
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
        <h3> Detalles Operación </h3>
        <p style="margin:0">Email: {{ $balance->user->email }}<br></p>
        <p style="margin:0">Nombres:{{ $balance->user->name }} {{ $balance->user->lastName }}</p>
        <p style="margin:0">Fecha: {{ $balance->created_at }}</p>
        <p style="margin:0">Operacion: {{ General::getTipoCompraVenta($balance->compra,$balance->venta)}}</p>
        
              @if(General::getTipoCompraVenta($balance->compra,$balance->venta)=="Buy")
              <table class="table table-striped">
                  <thead class="">
                    <tr>
                      <th scope="col">Cripto</th>
                      <th scope="col">Comision</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>{{ General::getCompraVenta($balance->compra,$balance->venta)}} {{ $balance->crypto->code }}</td>
                      <td>{{  $balance->taker }} {{ $balance->cryptowalletpayment->payment->currency->code }} </td>
                      <td></td>
                        </tr>
                  </tbody>
                </table>
              <table class="table table-striped">
                    <thead class="">
                      <tr>
                        <th scope="col">Payment</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $balance->cryptowalletpayment->payment->pasarela }}</td>
                        <td>{{ $balance->cryptowalletpayment->payment->total }} {{ $balance->cryptowalletpayment->payment->currency->code }}</td>
 
                          </tr>
                    </tbody>
                  </table>
                  @endif
                  @if(General::getTipoCompraVenta($balance->compra,$balance->venta)=="Sell")
                  <table class="table table-striped">
                      <thead class="">
                        <tr>
                          <th scope="col">Cripto</th>
                          <th scope="col">Comision</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td>{{ General::getCompraVenta($balance->compra,$balance->venta)}} {{ $balance->crypto->code }}</td>
                          <td>
                            {{ $balance->taker }} {{$balance->cryptowalletwallet->wallet->currency->code  }} </td>
                          <td></td>
                            </tr>
                      </tbody>
                    </table>
                  <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">Total</th>
                            <th scope="col">divisa</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$balance->cryptowalletwallet->wallet->abono }}</td>
                            <td>{{ $balance->cryptowalletwallet->wallet->currency->code }}</td>
                              </tr>
                        </tbody>
                      </table>
                      @endif
        <form action="{{ url('admin/balance/'.$balance->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12 control-label">status</label>

                    <div class="col-md-12">
                            {!!Form::select('state', $states, $balance->status, [
                                'id' => 'getCryptos',
                                'class' => 'form-control'
                            ])!!}
                       
                    </div>
                </div>

                <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-12 control-label">comments</label>
    
                        <div class="col-md-12">
                                <textarea style="margin:0" class="form-control" name="comments"   rows="3">
                                        {{ trim($balance->comments) }}
                                    </textarea>
                                    @if ($errors->has('comments'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                           
                        </div>
                </div>


                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button> 
                        </div>
                </div>
                
        </form>
       

      </section>
    </div>


<!--section end -->
@endsection