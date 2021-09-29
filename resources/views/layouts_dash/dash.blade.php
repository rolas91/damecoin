<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/fm.selectator.jquery.css') }}" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--switalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11065338-21"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-11065338-21');
    </script>
    @if (env('APP_ENV') == 'production')
        <script type="text/javascript">
            window.Trengo = window.Trengo || {};
            window.Trengo.key = 'GKdX1ztIR4cVgtE9z1SC';
            (function(d, script, t) {
                script = d.createElement('script');
                script.type = 'text/javascript';
                script.async = true;
                script.src = 'https://static.widget.trengo.eu/embed.js';
                d.getElementsByTagName('head')[0].appendChild(script);
            }(document));
            window.Trengo.extraOffsetX = '22px';
            window.Trengo.extraOffsetY = '6rem';

        </script>
    @endif

    <style>
        #select-buy {
            color: oldlace
        }

        table.dataTable.display tbody tr.odd>.sorting_1,
        table.dataTable.order-column.stripe tbody tr.odd>.sorting_1 {
            background-color: transparent !important;
        }

        table.dataTable.display tbody tr.even>.sorting_1,
        table.dataTable.order-column.stripe tbody tr.even>.sorting_1 {
            background-color: transparent !important;
        }

        .hide {
            display: none;
        }

    </style>

    <script src="{{ asset('dashboard/assets/js/Chart.js') }}"></script>
    <title>{{ $meta['title'] ? $meta['title'] : '' }}</title>
</head>

<body>


    @include('layouts_dash.menu_dashboard')
    @include('layouts_dash.menu_dashboard_mobile')

    <!--test git-->
    @yield('content')


    <section style="float:right;padding:10px; margin: 0 0 1em 0;">
        {!! Form::select('idioma2', config('idioma.' . App::getLocale()), App::getLocale(), [
    'id' => 'idioma2',
    'class' => 'form-control',
]) !!}
    </section>


    <!-- CDN -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('/dashboard/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/js/fm.selectator.jquery.js') }}"></script>
    <!-- CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        $("#idioma2").change(function() {
            var lang = $(this).val();
            window.location = '/lang/' + lang;
        });


        /** Select **/
        $('#select-comprar').selectator();

        /* var btnCompra = document.getElementById('button-Comprar');

         btnCompra.addEventListener('click', () => {
             document.getElementById('list-item').classList.toggle('active');
             btnCompra.classList.toggle('show');
         })*/


        //Navbar Móvil
        let menu_operar = document.getElementById('menu-operar');
        let btn_nav = document.getElementById('btn-nav');

        btn_nav.addEventListener('click', () => {
            btn_nav.classList.toggle('active');

            menu_operar.classList.toggle('show-menu-operar');

        });


        //NAVBAR
        let toggler_nav = document.getElementById('toggler-nav');
        let navbar_custom = document.getElementById('navbar-custom');
        let principal = document.getElementById('principal-section');
        let navHorizontal = document.getElementById('nav-horizontal');


        toggler_nav.addEventListener('click', () => {
            navbar_custom.classList.toggle('navbar-custom-small');
            principal.classList.toggle('principal-section-large');
            navHorizontal.classList.toggle('nav-horizontal-large');

            if (navbar_custom.classList.contains('navbar-custom-small')) {
                localStorage.setItem('navSmall', 'true');
            } else {
                localStorage.setItem('navSmall', 'false');
            }

        });

        if (localStorage.getItem('navSmall') === 'true') {
            navbar_custom.classList.toggle('navbar-custom-small');
            principal.classList.toggle('principal-section-large');
            navHorizontal.classList.toggle('nav-horizontal-large');
        }


        //DARK MODE
        let modeDarkChart;

        const btnDarkMode = document.getElementById('btn-dark-mode');
        const navHeader = document.getElementById('nav-header');
        btnDarkMode.addEventListener('click', () => {
            btnDarkMode.classList.toggle('active');
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('dark-mode', 'true');
                ClearChart();
                modeDarkChart = 'true';
                showChart();
            } else {
                localStorage.setItem('dark-mode', 'false');
                ClearChart();
                modeDarkChart = 'false';
                showChart();
            }
        });

        if (localStorage.getItem('dark-mode') === 'true') {
            btnDarkMode.classList.add('active');
            document.body.classList.add('dark-mode');
            modeDarkChart = 'true';
        } else {
            modeDarkChart = 'false';
        }

        function soloNumeros(e) {

            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " 1234567890";
            especiales = [8, 37, 39, 46];

            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }

            }


            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }

    </script>





    </script>
    <script type="text/javascript" src="/dashboard/assets/js/code.js"></script>

</html>
