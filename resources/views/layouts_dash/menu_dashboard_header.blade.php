<div class="container mt-4  d-lg-none ">
    <div class="row">
        {{-- @include("dashboard.partials.divisa") --}}
    </div>
</div>

<div class="d-flex justify-content-center align-items-center flex-column mt-4 d-lg-none">

    <p class="">@lang('dash_general.balance') </p>
    <p class="mb-1">{{ Dashboard::balanceWallet() }}</p>

    <p class="font-weight-bolder h2"><strong>{{ Dashboard::balanceFiat() }} </strong></p>
   
</div>
<div class="container d-none d-lg-block">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-4">
                    <strong>@lang('dash_general.i_want_to_buy'):</strong>
                    <div class="input-group dropdown-group-custom">
                        <input type="text" id="cryptos-express" onkeyup="getCryptos()"
                            onkeypress="return soloNumeros(event)" class="form-control"
                            aria-label="Text input with dropdown button">
                        <div class="input-group-append">
                            {!! Form::select('getCryptos', $getCryptos, $defaultCrypto->id, ['id' => 'getCryptos', 'class' => 'w-00', 'onchange' => 'cryptoChange(this);', 'id' => 'cars']) !!}

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <strong>@lang('dash_general.you_pay'):</strong>
                    <div class="input-group dropdown-group-custom">
                        <input type="text" id="currency-express" onkeyup="getCurrency()"
                            onkeypress="return soloNumeros(event)" class="form-control"
                            aria-label="Text input with dropdown button">
                        <div class="input-group-append ">

                            {!! Form::select('getCurrencies', $getCurrencies, $defaultCurrency->id, ['id' => 'getCurrencies', 'class' => 'w-00', 'onchange' => 'currenChange(this);', 'id' => 'cars', 'data-default' => $defaultCurrency->code, 'data-symbol' => $defaultCurrency->symbol]) !!}


                        </div>
                    </div>

                </div>
                {{-- 
                <div class="col-12 col-md-6 col-xl-4  ">
                    <br>
                    <div class="input-group input-group-custom">
                        <input type="text" class="form-control" placeholder="@lang('dash_general.number_card')">
                        <input type="text" class="form-control" placeholder="MM / YY">
                        <input type="text" class="form-control" placeholder="CVV">
                        <img src="/dashboard/assets/img/portafolio/icon-input-group.svg" alt="">
                    </div>

                    <div class="form-group form-check form-check-custom">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <small class="form-check-label" for="exampleCheck1">@lang('dash_general.government_anonymous')</small>
                    </div>
                </div>
                --}}
                <div class="col-12 col-md-6 col-xl-4 ">
                    <br>
                    <button class="btn text btn-info-custom" onclick="buyExpress()">
                        <span><img src="/dashboard/assets/img/portafolio/compraInst.svg"
                                alt=""></span>@lang('dash_general.buy_insta')
                        </span>
                        </buttom>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var firstConver = false;
    var convertOriginal;

    function cryptoChange(tr) {
        window.location.href = '/dash/crypto/' + tr.value;
    }

    function buyExpress() {
        var xx = parseFloat($("#currency-express").val());
        var currencyx = "{{ $defaultCurrency->code }}";
        if (isNaN(xx)) {
            swal({
                            text: "{{ __('dash_general.form_empty') }}",
                            icon: "error"
                        });
            return;
        }
        calculateMinimumFasterx(currencyx, xx)
            .then(() => {
                var data = {
                    'total': xx,
                    'country': "{{ Auth::user()->country_id }}",
                    //'dni': $("#dni").val(),
                    'ciudad': '{{ Auth::user()->ciudad }}',
                    'direccion': '{{ Auth::user()->direccion }}',
                    'phone': '{{ Auth::user()->phone }}',
                    'dir': "buy",
                    'idCurrency': '{{ $defaultCurrency->id }}',
                    'idCrypto': '{{ $defaultCrypto->id }}',
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

    function getCurrency() {
        global2("false");
    }
    //dos funciones iguales lo iam sorry luego las uno
    function getCryptos() {

        global("true");
    }

    function global(divisa) {
        var cripto_express = $("#cryptos-express").val();
        var data = {
            'currency': '{{ $defaultCurrency->code }}',
            'crypto': '{{ $defaultCrypto->code }}',
            'totalCrypto': cripto_express,
            'cry': divisa,
            "_token": "{{ csrf_token() }}",
        };
        var totalCrypto = parseFloat(cripto_express);
        if (firstConver) {
            if (isNaN(totalCrypto)) {
                totalCrypto = 0;
                $("#currency-express").val(0);
                return;
            }
            var convert = parseFloat(convertOriginal) * totalCrypto;
            convert = convert.toFixed(2);
            $("#currency-express").val(convert);
            return;
        }

        if (isNaN(totalCrypto)) {
            totalCrypto = 0;
            $("#currency-express").val(0);
            return;
        } else {
            $("#cryptos-express").val(totalCrypto);
        }
        // $("#cryptos-express").val(totalCrypto);
        var ajax = $.ajax({
            url: "/dash/buy-express-convert",
            method: 'post',
            data: data,
            dataType: 'json',
        });

        ajax.done(function(data) {
            if (data.success == "true") {
                $("#currency-express").val(data.converCrypto);
                firstConver = true;
                convertOriginal = data.convertOriginal;
            }

        })
        ajax.fail(function(err) {});
    }

    function global2(divisa) {
        var cripto_express = $("#currency-express").val();
        var data = {
            'currency': '{{ $defaultCurrency->code }}',
            'crypto': '{{ $defaultCrypto->code }}',
            'totalCrypto': cripto_express,
            'cry': divisa,
            "_token": "{{ csrf_token() }}",
        };
        var totalCrypto = parseFloat(cripto_express);
        if (firstConver) {
            if (isNaN(totalCrypto)) {
                totalCrypto = 0;
                $("#cryptos-express").val(0);
                return;
            }
            if (divisa == "true") {
                var convert = parseFloat(convertOriginal) * totalCrypto;
            } else {
                var convert = totalCrypto / parseFloat(convertOriginal);
            }

            convert = convert.toFixed(8);
            $("#cryptos-express").val(convert);
            return;
        }

        if (isNaN(totalCrypto)) {
            totalCrypto = 0;
            $("#cryptos-express").val(0);
            return;
        } else {
            $("#currency-express").val(totalCrypto);
        }
        // $("#cryptos-express").val(totalCrypto);
        var ajax = $.ajax({
            url: "/dash/buy-express-convert",
            method: 'post',
            data: data,
            dataType: 'json',
        });

        ajax.done(function(data) {
            if (data.success == "true") {
                $("#cryptos-express").val(data.converCrypto);
                firstConver = true;
                convertOriginal = data.convertOriginal;
            }

        })
        ajax.fail(function(err) {});
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

</script>
