@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Wallet
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/balance"><i class="fa fa-dashboard"></i> wallet</a></li>
        <li class="active">list</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-3">
                <p style="margin:0">Fecha: {{ $wallet->created_at }}</p>
            </div>
            <div class="col-sm-3">
                <p style="margin:0">Email: {{ $wallet->user->email }}</p>
            </div>
            <div class="col-sm-3">
                <p style="margin:0">Nombres:{{ $wallet->user->name }} {{ $wallet->user->lastName }}</p>
            </div>

        </div>
        
        @if(General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)=="Retiro")
              <p style="margin:0">Beneficiario :{{ $wallet->bankacounts->benefics }}</p>
        @endif  
            
              @if(General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)=="Retiro")
              <table class="table table-striped">
                  <thead class="">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Total</th>
                      <th scope="col">Divisa</th>
                      <th scope="col">Operacion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>#</td>
                      <td>{{ $wallet->bankacounts->monto}}</td>
                      <td>{{ $wallet->currency->code }}</td>
                      <td>{{ General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)}}</td>
                        </tr>
                  </tbody>
                </table>
              <p style="margin:0">Detalles del banco</p>
              <p style="margin:0">Banco: {{ $wallet->bankacounts->name }}</p>
              <p style="margin:0">Pais: {{ $wallet->bankacounts->country }}</p>
              <p style="margin:0">Direccion: {{ $wallet->bankacounts->addres }}</p>
              <p style="margin:0">Swift: {{ $wallet->bankacounts->swit }}</p>
              <p style="margin:0">Iban: {{ $wallet->bankacounts->iban }}</p>
              @endif
              @if(General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)=="Deposito")
              <table class="table table-striped">
                  <thead class="">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Total</th>
                      <th scope="col">Divisa</th>
                      <th scope="col">Operacion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>#</td>
                      <td>{{ $wallet->abono}}</td>
                      <td>{{ $wallet->currency->code }}</td>
                      <td>{{ General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)}}</td>
                        </tr>
                  </tbody>
                </table>
                <table class="table table-striped">
                    <thead class="">
                      <tr>
                        <th scope="col">Comision</th>
                        <th scope="col">Payment</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($wallet->paymenwallets)
                    <tr>
                      <td>{{$wallet->paymenwallets->payment->total -$wallet->abono }}</td>
                      <td>{{$wallet->paymenwallets->payment->pasarela}}</td>
                    </tr>
                    @endif
                    @if($wallet->transferences)
                    <tr>
                      <td>{{$wallet->transferences->total -$wallet->abono }}</td>
                      <td>{{$wallet->transferences->pasarela}}</td>
                    </tr>
                    @endif

                    </tbody>
                   </table>
                @endif
                @if(General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)=="Abono")
                <table class="table table-striped">
                    <thead class="">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">total</th>
                        <th scope="col">Divisa</th>
                        <th scope="col">Operacion</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#</td>
                        <td>{{ General::getAbonoRetiro($wallet->abono,$wallet->retiro)}}</td>
                        <td>{{ $wallet->currency->code }}</td>
                        <td>{{ General::getTipoAbonoRetiro($wallet->abono,$wallet->retiro)}}</td>
                          </tr>
                    </tbody>
                  </table>
                   @if($wallet->cryptowalletwallet)
                   <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">Total</th>
                            <th scope="col">Cripto</th>
                            <th scope="col">comision</th>
                            <th scope="col">Descripcion</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> {{ $wallet->cryptowalletwallet->cripto_wallet->venta }}</td>
                            <td>{{ $wallet->cryptowalletwallet->cripto_wallet->crypto->code }} </td>
                            <td> {{ $wallet->cryptowalletwallet->cripto_wallet->taker }}</td>
                            <td> Venta de cripto</td>
                              </tr>
                        </tbody>
                       </table>
                      
                   @endif   
                @endif 

                      <form action="{{ url('admin/wallets/'.$wallet->id) }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">status</label>
        
                            <div class="col-md-12">
                                    {!!Form::select('state', $states, $wallet->status, [
                                        'id' => 'getCryptos',
                                        'class' => 'form-control'
                                    ])!!}
                               
                            </div>
                        </div>
                        @if($wallet->transferences)
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">status transferencia</label>
        
                            <div class="col-md-12">
                                    {!!Form::select('status_user', ['Aprobado' => 'Aprobado','Pendiente'=>'Pendiente','Rechazado'=>'Rechazado'], $wallet->status_user, [
                                        'id' => 'getstatus',
                                        'class' => 'form-control'
                                    ])!!}
                               
                            </div>
                        </div>

                        @endif
        
                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-12 control-label">comments</label>
            
                                <div class="col-md-12">
                                        <textarea style="margin:0" class="form-control" name="comments"   rows="3">
                                                {{ trim($wallet->comments) }}
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
                @if($wallet->transferences)
                <p>ver comprobante</p>
                <a href="{{ asset('uploads/comprobante') }}/{{ $wallet->transferences->img }}" target="_blank">
                <img src="{{ asset('uploads/comprobante') }}/{{ $wallet->transferences->img }}" alt="">
              </a>
                @endif
       
      </section>

    </div>


<!--section end -->
@endsection