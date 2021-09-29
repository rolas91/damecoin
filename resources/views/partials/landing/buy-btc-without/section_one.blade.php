<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div class="container " style="margin-top: 6%">
    <div class="row">
        <div class="col-12 col-lg-5">
            <img src="/img/emptylogo.png" id="imageBtcTop" width="50" height="50">
            <h2 class="text-white font-weight-bold">
               @lang('index.sinId')
               {{ $getCriptodefault->code }}
               @lang('index.sinId2')
            </h2>
            <span class="text-resaltado">@lang('index.sinVerificacion')</span>
            <p class="text-white mt-2">
                @lang('index.dameCoins')
            </p>
            
            <ul class="list-punto-light mt-4">
               @lang('index.li2')
            </ul>

        </div>
        <div class="col-12 col-lg-7 mt-4">
            <div class="card card-compra-instantanea ">
                <div class="card-body">

                    <div class="row mr-0">
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
                    <div class="row p-25 pb-3" style="padding: 13px!important">
                        @include('partials.bootonModal')
                        <p class="text-justify p-3"> <small>*PayPal has its own commission from 2.4% to 3.4%, on top of which we add our commission.  Its high commissions are the reason why most cryptocurrency sites don't support it as a payment method.  We support it but do not recommend it.  To avoid high commissions we recommend that you create a free account and make your payment by bank transfer.  We have accounts in more than 5 countries (Amercia, Asia, Europe, Australia) for your convenience and thus avoid unnecessary commissions</small></p>
                    </div>
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