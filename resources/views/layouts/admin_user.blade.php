<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
  <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->

  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">

  <style>
    .skin-blue .sidebar-menu>li.header {
      background: transparent;
    }

    .mb-2 {
      margin-bottom: .5rem;
    }

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

    .help-block {
      color: red;
    }
  </style>
  <!-- Morris chart -->

  <!--
  <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css')}}">
  -->
  <!-- jvectormap -->
  <!--
  <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  -->
  <!-- Date Picker -->
  <!--
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  -->
  <!-- Daterange picker -->
  <!--
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  -->
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
  <!-- Google Font -->

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!--
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
-->
  <style>
    .circulo {
      width: 5rem;
      height: 5rem;
      border-radius: 50%;
      background: #ccc;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      margin: 0px auto;
      padding: 3%
    }

    .circulo>h2 {
      font-family: sans-serif;
      color: white;
      font-size: 1.3rem;
      font-weight: bold;
    }

    .final {
      color: #ef8a13 !important;
      text-align: right;
      font-weight: bold;
      font-size: 1.2em;
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

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }

    .panelx {
      border: solid 1px #ccc !important;
      padding: 4px 20px;
      margin: 8px 0!important;
      border-radius: 6px;
      background-color: #e7edff;
      cursor: pointer;
    }

    input-group>.form-control:not(:first-child) {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    .input-group {
      position: relative;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      -webkit-box-align: stretch;
      -ms-flex-align: stretch;
      align-items: stretch;
      width: 100%;
    }

    .input-group-prepend {
      margin-right: -1px;
    }

    .input-group-append,
    .input-group-prepend {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
    }

    .input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle),
    .input-group>.input-group-append:last-child>.input-group-text:not(:last-child),
    .input-group>.input-group-append:not(:last-child)>.btn,
    .input-group>.input-group-append:not(:last-child)>.input-group-text,
    .input-group>.input-group-prepend>.btn,
    .input-group>.input-group-prepend>.input-group-text {
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
    }

    .color-input {
      background-color: #20509e !important;
      color: #fff;
      font-weight: bold;
    }

    .input-group-text {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      padding: .375rem .75rem;
      margin-bottom: 0;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      text-align: center;
      white-space: nowrap;
      background-color: #e9ecef;
      border: 1px solid #ced4da;
      border-radius: .25rem;
    }

    select.form-control:not([size]):not([multiple]) {
      /*height: calc(2.25rem + 2px);*/
    }

    .color-input {
      background-color: #20509e !important;
      color: #fff;
      font-weight: bold;
    }

    .input-group>.custom-select:not(:first-child),
    .input-group>.form-control:not(:first-child) {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    .input-group>.custom-file,
    .input-group>.custom-select,
    .input-group>.form-control {
      position: relative;
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      width: 1%;
      margin-bottom: 0;
    }



    input-group>.input-group-append>.btn,
    .input-group>.input-group-append>.input-group-text,
    .input-group>.input-group-prepend:first-child>.btn:not(:first-child),
    .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child),
    .input-group>.input-group-prepend:not(:first-child)>.btn,
    .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    .input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle),
    .input-group>.input-group-append:last-child>.input-group-text:not(:last-child),
    .input-group>.input-group-append:not(:last-child)>.btn,
    .input-group>.input-group-append:not(:last-child)>.input-group-text,
    .input-group>.input-group-prepend>.btn,
    .input-group>.input-group-prepend>.input-group-text {
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
    }

    .color-input {
      background-color: #20509e !important;
      color: #fff;
      font-weight: bold;
    }


    .titulo {
      margin: 0;
      padding: 0;
      font-weight: bold;
      color: #20509e !important;
    }

    .subt1 {
      margin: 0;
      padding: 0;
      color: gray !important;
      font-size: 12px;
      text-indent: 10px;
    }

    .subt {
      margin: 0;
      padding: 0;
      color: gray !important;
      font-size: 14px;
      font-weight: bold;
    }

    .textcomi {
      margin: 0;
      padding: 0;
      color: gray !important;
      font-size: 12px;
      text-align: center;
    }

    .modal-open {
      overflow: hidden
    }

    .modal {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      z-index: 1050;
      display: none;
      overflow: hidden;
      outline: 0
    }

    .modal-open .modal {
      overflow-x: hidden;
      overflow-y: auto
    }

    .modal-dialog {
      position: relative;
      width: auto;
      margin: .5rem;
      pointer-events: none
    }

    .modal.fade .modal-dialog {
      transition: -webkit-transform .3s ease-out;
      transition: transform .3s ease-out;
      transition: transform .3s ease-out, -webkit-transform .3s ease-out;
      /*-webkit-transform: translate(0, -25%);
transform: translate(0, -25%)*/
    }

    .modal.show .modal-dialog {
      -webkit-transform: translate(0, 0);
      transform: translate(0, 0)
    }

    .modal-dialog-centered {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      min-height: calc(100% - (.5rem * 2))
    }

    .modal-content {
      position: relative;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      -ms-flex-direction: column;
      flex-direction: column;
      width: 100%;
      pointer-events: auto;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid rgba(0, 0, 0, .2);
      border-radius: .3rem;
      outline: 0
    }

    .modal-backdrop {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      z-index: 1040;
      background-color: #000
    }

    .modal-backdrop.fade {
      opacity: 0
    }

    .modal-backdrop.show {
      opacity: .5
    }

    .modal-header {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: start;
      -ms-flex-align: start;
      align-items: flex-start;
      -webkit-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
      padding: 1rem;
      border-bottom: 1px solid #e9ecef;
      border-top-left-radius: .3rem;
      border-top-right-radius: .3rem
    }

    .modal-header .close {
      padding: 1rem;
      margin: -1rem -1rem -1rem auto
    }

    .modal-title {
      margin-bottom: 0;
      line-height: 1.5
    }

    .modal-body {
      position: relative;
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      padding: 1rem
    }

    .modal-footer {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: end;
      -ms-flex-pack: end;
      justify-content: flex-end;
      padding: 1rem;
      border-top: 1px solid #e9ecef
    }

    .modal-footer>:not(:first-child) {
      margin-left: .25rem
    }

    .modal-footer>:not(:last-child) {
      margin-right: .25rem
    }

    .modal-scrollbar-measure {
      position: absolute;
      top: -9999px;
      width: 50px;
      height: 50px;
      overflow: scroll
    }

    @media (min-width:576px) {
      .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto
      }

      .modal-dialog-centered {
        min-height: calc(100% - (1.75rem * 2))
      }

      .modal-sm {
        max-width: 300px
      }
    }

    @media (min-width:992px) {
      .modal-lg {
        max-width: 800px
      }
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

    .align-items-center {
      -webkit-box-align: center !important;
      -ms-flex-align: center !important;
      align-items: center !important;
    }

    .justify-content-center {
      -webkit-box-pack: center !important;
      -ms-flex-pack: center !important;
      justify-content: center !important;
    }

    .d-flex {
      display: -webkit-box !important;
      display: -ms-flexbox !important;
      display: flex !important;
    }
  </style>
  <!--
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
-->
  <!-- jQuery UI 1.11.4 -->
  <!--
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
-->
  <script src="https://js.stripe.com/v3/"></script>
  <script src="https://checkout.stripe.com/checkout.js"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11065338-21"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-11065338-21');
  </script>
  <!--
<script src="//code.tidio.co/60azmufq3r8t5vmahndtxni5zzv9omfy.js" async></script>
<script> document.tidioChatLang = "{{ app()->getLocale() }}"</script>-->

@if(env("APP_ENV")=="production")
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
 window.Trengo.extraOffsetX = '12px';
window.Trengo.extraOffsetY = '4rem';
  </script>
  
@endif

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('layouts.header_user') @yield('content')


  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <!-- <b>Version</b> 1.0-->

    </div>

    <strong>DAME Banking Group Ltd. </strong> <br> 
    27 Old Gloucester Street London, <br> WC1N 3AX , United Kingdom. <br>

    <strong>
      Copyright © 2020 DameCoins.
    </strong> All rights
    reserved.


    <div style="float:right;padding:10px">
      {!!Form::select('idioma2',config('idioma.'.App::getLocale()) ,App::getLocale(), [
      'id' => 'idioma2',
      'class' => 'form-control'
      ])!!}
    </div>
  </footer>
  <!-- jQuery 3 -->

  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>

  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- Morris.js charts -->

  <script src="{{ asset('bower_components/raphael/raphael.min.js')}}"></script>
  <script src="{{ asset('bower_components/morris.js/morris.min.js')}}"></script>

  <!-- Sparkline -->
  <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- datepicker -->

  <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>


  <script src="{{ asset('js/jquery-3.2.1.min.js') }}" async></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js')}}"></script>

  @yield('js')

  <script>
    $("#idioma2").change(function () {
      var lang = $(this).val();
      window.location='/lang/'+lang;
    });

    var loc = window.location.href;

    if (loc.endsWith("/")) {
      loc = loc.substring(0, loc.length - 1);
    }

    $('.sidebar-menu').find('a').each(function() {
      $(this).parent().toggleClass('active', $(this).attr('href') == loc);
    });
  </script>
</body>

</html>