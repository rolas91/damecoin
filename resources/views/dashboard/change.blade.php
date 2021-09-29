@extends('layouts_dash.dash')
@section('content')

    <div class="container-menu-operar" id="menu-operar">
        <div class="menu-operar">
            <h6>Operar</h6>
            <div class="row">
                <div class="col-12 col-md-6 mt-4">
                    <a href="comprar.html" class="operar-enlace ">
                        <span class="mr-3 operar-icon "> <img src="assets/img/navbar-movil/comprar.svg" alt=""> </span>
                        <span>Comprar</span>
                        <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-12 col-md-6 mt-4">
                    <a href="vender.html" class="operar-enlace ">
                        <span class="mr-3 operar-icon "> <img src="assets/img/navbar-movil/vender.svg" alt=""> </span>
                        <span>Vender</span>
                        <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-12 col-md-6 mt-4">
                    <a href="cambiar.html" class="operar-enlace ">
                        <span class="mr-3 operar-icon "> <img src="assets/img/navbar-movil/cambiar.svg" alt=""> </span>
                        <span>Cambiar</span>
                        <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-12 col-md-6 mt-4">
                    <a href="deposito.html" class="operar-enlace ">
                        <span class="mr-3 operar-icon "> <img src="assets/img/navbar-movil/depositar.svg" alt=""> </span>
                        <span>Depositar</span>
                        <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="col-12 col-md-6 mt-4">
                    <a href="movimientos.html" class="operar-enlace ">
                        <span class="mr-3 operar-icon "> <img src="assets/img/navbar-movil/movimientos.svg" alt=""> </span>
                        <span>Movimientos</span>
                        <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>


            </div>
        </div>
    </div>


    <div class="principal-section pb-3 " id="principal-section">
        <div class="cambiar-section">


            <div class="container mt-5  d-lg-none ">
                <div class="row">
                    <div class="col-12  d-flex justify-content-between ">
                        <strong class="h5 mr-3 my-0 py-0">@lang('home.buy')</strong>
                        <div class="select-container">
                            <span><i class="fas fa-angle-down"></i></span>
                            {!! Form::select('getCurrencies', $getCurrencies, $defaultCurrency->id, ['id' => 'getCurrencies', 'class' => 'form-control', 'onchange' => 'currencyChange(this);', 'data-default' => $defaultCurrency->code, 'data-symbol' => $defaultCurrency->symbol]) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-column mt-4 d-lg-none">
                <p class="mb-1">Balance total (USD)</p>
                <p class="font-weight-bolder h2"><strong>USD 2.523.089</strong></p>
                <p class="color-succes">2.523.089 (12%) <i class="fas fa-arrow-up"></i></p>
            </div>

            <div class="container first-section ">
                <div class="row ">
                    <div class="col-12 col-lg-6">
                        <div class="card card-blue cambiar">
                            <div class="card-header">
                                <h6>@lang('home.change_title_1')</h6>
                            </div>
                            <div class="card-body">


                                <div class="container-select-list">
                                    <span><i class="fas fa-angle-down"></i></span>
                                    {!! Form::select('getCurrencies', $getCurrencies, $defaultCurrency->id, ['id' => 'select-recibir', 'class' => 'form-control', 'data-default' => $defaultCurrency->code, 'data-symbol' => $defaultCurrency->symbol]) !!}

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                        <div class="card card-blue">
                            <div class="card-header">
                                <h6>@lang('home.change_title_2'):</h6>
                            </div>
                            <div class="card-body">

                                <div class="container-select-list">
                                    <span><i class="fas fa-angle-down"></i></span>
                                    <select id="select-vender">
                                        @foreach ($unionCryptos as $c)
                                            <option
                                                data-left="https://github.com/spothq/cryptocurrency-icons/blob/master/32/color/abt.png?raw=true">
                                                {{ $c['crypto']->name }}</option>
                                        @endforeach
                                    </select>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container second-section mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <h5 class="card-title">@lang('home.change_available_wallet')</h5>
                                <div class="card card-venta">
                                    <div class="card-body py-4">
                                        <span class="icon-card-venta"><img src="assets/img/ventas/icon-bitcointwo.svg"
                                                alt=""></span>
                                        <small>Bitcoin</small>
                                        <h5 class="card-title mb-1">BTC 00.00</h5>
                                        <p class="card-text"> (0%)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                                <h5 class="card-title">@lang('home.change_amount_suggested')</h5>

                                <!-- desktop  -->

                                <div class="d-none d-lg-inline">
                                    <div class="card-input-radio">
                                        <input type="radio" name="radiocustom" id="">
                                        <span class="checkmark"></span>
                                        <div class="card-info-input">
                                            <div>
                                                <small>@lang('home.change_txt_change')</small><br>
                                                <strong> 0.000000 BTC</strong>
                                            </div>
                                            <div>
                                                <small>@lang('home.change_txt_get')</small><br>
                                                <strong> 00 USD</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-input-radio mt-3">
                                        <input type="radio" name="radiocustom" id="">
                                        <span class="checkmark"></span>
                                        <div class="card-info-input">
                                            <div>
                                                <small>@lang('home.change_txt_change')</small><br>
                                                <strong> 0.000000 BTC</strong>
                                            </div>
                                            <div>
                                                <small>@lang('home.change_txt_get')</small><br>
                                                <strong> 00 USD</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-input-radio mt-3">
                                        <input type="radio" name="radiocustom" id="">
                                        <span class="checkmark"></span>
                                        <div class="card-info-input">
                                            <div>
                                                <small>@lang('home.change_txt_change')</small><br>
                                                <strong> 0.000000 BTC</strong>
                                            </div>
                                            <div>
                                                <small>@lang('home.change_txt_get')</small><br>
                                                <strong> 00 USD</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Móvil  -->

                                <div class="d-lg-none">
                                    <div class="row">

                                        <div class="col-12 col-md-6">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>@lang('home.change_txt_change')</small><br>
                                                        <strong>00 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('home.change_txt_get')</small><br>
                                                        <strong>0.000000 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt-4 mt-md-0">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>@lang('home.change_txt_change')</small><br>
                                                        <strong>00 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('home.change_txt_get')</small><br>
                                                        <strong>0.0000000 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt-4">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>@lang('home.change_txt_change')</small><br>
                                                        <strong>00 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('home.change_txt_get')</small><br>
                                                        <strong>0.000000 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt-4">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>@lang('home.change_txt_change')</small><br>
                                                        <strong>00 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('home.change_txt_get')</small><br>
                                                        <strong>0.000000 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                                <h5 class="card-title">@lang('home.change_other_amount')</h5>
                                <small>@lang('home.change_txt_change')</small>

                                <div class="input-group input-group-monto mb-3">
                                    <input type="text" class="form-control">
                                    <div class="input-group-append ">
                                        <span class="input-group-text" id="basic-addon2">
                                            <div class="d-flex flex-column align-items-start">
                                                <strong class="m-0">{{ $cryptoDefault->code }}</strong>
                                            </div>

                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-sm-between align-items-center py-1">
                                    <small class="mr-4 mr-sm-0">@lang('home.change_txt_get')</small>
                                    <span class="ml-5 ml-sm-0 icon-cambiar-monto"></span>
                                </div>

                                <div class="input-group input-group-monto mb-3">
                                    <input type="text" class="form-control">
                                    <div class="input-group-append ">
                                        <span class="input-group-text" id="basic-addon2">
                                            <div class="d-flex flex-column align-items-start">
                                                <strong class="m-0">{{ $defaultCurrency->code }}</strong>
                                            </div>

                                        </span>
                                    </div>
                                </div>

                                <button class="btn btn-info btn-info-gradient  btn-block mt-3">Cambiar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="card card-information">
                    <div class="card-body d-flex">
                        <span class="mr-3"><img src="assets/img/vender/information.png" alt=""></span>

                        <div class="ventas-info">
                            - Tras el pago los BTC serán instantáneamente añadidos a tu cartera en DameCoins. <br>

                            - Podrás acceder a tu cartera simplemente iniciando sessión. Recibirás un email con los datos de
                            acceso al instante. <br>

                            - Podrás vender tus BTC en cualquier momento y depositar el dinero a tu cuenta bancaria en COP
                            (dependiendo del país, puede tardar de 1 a 5 días en llegar a tu cuenta bancaria). <br>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
