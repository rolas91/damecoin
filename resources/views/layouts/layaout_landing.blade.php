<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://www.googleoptimize.com/optimize.js?id=OPT-5HWF6K3"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
  
    <script>
        document.cookie = 'same-site-cookie=foo; SameSite=Lax';
        document.cookie = 'cross-site-cookie=bar; SameSite=None; Secure';
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/app_landing.css')}}">
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
    <!-- /Seo Tags -->
    @endif

   

  </head>
  <body class="bg-white">

    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('partials.carrousel')
    {{-- Nav --}}
    @include('layouts.contents.ladding.nav')

    {{-- divContent --}}
    @include('layouts.contents.ladding.divContent')

    {{-- footer --}}
    @include('layouts.contents.ladding.footer')
    


  </body>
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js')}}"></script>

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

        var owl = $('#owl-carousel-compra');
        owl.owlCarousel();
        // Go to the next item
        $('#slider-compra-prev').click(function() {
            owl.trigger('next.owl.carousel');
        })
  
        $('.owl-dot').click(function () {
            owl.trigger('to.owl.carousel', [$(this).index(), 300]);
        });



    </script>

    @yield('js')

</html>