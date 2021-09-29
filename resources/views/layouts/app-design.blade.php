<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @section('meta_title')
    <title>DameCoins</title>
    @show
    <!-- /Page title -->
    @section('meta_tags')
    <!-- Seo Tags -->
    <meta name="description" content="Your page description here" />
    <meta name="keywords" content="Your meta keywords, here" />
    <meta name="robots" content="index, follow">
    <!-- /Seo Tags -->
    @show
    <!-- CSRF Token <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <title></title>
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" />

    {{--  Styles  --}}
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('new-design/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/index/app.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/index/feature.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/index/about.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/index/process.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/index/fact.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/index/questions.css') }}">
    <link rel="stylesheet" href="{{ asset('new-design/css/footer.css') }}">
    <style type="text/css">
        .header {
            position: relative;
            z-index: 100;
            overflow: hidden;
            min-height: 100vh;
        }
        .header:before {
            content: "";
            position: absolute;
            width: 2286.32px;
            height: 1367.09px;
            left: -520px;
            top: -438.81px;
            background: linear-gradient(91.48deg,#3552a2 -.6%,#09173e 56.01%);
            border-radius: 0 0 0 300px;
            -webkit-transform: rotate(-38.68deg);
            transform: rotate(-38.68deg);
        }
        .header .container-fluid:before {
            content: "";
            position: absolute;
            width: 1152.74px;
            height: 872.55px;
            left: 674.75px;
            top: -125.4px;
            background: #4c84ff;
            opacity: .1;
            border-radius: 45px;
            -webkit-transform: rotate(47.34deg);
            transform: rotate(47.34deg)
        }
        @media (min-width: 768px){
            .mt-md-4, .my-md-4 {
                margin-top: 1.5rem!important;
            }
        }
        .header .container-fluid {
            width: 90%;
        }
    </style>
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    <header class="header">
        @yield('content') 
    </header>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.10/cleave.min.js" defer></script>
    
    <script src="{{ asset('new-design/js/bootstrap-select.min.js') }}" defer></script>
    
    <script src="{{ asset('new-design/js/app.js') }}"></script>
    @yield('scripts')

</body>