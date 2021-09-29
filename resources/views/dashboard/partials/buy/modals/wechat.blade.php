{{-- WeChat Pay --}}
<div class="modal fade modal-custom-comprar" id="wechat" tabindex="-1" role="dialog" aria-labelledby="WechatPayPaymentModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SkrillPaymentLabel">@lang('index.title_wechat')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 10px">
                <div>
                    <div class="text-center mb-2">
                        <img loading="lazy" src="{{ asset('img/wechatpay.png') }}" class="img-fluid" alt=""
                            style="width: 200px">
                    </div>
                    <div class="">
                        <div
                            style="background-color: rgba(183, 205, 232, 1);font-size: 21px;border-radius: 5px 5px 0px 0px;;padding: 10px;">
                            <p style="margin-bottom: 0px;">
                                @lang('index.sendMoneywechatpay')</p><span style="font-weight: bold;color: #003187;"
                                id="wechatEmail"></span><br>
                        </div>
                        <div>
                            <img width="100%" src="" alt="" id="wechatImagen">
                        </div>
                        <div
                            style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                            {{ __('index.message_wechatpay3') }}
                            <br>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            {{ __('index.cant_minimum_method_pay') }} <span id="calculatorWechat"></span>.
                            {{ __('index.cant_minimum_method_pay2') }} <span id="calculatorWechatMax"></span>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            <span>@lang('index.message_wechatpay')</span>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            <span>@lang('index.subtitleAllPopups')</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <center>
                            <a href="https://pay.weixin.qq.com/index.php/xphp/v/coversea_pay_applyment/index#/guide/region"
                                target="_blank" style="width: 100%;" class="btn color">@lang('index.login_wechat')</a>

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


