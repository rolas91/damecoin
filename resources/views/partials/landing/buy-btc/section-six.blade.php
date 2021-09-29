<div class="modal fade" id="westernUnionPaymentModal" tabindex="-1" role="dialog" aria-labelledby="westernUnionPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="westernUnionPaymentLabel">WESTERN UNION</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px 30px;">
                <div class="text-center mb-2">
                    <img loading="lazy" src="https://lh3.googleusercontent.com/r1qrqwYTNX0x1fN_0Xty0JWzkKBgad0RylI6rmGsRg144dvrRoKuZFqMJssOHhaPtA" class="img-fluid" style="width:200px;height:200px" alt="">
                </div>
                <h4 class="text-center" style="font-weight: normal;">
                    {{ __('home_buy.western_union') }}
                </h4>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!--le quité corte1-blue-->
<div class="section-six py-4" id="six-section">

  <div class="container ">
        <div class="row">
            <div class="col-12 col-lg-5">
                <img src="{{ asset('assets/img/metodo-pago/Group17.png')}}" alt="">
                <h2 class="font-weight-bold">@lang('index.wallet')</h2>
                <p class="font-weight-bold h4" >@lang('index.credit')</p>
      
                <ul class="list-punto mt-4">
                    @lang('index.li')
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
                                        'id' => 'getCryptoss',
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
                                        'id' => 'getCurrenciess',
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
                                          {{$getCriptodefault->name}}
                                      </span>
                                    </div>
                                  </div>

                            </div>
                            <div class="col-12 col-md-6">

                                <div class="input-group input-group-cantidad mb-3">
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)" id="persoCurrency" onkeyup="document.getElementById('customBuy').value=this.value; newChecked(this);">
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                          {{$getCurrencyUser->name}}
                                      </span>
                                    </div>
                                  </div>

                            </div>
                        </div>

                    
                        <!-- @include('partials.formPayU') -->
                   
                         <div class="row justify-content-lg-between mt-3">
                            <div class="d-flex justify-content-center align-items-center flex-wrap mt-3" style="width: 100%;">
                                <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.comiciones')</p>
                                <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.inmediato')</p>
                                <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.proceso')</p>
                            </div>
                            
                            <center style="width: 100%;">
                                <a href="{{ url(__('route.Payments', ['crypto' => $getCriptodefault->code, 'divisa' => $getCurrencyUser->code,'method' => $metodo  ])) }}" class=" link " >@lang('index.verMetodos')</a>
                            </center>
                        </div>
                        

                       <div class="d-flex justify-content-center align-items-center mt-3 container-or">
                           <span>@lang('index.or')</span>
                       </div>


                       <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="btn btn-primary btn-primary-custom btn-block" data-toggle="modal" data-target="#ModalPaypal">
                                    <img class="mr-2" src="{{ asset('assets/img/formulario/paypal1.png')}}" alt="">
                                    @lang('index.paypal')
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                <button class="btn btn-primary btn-primary-custom btn-block" data-toggle="modal" data-target="#westernUnionPaymentModal">
                                    <img class="mr-2" src="{{ asset('assets/img/formulario/Capa11.png')}}" alt="">
                                    @lang('index.westerUnion')
                                </button>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center mt-3">
                                <a href="{{ url(__('route.Payments', ['crypto' => $getCriptodefault->code, 'divisa' => $getCurrencyUser->code,'method' => $metodo  ])) }}" class=" link " >@lang('index.method_patment')</a>
                            </div>
                       </div>
                    

                    </div>
                </div>
            </div>
          
        </div>
  </div>

</div>