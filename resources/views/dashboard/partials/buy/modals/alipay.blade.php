
<div class="modal fade modal-custom-comprar" id="alipay" tabindex="-1" role="dialog" aria-labelledby="AlipayPaymentModal"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 class="modal-title" id="SkrillPaymentLabel">@lang('index.title_alipay')</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" >
                    <div class="text-center mb-2">
                        <img loading="lazy" src="{{ asset('img/alipay.svg') }}" class="img-fluid" alt=""
                            style="width: 200px">
                    </div>

                    <div class="">
                        <div style="font-size: 21px;border-radius: 5px 5px 0px 0px;padding: 5px;">
                            <p class="card-text mb-0">
                                @lang('index.sendMoneyalipay')</p><span style="font-weight: bold;"
                                id="alipayEmail"></span><br>
                        </div>
                        <div>
                            <img width="100%" src="" alt="" id="alipayImagen">
                        </div>
                        <div
                            style="font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;">
                           <p class="card-text mb-0"> {{ __('index.message_alipay3') }}</p>
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


