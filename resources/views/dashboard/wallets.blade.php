@extends('layouts_dash.dash')
@section('content')

    <div class="principal-section pb-3 " id="principal-section">
        <div class="wallets-section">

            @include('layouts_dash.menu_dashboard_header')
            
            <div class="container nav-wallets d-lg-none ">
                <a class="active" href="#" onclick="walletType(2, this);">@lang('dash_wallets.wallets_to_fiat')</a>
                <a href="#" onclick="walletType(3, this);">@lang('dash_wallets.wallets_cryptocurrency')</a>
                <div class="search-walelts">
                    <span><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="@lang('dash_wallets.wallets_to_search_placeholder')"
                        onkeyup="walletSearch(this);">
                </div>
            </div>
            <div class="container  mt-lg-4">
                <div class="card card-movil ">
                    <div class="card-header d-lg-flex align-items-lg-center justify-content-lg-between d-none d-lg-block">
                        <h5 class="card-title font-weight-bolder"><strong>@lang('dash_wallets.wallets_to_fiat'):</strong></h5>
                        <div class="mt-3 mt-md-0 d-flex justify-content-center flex-wrap flex-row items-button">
                            <button class="btn btn-primary-custom-gradient active m-1"
                                onclick="walletType(1, this);">@lang('dash_wallets.wallets_to_all')</button>
                            <button class="btn btn-primary-custom-gradient m-1"
                                onclick="walletType(2, this);">@lang('dash_wallets.wallets_to_fiat')</button>
                            <button class="btn btn-primary-custom-gradient m-1"
                                onclick="walletType(3, this);">@lang('dash_wallets.wallets_cryptocurrency')</button>
                            <div class="input-icon">
                                <!--
                         <span><i class="fas fa-search"></i></span>
                         
                         <input class="form-control" type="text" placeholder="@lang('dash_general.wallets_to_search_placeholder')" onkeyup="walletSearch(this);">
                         -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-2" id="section_one">
                        <div class="row wallets-container">
                            @foreach ($currencies_list as $list)
                            @if(($list->code!="EUR")&& ($list->id>10))
                                <div class="col-6 px-1 px-md-2 col-md-4 col-lg-4 mt-4 mt-md-0 mb-4 item-wallet-list">
                                    <div class="card">
                                        <div class="card-header pb-0 pt-2 text-right">
                                            {{--<button class="btn p-0"><small>@lang('dash_general.retiro')</small></button>--}}
                                        </div>
                                        <div class="card-body pt-0 pb-3 px-2 px-sm-3">
                                            <span class="logo-wallets">
                                                {{ $list->symbol }}
                                            </span>
                                            <small class="is-search-js">{{ $list->isoCountry }}</small>
                                            <h5 class="card-title">{{ $list->code }}
                                                {{ General::getCryptoWalettUser($list->id) }}</h5>
                                            <div class=" tarjeta-banco float-lg-right">
                                                <span class="mr-2">@lang('dash_general.to_deposit'): </span><br class="d-lg-none">
                                                <div class="d-flex  align-items-center">
                                                    <a href="/dash/deposit"
                                                        class="btn p-0 d-flex justify-content-center flex-wrap">
                                                        <img src="/dashboard/assets/img/wallets/icon-wallets-one.svg"
                                                            alt="">
                                                        <span class="d-lg-none small ml-2">@lang('dash_wallets.credit_card')</span>
                                                    </a>
                                                    <span class="mx-2">|</span>
                                                    <a href="/dash/deposit"
                                                        class="btn p-0 ml-0 d-flex justify-content-center flex-wrap ">
                                                        <img src="/dashboard/assets/img/wallets/icon-wallets-two.svg"
                                                            alt="">
                                                        <span class="d-lg-none small ml-2">@lang('dash_wallets.bank')</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4" id="section_two">
                <div class="card card-movil  ">
                    <div class="card-header py-0 py-lg-2 pl-0 pl-lg-2">
                        <h5 class="font-weight-bolder my-0 "><strong>@lang('dash_wallets.wallets_cryptocurrency'):</strong></h5>
                    </div>
                    <div class="card-body px-2 ">
                        <div class="row cryptomonedas-container">
                            @foreach ($cryptomonedas as $crypto)
                                @if ($loop->index <= 2)
                                    <div class="col-6 px-1 px-md-2 col-md-4 col-lg-4 mt-md-4 mt-lg-0 crypto-wallet-list">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-end ">
                                                @if ($user->created_at->gt(\Carbon\Carbon::create(2020, 4, 20)) || $paymentAcount == 0)
                                                    <a class="btn px-0 mr-lg-3 open-AddBookDialog" href="#"
                                                        data-toggle="modal" data-target="#wallet"
                                                        data-code="{{ $crypto['crypto']->code }}"
                                                        data-id="{{ $crypto['crypto']->id }}"
                                                        data-default="{{ $defaultCurrency->id }}"><small>@lang('dash_wallets.wallets_withdrawals')</small></a>
                                                @endif
                                                <a class="btn px-0 d-none d-lg-inline"
                                                    href="/dash/buycrypto/{{ $crypto['crypto']->id }}">
                                                    <small>@lang('dash_wallets.wallets_buy')</small></a>
                                            </div>
                                            <div
                                                class="card-body pt-3 px-2 px-sm-3 pb-1 pb-lg-5 d-flex justify-content-between align-items-lg-center align-items-start flex-column flex-lg-row">
                                                <span class="logo-crytomonedas"><img
                                                        src="{{ asset('uploads/img') }}/{{ $crypto['crypto']->img }}"
                                                        alt=""></span>
                                                <div class="crypto-info">
                                                    <small>{{ $crypto['crypto']->code }}</small>
                                                    <h5 class="card-title mb-1 font-weight-bolder "><strong><span
                                                                class="crypto-code-js">{{ $crypto['crypto']->code }}</span>
                                                            {{ $crypto['amount'] }}</strong></h5>
                                                    <span class="precio-crypto">{{ $defaultCurrency->code }}
                                                        {{ $crypto['conver'] }}</span>
                                                </div>
                                                <strong class="color-succes">0 (0%) <span class="ml-2"><i
                                                            class="fas fa-arrow-up"></i></span> </strong>
                                                <a class="btn py-2 btn-comprar"
                                                    href="/dash/buycrypto/{{ $crypto['crypto']->id }}">
                                                    <span class="mr-2"><img
                                                            src="{{ asset('dashboard/assets/img/wallets/btn-crypto.svg') }}"
                                                            alt=""></span>@lang('dash_wallets.wallets_to_buy')
                                                </a>
                                                <a class="btn mx-auto d-lg-none mt-2"
                                                    href="/dash/buycrypto/{{ $crypto['crypto']->id }}">
                                                    <small>@lang('dash_wallets.wallets_to_buy')</small></a>
                                            </div>
                                        </div>
                                    </div>
                                @else

                                    <div class="col-6 px-1 px-md-2 col-md-4 col-lg-4 mt-4 crypto-wallet-list">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-end ">
                                                @if ($user->created_at->gt(\Carbon\Carbon::create(2020, 4, 20)) || $paymentAcount == 0)
                                                    <a class="btn px-0 mr-lg-3 open-AddBookDialog" href="#"
                                                        data-toggle="modal" data-target="#wallet"
                                                        data-code="{{ $crypto['crypto']->code }}"
                                                        data-id="{{ $crypto['crypto']->id }}"
                                                        data-default="{{ $defaultCurrency->id }}"><small>@lang('dash_wallets.wallets_withdrawals')</small></a>
                                                @endif
                                                <a class="btn px-0 d-none d-lg-inline"
                                                    href="/dash/sellcrypto/{{ $crypto['crypto']->id }}">
                                                    <small>@lang('dash_wallets.wallets_buy')</small></a>
                                            </div>
                                            <div
                                                class="card-body pt-3 px-2 px-sm-3 pb-1 pb-lg-5 d-flex justify-content-between align-items-lg-center align-items-start flex-column flex-lg-row">
                                                <span class="logo-crytomonedas"><img
                                                        src="{{ asset('uploads/img') }}/{{ $crypto['crypto']->img }}"
                                                        alt=""></span>
                                                <div class="crypto-info">
                                                    <small>{{ $crypto['crypto']->code }}</small>
                                                    <h5 class="card-title mb-1 font-weight-bolder ">
                                                        <strong>{{ $crypto['crypto']->code }}
                                                            {{ $crypto['amount'] }}</strong></h5>
                                                    <span class="precio-crypto">USD {{ $crypto['conver'] }}</span>
                                                </div>
                                                <strong class="color-succes">0 (0%) <span class="ml-2"><i
                                                            class="fas fa-arrow-up"></i></span> </strong>
                                                <a class="btn py-2 btn-comprar"
                                                    href="/dash/buycrypto/{{ $crypto['crypto']->id }}">
                                                    <span class="mr-2"><img
                                                            src="{{ asset('dashboard/assets/img/wallets/btn-crypto.svg') }}"
                                                            alt=""></span>@lang('dash_wallets.wallets_to_buy')
                                                </a>
                                                <a class="btn mx-auto d-lg-none mt-2"
                                                    href="/dash/buycrypto/{{ $crypto['crypto']->id }}">
                                                    <small>@lang('dash_wallets.wallets_to_buy')</small></a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-custom-comprar" id="wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-blue" id="exampleModalLabel"
                    >@lang('dash_general.retiro') <span
                            class="title-crypto"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" role="alert">
                        <p style="line-height:28px"> You do not have enough <span class="title-crypto"></span> to send to
                            another <span class="title-crypto"></span> wallet outside Damecoins! Please purchase more <span
                                class="title-crypto"></span> and try again!</p>
                    </div>
                    <div style="display: flex; justify-content: center">
                        <a class="btn btn-info mt-2 py-2 btn-block" href="/dash/buy"> @lang('dash_general.buy') <span
                                class="title-crypto"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on("click", ".open-AddBookDialog", function() {
            
        });

    </script>

@endsection
