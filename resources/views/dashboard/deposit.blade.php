@extends('layouts_dash.dash')
@section('content')
    <div class="principal-section pb-3 " id="principal-section">
        <div class="deposito-section">

            <div class="container mt-5  d-lg-none ">
                <div class="row">
                    <div class="col-12  d-flex justify-content-between ">
                        <strong class="h5 mr-3 my-0 py-0">@lang('home.deposit')</strong>
                        <div class="select-container">
                            <span><i class="fas fa-angle-down"></i></span>
                            {!! Form::select('getCurrencies', $getCurrencies, $defaultCurrency->id, ['id' => 'getCurrencies', 'class' => 'form-control', 'onchange' => 'currencyChange(this);', 'data-default' => $defaultCurrency->code, 'data-symbol' => $defaultCurrency->symbol]) !!}
                        </div>
                    </div>
                </div>
            </div>


            <div class="container first-section mt-4 mt-lg-0">
                {{-- <h2 class="title d-none d-lg-block">
                    @lang('home.deposit_inst_credit_card')</h2> --}}

                <div class="row">

                    <div class="col-12 col-lg-6">

                        <div class="card card-blue-movil arrow">
                            <div class="card-header text-center d-none d-lg-inline">
                                @lang('dash_general.to_deposit')
                            </div>
                            <div class="card-body px-0 px-lg-3">
                                <h6 class="card-title ">@lang('dash_deposit.quanty')</h6>

                                <div class="d-lg-inline">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card-input-radio-text">
                                                
                                                <input type="radio" class="person" name="radiocustom"
                                                        id="p1" value="500">
                                                <span class="checkmark"></span>
                                                <div class="card-info-input">
                                                    <strong>500 {{ $defaultCurrency->code }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card-input-radio-text">
                                                <input type="radio" class="person" name="radiocustom"
                                                        id="p2" value="1000">
                                                <span class="checkmark"></span>
                                                <div class="card-info-input">
                                                    <strong>1000 {{ $defaultCurrency->code }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="card-input-radio-text">
                                                <input type="radio" class="person" name="radiocustom"
                                                        id="p1" value="200">
                                                <span class="checkmark"></span>
                                                <div class="card-info-input">
                                                    <span><strong>2000 {{ $defaultCurrency->code }}</strong>
                                                        <!--+ 30 USD
                                                                @lang('home.deposit_present')-->
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                             

                                <h6 class="card-title mt-3 ">@lang('home.deposit_other_amount')</h6>

                                <div class="input-group input-group-monto mb-3">
                                    <input type="text" id="persoCurrency" class="form-control"
                                        onKeyPress="return soloNumeros(event)">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">

                                            <div class="d-flex flex-column align-items-start">
                                                <strong class="m-0">{{ $defaultCurrency->code }}</strong>

                                            </div>

                                        </span>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>

                    <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                        <div class="card card-blue">
                            <div class="card-header text-center">
                                @lang('dash_deposit.payment_card')
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
                                            <small>@lang('home.deposit_payment_shop')</small>
                                            <div class="form-group input-tarjeta-icon">
                                                <img src="assets/img/portafolio/icon-input-group.svg" alt="">
                                                <input type="text" class="form-control" placeholder="Numero de tarjeta">
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="form-group input-tarjeta">
                                                <small>@lang('home.deposit_payment_date_exp')</small>
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
                                    --}}
                                </div>
                                {{-- 
                                <button class="btn btn-tarjeta mt-3 py-2 " data-toggle="modal"
                                    data-target="#modal-tarjetas">@lang('home.deposit_payment_select_card_save')</button>

                                <div class="form-group form-check form-check-custom mt-3 text-left">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <small class="form-check-label"
                                        for="exampleCheck1">@lang('home.deposit_payment_gov_term')</small>
                                </div>
                                --}}
                                <br><br>

                                <button onclick="deposit()"
                                    class="btn btn-info btn-info-gradient py-3  btn-block mt-3">@lang('dash_deposit.deposit_insta')</button>


                                <div class="container-img-deposito mt-3">
                                    <img src="/assets/img/deposito/masterCard.png" alt="">
                                    <img src="/assets/img/deposito/visa.png" alt="">
                                    <img src="/assets/img/deposito/masterCard.png" alt="">
                                    <img src="/assets/img/deposito/norton.png" alt="">
                                    <img src="/assets/img/deposito/ssl.png" alt="">
                                    <img src="/assets/img/deposito/truste.png" alt="">
                                </div>
                                <hr class="mt-2 mb-2">

                                <small> <img class="img-fluid mr-2" src="assets/img/vender/information.png" alt="">
                                    @lang('dash_buy.acepted')</small>

                                <img class="mt-2 img-fluid" src="assets/img/deposito/group.png" alt="">

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="container mt-4">
                <div class="card card-information">
                    <div class="card-body d-flex justify-content-center align-items-center py-3">
                        <span class="mr-3"><img src="assets/img/vender/information.png" alt=""></span>

                        <div class="ventas-info">
                            @lang('dash_deposit.diner',["currency"=>$defaultCurrency->code])
                        </div>

                    </div>
                </div>
            </div>

            <div class="container mt-4 d-none d-lg-block">
                <h2 class="title">@lang('dash_deposit.to_deposit_other_payment')</h2>

                <div class="accordion accordion-custom" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    @lang('dash_buy.payment_transfe') <span></span>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="card-text">
                                  {{-- @lang('home.to_deposit_2_5_days')--}} <br>
                                  @lang('dash_general.transfe2')
                                </p>

                                @include("dashboard.partials.buy.bank-desktop")


                                <h5 class="card-title mt-3"><span class="mr-1"><img src="assets/img/deposito/anonymous.png"
                                            alt=""></span> Anonimous measures</h5>

                                <p class="card-text">
                                    - Our bank accounts are not directly linked to any crypto chain so you can make your
                                    transfer without worring about local bank / Government restrictions agains Crypto: <br>

                                    - If you need other deposit methods (i.e. Alipay, WeChat Pay, Singapour Bank Account,
                                    etc. please contact our 24/7 Support Chat. <br>

                                    - If you need "Government & Bank Statement 100% Anonymous for bank transfer, please
                                    check it upon the bank details.
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
                                    @lang("dash_general.alternate_payment") <span></span>
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
                            <span class="metodo-icon"><img src="assets/img/comprar/icon1.png" alt=""></span> <span
                                class=" m-0 color-succes">@lang('dash_general.noinmediato')</span>
                        </div>
                        <p class="mt-3 text-left ">@lang('dash_general.payment_alternate')</p>
                        <a href="#" data-toggle="modal" data-target="#modal-deposito" class="btn mx-auto">@lang('dash_general.ver_account')</a>
                    </div>
                    <div class="metodos-pago text-center">
                        <div class="d-flex justify-content-between">
                            <span class="metodo-icon"><img src="assets/img/comprar/icon2.png" alt=""></span>
                        </div>
                        <p class="mt-3 text-left">@lang('dash_general.payment_alternate')</p>
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
                                    <span class="checkmark"><i class="fas fa-check"></i></span>
                                    <div class="card-div card-mastercard">
                                        <div class="card-info">
                                            <img class="placa" src="assets/img/perfil/placa.png" alt="">
                                            <p class="mt-1 mt-lg-2 mb-1">
                                                <span class="mr-3">**** </span> <span class="mr-3">**** </span> <span
                                                    class="mr-3">**** </span>
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
                                    <span class="checkmark"><i class="fas fa-check"></i></span>
                                    <div class="card-div  card-visa">
                                        <div class="card-info">
                                            <img class="placa" src="assets/img/perfil/placa.png" alt="">
                                            <p class="mt-2 mb-1">
                                                <span class="mr-3">**** </span> <span class="mr-3">**** </span> <span
                                                    class="mr-3">**** </span>
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

    <script>
        function deposit() {
            var xtotal = amountPayF();
            if ((xtotal == "") || (xtotal == 0)) {
                swal({
                    text: "{{ __('dash_deposit.error_form') }}",
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
                            'idCrypto': '{{$defaultCurrency->id}}',
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
