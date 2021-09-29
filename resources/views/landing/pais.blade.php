@extends('layouts.ladingGeneralNew')

@section('content')

<div class="section-compra-pais">        
    <div class="banner-principal-four">
      <div class="container" >
            <div class="row" style="margin-top: 90px;">
                <div class="col-12 col-lg-5">
                    
                  <div class="d-flex justify-content-start align-items-center ">
                      <img class="icon-coin" src="{{asset('assets/img/detalle-metodo-pago/5a3a27023146b31.png')}}" alt="">
                      <img class="icon-coin-small mx-3" src="{{asset('assets/img/detalle-metodo-pago/switch1.png')}}" alt="">
                      <img class="icon-coin" src="{{asset('assets/img/compra-pais/MaskGroup.png')}}" alt="">
                  </div>
                  
                    <h2 class="text-white font-weight-bold mt-3">
                      Compra Bitcoins en<br class="d-none d-lg-block">
                        <span class="color-green"><span id="TextCountry"></span> a la mejor tasa local</span>
                    </h2>

                    <p class="text-white mt-2">
                      @lang('index.new_sub_title')
                    </p>
                    
                    <ul class="list-punto-light mt-4">
                      <li >
                        @lang('index.mesagge1')
                     </li>
                     <li >
                        @lang('index.mesagge2')
                     </li>
                     <li >
                        @lang('index.mesagge3') {{$getCriptodefault->code}} @lang('index.mesagge3-1') {{$getCurrencyUser->code}} @lang('index.mesagge3-2')
                     </li>
                  </ul>
                    </ul>

                </div>
                <div class="col-12 col-lg-7 mt-4">
                    <div class="card card-compra-instantanea ">
                        <div class="card-body">

                          <div class="row">
                            <div class="col-12 col-md-6 ">
                                <strong>@lang('index.buydivisa')</strong>
    
                                <div class="container-select-list mt-2">
                                    <div class="icon"> 
                                        <span class="mr-2">{{$getCriptodefault->code}} </span>
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>
                                    {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                                        'id' => 'getCryptosss',
                                        'class' => 'selectpicker'
                                        ])
                                    !!}
                                </div>
    
    
                            </div>
                            <div class="col-12 col-md-6 ">
                                <strong >@lang('index.paydivisa')</strong>
    
                                <div class="container-select-list mt-2">
                                    <div class="icon"> 
                                        <span class="mr-2" id="pay" >{{$getCurrencyUser->code}} </span>
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>
                                    {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                                        'id' => 'getCurrenciesss',
                                        'class' => 'selectpicker'
                                    ])!!}
                                </div>
    
                            </div>
                        </div>

                            <h6  class="font-weight-bold mt-3">@lang('index.mount')</h6>

                            <div class="row">
                              @foreach($getPanel as $index => $panel)
                                  <div class="col-12 col-md-6 mt-3">
                                      <div class="input-radio-option">
                                          @if($index == 2)
                                              <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}"  class="radioBtnClass2"  name="amount" checked>
                                          @else
                                              <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}"  class="radioBtnClass2"  name="amount">
                                          @endif
      
                                      
                                          <div class="card-radio">
                                              <div class="icon mr-auto"></div>
                                              <p>
                                                  <small>@lang('index.pay')</small> <br>
                                                  <span>
                                                      {{$panel["pagar"]}}
                                                      {{$getCurrencyUser->code}}
                                                  </span>
                                              </p>
                                              <p class="signo">=</p>
                                              <p>
                                                  <small>@lang('index.get')</small> <br>
                                                  <span>
                                                      {{$panel["recibir"]}}
                                                      {{$getCriptodefault->code}}
                                                  </span>
                                              </p>
                                          </div>
                                      </div>
      
                                  </div>
                              @endforeach
                          </div>

                            <h6  class="font-weight-bold mt-3">@lang('index.otherQuantity')</h6>

                            <div class="row">
                              <div class="col-12 col-md-6">
      
                                  <div class="input-group input-group-cantidad mb-3">
                                      <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="personasCryptos" aria-describedby="buyHelp" value="{{$default['recibe']}}" onKeyPress="return soloNumeros(event)">
                                      <div class="input-group-append">
                                        <span class="input-group-text">
                                            {{-- <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt=""> --}}
                                            {{$getCriptodefault->name}}
                                        </span>
                                      </div>
                                    </div>
      
                              </div>
                              <div class="col-12 col-md-6">
      
                                  <div class="input-group input-group-cantidad mb-3">
                                      <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)" id="personasCurrencys" onkeyup="document.getElementById('customBuy').value=this.value; newChecked(this);">
                                      <div class="input-group-append">
                                        <span class="input-group-text">
                                            {{-- <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt=""> --}}
                                            {{$getCurrencyUser->name}}
                                        </span>
                                      </div>
                                    </div>
      
                              </div>
                          </div>

                          @include('partials.formPayU')
                   
                    <div class="row justify-content-lg-between mt-3">
                        <div class="d-flex justify-content-center align-items-center flex-wrap mt-3" style="width: 100%;">
                            <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.comiciones')</p>
                            <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.inmediato')</p>
                            <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.proceso')</p>
                        </div>
                        
                        <center style="width: 100%;">
                            <a href="#" class=" link " >@lang('index.verMetodos')</a>
                        </center>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>


    <section id="by-country-overview">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-xl-3">
              <div class="card-overview">
                <img src="{{asset('assets/img/landing/icons/compra-instantanea.svg')}}">
                <div class="card-overview-content">
                  <h5 class="text-dark-primary">@lang('index.cinsta')</h5>
                  <p></p>
                </div>
              </div>
            </div>
      
            <div class="col-md-6 col-xl-3">
              <div class="card-overview">
                <img src="{{asset('assets/img/landing/icons/sin-tasas-ocultas.svg')}}">
                <div class="card-overview-content">
                  <h5 class="text-dark-primary">@lang('index.soculta')</h5>
                  <p></p>
                </div>
              </div>
            </div>
      
            <div class="col-md-6 col-xl-3">
              <div class="card-overview">
                <img src="{{asset('assets/img/landing/icons/soporte-en-vivo.svg')}}">
                <div class="card-overview-content">
                  <h5 class="text-dark-primary">@lang('index.masbaja')</h5>
                  <p></p>
                </div>
              </div>
            </div>
      
            <div class="col-md-6 col-xl-3">
              <div class="card-overview">
                <img src="{{asset('assets/img/landing/icons/pagos-seguros.svg')}}">
                <div class="card-overview-content">
                  <h5 class="text-dark-primary">@lang('index.pagos100')</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    {{-- <div class="container text-center py-4">
        <h2 class="font-weight-bold">Las mejores tasas en Colombia  <br class="d-none d-lg-block">  con tu moneda local</h2>

        <div class="card card-dark">
            <div class="card-body">
        
               <div class="table-responsive-custom">
                    <div class="container-table">
                   
                        <div class="row-header">
                          <div class="left">Cripto moneda</div>
                          <div>Precio (USD)</div>
                          <div>Market cap (USD)</div>
                          <div>Cambio</div>
                          <div>Gráfica</div>
                          <div> </div>
                        </div>
                   
                        <div class="row-table">
                          <div class="left"> 
                           <div class="container-moneda">
                            <img src="{{ asset('assets/img/precios/1.png')}} " alt=""> 
                            <span>Bitcoin <br> <small>(BTC)</small></span>
                           </div>
                          </div>
                          <div>$ 10.000</div>
                          <div>9,595.119,600,000</div>
                          <div class="color-danger-second" >-0,04%</div>
                          <div>
                            <div class="container-miniChart" >
                                <canvas id="miniChart" ></canvas>
                            </div>
                          </div>
                          <div class="right">
                           <div class="d-flex">
                            <button class="btn btn-primary-custom-gradient active m-1">Comprar</button>
                            <button class="btn btn-primary-custom-gradient m-1"
                            data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">Detalles</button>
                           </div>
                          </div>
                        </div>
                   
                        <div  class="collapse show" id="collapse1">
                            <div class="row">
                              <div class="col-12 col-md-6 text-left py-3">
                                <small class="d-block">Valor actual</small>
                                <h5 class="mb-0 h4">USD 2.523.089</h5>
                                <small class="color-succes">216.10 USD (2.17%)</small>
                              </div>
                   
                              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                                <div class="">
                                  <span class=" font-small">24h: <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">7D:  <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">20D: <b class="color-danger">17%<i class="fas fa-arrow-down"></i></b></span>
                                </div>
                              </div>
                            </div>
                   
                            <div class="container-chart" id="container-chart">
                              <canvas id="myChart" ></canvas>
                            </div>
                   
                            <div class="d-flex justify-content-center align-items-center py-3">
                              <button class="btn btn-light mx-2" 
                              data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">Cerrar gráfica</button>
                              <button class="btn link-gradient-blue mx-2" >Comprar BTC</button>
                            </div>
                   
                        </div>
                   
                        <div class="row-table">
                          <div class="left"> 
                           <div class="container-moneda">
                            <img src="assets/img/precios/1.png" alt=""> 
                            <span>Bitcoin <br> <small>(BTC)</small></span>
                           </div>
                          </div>
                          <div>$ 10.000</div>
                          <div>9,595.119,600,000</div>
                          <div class="color-danger-second" >-0,04%</div>
                          <div>
                            <div class="container-miniChart" >
                                <canvas id="miniChart" ></canvas>
                            </div>
                          </div>
                          <div>
                           <div class="d-flex">
                            <button class="btn btn-primary-custom-gradient active m-1">Comprar</button>
                            <button class="btn btn-primary-custom-gradient m-1"
                            data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">Detalles</button>
                           </div>
                          </div>
                        </div>
                   
                        <div  class="collapse" id="collapse2">
                            <div class="row">
                              <div class="col-12 col-md-6 text-left py-3">
                                <small class="d-block">Valor actual</small>
                                <h5 class="mb-0 h4">USD 2.523.089</h5>
                                <small class="color-succes">216.10 USD (2.17%)</small>
                              </div>
                   
                              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                                <div class="">
                                  <span class=" font-small">24h: <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">7D:  <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">20D: <b class="color-danger">17%<i class="fas fa-arrow-down"></i></b></span>
                                </div>
                              </div>
                            </div>
                   
                            <div class="container-chart" id="container-chart">
                              <canvas id="myChart" ></canvas>
                            </div>
                   
                            <div class="d-flex justify-content-center align-items-center py-3">
                              <button class="btn btn-light mx-2" 
                              data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">Cerrar gráfica</button>
                              <button class="btn link-gradient-blue mx-2" >Comprar BTC</button>
                            </div>
                   
                        </div>
                   
                        <div class="row-table">
                          <div class="left"> 
                           <div class="container-moneda">
                            <img src="assets/img/precios/1.png" alt=""> 
                            <span>Bitcoin <br> <small>(BTC)</small></span>
                           </div>
                          </div>
                          <div>$ 10.000</div>
                          <div>9,595.119,600,000</div>
                          <div class="color-danger-second" >-0,04%</div>
                          <div>
                            <div class="container-miniChart" >
                                <canvas id="miniChart" ></canvas>
                            </div>
                          </div>
                          <div>
                           <div class="d-flex">
                            <button class="btn btn-primary-custom-gradient active m-1">Comprar</button>
                            <button class="btn btn-primary-custom-gradient m-1"
                            data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapseExample">Detalles</button>
                           </div>
                          </div>
                        </div>
                   
                        <div  class="collapse" id="collapse3">
                            <div class="row">
                              <div class="col-12 col-md-6 text-left py-3">
                                <small class="d-block">Valor actual</small>
                                <h5 class="mb-0 h4">USD 2.523.089</h5>
                                <small class="color-succes">216.10 USD (2.17%)</small>
                              </div>
                   
                              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                                <div class="">
                                  <span class=" font-small">24h: <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">7D:  <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">20D: <b class="color-danger">17%<i class="fas fa-arrow-down"></i></b></span>
                                </div>
                              </div>
                            </div>
                   
                            <div class="container-chart" id="container-chart">
                              <canvas id="myChart" ></canvas>
                            </div>
                   
                            <div class="d-flex justify-content-center align-items-center py-3">
                              <button class="btn btn-light mx-2" 
                              data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapseExample">Cerrar gráfica</button>
                              <button class="btn link-gradient-blue mx-2" >Comprar BTC</button>
                            </div>
                   
                        </div>
                   
                        <div class="row-table">
                          <div class="left"> 
                           <div class="container-moneda">
                            <img src="assets/img/precios/1.png" alt=""> 
                            <span>Bitcoin <br> <small>(BTC)</small></span>
                           </div>
                          </div>
                          <div>$ 10.000</div>
                          <div>9,595.119,600,000</div>
                          <div class="color-danger-second" >-0,04%</div>
                          <div>
                            <div class="container-miniChart" >
                                <canvas id="miniChart" ></canvas>
                            </div>
                          </div>
                          <div>
                           <div class="d-flex">
                            <button class="btn btn-primary-custom-gradient active m-1">Comprar</button>
                            <button class="btn btn-primary-custom-gradient m-1"
                            data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapseExample">Detalles</button>
                           </div>
                          </div>
                        </div>
                   
                        <div  class="collapse" id="collapse4">
                            <div class="row">
                              <div class="col-12 col-md-6 text-left py-3">
                                <small class="d-block">Valor actual</small>
                                <h5 class="mb-0 h4">USD 2.523.089</h5>
                                <small class="color-succes">216.10 USD (2.17%)</small>
                              </div>
                   
                              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                                <div class="">
                                  <span class=" font-small">24h: <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">7D:  <b class="color-succes">17%<i class="fas fa-arrow-up"></i></b></span>
                                  <span class="mx-3">|</span>
                                  <span class=" font-small">20D: <b class="color-danger">17%<i class="fas fa-arrow-down"></i></b></span>
                                </div>
                              </div>
                            </div>
                   
                            <div class="container-chart" id="container-chart">
                              <canvas id="myChart" ></canvas>
                            </div>
                   
                            <div class="d-flex justify-content-center align-items-center py-3">
                              <button class="btn btn-light mx-2" 
                              data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapseExample">Cerrar gráfica</button>
                              <button class="btn link-gradient-blue mx-2" >Comprar BTC</button>
                            </div>
                   
                        </div>
                   
                   
                    </div>
               </div>
        
            </div>
        </div>

    </div> --}}

    <section id="by-country-how-to-buy">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-6">
              <img src="{{asset('assets/img/landing/flag-col.png')}}" class="img-fluid">
            </div>
      
            <div class="col-md-6 col-lg-6">
              <h2 class="mb-5">¿Como comprar {{$getCriptodefault->name}} en {{ $pais[0]->name }}?</h2>
      
              <div class="card-step">
                <span class="card-step-number"></span>
                <div class="card-step-content">
                  <h5>@lang('index.paso1')</h5>
                  <p>
                    {{-- Para realizar el pago, simplemente acude a la oficina de Western Union más cercana a ti (hay docenas en cada ciudad) y realiza el envío de dinero con los datos que se muestran debajo. --}}
                  </p>
                </div>
              </div>
      
              <div class="card-step">
                <span class="card-step-number"></span>
                <div class="card-step-content">
                  <h5>@lang('index.paso2')</h5>
                  <p>
                    {{-- Aquí tienes un ejemplo. Por favor, ten en cuenta que el formato de recibo de WU es diferente para cada país, así que no te preocupes si es diferente. Es importante que se vea toda la información (MTCN , nombres, cantidades, etc) para poder verificar el pago con mayor rapidez. --}}
                  </p>
                </div>
              </div>
      
              <div class="card-step">
                <span class="card-step-number"></span>
                <div class="card-step-content">
                  <h5>@lang('index.paso3')</h5>
                  <p>
                    {{-- Aquí tienes un ejemplo. Por favor, ten en cuenta que el formato de recibo de WU es diferente para cada país, así que no te preocupes si es diferente. Es importante que se vea toda la información (MTCN , nombres, cantidades, etc) para poder verificar el pago con mayor rapidez. --}}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <section id="by-country-popular-payment-methods">
        <div class="container">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <h2 class="text-center">
                Los metodo de pago más populares en {{$pais[0]->name}}
              </h2>
            </div>
          </div>
      
          <div class="row mt-5">
            @foreach ($data as $item)
            <div class="col-md-6 col-lg-4">
              <div class="card-payment-method">
                <img src="{{ asset($item->file) }}" class="payment-method-icon">
                <h4>{{ $item->name }}</h4>
                <p>
                  Compra tus {{ $getCriptodefault->name }} con {{ $item->name}}, rapido y sencillo, solo comunicate con nuestro chat 24
                </p>
                <a href="{{ url('buy-btc/usd/with') }}/{{$item->name}}">
                  Comprar con {{$item->name}}
                  <img src="{{ asset('assets/img/landing/icons/arrow-right-blue.svg') }}">
                </a>
              </div>
            </div>
            @endforeach
      
          </div>
        </div>
    </section>

    <section id="free-account-buy-neteller" style="background: #F5F7FB;">
        <img src="{{ asset('assets/img/landing/bg/waves2.png') }}" class="waves">
      
        <div class="container">
          <div class="row">
            <div class="col-md-5 d-flex flex-column align-items-start justify-content-center">
              <h2 class="mb-4">@lang('index.h3-text-section-five')</h2>
              <a href="{{ url('signup') }}" class="btn btn-blue-gradient shadow-sm">
                <img src="{{ asset('assets/img/landing/icons/rocket.png') }}" class="left-icon">
                @lang('index.compraAhora')
              </a>
            </div>
            <div class="col-md-6 offset-md-1">
              <img src="{{ asset('assets/img/landing/07.png') }}" class="img-fluid mt-5">
            </div>
          </div>
        </div>
    </section>


    <div class="container py-4 mt-5">
      <h2 class="font-weight-bold text-center ">Preguntas frecuentes</h2>
      <div class="row mt-4">
          <div class="col-12 col-md-6">
                <div class="accordion acordion-preguntas" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          ¿Qué tipo de tarjetas puedo usar para comprar  <br class="d-none d-lg-block"> criptomonedas ?
                          <span class="icon"><i class="fas fa-angle-down"></i></span>
                        </button>
                      </h2>
                    </div>
                
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                          Se aceptan Visa (tarjeta de débito, tarjeta de crédito, tarjeta prepaga) y Mastercard (tarjeta de débito, tarjeta de crédito, tarjeta prepaga). American Express solo se acepta cuando se elige USD como moneda de pago. También puedes usar tarjetas de regalo.Para grandes cantidades (más de 10,000 USD) se acepta transferencia bancaria previa solicitud. Si es necesario, por favor pregunte a nuestro Centro de Soporte 24 horas.
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          ¿Qué tipo de tarjetas puedo usar para comprar  <br class="d-none d-lg-block"> criptomonedas ?
                          <span class="icon"><i class="fas fa-angle-down"></i></span>
                        </button>
                      </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <div class="card-header" id="headingThree">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          ¿Qué tipo de tarjetas puedo usar para comprar  <br class="d-none d-lg-block"> criptomonedas ?
                          <span class="icon"><i class="fas fa-angle-down"></i></span>
                        </button>
                      </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                </div>
          </div>
          <div class="col-12 col-md-6">
               <div class="accordion acordion-preguntas" id="accordionExample2">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseOne">
                          ¿Qué tipo de tarjetas puedo usar para comprar  <br class="d-none d-lg-block"> criptomonedas ?
                          <span class="icon"><i class="fas fa-angle-down"></i></span>
                        </button>
                      </h2>
                    </div>
                
                    <div id="collapse4" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample2">
                      <div class="card-body">
                          Se aceptan Visa (tarjeta de débito, tarjeta de crédito, tarjeta prepaga) y Mastercard (tarjeta de débito, tarjeta de crédito, tarjeta prepaga). American Express solo se acepta cuando se elige USD como moneda de pago. También puedes usar tarjetas de regalo.Para grandes cantidades (más de 10,000 USD) se acepta transferencia bancaria previa solicitud. Si es necesario, por favor pregunte a nuestro Centro de Soporte 24 horas.
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapseTwo">
                          ¿Qué tipo de tarjetas puedo usar para comprar  <br class="d-none d-lg-block"> criptomonedas ?
                          <span class="icon"><i class="fas fa-angle-down"></i></span>
                        </button>
                      </h2>
                    </div>
                    <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample2">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <div class="card-header" id="headingThree">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapseThree">
                          ¿Qué tipo de tarjetas puedo usar para comprar  <br class="d-none d-lg-block"> criptomonedas ?
                          <span class="icon"><i class="fas fa-angle-down"></i></span>
                        </button>
                      </h2>
                    </div>
                    <div id="collapse6" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample2">
                      <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
               </div>
          </div>
      </div>

    </div>


    <div class=" py-4 corte-1-blue">

        <div class="container ">
              <div class="row">
                  <div class="col-12 col-lg-5">
                      <img src="{{ asset('assets/img/metodo-pago/Group17.png') }}" alt="">
                      <h2 class="font-weight-bold">¿Ya tienes una <br class="d-none d-lg-block">  Billetera?</h2>
                      <p class="font-weight-bold h4" >Compra Bitcoin al instante con tu tarjeta de credito</p>
            
                      <ul class="list-punto mt-4">
                          <li>
                              Tras el pago los BTC serán instantáneamente 
                              añadidos a tu cartera en DameCoins.
                          </li>
                          <li>
                              Podrás acceder a tu cartera simplemente iniciando sessión. Recibirás un email con los datos de acceso al instante.
                          </li>
                          <li>
                              Podrás vender tus BTC en cualquier momento y depositar el dinero a tu cuenta bancaria en COP(dependiendo del país, puede tardar de 1 a 5 días en llegar a tu cuenta bancaria).
                          </li>
                          <li>
                              Tus pagos nunca mostrarán ningún nombre relacionado con la criptomoneda en el extracto bancario, de tarjeta o historial de pagos. Tu privacidad es muy importante para nosotros.
                          </li>
                      </ul>
            
                  </div>
                 
                  <div class="col-12 col-lg-7 mt-4">
                      <div class="card card-compra-instantanea ">
                          <div class="card-body">

                              <div class="row">
                                  <div class="col-12 col-md-6 ">
                                      <strong>¿Qué divisa quieres comprar?</strong>

                                      <div class="container-select-list mt-2">
                                          <div class="icon"> 
                                              <span class="mr-2">BTC </span>
                                              <span><i class="fas fa-angle-down"></i></span>
                                          </div>
                                          <select class="selectpicker" data-live-search="true">
                                              <option value="h:464e" data-content="<img class='img-select' src='{{asset("assets/img/formulario/1.png")}}'></img> Bitcoin (BTC)">
                                                  Bitcoin (BTC)</option>
                                              <option value="h:464e" data-content="<img class='img-select' src='{{asset("assets/img/formulario/1.png")}}'></img> Bitcoin (BTC)">
                                                  Bitcoin (BTC)</option>
                                              <option value="h:464e" data-content="<img class='img-select' src='{{asset("assets/img/formulario/2.png")}}'></img> Bitcoin (BTC)">
                                                  Bitcoin (BTC)</option>
                                          </select>
                                      </div>


                                  </div>
                                  <div class="col-12 col-md-6 ">
                                      <strong >¿En qué divisa quieres pagar?</strong>

                                      <div class="container-select-list mt-2">
                                          <div class="icon"> 
                                              <span class="mr-2">USD </span>
                                              <span><i class="fas fa-angle-down"></i></span>
                                          </div>
                                          <select class="selectpicker" data-live-search="true">
                                              <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png') }}'></img> Dolares americanos">
                                                  Dolares americanos</option>
                                              <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png') }}'></img> Dolares americanos">
                                                  Dolares americanos</option>
                                              <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png') }}'></img> Dolares americanos">
                                                  Dolares americanos</option>
                                              </select>
                                      </div>

                                  </div>
                              </div>

                              <h6  class="font-weight-bold mt-3">Montos sugeridos</h6>

                              <div class="row">
                                  <div class="col-12 col-md-6 mt-3 mt-lg-0">

                                      <div class="input-radio-option">
                                          <input type="radio" name="radioMonto">
                                         
                                          <div class="card-radio">
                                              <div class="icon mr-auto"></div>
                                              <p>
                                                  <small>Pagas</small> <br>
                                                  <span>100 USD</span>
                                              </p>
                                              <p class="signo">=</p>
                                              <p>
                                                  <small>Recibes</small> <br>
                                                  <span>0.0095954 BTC</span>
                                              </p>
                                          </div>
                                      </div>

                                  </div>
                                  <div class="col-12 col-md-6 mt-3 mt-lg-0">
                                      
                                      <div class="input-radio-option">
                                          <input type="radio" name="radioMonto">
                                         
                                          <div class="card-radio">
                                              <div class="icon mr-auto"></div>
                                              <p>
                                                  <small>Pagas</small> <br>
                                                  <span>100 USD</span>
                                              </p>
                                              <p class="signo">=</p>
                                              <p>
                                                  <small>Recibes</small> <br>
                                                  <span>0.0095954 BTC</span>
                                              </p>
                                          </div>
                                      </div>

                                  </div>
                                  <div class="col-12 col-md-6 mt-3">
                                     
                                      <div class="input-radio-option">
                                          <input type="radio" name="radioMonto">
                                         
                                          <div class="card-radio">
                                              <div class="icon mr-auto"></div>
                                              <p>
                                                  <small>Pagas</small> <br>
                                                  <span>100 USD</span>
                                              </p>
                                              <p class="signo">=</p>
                                              <p>
                                                  <small>Recibes</small> <br>
                                                  <span>0.0095954 BTC</span>
                                              </p>
                                          </div>
                                      </div>

                                  </div>
                                  <div class="col-12 col-md-6 mt-3">
                                    
                                      <div class="input-radio-option">
                                          <input type="radio" name="radioMonto">
                                         
                                          <div class="card-radio">
                                              <div class="icon mr-auto"></div>
                                              <p>
                                                  <small>Pagas</small> <br>
                                                  <span>100 USD</span>
                                              </p>
                                              <p class="signo">=</p>
                                              <p>
                                                  <small>Recibes</small> <br>
                                                  <span>0.0095954 BTC</span>
                                              </p>
                                          </div>
                                      </div>

                                  </div>
                              </div>

                              <h6  class="font-weight-bold mt-3">Otra cantidad</h6>

                              <div class="row">
                                  <div class="col-12 col-md-6">

                                      <div class="input-group input-group-cantidad mb-3">
                                          <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                          <div class="input-group-append">
                                            <span class="input-group-text">
                                                <img class="mr-1" src="{{asset('assets/img/formulario/1.png')}}" alt="">
                                                BTC
                                            </span>
                                          </div>
                                        </div>

                                  </div>
                                  <div class="col-12 col-md-6">

                                      <div class="input-group input-group-cantidad mb-3">
                                          <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                          <div class="input-group-append">
                                            <span class="input-group-text">
                                                <img class="mr-1" src="{{asset('assets/img/formulario/1.png')}}" alt="">
                                                USD
                                            </span>
                                          </div>
                                        </div>

                                  </div>
                              </div>

                          
                              <div class="row container-datos py-3" >
                                  <div class="col-12">
                                      <p class=" mb-0">
                                          <span class="font-weight-bold h6 d-block"> Datos para tu nueva cuenta donde accederás a tus Criptodivisas </span>
                                          y podrás retirarlas a otros wallets, hacer trading, etc.
                                      </p>
                                  </div>
                                  <div class="col-12 col-md-6 mt-3" >
                                      <input type="text" class="form-control"  placeholder="Nombre" >
                                  </div>
                                  <div class="col-12 col-md-6 mt-3"   >
                                      <input type="text" class="form-control" placeholder="Apellidos" >
                                  </div>
                                  <div class="col-12 col-md-6 mt-3"   >
                                      <input type="text" class="form-control" placeholder="Emails" >
                                  </div>
                                  <div class="col-12 col-md-6 mt-3"  >
                                      <div class="select-standard">
                                          <span class="icon"><i class="fas fa-angle-down"></i></span>
                                          <select id="Select " class="form-control selectpicker">
                                            <option>País</option>
                                            <option>País</option>
                                            <option>País</option>
                                            <option>País</option>
                                          </select>
                                        </div>
                                  </div>
                              </div>
                              
                              <h6  class="font-weight-bold mt-3">Pago instantaneo con tarjeta de credito</h6>

                              <div class="row justify-content-lg-between ">
                                  <div class="col-12 col-md-5">
                                      <small>Numero de tarjeta</small>
                                      <input type="text" class="form-control" placeholder="---- ---- ---- ----" >
                                  </div>
                                  <div class="col-12 col-md-3">
                                      <small>Fecha Exp.</small>
                                      <div class="input-group input-group-fecha mb-3">
                                          <input type="text" class="form-control" placeholder="MM / YYYY" >
                                          <div class="input-group-append">
                                            <span class="input-group-text"> <img class="img-fluid" src="{{asset('assets/img/formulario/calendar.png')}}" alt=""></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-3">
                                      <small>CVV</small>
                                      <input type="text" class="form-control" placeholder="- - -" >
                                  </div>
                                  <div class="col py-0">
                                      <div class="form-group form-check">
                                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                          <label class="form-check-label" for="exampleCheck1"><small>Estoy de acuerdo con los Términos de Servicio</small></label>
                                        </div>
                                  </div>
                                 
                              </div>

                             <button class="btn btn-success btn-success-custom  btn-block  py-3">Compra instantanea con tarjeta</button>

                             <div class="img-form mt-3">
                                 <img class="img-fluid" src="{{asset('assets/img/formulario/Rectangle117.png')}}" alt="">
                                 <img class="img-fluid" src="{{asset('assets/img/formulario/Rectangle118.png')}}" alt="">
                                 <img class="img-fluid" src="{{asset('assets/img/formulario/Rectangle119.png')}}" alt="">
                                 <img class="img-fluid" src="{{asset('assets/img/formulario/Rectangle120.png')}}" alt="">
                                 <img class="img-fluid" src="{{asset('assets/img/formulario/Rectangle121.png')}}" alt="">
                                 <img class="img-fluid" src="{{asset('assets/img/formulario/Rectangle122.png')}}" alt="">
                             </div>

                             <div class="d-flex justify-content-center align-items-center mt-3 container-or">
                                 <span>Or</span>
                             </div>


                             <div class="row">
                                  <div class="col-12 col-md-6">
                                      <button class="btn btn-primary btn-primary-custom btn-block">
                                          <img class="mr-2" src="{{asset('assets/img/formulario/paypal1.png')}}" alt="">
                                          Pay with Paypal
                                      </button>
                                  </div>
                                  <div class="col-12 col-md-6 mt-3 mt-md-0">
                                      <button class="btn btn-primary btn-primary-custom btn-block">
                                          <img class="mr-2" src="{{asset('assets/img/formulario/Capa11.png')}}" alt="">
                                          Pay with Western Union
                                      </button>
                                  </div>
                                  <div class="col-12 d-flex justify-content-center align-items-center mt-3">
                                      <a href="#" class=" link " >Ver más metodos de pago</a>
                                  </div>
                             </div>
                          

                          </div>
                      </div>
                  </div>
                
              </div>
        </div>

    </div>

    <div class="container-fluid section-slider-comprar pl-5">
        <div class="row">    
            <div class="col-12 col-lg-4 pl-lg-5">
                <h2 class="text-white font-weight-bold">Tambien te puede <br class="d-none d-lg-block"> interesar</h2>
            </div>

            <div class="col-12 col-lg-8 mt-4 mt-lg-0">
                <div class="slider-compra">

                    <div id="slider-compra-prev" class="slider-compra-prev"> 
                        <span><i class="fas fa-arrow-left"></i></span> 
                    </div>

                    <div class="owl-carousel owl-theme" id="owl-carousel-compra">
                        <div class="item" >
                            <h5>Compra Bitcoin al instante sin ID</h5>
                            <a href="#" class="">Saber más <span><i class="fas fa-chevron-right"></i></span> </a>
                        </div>
                        <div class="item" >
                            <h5>Compra Bitcoin al instante sin ID</h5>
                            <a href="#" class="">Saber más <span><i class="fas fa-chevron-right"></i></span> </a>
                        </div>
                        <div class="item" >
                            <h5>Compra Bitcoin al instante sin ID</h5>
                            <a href="#" class="">Saber más <span><i class="fas fa-chevron-right"></i></span> </a>
                        </div>
                    </div>

                    <div id="slider-compra-dots" class="mt-3 slider-compra-dots">
                        <div class="owl-dot active"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('#TextCountry').text('{{ $pais[0]->name }}');
        var actualityCrypto = $('#buyContainer #getCryptos').val();
        
        function cryptoIconHome(name){
            return `https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/${name.toLocaleLowerCase()}.png`;
        }
    </script>
@endsection