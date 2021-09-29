@extends('layouts_dash.dash')

@section('content')

    <div class="principal-section pb-3 " id="principal-section">
        <div class="comprar-section">

            <div class="container mt-5  d-lg-none ">
                <div class="row">
                    <div class="col-12  d-flex justify-content-between ">
                        <strong class="h5 mr-3 my-0 py-0">{{-- agregar traduccion --}}</strong>
                        <div class="select-container">
                            <span>
                                <i class="fas fa-angle-down"></i>
                            </span>
                            @include("dashboard.partials.divisa") 
                        </div>
                    </div>
                </div>
            </div>


            <div class="container first-section mt-4 mt-lg-0">

                <div class="d-flex justify-content-center align-items-center flex-column mt-4 d-lg-none">
                    @include("layouts_dash.balance")
                </div>

                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="card card-blue-movil arrow">
                            <div class="card-header d-flex justify-content-center align-items-center flex-wrap ">
                                <span class="mr-3">
                                    @lang('dash_general.buy') :
                                </span>
                                <div class="container-select-list-two">
                                    <span>
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                    <select id="select-buy" onchange='cryptoChange(this);'>
                                        <!--
                                                    <option value="a" data-left="assets/img/vender/coin.png">Bitcoin (BTC)</option>
                                                    <option value="a" data-left="assets/img/vender/dolar.png">Dolares</option>
                                                -->
                                        @foreach ($getCryptos as $c)
                                            <option value="{{ $c->id }}"> {{ $c->name }}</option>

                                        @endforeach

                                    </select>

                                </div>
                            </div>

                            <script>
                                function cryptoChange(tr) {
                                    window.location.href = '/dash/crypto/' + tr.value;
                                }

                            </script>
                            <div class="card-body px-0 px-lg-3">

                                <h6 class=" card-title ">@lang('dash_buy.prices_sugerido')</h6>

                                <!-- Modo Desktop  -->
                                <div class="d-lg-block">
                                    <div class="row ">

                                        @foreach ($getPanel as $panel)

                                            <div class="col-6 mt-1">
                                                <div class="card-input-radio mt-3">
                                                    <input type="radio" class="person" name="radiocustom"
                                                        id="{{ $panel['id'] }}" value="{{ $panel['pagar'] }}">
                                                    <span class="checkmark"></span>
                                                    <div class="card-info-input">
                                                        <div>
                                                            <small>@lang('home.you_pay')</small><br>
                                                            <strong>{{ $panel['pagar'] }}
                                                                {{ $getCurrencyUser->code }}</strong>
                                                        </div>
                                                        <div>
                                                            <small>@lang('home.sell_receive')</small><br>
                                                            <strong>
                                                                {{ $panel['recibir'] }}
                                                                {{ $getCriptodefault->code }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                                <!-- Modo Móvil  -->
                                {{--
                                <div class="owl-carousel owl-theme owl-carousel-comprar  d-lg-none">

                                    @foreach ($getPanel as $panel)

                                        <div class="item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>
                                                    <small>@lang('home.you_pay')</small><br>
                                                    <strong>{{ $panel['pagar'] }} {{ $getCurrencyUser->code }}</strong>
                                                </span>
                                                <span>
                                                    <i class="fas fa-arrow-right"></i>
                                                </span>
                                                <span>
                                                    <small>@lang('home.sell_receive')</small><br>
                                                    <strong>{{ $panel['recibir'] }}
                                                        {{ $getCriptodefault->code }}</strong>
                                                </span>
                                            </div>

                                            <button class="btn mt-2">@lang("home.seleccionar")</button>

                                        </div>

                                    @endforeach
                                    <!--
                                            <div class="card-input-radio-dark mt-3">
                                                <input type="radio" class="person" name="radiocustom" id="{{ $panel['id'] }}"
                                                    value="{{ $panel['pagar'] }}">
                                                <span class="checkmark"></span>
                                                <div class="card-info-input">
                                                    <div>
                                                        <small>@lang('home.you_pay')</small><br>
                                                        <strong>{{ $panel['pagar'] }} {{ $getCurrencyUser->code }}</strong>
                                                    </div>
                                                    <div>
                                                        <small>@lang('home.sell_receive')</small><br>
                                                        <strong> {{ $panel['recibir'] }}
                                                            {{ $getCriptodefault->code }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                          -->


                                </div>
                                --}}


                                <h6 class="card-title mt-3">@lang('dash_buy.other_amount')</h6>
                                <div class="px-3 px-lg-0">
                                    <div class="row card-simulador ">
                                        <div class="col-12 col-md-6">
                                            <small>@lang('dash_buy.buy')</small>
                                            <div class="input-group input-group-monto mb-3">
                                                <input type="text" id="persoCrypto" class="form-control"
                                                    onKeyPress="return soloNumeros(event)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">
                                                        <img src="{{ asset('uploads/img/' . $getCriptodefault->img) }}"
                                                            alt="">

                                                        <div class="d-flex flex-column align-items-start">
                                                            <strong class="m-0">{{ $getCriptodefault->code }}</strong>
                                                        </div>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <small>@lang('dash_buy.pay')</small>
                                            <div class="input-group input-group-monto mb-3">
                                                <input type="text" id="persoCurrency" class="form-control"
                                                    onKeyPress="return soloNumeros(event)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">
                                                        <img src="/dashboard/assets/img/comprar/2.png" alt="">

                                                        <div class="d-flex flex-column align-items-start">
                                                            <strong class="m-0">{{ $defaultCurrency->code }}</strong>

                                                        </div>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card card-blue">
                            <div class="card-header text-center ">
                                @lang('dash_buy.pay_credit_card')
                            </div>
                            <div class="card-body text-center">
                                
                                <h6 class="card-title text-left"></h6>
                                <br>

                                <!-- Modo desktop  -->
                                {{--
                                <div class="d-none d-lg-block">
                                    <div class="input-group input-group-custom ">
                                        <input type="text" class="form-control" placeholder="Numero de tarjeta">
                                        <input type="text" class="form-control" placeholder="MM / YY">
                                        <input type="text" class="form-control" placeholder="CVV">
                                        <img src="assets/img/portafolio/icon-input-group.svg" alt="">
                                    </div>
                                </div>
                                --}}

                                <!-- Modo móvil -->
                                {{--
                                <div class="d-lg-none">
                                    <div class="row text-left">
                                        <div class="col-12">
                                            <small>Compras</small>
                                            <div class="form-group input-tarjeta-icon">
                                                <img src="assets/img/portafolio/icon-input-group.svg" alt="">
                                                <input type="text" class="form-control" placeholder="Numero de tarjeta">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group input-tarjeta">
                                                <small>Fecha exp</small>
                                                <input type="text" class="form-control" placeholder="MM / YY">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group input-tarjeta">
                                                <small>CVV</small>
                                                <input type="text" class="form-control" placeholder="CVV">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                --}}

                                {{--
                                <button class="btn btn-tarjeta mt-3 py-2 " data-toggle="modal"
                                    data-target="#modal-tarjetas">Seleccionar una tarjeta guardada</button>

                                <div class="form-group form-check form-check-custom mt-3 text-left">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <small class="form-check-label" for="exampleCheck1">Government & Bank statement 100%
                                        Anonymous</small>
                                </div>
                                --}}
                                <br><br>
                                <button href="#" onclick="buy()"
                                    class="btn btn-info btn-info-gradient py-3  btn-block mt-3">
                                @lang('dash_buy.buy_credit_card')</button>

                                <div class="container-img-deposito mt-3">
                                    <img src="assets/img/deposito/masterCard.png" alt="">
                                    <img src="assets/img/deposito/visa.png" alt="">
                                    <img src="assets/img/deposito/masterCard.png" alt="">
                                    <img src="assets/img/deposito/norton.png" alt="">
                                    <img src="assets/img/deposito/ssl.png" alt="">
                                    <img src="assets/img/deposito/truste.png" alt="">
                                </div>
                                <hr class="mt-2 mb-2">

                                <small>
                                    <img class="img-fluid mr-2" src="assets/img/vender/information.png" alt="">
                                   @lang('dash_buy.acepted')</small>

                                <img class="mt-2 img-fluid" src="assets/img/deposito/group.png" alt="">

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container mt-4">
                <div class="card card-information">
                    <div class="card-body d-flex pl-2 pr-1 pl-lg-3 prlg-3">
                        <span class="mr-3"><img src="assets/img/vender/information.png" alt=""></span>

                        <div class="ventas-info">
                            -  @lang('dash_buy.info1',["cripto"=>$getCriptodefault->code ])
                           
                            <br>
                            -  @lang('dash_buy.info2')
                            
                            <br>
                            -  @lang('dash_buy.info3',["cripto"=>$getCriptodefault->code ,"currency"=>$defaultCurrency->code])
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="container mt-4 d-none d-lg-block">
                <h2 class="title">@lang('dash_buy.other_payment')</h2>

                <div class="accordion accordion-custom" id="accordionExample">
                    <!--fiat-->
                    @if($getTotalDivisa>0)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseWallet" aria-expanded="true" aria-controls="collapseWallet">
                                    @lang('dash_buy.walletpaymet') {{ $defaultCurrency->code }}
                                    <span></span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseWallet" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="col-12 col-lg-6">
                                    <div class="card card-blue">
                                        <div class="card-header text-center ">
                                           @lang('dash_buy.payfiat') {{ $defaultCurrency->code }}
                                        </div>
                                        <div class="card-body text-center">
                                            @lang('dash_buy.saldodisponible') {{ $getTotalDivisa }} {{ $defaultCurrency->code }}
            
                                            <button  onclick="paymentWallet()"
                                                class="btn btn-info btn-info-gradient py-3  btn-block mt-3">@lang('dash_buy.payfiat') {{ $defaultCurrency->code }}</button>
        
                                            
                                        </div>
                                    </div>
                                </div>

                             

                              
                            </div>
                        </div>
                    </div>
                    @endif
                    <!--endfiat-->
                    <div class="card mt-4">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    @lang('dash_buy.payment_transfe')
                                    <span></span>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="card-text">
                                  <!--  Deposito por transferencia (2-5 dias)-->
                                  
                                  @lang('home_deposit.mesaggetransfe2')
                                    <br><!--
                                    Transfiera su dinero a la siguiente cuenta bancaria. Una vez que recibamos el dinero, lo
                                    agregaremos a su saldo en menos de 24 horas. Puede cargar el comprobante de
                                    transferencia
                                    para acelerar el proceso. IMPORTANTE: para que podamos vincular la transferencia
                                    bancaria
                                    con usted, en los detalles de la transferencia, escriba los primeros 8 caracteres del
                                    correo
                                    electrónico utilizado en su cuenta DameCoins (ejemplo: si su cuenta DameCoins es
                                    anna.tonks32@gmail.com, escriba "annatonk" como detalles de transferencia.) Sin estos
                                    detalles de transferencia, sus fondos no pueden acreditarse en su billetera.
                                    -->
                                </p>

                                <!-- cuentas bancarias y deposito-->
                                @include("dashboard.partials.buy.bank-desktop")


                                <h5 class="card-title mt-3">
                                    <span class="mr-1"><img src="assets/img/deposito/anonymous.png" alt=""></span>
                                    @lang('dash_buy.anonimous')
                                </h5>

                                <p class="card-text">
                                    - Our bank accounts are not directly linked to any crypto chain so you can make your
                                    transfer without worring about local bank / Government restrictions agains Crypto.
                                    <br>

                                    - If you need other deposit methods (i.e. Alipay, WeChat Pay, Singapour Bank Account,
                                    etc.
                                    please contact our 24/7 Support Chat.
                                    <br>

                                    - If you need "Government & Bank Statement 100% Anonymous for bank transfer, please
                                    check it
                                    upon the bank details.
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                   @lang("dash_general.alternate_payment")
                                    <span></span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <!--pagos alternos-->
                                @include("dashboard.partials.buy.pagos-alternos")

                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="container  d-lg-none mt-4">
                <h2 class="title">@lang('dash_buy.other_payment')</h2>

                <div class="d-flex justify-content-between">
                    <div class="metodos-pago text-center">
                        <div class="d-flex justify-content-between">
                            <span class="metodo-icon"><img src="assets/img/comprar/icon1.png" alt=""></span>
                            <span class=" m-0 color-succes">@lang('dash_general.noinmediato')</span>
                        </div>
                        <p class="mt-3 text-left ">@lang('dash_general.transf_deposit')</p>
                        <a href="#" data-toggle="modal" data-target="#modal-deposito" class="btn mx-auto">@lang('dash_general.ver_account')</a>
                    </div>
                    <div class="metodos-pago text-center">
                        <div class="d-flex justify-content-between">
                            <span class="metodo-icon"><img src="assets/img/comprar/icon2.png" alt=""></span>
                        </div>
                        <p class="mt-3 text-left">@lang('dash_general.payment_alternate')
                        </p>
                        <a href="#" data-toggle="modal" data-target="#modal-alternativas" class="btn mx-auto">@lang('dash_general.account_alternate')</a>
                    </div>
                </div>

            </div>

            <!-- Modal modal tarjetas -->
            <div class="modal fade modal-custom-comprar" id="modal-tarjetas" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Selecciona tu tarjeta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="select-tarjeta">

                                <div class="card-tarjeta">
                                    <input type="radio" name="radio">
                                    <span class="checkmark">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="card-div card-mastercard">
                                        <div class="card-info">
                                            <img class="placa" src="assets/img/perfil/placa.png" alt="">
                                            <p class="mt-1 mt-lg-2 mb-1">
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <strong>2345</strong>
                                            </p>
                                            <small class="m-0">EXP: 12/28</small>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="my-0">Nombre completo</p>
                                                <img class="img-fluid" src="assets/img/comprar/mastercard.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-tarjeta">
                                    <input type="radio" name="radio">
                                    <span class="checkmark">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="card-div  card-visa">
                                        <div class="card-info">
                                            <img class="placa" src="assets/img/perfil/placa.png" alt="">
                                            <p class="mt-2 mb-1">
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <strong>2345</strong>
                                            </p>
                                            <small>EXP: 12/28</small>
                                            <div class="d-flex justify-content-between align-items-center py-2">
                                                <p class="my-0">Nombre completo</p>
                                                <img class="img-fluid" src="assets/img/comprar/visa.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <a href="#" class="btn-add-tarjeta  mx-auto mt-3">
                                <span><img src="assets/img/deposito/Mask.png" alt=""></span>
                                Agregar nueva tarjeta
                            </a>


                        </div>
                        <div class="modal-footer" ">
                                             <button type=" button" class="btn text-white btn-info-gradient  mx-auto">
                            Selecionar
                            tarjeta</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Depósito -->
            @include("dashboard.partials.buy.bank-mobile")


            <!-- Modal modal medios alternativos -->
            <div class="modal fade modal-custom-comprar" id="modal-alternativas" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@lang("dash_general.other_payment")</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @include("dashboard.partials.buy.pagos-alternos")

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <hr>

    <div class="principal-section pb-3 " id="principal-section" style="display:none">
        <div class="comprar-section">
            <div class="container first-section two-column mt-4 mt-lg-0 ">
                <span class="icon-line d-none d-lg-block"></span>
                <img class="icon-number d-none d-lg-block " src="/dashboard/assets/img/comprar/Group226.png" alt="">
                <div>
                    <h2 class="title">@lang('home.buy_new_title')</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-4">

                                    <h6>@lang('home.buy_new_select_curency')</h6>
                                    <small>@lang('home.buy_new_select_what_currency')</small>
                                    <!-- select   -->
                                    <div class="container-select-bootstrap mt-2 mb-2">
                                        <div class="icon">
                                            <span><i class="fas fa-angle-down"></i></span>
                                        </div>


                                        <select class="selectpicker" data-live-search="true" id="getCryptoBuy">
                                            @foreach ($getCryptos as $c)
                                                <option value="{{ $c->id }}"
                                                    data-content="<img class='img-select' src='{{ asset('uploads/img/' . $c->img) }}'> {{ $c->name }}">

                                            @endforeach
                                        </select>

                                    </div>

                                    <small>@lang('home.buy_new_currency_pay')</small>
                                    <!-- select -->
                                    <div class="container-select-bootstrap mt-2">

                                        <div class="icon">
                                            <span><i class="fas fa-angle-down"></i></span>
                                        </div>

                                        {!! Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->id, ['id' => 'getCurrencyBuy', 'class' => 'selectpicker', 'data-live-search' => true, 'data-default' => $getCurrencyUser->code, 'data-symbol' => $getCurrencyUser->symbol]) !!}

                                    </div>


                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6>@lang('home.buy_new_suggested_amounts')</h6>
                                    @foreach ($getPanel as $panel)
                                        <div class="card-input-radio-dark mt-3">
                                            <input type="radio" class="person" name="radiocustom" id="{{ $panel['id'] }}"
                                                value="{{ $panel['pagar'] }}">
                                            <span class="checkmark"></span>
                                            <div class="card-info-input">
                                                <div>
                                                    <small>@lang('home.you_pay')</small><br>
                                                    <strong>{{ $panel['pagar'] }}
                                                        {{ $getCurrencyUser->code }}</strong>
                                                </div>
                                                <div>
                                                    <small>@lang('home.sell_receive')</small><br>
                                                    <strong> {{ $panel['recibir'] }}
                                                        {{ $getCriptodefault->code }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-12 col-lg-4">
                                    <h6>@lang('home.buy_new_other_amount')</h6>
                                    <small>@lang('home.buy_new_what_currency_buy')</small>
                                    <div class="input-group input-group-monto mb-3">
                                        <input type="text" class="form-control" id="persoCrypto"
                                            value="{{ $person['recibe'] }}" onKeyPress="return soloNumeros(event)"
                                            onkeyup="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <img src="{{ asset('uploads/img/' . $getCriptodefault->img) }}" alt="">

                                                <div class="d-flex flex-column align-items-start">
                                                    <strong class="m-0">{{ $getCriptodefault->code }}</strong>
                                                    {{-- <small class="m-0">{{ $getCriptodefault->name }}</small> --}}
                                                </div>

                                            </span>
                                        </div>
                                    </div>

                                    <small>@lang('home.buy_new_what_currency_pay')</small>
                                    <div class="input-group input-group-monto mb-3">
                                        <input type="text" class="form-control" id="persoCurrency"
                                            value="{{ $person['pay'] }}" onKeyPress="return soloNumeros(event)"
                                            onkeyup="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <img src="/dashboard/assets/img/comprar/2.png" alt="">

                                                <div class="d-flex flex-column align-items-start">
                                                    <strong class="m-0">{{ $getCurrencyUser->code }}</strong>
                                                    {{-- <small class="m-0">{{ $getCurrencyUser->symbol }}</small> --}}
                                                </div>

                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card card-information mt-4">
                        <div class="card-body d-flex pl-2 pr-1 pl-lg-3 prlg-3">
                            <span class="mr-3"><img src="/dashboard/assets/img/vender/information.png" alt=""></span>

                            <div class="ventas-info">

                                - @lang('home.buy_new_step_1'). <br>

                                - @lang('home.buy_new_step_2').
                                <br>
                                - @lang('home.buy_new_step_3').
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="container  two-column mt-4 ">
                <img class="icon-number d-none d-lg-block" src="/dashboard/assets/img/comprar/Group243.png" alt="">

                <div>
                    <h2 class="title">@lang('home.buy_select_payment'):</h2>

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <!--form buy-->
                            <form action="/dash/buy" method="POST" id="sendBuy" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="idCripto" value="{{ $getCriptodefault->id }}">
                                <input type="hidden" name="idCurrency" value="{{ $getCurrencyUser->id }}">
                                <!-- select -->
                                <div class="container-select-bootstrap mt-2 mb-2">
                                    <div class="icon">
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>

                                    <select class="selectpicker" id="selectPayment" name="selectPayment"
                                        data-live-search="true">
                                        <option value="wallet"
                                            data-content="<img class='img-select' src=''> Wallet {{ $getCurrencyUser->code }}">
                                            @foreach ($paymentMethods as $p)
                                        <option value="{{ $p->id }}"
                                            data-content="<img class='img-select' src='{{ asset($p->file) }}'> {{ $p->name }}">
                                            @endforeach
                                    </select>
                                </div>

                                <div class="card mt-4">
                                    @if ($wallet)
                                        <div class="card-body">



                                            <hr>

                                            <div class="card-dark-comprar p-2">
                                                <p class="font-Xsmall m-0"> @lang('home.buy_description')</p>
                                            </div>

                                            <div class="form-group form-check mt-1">
                                                <input type="checkbox" class="form-check-input" id="terminos">
                                                <label class="form-check-label font-info-small" for="exampleCheck1">
                                                    @lang('home.buy_accept')
                                                </label>
                                            </div>


                                            <button type="button" class="btn btn-block btn-success  py-3"
                                                onclick="paymentWallet()">
                                                @lang('home.buy_send_payment_go')
                                            </button>



                                            <p class="text-center font-Xsmall mt-3">
                                                @lang('home.buy_time_alert')
                                            </p>

                                        </div>
                                    @else
                                        <div class="card-body">
                                            <small class="color-succes"> <img class="mr-2"
                                                    src="/dashboard/assets/img/vender/information.png" alt="">
                                                @lang('home.buy_pay_minium') 400 USD</small>
                                            <p class="font-small">
                                                Go to a Western Union Shop ( you can find one close to you in <a
                                                    class="color-succes" href="#"> this Link</a> ) and send your payment to:
                                            </p>

                                            <div class="card-name">
                                                <div class="d-flex align-items-center ">
                                                    <span class="font-small">@lang('home.buy_name'):</span>
                                                    <img src="/dashboard/assets/img/comprar/Sami.png" alt="">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2"><i class="fa fa-arrow-right"></i></span>
                                                    <p class="font-Xsmall color-succes m-0">
                                                        @lang('home.buy_please_alert')
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="card-upload mt-4">
                                                <div class="">
                                                    <h6 class=" m-0"> @lang('home.buy_please_upload')</h6>
                                                    <a class="color-succes font-small"
                                                        href="#">@lang('home.buy_view_example')</a>
                                                </div>
                                                <!--file-->
                                                <div class="input-file-custom btn">
                                                    <span>@lang('home.buy_upload_file')</span>
                                                    <input type="file" name="receipt" id="receipt" required>
                                                </div>
                                                <!--End file-->
                                            </div>

                                            <hr>

                                            <div class="card-dark-comprar p-2">
                                                <p class="font-Xsmall m-0"> @lang('home.buy_description')</p>
                                            </div>

                                            <div class="form-group form-check mt-1">
                                                <input type="checkbox" class="form-check-input" id="terminos">
                                                <label class="form-check-label font-info-small" for="exampleCheck1">
                                                    @lang('home.buy_accept')
                                                </label>
                                            </div>


                                            <button type="submit" class="btn btn-block btn-success  py-3  ">
                                                @lang('home.buy_send_payment_go')
                                            </button>

                                            <div class="d-flex justify-content-center align-items-center mt-3"
                                                style="display.:none">
                                                <span class="time">
                                                    15:00:00
                                                    <small>@lang('home.buy_time_clock')</small>
                                                </span>

                                                <div class="progress progress-gradient ml-2">
                                                    <div class="progress-bar " role="progressbar" style="width: 100%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                            </div>

                                            <p class="text-center font-Xsmall mt-3">
                                                @lang('home.buy_time_alert')
                                            </p>

                                        </div>
                                    @endif

                                </div>

                            </form>
                            <!--ENd form buy-->
                        </div>
                        <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                            <!--beging pagos con tarjetas-->
                            <div class="card  card-recomendado">
                                <div class="card-header py-3">
                                    <span class="icon-1">@lang('home.buy_time_recommend')</span>
                                    <h6 class="m-0">@lang('home.buy_instan_pay')</h6>
                                    <span class="icon-2">@lang('home.buy_accesible_payment')</span>
                                </div>
                                <div class="card-body">

                                    <small>@lang('home.buy_number_card')</small>
                                    <input type="text" class="form-control" placeholder="----   ----   ----   ----">

                                    <div class="form-group form-check mt-1">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label font-info-small" for="exampleCheck1">
                                            @lang('home.buy_accept_terms')
                                        </label>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <small>@lang('home.buy_finish_exp').</small>

                                            <div class="input-group input-group-calendar  mb-3">
                                                <input type="text" class="form-control font-small" placeholder="MM / YYYY">
                                                <div class="input-group-append ">
                                                    <span class="input-group-text font-small"> <img
                                                            src="/dashboard/assets/img/comprar/calendar.png" alt=""></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-6">
                                            <small>CVV</small>
                                            <input type="text" class="form-control font-small" placeholder="-----">
                                        </div>
                                    </div>

                                    <button class="btn btn-info btn-info-gradient btn-block py-3 mt-3 mt-lg-0">
                                        @lang('home.buy_card_instante_new')
                                    </button>

                                    <div class="text-center mt-3">
                                        <div class="container-img-deposito ">
                                            <img src="/dashboard/assets/img/deposito/masterCard.png" alt="">
                                            <img src="/dashboard/assets/img/deposito/visa.png" alt="">
                                            <img src="/dashboard/assets/img/deposito/masterCard.png" alt="">
                                            <img src="/dashboard/assets/img/deposito/norton.png" alt="">
                                            <img src="/dashboard/assets/img/deposito/ssl.png" alt="">
                                            <img src="/dashboard/assets/img/deposito/truste.png" alt="">
                                        </div>

                                        <img class="mt-2 img-fluid" src="/dashboard/assets/img/deposito/group.png" alt="">
                                    </div>

                                </div>
                                <div class="footer-card py-3 text-center">
                                    <span class="m-1"> <img src="/dashboard/assets/img/comprar/Vector26.png" alt="">
                                        @lang('home.buy_lower_commissions')</span>
                                    <span class="m-1"> <img src="/dashboard/assets/img/comprar/Vector26.png" alt="">
                                        @lang('home.buy_immediate_payment')</span>
                                    <span class="m-1"> <img src="/dashboard/assets/img/comprar/Vector26.png" alt="">
                                        @lang('home.buy_simple')</span>
                                </div>
                            </div>
                            <!--end pagos con tarjetas-->

                        </div>
                    </div>

                </div>

            </div>


            <!--modales-->

            @include("dashboard.modals.buy.buymodal")



        </div>
    </div>



    <script>
        $("#select-buy option[value='{{ $getCriptodefault->id }}']").prop('selected', true);

        function buy() {
            var xtotal = amountPayF();
            if ((xtotal == "") || (xtotal == 0)) {
                swal({
                    text: "Por favor ingrese la cantidad a comprar",
                    icon: "info"
                });

            } else {
                var xxtotal = parseFloat(xtotal);
                var currencyx = "{{ $defaultCurrency->code }}";
                calculateMinimumFasterx(currencyx, xxtotal)
                    .then(() => {
                        var data = {
                            'total': xxtotal,
                            'country': "{{ Auth::user()->country_id }}",
                            //'dni': $("#dni").val(),
                            'ciudad': '{{ Auth::user()->ciudad }}',
                            'direccion': '{{ Auth::user()->direccion }}',
                            'phone': '{{ Auth::user()->phone }}',
                            'dir': "buy",
                            'idCurrency': '{{ $defaultCurrency->id }}',
                            'idCrypto': '{{ $getCriptodefault->id }}',
                            'currency': '{{ $defaultCurrency->code }}',

                            "_token": "{{ csrf_token() }}"
                        }
                        var ajax = $.ajax({
                            url: "/paymentsharebuy",
                            method: 'post',
                            data: data,
                            dataType: 'json'
                        });
                        ajax.done(function(data) {
                            if (data.error == "true") {
                                swal({
                                    text: data.code,
                                    icon: "error"
                                });
                            }
                            if (data.success == "false") {
                                swal({
                                    text: data.code,
                                    icon: "error"
                                });
                            }
                            if (data.success == "true") {
                                window.location.href = data.url;
                            }

                        })
                        ajax.fail(function(err) {
                            console.log(err);
                            if (err.status == 422) { // when status code is 422, it's a validation issue
                                //console.log(err.responseJSON);
                                swal({
                                    text: "{{ __('index.form_error') }}",
                                    icon: "error"
                                });
                            }
                        });
                    })
                    .catch(data => {
                        swal({
                            text: "{{ __('home_buy.minimun_faster') }}" + data.min + ". " +
                                "{{ __('home_buy.maximo_faster') }}" + data.max,
                            icon: "error",
                        });
                    });
            }
            // alert("buy");
        }

        function paymentWallet() {
            var amountF = amountPayF();
            //segundo paso validar los terminos
           // var terminos = validaTerminos();

           if ((amountF == "") || (amountF == 0)) {
                swal({
                    text: "Por favor ingrese la cantidad a comprar",
                    icon: "info"
                });

            } else {

                var data = {
                    'idCurrency': '{{ $getCurrencyUser->id }}',
                    'idCrypto': '{{ $getCriptodefault->id }}',
                    'email': $("#email").val(),
                    'total': amountF,
                    "_token": "{{ csrf_token() }}",
                }
                var ajax = $.ajax({
                    url: "/dash/buy-user-wallet",
                    method: 'post',
                    data: data,
                    dataType: 'json',
                });

                ajax.done(function(data) {

                    if (data.success == "true") {
                        swal({
                            text: data.mensaje,
                            icon: "success"
                        });
                        window.location.href = "/dash/portafolio";

                    }

                    if (data.success == "false") {

                        swal({
                            text: data.mensaje,
                            icon: "error"
                        });

                    }

                })
                ajax.fail(function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                });

            }
        }

        var form = document.getElementById('sendBuy');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            //funcion enviar primer paso ioptenet el precio dinamico
            var amountF = amountPayF();
            //segundo paso validar los terminos
            var terminos = validaTerminos();
            if (terminos) {

                var amount = document.createElement('input');
                amount.setAttribute('type', 'hidden');
                amount.setAttribute('name', 'amount');
                amount.setAttribute('value', amountF);
                form.appendChild(amount);
                form.submit();

            } else {
                swal({
                    text: "Por favor valide los términos",
                    icon: "info"
                });
                //alert("valide los terminos");
            }

        })


        function validaTerminos() {
            if ($("input[type='checkbox']#terminos").is(':checked')) {
                return true;

            } else {
                return false;
            }

        }

        function amountPayF() {
            var totalxx = 0;
            if ($("input[type='radio'].person").is(':checked')) {
                totalxx = $("input[type='radio'].person:checked").val();
            } else {
                totalxx = $("#persoCurrency").val();
            }
            return totalxx;
        }

        function calculateMinimumFasterx(currency, total) {
            return new Promise((resolve, reject) => {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    }
                });
                $
                    .post("/calculate-minimun-flutter", {
                        "currency": currency,
                        "amount": total,
                        "card": true
                    })
                    .done(function(data) {
                        if (data.data == 'false') {
                            reject(data);
                        }
                        resolve();
                    });
            });
        }

        //selected options
        //$("#getCryptoBuy option[value='wallet']").prop('selected', true)
        //select currecy
        $("#getCurrencyBuy").change(function() {
            var str = $(this).val();
            var currency = str.toLowerCase();
            var xcrypto = $("#getCryptoBuy").val();
            var crypto = xcrypto.toLowerCase();
            redireccion(crypto, currency);
        });
        //select crypto
        $("#getCryptoBuy").change(function() {
            var str = $(this).val();
            var crypto = str.toLowerCase();
            var currencyx = $("#getCurrencyBuy").val();
            var currency = currencyx.toLowerCase();
            redireccion(crypto, currency);
        });

        function redireccion(crypto, currency) {
            window.location = '/dash/buy/' + crypto + '/' + currency;
        }

        $("#persoCrypto").keyup(function() {
            var crypto = $(this).val();
            var defaultCurrency = '{{ $person['pay'] }}';
            var defaultCripto = '{{ $person['recibe'] }}';
            var totalCurrency = parseFloat((defaultCurrency * crypto) / defaultCripto);
            var totalCurrency = totalCurrency.toFixed(2);
            if (isNaN(totalCurrency)) {
                totalCurrency = 0;
                totalCurrency = totalCurrency.toFixed(2);
                $("#persoCurrency").val(totalCurrency);
            } else {
                $("#persoCurrency").val(totalCurrency);
            }
        });
        $("#persoCurrency").keyup(function() {
            var currency = $(this).val();
            var defaultCurrency = '{{ $person['pay'] }}';
            var defaultCripto = '{{ $person['recibe'] }}';
            var totalCrypto = parseFloat((currency * defaultCripto) / defaultCurrency);
            var totalCrypto = totalCrypto.toFixed(7);
            if (isNaN(totalCrypto)) {
                totalCrypto = 0;
                totalCrypto = totalCrypto.toFixed(7);
                $("#persoCrypto").val(totalCrypto);
            } else {
                $("#persoCrypto").val(totalCrypto);
            }
        });
        
        $("#persoCurrency").blur(function() {
            desactivaOptions();
        });

        function desactivaOptions() {
            //desactivar inputs
            $("input[type='radio'].person").each(function() {
                $(this).prop('checked', false);
            });
        }

    </script>


@endsection
