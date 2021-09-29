@extends('layouts_dash.dash')
@section('content')

    



    <div class="principal-section pb-3 " id="principal-section">
        <div class="movimientos-section">

            <div class="container d-lg-none mt-5 mb-2">
                <h5>Movements</h5>
            </div>

            <div class="container first-section ">
                <div class="card card-blue">
                    <div class="card-header">
                        <h6>Filter by</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <h6>date</h6>
                                <div class="mt-3 d-flex justify-content-start flex-wrap flex-row align-items-center">
                                    <button class="btn btn-primary-custom-gradient active m-1">All</button>
                                    <button class="btn btn-primary-custom-gradient m-1">24 H</button>
                                    <button class="btn btn-primary-custom-gradient m-1">1 Month</button>
                                    <button class="btn btn-primary-custom-gradient m-1">3 Month</button>
                                    <button class="btn btn-primary-custom-gradient m-1">6 Month</button>
                                </div>

                                <div class="mt-3">
                                    <!-- <input id="date" class="btn m-1" type="date" data-date-format="DD-MM-AAAA"> -->
                                    <span class="d-none d-sm-inline"> -</span>
                                    <input id="date" class="btn m-1" type="date" data-date-format="DD-MM-AAAA">
                                </div>

                            </div>
                            <div class="col-12 col-lg-5 mt-4 mt-lg-0">
                                <h6>Operación</h6>
                                <div class="mt-3 d-flex justify-content-start flex-wrap flex-row">
                                    <button class="btn btn-primary-custom-gradient active m-1">All</button>
                                    <button class="btn btn-primary-custom-gradient m-1">Buy</button>
                                    <button class="btn btn-primary-custom-gradient m-1">Sell</button>
                                    <button class="btn btn-primary-custom-gradient m-1">Deposit</button>
                                    <button class="btn btn-primary-custom-gradient m-1">Retirement</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container d-lg-none">
                <div class="row">
                    @forelse (Auth::user()->payments as $payment)
                    <div class="col-12 col-md-6">
                        <div class="card ">
                            <div class="card-body d-flex justify-content-between px-2 px-sm-3 py-2">
                                <div class="d-flex flex-wrap">
                                    <img src="/dashboard/assets/img/precio/icon-bitcointwo.svg"
                                        class="img-fluid  img-coin m-1" alt="">
                                    <div class="">
                                       <!-- <span>Bitcoin</span>--> <br>
                                        <small>{{ $payment->created_at }}</small>
                                    </div>
                                </div>

                                <div class=" d-flex align-items-center ">
                                    <div class="d-flex flex-column ">
                                        <span class="text-center">{{ $payment->total }} {{ $payment->currency->code }}</span>
                                        <small class="color-danger text-center"> <img
                                                src="/dashboard/assets/img/movimientos/venta-small.png" alt="">
                                            </small>
                                    </div>
                                    <span class="mx-3">|</span>
                                    <a href="#" class="text-decoration-none color-succes text text-center> <img class="
                                        icon-table mr-2" src="/dashboard/assets/img/movimientos/descarga.png"
                                        alt="">Receipt</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @empty
                    <p>There are no registered movements</p>
                @endforelse


                </div>
            </div>

            <div class="container second-section mt-4 d-none d-lg-block ">

                <div class="table-responsive table-responsive-custom">
                    <table class="table table-striped">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                                <th scope="col">Runway</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            @forelse (Auth::user()->payments as $payment)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $payment->created_at }}</td>
                                    <td>{{ General::getTypePayment($payment->status) }}</td>
                                    <td>{{ $payment->total }} {{ $payment->currency->code }}</td>
                                    <td>{{ $payment->pasarela }}</td>

                                </tr>
                            @empty
                                <p>There are no registered movements</p>
                            @endforelse

                        </tbody>
                    </table>
                    {{--  
                    <table class="table table-custom-collapse" style="display:none">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div>Cripto</div>
                                </th>
                                <th scope="col">
                                    <div>Transacción</div>
                                </th>
                                <th scope="col">
                                    <div>Cantidad</div>
                                </th>
                                <th scope="col">
                                    <div>Fecha</div>
                                </th>
                                <!--
                                <th scope="col">
                                    <div>Recibo</div>
                                </th>
                            -->
                            </tr>
                        </thead>
                        <tbody class="tbody-card ">

                            <tr>
                                <td>
                                    <img src="/dashboard/assets/img/precio/icon-bitcointwo.svg"
                                        class="img-fluid  img-coin mr-2" alt="">
                                    <span>Bitcoin</span>
                                </td>
                                <td class="color-danger-light text-left"> <img class="icon-table ml-5 mr-2"
                                        src="/dashboard/assets/img/movimientos/venta.png" alt=""> Venta</td>
                                <td> 1,2</td>
                                <td> 10 /05 /2020 </td>
                                <!--
                                <td>
                                    <a href="#" class="text-decoration-none color-succes"> <img class="icon-table mr-2"
                                            src="/dashboard/assets/img/movimientos/descarga.png" alt="">Descargar recibo</a>
                                </td>
                            -->
                            </tr>



                        </tbody>
                    </table>
                    --}}
                </div>

            </div>



        </div>
    </div>
@endsection
