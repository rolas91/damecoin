<a href="#" class="btn btn-primary" style="display: flex;align-items: center;" data-toggle="modal"
    data-target="#AlipayPaymentModal" onclick="newAlipay()">
    <img src="{{ asset('img/alipay.svg') }}" class="left-icon" style="width: 50px;">
    @lang('index.title_alipay')
</a>
<div class="modal fade" id="AlipayPaymentModal" tabindex="-1" role="dialog" aria-labelledby="AlipayPaymentModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="SkrillPaymentLabel">@lang('index.title_alipay')</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px 30px">
                <div class="list-group mb-3">
                    <div class="text-center mb-2">
                        <img loading="lazy" src="{{ asset('img/alipay.svg') }}" class="img-fluid" alt=""
                            style="width: 200px">
                    </div>
                    <div class="list-group-item">
                        <div
                            style="background-color: rgba(183, 205, 232, 1);font-size: 21px;border-radius: 5px 5px 0px 0px;;padding: 10px;">
                            <p style="margin-bottom: 0px;">
                                @lang('index.sendMoneyalipay')</p><span style="font-weight: bold;color: #003187;"
                                id="alipayEmail"></span><br>
                        </div>
                        <div>
                            <img width="100%" src="" alt="" id="alipayImagen">
                        </div>
                        <div
                            style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                            {{ __('index.message_alipay3') }}
                            <br>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            {{ __('index.cant_minimum_method_pay') }} <span id="calculatorAlipay"></span>.
                            {{ __('index.cant_minimum_method_pay2') }} <span id="calculatorAlipayMax"></span>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            <span>@lang('index.message_alipay')</span>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            <span>@lang('index.subtitleAllPopups')</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <center>
                            <a href="https://globalprod.alipay.com/login/global.htm" target="_blank"
                                style="width: 100%;" class="btn color">@lang('index.login_alipay')</a>

                            <br>

                            <button class="color" data-dismiss="modal" aria-label="Close"
                                style="margin-top: 10px;width:100%; padding: 11px 24px;border: 0;background-color: #cecece;">Cancel</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function newAlipay() {
        currency = '{{ $getCurrencyUser->code }}';
        calculateMinimum(currency, "alipay")
            .then((data) => {
               $('#calculatorAlipay').html(`${data.minUsd} (${data.min})`);
                $('#alipayEmail').html(`${data.emailAlipay}`);
                $('#alipayImagen').attr('src', '/methodpayQR/' + data.imagen);
                $('#calculatorAlipayMax').html(`${data.maxUsd} (${data.max})`);
            })
            .catch(err => console.log(err));

    }

</script>
