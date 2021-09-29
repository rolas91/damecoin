
<div class="modal fade modal-custom-comprar" id="skrill" tabindex="-1" role="dialog" aria-labelledby="SkrillPaymentLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="padding: 20px 30px 10px;">
            <h5 class="modal-title" id="SkrillPaymentLabel">Skrill</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body" style="padding: 20px" >
            <div class="">
                <div class="text-center mb-2">
                    <img loading="lazy"
                        src="https://www.skrill.com/typo3conf/ext/theme2020/Resources/Public/images/Skrill-Logo.svg"
                        class="img-fluid" alt="" style="width: 200px">
                </div>
                <div class="">
                    <div
                        style="background-color: rgba(183, 205, 232, 1);font-size: 21px;border-radius: 5px 5px 0px 0px;;padding: 10px;">
                        <p style="margin-bottom: 0px;">
                            @lang('index.sendMoneySkrill')</p><span style="font-weight: bold;color: #003187;"
                            id="skrillEmail"></span><br>
                    </div>

                    <div
                        style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                        {{ __('index.message_skrill3') }}
                        <br>
                    </div>
                    <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                        <span>@lang('index.subtitleAllPopups')</span>
                    </div>
                    <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                        {{ __('index.message_skrill') }}
                        min: <b><span id="calculatorSkrill"></span></b> <br>
                        {{ __('index.message_skrill1') }}
                    </div>
                </div>
                <div class="mt-3">
                    <center>
                        <a href="https://account.skrill.com/wallet/account/login?locale=en-US" target="_blank"
                            style="width: 100%;" class="btn color">Skrill Login</a>

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