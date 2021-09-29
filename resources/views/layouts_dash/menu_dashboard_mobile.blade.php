<!-- Menu Móvil  -->

<div class="container-menu-operar" id="menu-operar">
    <div class="menu-operar">
        <h6>@lang('home.buy')</h6>
        <div class="row">
            <div class="col-12 col-md-6 mt-4">
                <a href="{{ url('/dash/buy') }}" class="operar-enlace ">
                    <span class="mr-3 operar-icon "> <img src="/dashboard/assets/img/navbar-movil/comprar.svg" alt="">
                    </span>
                    <span>@lang('home.buy')</span>
                    <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>

            <div class="col-12 col-md-6 mt-4">
                <a href="{{ url('/dash/sell') }}" class="operar-enlace ">
                    <span class="mr-3 operar-icon "> <img src="/dashboard/assets/img/navbar-movil/vender.svg" alt="">
                    </span>
                    <span>@lang('dash_general.sell')</span>
                    <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            {{-- 
            <div class="col-12 col-md-6 mt-4">
                <a href="{{ url('/dash/change') }}" class="operar-enlace ">
                    <span class="mr-3 operar-icon "> <img src="/dashboard/assets/img/navbar-movil/cambiar.svg" alt="">
                    </span>
                    <span>@lang('dash_general.change')</span>
                    <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            --}}

            <div class="col-12 col-md-6 mt-4">
                <a href="{{ url('/dash/deposit') }}" class="operar-enlace ">
                    <span class="mr-3 operar-icon "> <img src="/dashboard/assets/img/navbar-movil/depositar.svg" alt="">
                    </span>
                    <span>@lang('dash_general.to_deposit')</span>
                    <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>

            <div class="col-12 col-md-6 mt-4">
                <a href="{{ url('/dash/movements') }}" class="operar-enlace ">
                    <span class="mr-3 operar-icon "> <img src="/dashboard/assets/img/navbar-movil/movimientos.svg"
                            alt=""> </span>
                    <span>@lang('dash_general.movements')</span>
                    <span class="operar-arrow ml-auto"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>


        </div>
    </div>
</div>

<div class="navbar-top d-lg-none ">
    <img src="/dashboard/assets/img/navbar-movil/logo.png" alt="">
    <span><img src="/dashboard/assets/img/navbar-movil/perfil.svg" alt=""></span>
</div>

<div class="navbar-botom d-lg-none">

    <ul>
        <li><a class="{{ $page == 'prices' ? 'active' : '' }}" href="{{ url('/dash/prices') }}"><span><img
                        src="/dashboard/assets/img/navbar-movil/precios.svg"
                        alt=""></span>@lang('dash_general.prices')</a></li>

        <li><a href="{{ url('/dash/wallets') }}" class="{{ $page == 'wallets' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar-movil/wallets.svg"
                        alt=""></span>@lang('dash_general.wallets')</a></li>

        <li><a href="#" class="{{ $page == 'buy' ? 'active' : '' }}"> <span></span> @lang('dash_general.buy')</a></li>
<!--
        <li><a href="{{ url('/dash/prices') }}" class="{{ $page == 'prices' ? 'active' : '' }}"><span><img
                        src="/dashboard/assets/img/navbar-movil/precios.svg" alt=""></span>@lang('dash_general.prices')</a></li>
        -->
        <li><a class="{{ $page == 'sell' ? 'active' : '' }}" href="{{ url('/dash/profile') }}"><span><img
                        src="/dashboard/assets/img/navbar-movil/perfil.svg" alt=""></span>@lang('dash_general.profile')</a></li>
    </ul>

    <button id="btn-nav" class=" btn button-nav "></button>

</div>
