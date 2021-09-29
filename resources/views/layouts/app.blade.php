<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> @section('meta_title')
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

    <!-- Google Fonts -->
    <!--
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        -->
    <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>


    <!--
         <script src="https://js.stripe.com/v3/"></script>
   -->

    <script src="https://js.recurly.com/v4/recurly.js"></script>
    <link href="https://js.recurly.com/v4/recurly.css" rel="stylesheet" type="text/css">
    <style>
        .izquier {
            text-align: left !important;
            color: black !important
        }
        
        .paymentRecurly {
            background: rgb(231, 237, 255);
            padding: 15px;
            border-radius: 4px;
        }
        
        .izquiert {
            text-align: left !important;
            color: #75849a !important;
            margin: 0;
            padding: 0;
            margin-top: 1px;
        }
        
        #recurly-elements {
            width: 100%;
            padding: 10px
        }
        
        .recurly-hosted-field-number {
            width: 100% !important;
            margin: 0;
        }
        
        .recurly-hosted-field-month {
            width: 90%;
            margin: 0;
        }
        
        .recurly-hosted-field-year {
            width: 90%;
            margin: 0;
        }
        
        .recurly-hosted-field-cvv {
            width: 50%;
            margin: 0;
        }
    </style>


    <!--
    <script src="https://checkout.stripe.com/checkout.js"></script>
    -->
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/themify-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    
    <!--
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
        -->
    <!--
        <script src="https://checkout.stripe.com/checkout.js"></script>
        -->
    <!--

        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('css/angular-material/angular-material19.min.css')}}">
        <script type="text/javascript" src="{{ asset('angular/angular.min.js')}}"></script>
        -->
    <style>
        .feature-content p {
            color: #fff !important;
        }
        
        #idioma,
        #idioma2 {
            font-size: 0.7em;
            padding: 1px;
            height: calc(1.55rem + 2px);
        }
        
        .section-title p {
            color: #fff !important;
        }
        
        .fact p {
            color: #fff !important;
        }
        
        p {
            color: #20509e !important;
        }
        
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            width: 100%;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        
        tripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        
        tripeElement--invalid {
            border-color: #fa755a;
        }
        
        tripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        /* enable absolute positioning */
        
        .inner-addon {
            position: relative;
        }
        
        .color-input {
            background-color: #20509e !important;
            color: #fff;
            font-weight: bold;
        }
        /* style icon */
        
        .inner-addon .glyphicon {
            position: absolute;
            height: 100%;
            pointer-events: none;
            background-color: #20509e;
            color: white;
            border-radius: 3px;
            width: 50px;
            text-align: center;
            vertical-align: middle;
        }
        /* align icon */
        
        .left-addon .glyphicon {
            left: 0px;
        }
        
        .right-addon .glyphicon {
            right: 0px;
        }
        /* add padding  */
        
        .left-addon input {
            padding-left: 60px;
        }
        
        .right-addon input {
            padding-right: 60px;
        }
        
        .left-addon select {
            padding-left: 60px;
        }
        
        .right-addon select {
            padding-right: 60px;
        }
        
        .subt {
            margin: 0;
            padding: 0;
            color: gray !important;
            font-size: 14px;
            font-weight: bold;
        }
        
        .mibuttom {
            background-color: #ef8a13 !important;
            border: solid 1px #ef8a13 !important;
        }
        
        .sign {
            background-color: rgb(231, 237, 255);
            ;
            padding: 10px;
            margin: 8px !important;
        }
        
        .formx {
            padding: 5px !important;
        }
        
        .subt1 {
            margin: 0;
            padding: 0;
            color: gray !important;
            font-size: 12px;
            text-indent: 10px;
        }
        
        .other {
            color: gray !important;
            font-size: 14px;
        }
        
        #finalx p {
            margin: 3px;
            padding: 0;
            text-align: justify;
            color: gray !important;
            font-size: 13px;
        }
        
        .textcomi {
            margin: 0;
            padding: 0;
            color: gray !important;
            font-size: 12px;
            text-align: center;
        }
        
        .titulo {
            margin: 0;
            padding: 0;
            font-weight: bold;
        }
        
        .panelx {
            border: solid 1px #ccc !important;
            padding: 5px;
            margin: 8px !important;
            border-radius: 6px;
            background-color: #e7edff;
            cursor: pointer;
        }
        
        .panel_other {
            padding: 8px !important;
            margin: 10px !important;
        }
        
        .total {
            padding: 10px;
        }
        
        @media only screen and (max-width: 767px) {
            .header-section {
                padding: 15px 0;
                background: #fff;
            }
            .hero-section {
                height: auto;
                padding-bottom: 130px;
                padding-top: 120px;
                background-position: right 50% top;
            }
        }
        
        @media only screen and (max-width: 991px) and (min-width: 768px) {
            .hero-section {
                background-position: right 25% top;
                height: auto !important;
                padding-top: 130px !important;
            }
        }
        
        @media only screen and (max-width: 767px) {
            .header-section .site-btn {
                display: flex !important;
                justify-content: center;
                margin: .5rem 0;
                margin-left: 10%;
                width: 80%;
                float: unset;
            }
        }
        
        @media only screen and (min-width: 360px) and (max-width:419px) {
            .header-section .site-btn {
                margin: 1rem 0;
                margin-left: 12%;
                width: 76%;
            }
        }
        
        @media only screen and (min-width: 420px) and (max-width:566px) {
            .header-section .site-btn {
                margin: 1rem 0;
                margin-left: 20%;
                width: 60%;
            }
        }
        
        @media only screen and (min-width: 567px) and (max-width: 767px) {
            .header-section .site-btn {
                margin: 1rem 0;
                margin-left: 25%;
                width: 50%;
            }
        }
        
        .btn-warning-temp {
            color: #fff;
            background-color: #e7550e;
        }
        
        .btn-warning-temp:hover {
            color: #fff;
            background-color: #e76322f6;
        }
        
        .alert-warning p {
            color: #856404 !important;
        }
        
        .steps {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            list-style: none;
            margin: 0;
            padding: 0;
            width: 300px;
        }
        
        .steps li {
            position: relative;
            padding: 0px 0 40px 30px;
            border-left: 4px solid #fff;
            font-weight: bold;
            border-color: #20509e;
        }
        
        .steps li:before {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: block;
            position: absolute;
            left: -12px;
            content: " ";
            background: #f8f8f8;
            border-color: inherit;
            border-style: solid;
            border-width: 4px;
        }
        
        .steps li:last-of-type {
            padding-bottom: 20px;
        }
        /* .steps li:nth-of-type(1) {
            border-color: #f9c80e;
        }

        .steps li:nth-of-type(2) {
            border-color: #84c318;
        }

        .steps li:nth-of-type(3) {
            border-color: #3e92cc;
        }

        .steps li:nth-of-type(4) {
            border-color: #db2763;
        } */
        
        .copy {
            font-size: 14px;
            color: #333;
            display: block;
            font-weight: 400;
            margin-top: 5px;
        }
    </style>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11065338-21"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-11065338-21');
    </script>

    <!--
<script src="//code.tidio.co/60azmufq3r8t5vmahndtxni5zzv9omfy.js" async></script>
<script> document.tidioChatLang = "{{ app()->getLocale() }}"</script>
<style>  
@media only screen and (max-width: 991px) and (min-width: 768px){
.hero-section {
    background-position: right 25% top;
        height: auto!important;
    padding-top: 100px;
}
}
 #tidio-chat iframe { bottom: 3.5em !important; } @media only screen and (max-width: 980px) { #tidio-chat iframe { bottom: 90px !important; } } </style>

-->

    {{--
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
    </script> --}}
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('layouts.header') @yield('content') @include('layouts.footer')
    <!-- Scripts -->        <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" async></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" async></script>
    <script src="{{ asset('js/main.js') }}" async></script>
    <!--
        <script src="{{ asset('angular/angular-animate.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('angular/angular-aria.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('angular/angular-material.js')}}"></script>
        <script src="{{ asset('angular/angular-messages.min.js')}}"></script>
        <script src="{{ asset('js/angular-stripe-checkout.js')}}"></script>
        <script src="{{ asset('js/index.js')}}"></script>
        -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    @yield('scripts')

</body>

</html>