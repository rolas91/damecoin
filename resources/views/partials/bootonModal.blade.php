
@if(isset($paypal_state))                
<style>
    .color
    {
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

<div style="width: 100%;padding: 10px 15px 5px;color: #2c4b8e;">0% deposit fees (FREE. RECOMMENDED!)</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


@endif

<div class="col-md-6 my-2">
        @include("partials.modal-payment.transferencia")
</div>

<div class="col-md-6 my-2">
        @include("partials.modal-payment.wechat")
</div>

<div class="col-md-6 my-2">
        @include("partials.modal-payment.alipay")
</div>

<div style="width: 100%;padding: 20px 15px 5px;color: #2c4b8e;">1.99% deposit fees</div>

<div class="col-md-6 my-2">
        @include("partials.modal-payment.skrill")
</div>

<div class="col-md-6 my-2">
        @include("partials.modal-payment.payoneer")
</div>

<div style="width: 100%;padding: 20px 15px 5px;color: #2c4b8e;">4.99% deposit fees (Not recommended)</div>

<div class="col-md-6 my-2" style="{{ (!$paypal_state->status) ? 'display:none !important' : '' }}">
    @include("partials.modal-payment.paypal")
</div>

<div class="col-md-6 my-2">
        @include("partials.modal-payment.westerunion")
</div>

<div style="width: 100%;padding: 20px 15px 5px;color: #2c4b8e;">Argentina 🇬🇹</div>

<div class="col-md-6 my-2">
    <a href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'mercadopago'])) }}" class="btn btn-blue w-100 style="display: flex;align-items: center; border-radius: 10px!important; padding: 10px">
        <img src="{{ asset('img/mercado-pago-logo.svg') }}" class="left-icon">
        Mercadopago
    </a>
</div>

<div class="col-md-6 my-2">
    <a href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'rapipago'])) }}" class="btn btn-blue w-100 style="display: flex;align-items: center; border-radius: 10px!important; padding: 10px ">
        <img src="{{ asset('img/rapipago.png') }}" class="left-icon" style="width: 60px!important; height: auto!important">
        Rapipago
    </a>
</div>

<div class="col-md-6 my-2">
    <a href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'pagofacil'])) }}" class="btn btn-blue w-100 style="display: flex;align-items: center; border-radius: 10px!important; padding: 10px">
        <img src="{{ asset('img/pagofacil.png') }}" class="left-icon" style="width: 30px!important; height: auto!important">
        Pago Fácil
    </a>
</div>


    <script>

        const dataBank = () => {
            let url = `{{ URL('getBankData') }}`;
            $.get(url,(data) => {
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

        $(document).ready(function(){
            var cripto = '{{$getCriptodefault->code}}';
            var criptoLower = cripto.toLowerCase()
            addUrl(criptoLower)
        })
         //funcion central
        function calculateMinimum(currency,metodo){
        return new Promise((resolve, reject) => {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}",
                }
            });
            $.post("/calculate-minimun", { "currency": currency,"metodo":metodo})
            .done(function( data ) {

            if(data.success== 'true'){
                resolve(data);
            }
            reject();
            });
        });
    }
    </script>