<div class="col-md-6 my-2">
    <a href="#" class="btn btn-blue w-100" data-toggle="modal" data-target="#westernUnionPaymentModal" style="font-size: 14px;display: flex;white-space: normal;align-items: center;padding: 8px 20px;text-align: left;line-height: 1;">
        <img src="{{ asset('img/landing/icons/western-union.png') }}" class="left-icon">
        @lang('index.paybottom_western')
    </a>
</div>

<div class="modal fade" id="westernUnionPaymentModal" tabindex="-1" role="dialog" aria-labelledby="westernUnionPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="westernUnionPaymentLabel">WESTERN UNION</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px 30px;">
                <div class="text-center mb-2">
                    <img loading="lazy" src="https://lh3.googleusercontent.com/r1qrqwYTNX0x1fN_0Xty0JWzkKBgad0RylI6rmGsRg144dvrRoKuZFqMJssOHhaPtA" class="img-fluid" style="width:200px;height:200px" alt="">
                </div>
                <h4 class="text-center" style="font-weight: normal;">
                    {{ __('home_buy.western_union') }}
                </h4>
            </div>
        </div>
    </div>
</div>
