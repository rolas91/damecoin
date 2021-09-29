<div class="container-pagos">
    @foreach (Dashboard::getPagos() as $payment)

        <div class="card card-pagos" data-toggle="modal" data-target="#{{ $payment->modal }}"  onclick="verifica('{{ $payment->modal }}')">
            <div class="card-header d-flex justify-content-between align-items-center ">
                <span><img class="img " style="width:120px;height:70px" src="/{{ $payment->file }}" alt=""></span>
                <span class="color-succes">
                    {{ $payment->deposit_fees}}
                    {{--
                    <button data-toggle="modal" data-target="#{{ $payment->modal }}"
                        onclick="verifica('{{ $payment->modal }}')">{{ $payment->deposit_fees}}</button>
                    --}}
                    </span>
            </div>
            <div class="card-body pt-0">
                <h5 class="card-title color-blue">
                    <strong>{{-- $payment->name --}}</strong>
                </h5>
                <p class="card-text">
                    @lang($payment->file_idioma.".".$payment->description)
                </p>
            </div>
        </div>

        @include("dashboard.partials.buy.modals",["modal"=>$payment->modal])

    @endforeach


</div>

<script>
    function verifica(name) {

        currency = '{{ $defaultCurrency->code }}';
        calculateMinimum(currency, name)
            .then((data) => {
                // console.log(data)
                if (name == "paypal") {
                    $('#calculatorPaypal').html(`${data.minUsd} (${data.min})`);
                    $('#paypalEmail').html(`${data.emailPaypal}`);
                    $('#min').html(`min(${data.min})`);
                }
                if (name == "skrill") {
                    $('#calculatorSkrill').html(`${data.minUsd} (${data.min})`);
                    $('#skrillEmail').html(`${data.emailSkrill}`);
                }
                if (name == "wechat") {
                    $('#calculatorWechat').html(`${data.minUsd} (${data.min})`);
                    $('#wechatEmail').html(`${data.emailWechatpay}`);
                    $('#wechatImagen').attr('src', '/methodpayQR/' + data.imagen);
                    $('#calculatorWechatMax').html(`${data.maxUsd} (${data.max})`);
                }
                if (name == "alipay") {
                    $('#calculatorAlipay').html(`${data.minUsd} (${data.min})`);
                    $('#alipayEmail').html(`${data.emailAlipay}`);
                    $('#alipayImagen').attr('src', '/methodpayQR/' + data.imagen);
                    $('#calculatorAlipayMax').html(`${data.maxUsd} (${data.max})`);
                }
                // $('#amountAccount').html(`${data.minUsd} (${data.min})`);
            })
            .catch(err => console.log(err));
    }

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
