@extends('layouts_dash.dash')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    <div class="principal-section pb-3 " id="principal-section">
        <div class="wallets-section">
            @include('layouts_dash.menu_dashboard_header')

            <div class="container mt-5  d-lg-none ">
                <div class="row">
                    <div class="col-12  d-flex justify-content-between ">
                        <strong class="h5 mr-3 my-0 py-0">@lang("dash_prices.wallet")</strong>
                        <div class="select-container">
                            <span><i class="fas fa-angle-down"></i></span>
                            {!! Form::select('getCurrencies', $getCurrencies, $defaultCurrency->id, ['id' => 'getCurrencies', 'class' => 'form-control', 'onchange' => 'currencyChange(this);', 'data-default' => $defaultCurrency->code, 'data-symbol' => $defaultCurrency->symbol]) !!}
                        </div>
                    </div>
                </div>
            </div>




            <div class="container nav-wallets d-lg-none ">
                <a class="active" href="#">@lang("dash_prices.fiat")</a>
                <a href="#">@lang("dash_prices.cripto")</a>

                <div class="search-walelts">
                    <span><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="@lang("dash_prices.seach")">
                </div>

            </div>
         

            <div class="container d-none d-lg-block" id="section_one">
                <div class="d-flex justify-content-center mt-5 " id="spinerx">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="table-responsive-custom mt-4" id="container_crypto" style="display:none">
                    <table id="table_id" class="display" data-page-length='50'>
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div>@lang('dash_prices.table_cripto')</div>
                                </th>
                                <th scope="col">
                                    <div>@lang('dash_prices.table_market')</div>
                                </th>
                                <th scope="col">
                                    <div>@lang('dash_prices.table_price')</div>
                                </th>
                                <th scope="col">
                                    <div>@lang('dash_prices.table_change')</div>
                                </th>
                                <!--
                                <th scope="col">
                                    <div>@lang('dash_prices.table_profit')</div>
                                </th>-->
                                <th scope="col" class="text-right">
                                    <!--
                                    <a href="#"
                                        class=" text-white color-succes ">@lang('dash_prices.see_all')</a>
                                -->
                                    </th>
                            </tr>
                        </thead>
                        <tbody class="tbody-card ">

                            @foreach ($list as $a)

                                <tr>
                                    <td>
                                        <span class="name-js d-none">{{ $a['name'] }}</span>
                                        <img src="{{ asset('uploads/img') }}/{{ $a['img'] }}" class="img-coin img-fluid  mr-2" alt=""
                                            width="50">
                                        <span class="is-symbol-search-js">{{ $a['code'] }}</span>
                                    </td>
                                    <td >{{ Dashboard::convertK($a['max_supply']) }} </td>
                                    <td > {{ $a['price'] }} {{ $defaultCurrency->code }} </td>
                                    <td class="color-succes">
                                        @if ($a['change'] > 0)
                                            +{{ round($a['change'],2) }}%
                                        @elseif($a['change'] == 0)
                                            <span class="color-succes">{{ $a['change'] }}%</span>
                                        @else
                                            <span class="text-danger">{{ round($a['change'],2) }}%</span>
                                        @endif
                                    </td>
                                    {{--
                                    <td>
                                        
                                        <div class="container-miniChart"
                                            onclick="viewChart('{{ $a['symbol'] }}', 168, this);">
                                            <button
                                                class="btn btn-primary-custom-gradient active m-1">@lang('home.table_view_metrics')</button>
                                        </div>
                                        
                                    </td>--}}
                                    <td>
                                        <a href="/dash/buycrypto/{{ $a["id"] }}"
                                            class="btn btn-primary-custom-gradient active m-1">@lang('dash_general.buy')</a>
                                    </td>
                                </tr>

                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container mt-4 d-lg-none">

                <div class="row">

                    @foreach ($list as $a)

                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header d-flex justify-content-start pb-1">
                                    <img src="{{ asset('uploads/img') }}/{{ $a['img'] }}" class="img-coin img-fluid  mr-1" alt="" width="50"
                                        height="auto">

                                    <span class="ml-2"><strong>{{ $a['name'] }}</strong> <br>
                                       </span>
                                    <span class="ml-auto text-right">

                                        @if ($a['change'] > 0)
                                            +{{ $a['change'] }}%
                                        @elseif($a['change'] == 0)
                                            <span class="text-white">{{ $a['change'] }}%</span>
                                        @else
                                            <span class="text-danger">{{ $a['change'] }}%</span>
                                        @endif


                                    </span>
                                </div>
                                <div class="card-body">
                                    <h6> Market cap  {{ $a['max_supply'] }}</h6>
                                    <div class="container-miniChart mt-2 d-none">
                                        <canvas id="miniChart"></canvas>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap justify-content-sm-center mt-3">
                                        <a class="btn  btn-info px-4"
                                        href="/dash/buycrypto/{{ $a["id"] }}">@lang('dash_general.buy')</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>


        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                "ordering": false
            });
            $('#spinerx').remove();
            $('#container_crypto').css("display", "block");
        });

    </script>


@endsection
