<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <!-- <script src="https://www.google.com/recaptcha/api.js"></script> -->
  <!--<script src="https://www.googleoptimize.com/optimize.js?id=OPT-5HWF6K3"></script>
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>-->

    <script>
        document.cookie = 'same-site-cookie=foo; SameSite=Lax';
        document.cookie = 'cross-site-cookie=bar; SameSite=None; Secure';
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="verification" content="fa2674c0bd092920cd254680ce7b7e" />
    
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
    

    <!-- Stylesheets -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" async></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app_landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newCss.css') }}">
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">


    {{-- Recaptcha --}}
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-11065338-21"></script>-->
     <!--<script
    src="https://www.paypal.com/sdk/js?client-id=AbFEs_YXWaJT26GJpzQwiFcqV9YNqKc2JCacSdu2XAzERAbqpYQ3sP6MPZAYiEZqXCGHwQ98fwxGBE9c&currency=USD" data-sdk-integration-source="button-factory">
    
    </script>-->

  
    {!! NoCaptcha::renderJs() !!}
   
    <!-- @if(isset($fiat))
        <script src="https://www.paypal.com/sdk/js?client-id=Ab9xtuAi1-NZeXfJtn-Lb978wZ7RTrpmWJJlBnUdiKNi8XTa1rodbtA1aoNutGe8JpYWeKmFuYGMVCOb&currency={{$fiat}}&disable-funding=credit,bancontact,blik,eps,giropay,ideal,mybank,p24,sepa,sofort,venmo" data-sdk-integration-source="button-factory"></script>
   @endif-->


    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11065338-21"></script>
      <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-11065338-21');
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

@if(env('APP_ENV')=="production")
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
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('partials.carrousel')
    @yield('content')
    @yield('footer')

    <!-- Scripts -->
    <script src="{{ asset('js/chart.js') }}" async></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="{{ asset('js/preloder.js') }}" async></script>
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>



    @yield('js')

    <script type="text/javascript">
        $(document).ready(function() {


//empleo el linkx solo para el enlace del header y el link normal quedo igual para el estilo
            $('nav.navbar .nav-linkx').click(function(event) {
                event.preventDefault();

                if($($(this).attr('href')).length > 0) {
                    $('html, body').animate({
                        scrollTop: $($(this).attr('href')).offset().top
                    }, 1000);
                } else {
                    window.location.href = '/' + $(this).attr('href');
                }
            });

            $('#testimonialsCarousel').slick({
                autoplay: true,
                prevArrow: $('#prevArrowTestimonialCarousel'),
                nextArrow: $('#nextArrowTestimonialCarousel')
            });

            $('#how-it-works-carousel').slick({
                autoplay: true,
                arrows: false
            });

            $('#comparison-carousel').slick({
                slidesToShow: 6,
                infinite: false,
                arrows: false,
                responsive: [
                    {
                      breakpoint: 1200,
                      settings: {
                        slidesToShow: 6
                      }
                    },
                    {
                      breakpoint: 992,
                      settings: {
                        slidesToShow: 4,
                        dots: true,
                        appendDots: '#comparison-carousel-dots'
                      }
                    },
                    {
                      breakpoint: 768,
                      settings: {
                        slidesToShow: 3,
                        dots: true,
                        appendDots: '#comparison-carousel-dots'
                      }
                    },
                    {
                      breakpoint: 480,
                      settings: {
                        slidesToShow: 1,
                        dots: true,
                        initialSlide: 2,
                        appendDots: '#comparison-carousel-dots'
                      }
                    }
                ]
            });

            $('#card-behavior-buy-sell-btc-carousel').slick({
                slidesToShow: 3,
                infinite: true,
                arrows: false,
                autoplay: true,
                centerMode: true,
                centerPadding: '150px',
                responsive: [
                    {
                      breakpoint: 1200,
                      settings: {
                        slidesToShow: 2,
                        centerPadding: '75px'
                      }
                    },
                    {
                      breakpoint: 992,
                      settings: {
                        slidesToShow: 2,
                        centerPadding: '75px'
                      }
                    },
                    {
                      breakpoint: 767,
                      settings: {
                        slidesToShow: 1,
                        centerPadding: '50px'
                      }
                    }
                ]
            });

            $('#payment-methods-carousel').slick({
                slidesPerRow: 2,
                slidesToScroll: 1,
                infinite: true,
                rows: 2,
                prevArrow: '',
                nextArrow: $('#payment-methods-carousel-prev-button'),
                responsive: [
                    {
                      breakpoint: 1200,
                      settings: {
                        slidesPerRow: 1,
                      }
                    },
                    {
                      breakpoint: 992,
                      settings: {
                        slidesPerRow: 1,
                      }
                    },
                    {
                      breakpoint: 767,
                      settings: {
                        slidesPerRow: 1,
                      }
                    }
                ]
            });

            $('#features-amex-carousel').slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                prevArrow: '',
                dots: true,
                nextArrow: $('#features-amex-carousel-prev-button'),
                responsive: [
                    {
                      breakpoint: 1200,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                      }
                    },
                    {
                      breakpoint: 992,
                      settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                      }
                    },
                    {
                      breakpoint: 767,
                      settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                      }
                    }
                ]
            });

            $('#how-it-works-carousel').on('afterChange', function(event, slick, currentSlide){
              $('.carousel-steps > .step').removeClass('active');
              $($('.carousel-steps > .step')[currentSlide]).addClass('active');
            });



            if(document.getElementById('chart-results-buy-sell-btc') != null) {
                var ctx = document.getElementById('chart-results-buy-sell-btc').getContext('2d');

                var gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(76, 132, 255,1)');
                gradient.addColorStop(1, 'rgba(133, 255, 255,0.05)');

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                        datasets: [{
                            //backgroundColor: 'rgba(0, 178, 255, 0.75)',
                            backgroundColor: gradient,
                            borderColor: 'rgba(76, 132, 255,1)',
                            data: [12, 19, 8, 5, 10, 7],
                            label: 'Dataset 1',
                            fill: 'origin'
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                            label: function(tooltipItem) {
                            console.log(tooltipItem)
                                return tooltipItem.yLabel;
                            }
                          }
                        },
                        maintainAspectRatio: false,
                        spanGaps: false,
                        elements: {
                            line: {
                                tension: 0.000001
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#ffffff"
                                },
                                gridLines: {
                                    color: '#C3C3C3',
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: "#ffffff"
                                },
                                gridLines: {
                                    color: '#C3C3C3',
                                    display: false
                                }
                            }]
                        }
                    }
                });
            }

            @yield('scripts')
        });
    </script>

    <script type="text/javascript">
          var menu =  document.getElementById('menu-landing');
          window.addEventListener('scroll', () => {
            if(window.pageYOffset > 50){
              menu.classList.add('navbar-landing-fixed');
              menu.style.paddingTop = '0';
              $("#lgnAbs").css('z-index', '999');
            }else{
              menu.classList.remove('navbar-landing-fixed');
              menu.style.paddingTop = '6.5rem';
              $("#lgnAbs").css('z-index', '99999');
            }
          });

          if(window.pageYOffset > 70){
              menu.classList.add('navbar-landing-fixed');
              menu.style.paddingTop = '0';
              $("#lgnAbs").css('z-index', '999');
            }else{
              menu.classList.remove('navbar-landing-fixed');
              menu.style.paddingTop = '6.5rem';
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
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#Slider-Cotiza').owlCarousel({
                    margin:  30 ,
                    loop:true,
                    autoWidth:true,
                    items:5,
                    dots: false,
                    autoplay:true,
                    autoplayTimeout:5000,
                    autoplayHoverPause:true,
                });
            })(jQuery);
        });
    </script>

  
</body>
</html>