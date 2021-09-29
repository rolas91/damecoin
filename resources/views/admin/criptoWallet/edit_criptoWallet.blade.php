@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Transferencia de {{$cryptoWall->crypto->name}} a {{$send_transfer->platform}}
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/criptoWallet"><i class="fa fa-dashboard"></i> Cripto Wallet</a></li>
        <li class="active">list</li>
      </ol>
    </section>
    <section class="content">
        <h3> Detalles Operación </h3>
        <p style="margin:0">Email: {{ $cryptoWall->user->email }}<br></p>
        <p style="margin:0">Nombres: {{$cryptoWall->user->name}} {{$cryptoWall->user->lastName}}</p>
        <p style="margin:0">Fecha: {{$send_transfer->created_at}}</p>

                  <table class="table table-striped">
                      <thead class="">
                        <tr>
                          <th scope="col">Transferir</th>
                          <th scope="col">Comision</th>
                          <th scope="col">Divisa</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td id="retiro">{{$cryptoWall->venta}} {{$cryptoWall->crypto->code}}</td>
                          <td id="comi">{{$cryptoWall->taker}} {{$cryptoWall->crypto->code}}</td>
                          <td>{{$currency->code}}</td>
                            </tr>
                      </tbody>
                    </table>
                    <form action="{{ url('admin/criptoWallet/'.$cryptoWall->id.'/edit') }}" method="POST" class="form-horizontal">
                      {{ csrf_field() }}
                      {{ method_field('PATCH') }}
                      <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-12 control-label">status</label>

                          <div class="col-md-12">
                                  {!!Form::select('state', $states, $cryptoWall->status, [
                                      'id' => 'statesF',
                                      'class' => 'form-control'
                                  ])!!}
                            
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                              <label for="name" class="col-md-12 control-label">comments</label>
          
                              <div class="col-md-12">
                                      <textarea style="margin:0" class="form-control" name="comments"   rows="3">
                                              {{ trim($cryptoWall->comments) }}
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
                      
        <!-- <form action="{{ url('admin/criptoWallet/'.$cryptoWall->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                
                <div class="form-group">
                <select class="form-select form-select-sm form-control" name='state' aria-label=".form-select-sm">
                    <option value="1" selected>Pendiente</option>
                    <option value="2">Aprobado</option>
                    <option value="3">Rechazado</option>
                </select>
                </div>
                <div class="form-group">
                        <label for="name" class="col-md-12 control-label">comments</label>
    
                        <div class="col-md-12">
                                <textarea style="margin:0" class="form-control" name="comments"   rows="3">
                                        {{ $cryptoWall->comments }}
                                    </textarea>
                        </div>
                </div>


                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button> 
                        </div>
                </div>
                
        </form> -->
       

      </section>
    </div>


<!--section end -->
@endsection