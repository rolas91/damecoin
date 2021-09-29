@if (isset($paypal_state))

    <style>
        .color {
            background-color: #7cd1f9;
            color: #fff;
            border: none;
            box-shadow: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 24px;
            margin: 0;
            cursor: pointer;
        }

    </style>

    <div style="width: 100%;padding-bottom: 5px;color: #2c4b8e;">0% deposit fees (FREE. RECOMMENDED!)</div>


    <div class="row" style="margin-top: 10px;">
        <div class="col-md-6 my-2">
            @include("partials.modal-payment.transferencia")
        </div>

        <div class="col-md-6 my-2">
            @include("partials.modal-payment.wechat")
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-6 my-2">
            @include("partials.modal-payment.alipay")
        </div>
    </div>

    <div style="width: 100%;padding-bottom: 5;margin-top: 20px;color: #2c4b8e;">1.99% deposit fees (Not recommended)
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-6 my-2">
            @include("partials.modal-payment.skrill")
        </div>
        <div class="col-md-6 my-2">
            @include("partials.modal-payment.payoneer")
        </div>
    </div>

    <div style="width: 100%;padding-bottom:5px;margin-top:20px;color: #2c4b8e;">4.99% deposit fees (Not recommended)
    </div>

    <div class="row">
        <div class="col-md-6 my-2" style="{{ !$paypal_state->status ? 'display:none !important' : '' }}">
            @include("partials.modal-payment.paypal")
        </div>
        <div class="col-md-6 my-2">
            @include("partials.modal-payment.westerunion")
        </div>
    </div>

    <div style="width: 100%;padding-bottom: 5;margin-top: 20px;color: #2c4b8e;">Argentina 🇬🇹</div>
    <div class="row" style="margin-top: 10px;">
        @if ($where === 'buy')
            <div class="col-md-6 my-2">
                <a href="/dash/buy/mercadopago/1/5" class="btn btn-primary" style="display: flex;align-items: center;">
                    <img width="100px" src="{{ asset('img/mercado-pago-logo.svg') }}" class="left-icon mr-3">
                    <span style="margin-left: 20px!important">Mercadopago</span>
                </a>
            </div>
            <div class="col-md-6 my-2">
                <a href="/dash/buy/rapipago/1/5" class="btn btn-primary" style="display: flex;align-items: center;">
                    <img width="100px" src="{{ asset('img/rapipago.png') }}" class="left-icon mr-3">
                    <span style="margin-left: 20px!important">Rapipago</span>
                </a>
            </div>
        @else
            <div class="col-md-6 my-2">
                <a href="/dash/mercadopago/1/5" class="btn btn-primary" style="display: flex;align-items: center;">
                    <img width="100px" src="{{ asset('img/mercado-pago-logo.svg') }}" class="left-icon mr-3">
                    <span style="margin-left: 20px!important">Mercadopago</span>
                </a>
            </div>
            <div class="col-md-6 my-2">
                <a href="/dash/rapipago/1/5" class="btn btn-primary" style="display: flex;align-items: center;">
                    <img width="100px" src="{{ asset('img/rapipago.png') }}" class="left-icon mr-3">
                    <span style="margin-left: 20px!important">Rapipago</span>
                </a>
            </div>
        @endif
    </div>
    <div class="row" style="margin-top: 10px;">
        @if ($where === 'buy')
            <div class="col-md-6 my-2">
                <a href="/dash/buy/pagofacil/1/5" class="btn btn-primary" style="display: flex;align-items: center;">
                    <img width="30px" src="{{ asset('img/pagofacil.png') }}" class="left-icon mr-3">
                    <span style="margin-left: 20px!important">Pago Fácil</span>
                </a>
            </div>
        @else
            <div class="col-md-6 my-2">
                <a href="/dash/pagofacil/1/5" class="btn btn-primary" style="display: flex;align-items: center;">
                    <img width="30px" src="{{ asset('img/pagofacil.png') }}" class="left-icon mr-3">
                    <span style="margin-left: 20px!important">Pago Fácil</span>
                </a>
            </div>
        @endif
    </div>


@endif

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        const dataBank = () => {
            let url = `{{ URL('getBankData') }}`;
            $.get(url, (data) => {
                data.forEach(e => {
                    $('.contentDataBnak').append(`
                            <div class="list-group mb-3">
                                <a class="list-group-item">
                                    <h4 class="list-group-item-heading">${e.title}</h4>
                                    <p class="list-group-item-text"><b>Bank</b> : ${e.name}</p>
                                    <p class="list-group-item-text"><b>Country</b> : ${e.country}</p>
                                    <p class="list-group-item-text"><b>Address</b> : ${e.addres}</p>
                                    <p class="list-group-item-text"><b>Number Account</b> : ${e.numero_cuenta}</p>
                                    <p class="list-group-item-text"><b>Swift</b> : ${e.swift}</p>
                                    <p class="list-group-item-text"><b>Destinatary</b> : ${e.destinatary}</p>
                                </a>
                            </div>
                        `);
                });
            })
        }

        dataBank();

    </script>

    <script>
        //funcion central
        function calculateMinimum(currency, metodo) {
            return new Promise((resolve, reject) => {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}",
                    }
                });
                $.post("/calculate-minimun", {
                        "currency": currency,
                        "metodo": metodo
                    })
                    .done(function(data) {

                        if (data.success == 'true') {
                            resolve(data);
                        }
                        reject();
                    });
            });
        }

    </script>

@endsection
