<!-- Menu desktop  -->
<div class="navbar-custom d-none d-lg-block" id="navbar-custom">

    <div class="nav-header" id="nav-header">
        <div class="nav-logo" style="width: 100%"><img src="/dashboard/assets/img/navbar/logo-nav.svg" class="img-fluid" alt=""></div>
        <span class="toggler-nav" id="toggler-nav"><span></span><span></span><span></span></span>
    </div>

    <div class="nav-info">
        @include("layouts_dash.balance")
        <!--
            <p>0 (0%) <i class="fas fa-arrow-up"></i></p>
            -->
    </div>

    <ul class="enlaces-principal">
        <li> <a href="{{ url('/dash/prices') }}" class="{{ $page == 'prices' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar/precios.svg"
                        alt=""></span><span>@lang('dash_general.prices')</span></a>
        </li>

        <li> <a href="{{ url('/dash/wallets') }}" class="{{ $page == 'wallets' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar/wallets.svg"
                        alt=""></span><span>@lang('dash_general.wallets')</span></a>

        </li>
<!--
        <li> <a href="{{ url('/dash/prices') }}" class="{{ $page == 'prices' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar/precios.svg"
                        alt=""></span><span>@lang('dash_general.prices')</span></a> </li>
        -->

    </ul>

    <ul class="enlaces-principal">
        <li class="subtitle">@lang('dash_general.operations')</li>

        <li class="dropdown-nav-custom">
            
            <a href="{{ url('/dash/buy') }}">
                <span>
                    <img src="/dashboard/assets/img/navbar/comprar.svg" alt="">
                </span>
                <span>
                    @lang('dash_general.buy')
                </span>
            </a>
        </li>


        <li> <a href="{{ url('/dash/sell') }}" class="{{ $page == 'sell' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar/vender.svg" alt=""></span><span>@lang('dash_general.sell')</span></a>
        </li>
        {{--
        <li> <a href="{{ url('/dash/change/1/1') }}" class="{{ $page == 'change' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar/cambiar.svg"
                        alt=""></span><span>@lang('dash_general.change')</span></a> </li>
        --}}
        <li> <a href="{{ url('/dash/deposit') }}" class="{{ $page == 'deposit' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar/depositar.svg"
                        alt=""></span><span>@lang('dash_general.to_deposit')</span></a> </li>
    </ul>

    <ul class="enlaces-principal">
        <li class="subtitle">@lang('dash_general.profile')</li>
        <li> <a href="{{ url('/dash/movements') }}" class="{{ $page == 'movements' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar/movimientos.svg" alt=""></span>
                <span>@lang('dash_general.movements')</span> </a> </li>
    </ul>

</div>

@include('layouts_dash.menu_horizontal')

<!-- Menu Móvil  -->
