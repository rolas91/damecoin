@extends('layouts_dash.dash')
@section('content')
    <!--datatable solo portafolio y precios-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    <div class="principal-section " id="principal-section">
        <div class="portafolio-section">

            @include('layouts_dash.menu_dashboard_header')

            <div class="container d-none d-lg-block">
                @if (Session::has('success'))
                    @include("dashboard.alerts.success",["mensage"=>Session::get("success")])
                @endif

                {{-- @include("dashboard.alerts.phone") --}}

                <div class="d-flex justify-content-center mt-5 " id="spinerx">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="">
                </div>

                <div class="table-responsive-custom mt-4" id="container_crypto" style="display: none">
                    <!--<table class="table table-custom-collapse" >-->
                    <table id="table_id" class="display" data-page-length='50'>
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div>@lang('dash_portafolio.table_cripto')</div>
                                </th>
                                <th scope="col">
                                    <div>@lang('dash_portafolio.table_market')</div>
                                </th>
                                <th scope="col">
                                    <div>@lang('dash_portafolio.table_price')</div>
                                </th>
                                <th scope="col">
                                    <div>@lang('dash_portafolio.table_change')</div>
                                </th>
                                <!--
                                                <th scope="col">
                                                    <div>@lang('dash_portafolio.table_profit')</div>jjj
                                                </th>
                                            -->
                                <th scope="col" class="text-right"><a href="#"
                                        class=" text-white color-succes ">{{-- @lang('dash_portafolio.see_all') --}}</a> </th>
                            </tr>
                        </thead>
                        <tbody class="tbody-card ">

                            @foreach ($list as $a)

                                <tr>
                                    <td>
                                        <img src="{{ asset('uploads/img/' . $a['img']) }}"
                                            class="img-coin img-fluid  mr-2" alt="" width="50">
                                        <span>{{ $a['name'] }}</span>
                                    </td>
                                    <td> {{ Dashboard::convertK($a['max_supply']) }} </td>
                                    <td > {{ $a['price'] }} {{ $defaultCurrency->code }}</td>
                                    <td class="color-succes">

                                        @if ($a['change'] > 0)
                                            +{{ round($a['change'], 2) }}%
                                        @elseif($a['change'] == 0)
                                            <span>{{ $a['change'] }}%</span>
                                        @else
                                            <span class="text-danger">{{ round($a['change'], 2) }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/dash/buycrypto/{{ $a['id'] }}"
                                            class="btn btn-primary-custom-gradient active m-1 ">
                                            @lang('dash_portafolio.buy')
                                        </a>
<!--
                                        <a href="https://www.tradingview.com/chart/?symbol=BINANCE%3AELFUSD"
                                            class="btn btn-primary-custom-gradient active m-1 ">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
                                            </svg>
                                        </a>
                                    -->

                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container mt-4 d-lg-none">
                <div class="d-flex  justify-content-between">
                    <h5>@lang('dash_portafolio.table_cripto')</h5>
                </div>

                <div class="row">
                    @foreach ($list as $a)

                        <div class="col-12 col-sm-6 col-md-4 mt-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-start ">
                                    <img src="{{ asset('uploads/img/' . $a['img']) }}" class="img-coin mr-1" alt=""
                                        style="width:40px!important;height:40px!important">
                                    <span class="ml-2"><strong></strong> <br>
                                        {{ $a['name'] }}</span>
                                </div>
                                <div class="card-body">
                                    <a href="/dash/buycrypto/{{ $a['id'] }}"
                                        class="btn btn-info btn-block mt-3 d-flex align-items-center justify-content-center ">
                                        <img class="mr-2" src="/dashboard/assets/img/portafolio/comprar.svg" alt="">
                                        @lang('dash_portafolio.buy')
                                    </a>

                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
            {{--
            <iframe src="https://www.tradingview.com/chart/?symbol=BINANCE%3AELFUSD" title="iframe Example 1" width="400" height="300">
                <p>Your browser does not support iframes.</p>
              </iframe>
              --}}
            {{-- pruaba insertando grafico en modal
            <div class="modal fade modal-custom-comprar" id="myModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Selecciona tu tarjeta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div id="select-tarjeta">

                                <div class="card-tarjeta">
                                    <input type="radio" name="radio">
                                    <span class="checkmark">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="card-div card-mastercard">
                                        <div class="card-info">
                                            <img class="placa" src="assets/img/perfil/placa.png" alt="">
                                            <p class="mt-1 mt-lg-2 mb-1">
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <strong>2345</strong>
                                            </p>
                                            <small class="m-0">EXP: 12/28</small>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="my-0">Nombre completo</p>
                                                <img class="img-fluid" src="assets/img/comprar/mastercard.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-tarjeta">
                                    <input type="radio" name="radio">
                                    <span class="checkmark">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="card-div  card-visa">
                                        <div class="card-info">
                                            <img class="placa" src="assets/img/perfil/placa.png" alt="">
                                            <p class="mt-2 mb-1">
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <span class="mr-3">****
                                                </span>
                                                <strong>2345</strong>
                                            </p>
                                            <small>EXP: 12/28</small>
                                            <div class="d-flex justify-content-between align-items-center py-2">
                                                <p class="my-0">Nombre completo</p>
                                                <img class="img-fluid" src="assets/img/comprar/visa.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <a href="#" class="btn-add-tarjeta  mx-auto mt-3">
                                <span><img src="assets/img/deposito/Mask.png" alt=""></span>
                                Agregar nueva tarjeta
                            </a>


                        </div>
                        <div class="modal-footer">
                            <button type=" button" class="btn text-white btn-info-gradient  mx-auto">
                                Selecionar
                                tarjeta</button>
                        </div>
                    </div>
                </div>
            </div>
            --}}

        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#table_id').DataTable({
                "ordering": false
            });
            $('#spinerx').remove();
            $('#container_crypto').css("display", "block");
            /*
                         $('.edit-link').click(function() {
                        $.ajax({
                            type: "GET",
                            url: $(this).attr('href')
                            alert("aquí entra");
                        }).done(function(html_form) {
                            alert("aquí no entra");
                            $('#select-tarjeta').html(html_form);
                            $('#myModal').show();
                        });
                        return false;
                    });
                    */

        });

    </script>


@endsection
