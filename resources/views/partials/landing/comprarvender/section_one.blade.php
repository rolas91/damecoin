<div class="banner-principal-two">
      <div class="container" style="margin-top: 6%">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <img src="/img/emptylogo.png" id="imageBtcTop" width="50" height="50">
                    <h2 class="text-white font-weight-bold">
                        @lang('index.compravender-text')
                        {{$getCriptodefault->code}}
                        @lang('index.compravender-text2')

                    </h2>
                    <p class="text-white">
                        @lang('index.comprar-p')
                    </p>
                    
                    <ul class="list-punto-light mt-4">
                       @lang('index.comprar-li')
                    </ul>

                </div>
                <div class="col-12 col-lg-7 mt-4">
                    <div class="card card-compra-instantanea ">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-6 ">
                                    <strong class="font-weight-bold">@lang('index.buydivisa')</strong>
    
                                    <div class="container-select-list mt-2">
                                        <div class="icon"> 
                                            <span class="mr-2">{{$getCriptodefault->code}} </span>
                                            <span><i class="fas fa-angle-down"></i></span>
                                        </div>
                                        {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                                            'id' => 'getCryptos',
                                            'class' => 'selectpicker'
                                            ])
                                        !!}
                                    </div>
                                </div>
    
                                <div class="col-12 col-md-6 ">
                                    <strong class="font-weight-bold">@lang('index.paydivisa')</strong>
    
                                    <div class="container-select-list mt-2">
                                        <div class="icon"> 
                                            <span class="mr-2" id="pay" >{{$getCurrencyUser->code}} </span>
                                            <span><i class="fas fa-angle-down"></i></span>
                                        </div>
                                        {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                                            'id' => 'getCurrencies',
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
                                                <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}"  class="radioBtnClass"  name="amount" checked>
                                            @else
                                                <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}"  class="radioBtnClass"  name="amount">
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
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="persoCrypto" aria-describedby="buyHelp" value="{{$default['recibe']}}" onKeyPress="return soloNumeros(event)">
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                          {{-- <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt=""> --}}
                                          {{-- {{$getCriptodefault->name}} --}}
                                      </span>
                                    </div>
                                  </div>

                            </div>
                            <div class="col-12 col-md-6">

                                <div class="input-group input-group-cantidad mb-3">
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)" id="persoCurrency" onkeyup="document.getElementById('customBuy').value=this.value; newChecked(this);">
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                          {{-- <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt=""> --}}
                                          {{-- {{$getCurrencyUser->name}} --}}
                                      </span>
                                    </div>
                                  </div>

                            </div>
                        </div>
                        
                            <div class="row container-datos py-3" >
                                <div class="col-12">
                                    <p class=" mb-0">
                                        <span class="font-weight-bold h6 d-block"> @lang('index.span2') </span>
                                    @lang('index.text_span2')
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
                                        {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                                        'form-control', 'placeholder' => __('index.form_country') ,
                                        'required'=>'required' ])!!}
                                      </div>
                                </div>
                            </div>
                            
                            <h6  class="font-weight-bold mt-3">@lang('index.paymentInstant')</h6>

                            <div class="row justify-content-lg-between ">
                                <div class="col-12 col-md-5">
                                    <small>@lang('index.number_tarjet')</small>
                                    <input type="text" class="form-control" placeholder="---- ---- ---- ----" >
                                </div>
                                <div class="col-12 col-md-3">
                                    <small>@lang('index.date_expired')</small>
                                    <div class="input-group input-group-fecha mb-3">
                                        <input type="text" class="form-control" placeholder="MM / YYYY" >
                                        <div class="input-group-append">
                                          <span class="input-group-text"> <img class="img-fluid" src="{{ asset('assets/img/formulario/calendar.png')}}" alt=""></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <small>@lang('index.cvv')</small>
                                    <input type="text" class="form-control" placeholder="- - -" >
                                </div>
                                <div class="col py-0">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1"><small>@lang('index.span')</small></label>
                                      </div>
                                </div>
                               
                            </div>

                            <button class="btn btn-success btn-success-custom  btn-block  py-3" data-toggle="modal" data-target="#exampleModal">@lang('index.buttonBtcInstant')</button>

                            <div class="img-form mt-3">
                                <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle117.png')}}" alt="">
                                <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle118.png')}}" alt="">
                                <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle119.png')}}" alt="">
                                <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle120.png')}}" alt="">
                                <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle121.png')}}" alt="">
                                <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle122.png')}}" alt="">
                            </div>
     
                            <div class="d-flex justify-content-center align-items-center mt-3 container-or">
                                <span>@lang('index.or')</span>
                            </div>
     
     
                            <div class="row">
                                 <div class="col-12 col-md-6">
                                    <a data-toggle="modal" data-target="#ModalPaypal" class="btn btn-primary btn-primary-custom btn-block">
                                        <img class="mr-2" src="{{ asset('assets/img/formulario/paypal1.png')}}" alt="">
                                        @lang('index.paypal')
                                    </a>
                                     {{-- <button class="btn btn-primary btn-primary-custom btn-block" onclick="paypal()">
                                         <img class="mr-2" src="{{ asset('assets/img/formulario/paypal1.png')}}" alt="">
                                         @lang('index.paypal')
                                     </button> --}}
                                 </div>
                                 <div class="col-12 col-md-6 mt-3 mt-md-0">
                                     <button class="btn btn-primary btn-primary-custom btn-block" data-toggle="modal" data-target="#westernUnionPaymentModal">
                                         <img class="mr-2" src="{{ asset('assets/img/formulario/Capa11.png')}}" alt="">
                                         @lang('index.westerUnion')
                                     </button>
                                 </div>
                                 <div class="col-12 d-flex justify-content-center align-items-center mt-3">
                                     <a href="#" class=" link " >@lang('index.method_patment')</a>
                                 </div>
                            </div>
                        

                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>