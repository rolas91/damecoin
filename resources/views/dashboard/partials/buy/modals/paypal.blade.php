<div class="modal fade modal-custom-comprar" id="{{ $modal }}" tabindex="-1" role="dialog" aria-labelledby="westernUnionPaymentLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h5 class="modal-title" id="westernUnionPaymentLabel">PAYPAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px 30px">
                <div class="text-center mb-2">
                    <img loading="lazy"
                        src="https://d31dn7nfpuwjnm.cloudfront.net/images/valoraciones/0033/7299/Como_retirar_dinero_de_PayPal_en_Colombia.png?1555502328"
                        class="img-fluid" alt="" style="width: 200px">
                </div>
                <div
                    style="background-color: rgba(183, 205, 232, 1);font-size: 21px;border-radius: 5px 5px 0px 0px;;padding: 10px;">
                    <p style="margin-bottom: 0px;">
                        @lang('index.sendMoneyPaypal')</p><span style="font-weight: bold;color: #003187;"
                        id="paypalEmail"></span><br>
                </div>

                <div
                    style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                    {{ __('index.message_paypal3') }}
                    <br>
                </div>

                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    <span>@lang('index.subtitleAllPopups')</span>
                </div>
                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    {{ __('index.message_paypal') }}
                    min: <b><span id="calculatorPaypal"></span></b> <br>
                    {{ __('index.message_paypal1') }}
                </div>

                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    <strong class="text-danger">
                        {{ __('index.message_paypal2') }}
                    </strong>
                </div>


                <div class="mt-2">
                    <center>
                        <button class="color" data-dismiss="modal" aria-label="Close"
                            style="padding: 8PX 24PX;background-color: #cecece;">Cancel</button>
                        <a href="https://www.paypal.com/signin" target="_blank" class="color">PayPal.com Login</a>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>