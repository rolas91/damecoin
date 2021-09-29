{{-- Payoneer --}}
<div class="modal fade" id="PayoneerPaymentModal" tabindex="-1" role="dialog" aria-labelledby="PayoneerPaymentLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="SkrillPaymentLabel">Payonner</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px 30px">
                <div class="list-group mb-3">
                    <div class="text-center mb-2">
                        <img loading="lazy" src="{{ asset('img/payoneer.png') }}" class="img-fluid" alt=""
                            style="width: 200px">
                    </div>
                    <div class="list-group-item">
                        <div
                            style="background-color: rgba(183, 205, 232, 1);font-size: 21px;border-radius: 5px 5px 0px 0px;;padding: 10px;">
                            <p style="margin-bottom: 0px;">
                                @lang('index.sendMoneyPayoneer')</p><span style="font-weight: bold;color: #003187;"
                                id="payoneerEmail"></span><br>
                        </div>

                        <div
                            style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                            {{ __('index.message_payoneer3') }}
                            <br>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            <span>@lang('index.subtitleAllPopups')</span>
                        </div>
                        <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                            {{ __('index.message_payoneer') }}
                            min: <b><span id="calculatorPayoneer"></span></b> <br>
                            {{ __('index.message_payoneer1') }}
                        </div>
                    </div>
                    <div class="mt-3">
                        <center>
                            <a href="https://login.payoneer.com/?sessionDataKey=36b7e4e99faa42e5ae61c6717c4795ee----&state=a1867d9a-9205-4c2d-8e17-20ae17e796b3&provider_id=internal&client_id=b3d186db-4e5d-49c8-8a12-5753136af807&redirect_uri=https%3A%2F%2Fmyaccount.brand.domain%2Flogin%2Flogin.aspx&scope=myaccount+openid&response_type=code&support=10"
                                target="_blank" style="width: 100%;" class="btn color">Payoneer Login</a>

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


<a href="#" class="btn btn-primary" style="display: flex;align-items: center;" data-toggle="modal"
    data-target="#PayoneerPaymentModal" onclick="newPayoneer()">
    <img src="{{ asset('img/payoneer.png') }}" class="left-icon" style="width: 50px;">
    Payoneer
</a>
<script>
    function newPayoneer() {
        currency = '{{ $getCurrencyUser->code }}';
        calculateMinimum(currency, "payoneer")
            .then((data) => {
                $('#payoneerEmail').html(`${data.emailPayoneer}`);
                $('#calculatorPayoneer').html(`${data.minUsd} (${data.min})`);
            })
            .catch(err => console.log(err));
    }

</script>
