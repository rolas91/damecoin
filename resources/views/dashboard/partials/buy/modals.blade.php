@if($modal=="paypal")
    @include("dashboard.partials.buy.modals.paypal")
@endif

@if($modal=="skrill")
    @include("dashboard.partials.buy.modals.skrill")
@endif

@if($modal=="western")
    @include("dashboard.partials.buy.modals.western")
@endif

@if($modal=="wechat")
    @include("dashboard.partials.buy.modals.wechat")
@endif

@if($modal=="alipay")
    @include("dashboard.partials.buy.modals.alipay")
@endif
