<div class="nav-horizontal  d-none d-lg-block" id="nav-horizontal">
    <div class="container pt-5 pt-sm-0">
        <div class="row d-flex justify-content-between py-3" >
            @if (isset($getCurrencies))
                <div 
                    class="col-12 col-xl-4 d-flex justify-content-start align-items-center order-12 order-xl-1 mt-3 mt-xl-0">
                    <strong class="h5 mr-3 my-0 py-0">@lang('dash_general.home')</strong>

                    <div class="select-container col-8" >
                        <span><i class="fas fa-angle-down"></i></span>
                        @include("dashboard.partials.divisa") 
                    </div>

                </div>
            @else
                <div
                    class="col-12 col-xl-3 d-flex justify-content-start align-items-center order-12 order-xl-1 mt-3 mt-xl-0">
                    <strong class="h5 mr-3 my-0 py-0">Movements</strong>

                </div>
            @endif

            <div class="col-12 col-xl-8  order-1 order-xl-12">
                <div class="row">
                    <div class="col-12 col-md-7 col-xl-5 d-flex order-12 order-xl-1  mt-3 mt-xl-0 align-items-center">
                        <div class="btn-group btn-group-custom" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href = '/dash/buy';"> <span><img
                                        src="/dashboard/assets/img/navbar/vender.svg"
                                        alt=""></span>@lang('dash_general.buy_header')</button>

                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href = '/dash/deposit';"><span><img
                                        src="/dashboard/assets/img/navbar/depositar.svg"
                                        alt=""></span>@lang('dash_general.deposit_header')</button>

                        </div>
                    </div>
                    <div
                        class="col-12 col-md-5 col-xl-3 d-flex flex-column order-12 order-xl-12 mt-3  mt-xl-0 text-center">
                        <span>@lang('dash_general.dark_mode')</span>
                        <button class="btn-dark-mode" id="btn-dark-mode">
                            <span>OFF</span>
                            <span>ON</span>
                        </button>
                    </div>
                    <div class="col-12 col-md-6  col-xl-4 order-1 order-xl-12 mt-3 mt-xl-0 ">
                        <div class="nav-user">
                            <div class="user-info">
                                <span>{{ Auth::user()->name }} {{ Auth::user()->lastName }}</span>
                                <a href="{{ url('/dash/profile') }}">@lang('dash_general.my_account')</a>
                            </div>
                            <div class="img-user"><img src="/dashboard/assets/img/navbar/avatar.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
