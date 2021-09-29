<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://www.googleoptimize.com/optimize.js?id=OPT-5HWF6K3"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
  
    <script>
        document.cookie = 'same-site-cookie=foo; SameSite=Lax';
        document.cookie = 'cross-site-cookie=bar; SameSite=None; Secure';
    </script>
    
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css')}}">
    <script src="{{ asset('assets/js/Chart.js')}}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/app_landing.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css')}}">
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" />
    
    @if(isset($meta))
    <!--@section('meta_title')
    <title>{{ $meta['title'] }}</title>
    @overwrite-->
    <title>{{ $meta['title'] }}</title>
    
    @section('meta_tags')

    
    <!-- Seo Tags -->
    <meta name="description" content="  {{ $meta['descripcion'] }}">
    <meta name="keywords" content="{{ $meta['key'] }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('img/damecoins/facebooklinkpreview.jpg')}}" />
    <meta property="og:url" content="https://damecoins.com/" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:description" content="{{ $meta['descripcion'] }}" />
    <meta name="verification" content="fa2674c0bd092920cd254680ce7b7e" />
    <!-- /Seo Tags -->
    @endif

    <link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
    <style>
      .intl-tel-input {
          position: relative;
          display: block;
      }

      #card_type, #cc, #mm, #yy, #cv, #sq-expiration-date, #sq-postal-code {
        background: #d8d9dc!important
    }
    </style>

@if(config('payment.APP_ENV')=="production")
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
    </script> 
@endif
  </head>
  <body class="bg-white">

      {{-- @include('landing.enviar') --}}
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('partials.carrousel')
    @include('layouts.contents.ladding.nav')  
    @yield('content')
    @include('partials.landing.footer')


  </body>
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js')}}"></script>

    
    @yield('js')


    <script>
     
        var menu =  document.getElementById('menu-landing');
          window.addEventListener('scroll', () => {
            if(window.pageYOffset > 50){
              menu.classList.add('navbar-landing-fixed');
              menu.style.paddingTop = '0';
              $("#lgnAbs").css('z-index', '999');
            }else{
              menu.classList.remove('navbar-landing-fixed');
              menu.style.paddingTop = '7.5rem';
              $("#lgnAbs").css('z-index', '99999');
            }
          });

          
						var d = new Date();
 						var n = d.getFullYear();
						 $('#date').text(n);
					

          if(window.pageYOffset > 70){
              menu.classList.add('navbar-landing-fixed');
              menu.style.paddingTop = '0';
              $("#lgnAbs").css('z-index', '999');
            }else{
              menu.classList.remove('navbar-landing-fixed');
              menu.style.paddingTop = '7.5rem';
              $("#lgnAbs").css('z-index', '99999');
            }


          var toggle = document.getElementById('toggle-menu');
          toggle.addEventListener('click', () => {
            if(window.pageYOffset > 70){
              menu.classList.add('navbar-landing-fixed')
            }else{
              menu.classList.toggle('navbar-landing-fixed')
            }
          });
        
   

       // Slider Compra
       $('#owl-carousel-compra').owlCarousel({
            nav: false,
            margin: 20,
            loop: true,
            autoWidth: true,
            autoplay: true,
            items: 5,
            dotsContainer: '#slider-compra-dots',
            URLhashListener: true,
            autoplayHoverPause: true,
            startPosition: 'URLHash'
        })

        var owlCompra = $('#owl-carousel-compra');
        owlCompra.owlCarousel();
        // Go to the next item
        $('#slider-compra-prev').click(function() {
            owlCompra.trigger('next.owl.carousel');
        })
  
        $('.owl-dot').click(function () {
            owlCompra.trigger('to.owl.carousel', [$(this).index(), 300]);
        });

        // Slider-Metodo de Pago 
        $('#owl-metodo-pago').owlCarousel({
            margin:5 ,
            loop:true,
            autoWidth:true,
            items:5,
            dotsContainer: '#slider-metodo-dots',
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            URLhashListener: true,
            autoplayHoverPause: true,
            startPosition: 'URLHash'
        })

        var owl = $('#owl-metodo-pago');
        owl.owlCarousel();
        // Go to the next item
        $('#slider-metodo-prev').click(function() {
            owl.trigger('next.owl.carousel');
        })

        $('.owl-dot').click(function () {
            owl.trigger('to.owl.carousel', [$(this).index(), 300]);
        });

    </script>

</html>