@extends('layouts_dash.dash')
@section('content')


    <div class="principal-section pb-3 " id="principal-section">
        <div class="perfil-section">

            <div class="container first-section">
                <div class="card">
                    <div class="card-body d-flex align-items-center">

                        <div class="img-perfil mt-3 mt-lg-0">
                            <img class="img-fluid" src="{{ asset('dashboard/assets/img/perfil/avatar.png') }}" alt="">
                        </div>

                        <div class="ml-4 mt-3 mt-lg-0">
                            <h5 class="my-0">{{ Auth::user()->name }} {{ Auth::user()->lastName }}</h5>
                            <p class="my-0">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="/logout" class="session-close"> @lang('dashboard_perfil.logout')</a>

                    </div>
                </div>
            </div>

            <div class="container">
                @if (Session::has('success'))
                    @include('dashboard.alerts.success',['mensage'=>Session::get('success')])
                @endif
                @if (Session::has('error'))
                    @include('dashboard.alerts.danger',['mensage'=>Session::get('error')])
                @endif
            </div>


            <div class="container mt-4">
                <div class="row">
                    <!--person-->
                    @include('dashboard.partials.perfil.personal')
                    <!--default -->

                    @include('dashboard.partials.perfil.ajustes')


                </div>
            </div>




        </div>
    </div>



@endsection
