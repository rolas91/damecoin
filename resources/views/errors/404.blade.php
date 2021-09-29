<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/app_landing.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css')}}">

    <title>404</title>
  </head>
  <body class="bg-white">

    
    <div class="section-circunstancia">
        
       <div class="banner-404">
           <div class="container">
               <div class="row">
                   <div class="col-12 col-md-6">
                    <img  class="img-1" src="{{ asset('assets/img/404/Group.png') }}" alt="">
                   </div>
                   <div class="col-12 col-md-6 d-flex justify-content-center align-items-center flex-column">
                       <img class="img-2" src="{{ asset('assets/img/404/Group251.png') }}" alt="">

                       {{-- <button class="btn btn-info link-gradient-blue mx-1 mt-3">
                        <img class="mr-2" src="{{ asset('assets/img/Features/Group.png') }}" alt="">
                        Crear cuenta gratis
                       </button> --}}

                       <a href="{{ url('signup') }}" class="btn text-decoration-none link-gradient-blue  py-2 px-3 mt-3"> <img class="mr-2" src="{{ asset('assets/img/navbar-landing-page/nave.png')}}" alt=""> @lang('index.btnnewacc')</a>

                   </div>
               </div>
           </div>
       </div>

        {{-- <div class="container py-5">
            <h2 class="font-weight-bold text-center">Link de interes</h2>
        </div>

        <div class=" py-4 corte-1-blue">

            <div class="container ">
                  <div class="row">
                      <div class="col-12 col-lg-5">
                          <img src="assets/img/metodo-pago/Group17.png" alt="">
                          <h2 class="font-weight-bold">¿Ya tienes una <br class="d-none d-lg-block">  Billetera?</h2>
                          <p class="font-weight-bold h4" >Compra Bitcoin al instante con tu tarjeta de credito</p>
                
                          <ul class="list-punto mt-4">
                              <li>
                                  Tras el pago los BTC serán instantáneamente 
                                  añadidos a tu cartera en DameCoins.
                              </li>
                              <li>
                                  Podrás acceder a tu cartera simplemente iniciando sessión. Recibirás un email con los datos de acceso al instante.
                              </li>
                              <li>
                                  Podrás vender tus BTC en cualquier momento y depositar el dinero a tu cuenta bancaria en COP(dependiendo del país, puede tardar de 1 a 5 días en llegar a tu cuenta bancaria).
                              </li>
                              <li>
                                  Tus pagos nunca mostrarán ningún nombre relacionado con la criptomoneda en el extracto bancario, de tarjeta o historial de pagos. Tu privacidad es muy importante para nosotros.
                              </li>
                          </ul>
                
                      </div>
                     
                      <div class="col-12 col-lg-7 mt-4">
                          <div class="card card-compra-instantanea ">
                              <div class="card-body">
  
                                  <div class="row">
                                      <div class="col-12 col-md-6 ">
                                          <strong>¿Qué divisa quieres comprar?</strong>
  
                                          <div class="container-select-list mt-2">
                                              <div class="icon"> 
                                                  <span class="mr-2">BTC </span>
                                                  <span><i class="fas fa-angle-down"></i></span>
                                              </div>
                                              <select class="selectpicker" data-live-search="true">
                                                  <option value="h:464e" data-content="<img class='img-select' src='assets/img/formulario/1.png'></img> Bitcoin (BTC)">
                                                      Bitcoin (BTC)</option>
                                                  <option value="h:464e" data-content="<img class='img-select' src='assets/img/formulario/1.png'></img> Bitcoin (BTC)">
                                                      Bitcoin (BTC)</option>
                                                  <option value="h:464e" data-content="<img class='img-select' src='assets/img/formulario/2.png'></img> Bitcoin (BTC)">
                                                      Bitcoin (BTC)</option>
                                              </select>
                                          </div>
  
  
                                      </div>
                                      <div class="col-12 col-md-6 ">
                                          <strong >¿En qué divisa quieres pagar?</strong>
  
                                          <div class="container-select-list mt-2">
                                              <div class="icon"> 
                                                  <span class="mr-2">USD </span>
                                                  <span><i class="fas fa-angle-down"></i></span>
                                              </div>
                                              <select class="selectpicker" data-live-search="true">
                                                  <option value="h:464e" data-content="<img class='img-select' src='assets/img/formulario/2.png'></img> Dolares americanos">
                                                      Dolares americanos</option>
                                                  <option value="h:464e" data-content="<img class='img-select' src='assets/img/formulario/1.png'></img> Dolares americanos">
                                                      Dolares americanos</option>
                                                  <option value="h:464e" data-content="<img class='img-select' src='assets/img/formulario/2.png'></img> Dolares americanos">
                                                      Dolares americanos</option>
                                                  </select>
                                          </div>
  
                                      </div>
                                  </div>
  
                                  <h6  class="font-weight-bold mt-3">Montos sugeridos</h6>
  
                                  <div class="row">
                                      <div class="col-12 col-md-6 mt-3 mt-lg-0">
  
                                          <div class="input-radio-option">
                                              <input type="radio" name="radioMonto">
                                             
                                              <div class="card-radio">
                                                  <div class="icon mr-auto"></div>
                                                  <p>
                                                      <small>Pagas</small> <br>
                                                      <span>100 USD</span>
                                                  </p>
                                                  <p class="signo">=</p>
                                                  <p>
                                                      <small>Recibes</small> <br>
                                                      <span>0.0095954 BTC</span>
                                                  </p>
                                              </div>
                                          </div>
  
                                      </div>
                                      <div class="col-12 col-md-6 mt-3 mt-lg-0">
                                          
                                          <div class="input-radio-option">
                                              <input type="radio" name="radioMonto">
                                             
                                              <div class="card-radio">
                                                  <div class="icon mr-auto"></div>
                                                  <p>
                                                      <small>Pagas</small> <br>
                                                      <span>100 USD</span>
                                                  </p>
                                                  <p class="signo">=</p>
                                                  <p>
                                                      <small>Recibes</small> <br>
                                                      <span>0.0095954 BTC</span>
                                                  </p>
                                              </div>
                                          </div>
  
                                      </div>
                                      <div class="col-12 col-md-6 mt-3">
                                         
                                          <div class="input-radio-option">
                                              <input type="radio" name="radioMonto">
                                             
                                              <div class="card-radio">
                                                  <div class="icon mr-auto"></div>
                                                  <p>
                                                      <small>Pagas</small> <br>
                                                      <span>100 USD</span>
                                                  </p>
                                                  <p class="signo">=</p>
                                                  <p>
                                                      <small>Recibes</small> <br>
                                                      <span>0.0095954 BTC</span>
                                                  </p>
                                              </div>
                                          </div>
  
                                      </div>
                                      <div class="col-12 col-md-6 mt-3">
                                        
                                          <div class="input-radio-option">
                                              <input type="radio" name="radioMonto">
                                             
                                              <div class="card-radio">
                                                  <div class="icon mr-auto"></div>
                                                  <p>
                                                      <small>Pagas</small> <br>
                                                      <span>100 USD</span>
                                                  </p>
                                                  <p class="signo">=</p>
                                                  <p>
                                                      <small>Recibes</small> <br>
                                                      <span>0.0095954 BTC</span>
                                                  </p>
                                              </div>
                                          </div>
  
                                      </div>
                                  </div>
  
                                  <h6  class="font-weight-bold mt-3">Otra cantidad</h6>
  
                                  <div class="row">
                                      <div class="col-12 col-md-6">
  
                                          <div class="input-group input-group-cantidad mb-3">
                                              <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                              <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <img class="mr-1" src="assets/img/formulario/1.png" alt="">
                                                    BTC
                                                </span>
                                              </div>
                                            </div>
  
                                      </div>
                                      <div class="col-12 col-md-6">
  
                                          <div class="input-group input-group-cantidad mb-3">
                                              <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                              <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <img class="mr-1" src="assets/img/formulario/1.png" alt="">
                                                    USD
                                                </span>
                                              </div>
                                            </div>
  
                                      </div>
                                  </div>
  
                              
                                  <div class="row container-datos py-3" >
                                      <div class="col-12">
                                          <p class=" mb-0">
                                              <span class="font-weight-bold h6 d-block"> Datos para tu nueva cuenta donde accederás a tus Criptodivisas </span>
                                              y podrás retirarlas a otros wallets, hacer trading, etc.
                                          </p>
                                      </div>
                                      <div class="col-12 col-md-6 mt-3" >
                                          <input type="text" class="form-control"  placeholder="Nombre" >
                                      </div>
                                      <div class="col-12 col-md-6 mt-3"   >
                                          <input type="text" class="form-control" placeholder="Apellidos" >
                                      </div>
                                      <div class="col-12 col-md-6 mt-3"   >
                                          <input type="text" class="form-control" placeholder="Emails" >
                                      </div>
                                      <div class="col-12 col-md-6 mt-3"  >
                                          <div class="select-standard">
                                              <span class="icon"><i class="fas fa-angle-down"></i></span>
                                              <select id="Select " class="form-control selectpicker">
                                                <option>País</option>
                                                <option>País</option>
                                                <option>País</option>
                                                <option>País</option>
                                              </select>
                                            </div>
                                      </div>
                                  </div>
                                  
                                  <h6  class="font-weight-bold mt-3">Pago instantaneo con tarjeta de credito</h6>
  
                                  <div class="row justify-content-lg-between ">
                                      <div class="col-12 col-md-5">
                                          <small>Numero de tarjeta</small>
                                          <input type="text" class="form-control" placeholder="---- ---- ---- ----" >
                                      </div>
                                      <div class="col-12 col-md-3">
                                          <small>Fecha Exp.</small>
                                          <div class="input-group input-group-fecha mb-3">
                                              <input type="text" class="form-control" placeholder="MM / YYYY" >
                                              <div class="input-group-append">
                                                <span class="input-group-text"> <img class="img-fluid" src="assets/img/formulario/calendar.png" alt=""></span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-3">
                                          <small>CVV</small>
                                          <input type="text" class="form-control" placeholder="- - -" >
                                      </div>
                                      <div class="col py-0">
                                          <div class="form-group form-check">
                                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                              <label class="form-check-label" for="exampleCheck1"><small>Estoy de acuerdo con los Términos de Servicio</small></label>
                                            </div>
                                      </div>
                                     
                                  </div>
  
                                 <button class="btn btn-success btn-success-custom  btn-block  py-3">Compra instantanea con tarjeta</button>
  
                                 <div class="img-form mt-3">
                                     <img class="img-fluid" src="assets/img/formulario/Rectangle117.png" alt="">
                                     <img class="img-fluid" src="assets/img/formulario/Rectangle118.png" alt="">
                                     <img class="img-fluid" src="assets/img/formulario/Rectangle119.png" alt="">
                                     <img class="img-fluid" src="assets/img/formulario/Rectangle120.png" alt="">
                                     <img class="img-fluid" src="assets/img/formulario/Rectangle121.png" alt="">
                                     <img class="img-fluid" src="assets/img/formulario/Rectangle122.png" alt="">
                                 </div>
  
                                 <div class="d-flex justify-content-center align-items-center mt-3 container-or">
                                     <span>Or</span>
                                 </div>
  
  
                                 <div class="row">
                                      <div class="col-12 col-md-6">
                                          <button class="btn btn-primary btn-primary-custom btn-block">
                                              <img class="mr-2" src="assets/img/formulario/paypal1.png" alt="">
                                              Pay with Paypal
                                          </button>
                                      </div>
                                      <div class="col-12 col-md-6 mt-3 mt-md-0">
                                          <button class="btn btn-primary btn-primary-custom btn-block">
                                              <img class="mr-2" src="assets/img/formulario/Capa11.png" alt="">
                                              Pay with Western Union
                                          </button>
                                      </div>
                                      <div class="col-12 d-flex justify-content-center align-items-center mt-3">
                                          <a href="#" class=" link " >Ver más metodos de pago</a>
                                      </div>
                                 </div>
                              
  
                              </div>
                          </div>
                      </div>
                    
                  </div>
            </div>
  
        </div> --}}

        {{-- <div class="container-fluid section-slider-comprar pl-5">
            <div class="row">    
                <div class="col-12 col-lg-4 pl-lg-5">
                    <h2 class="text-white font-weight-bold">Tambien te puede <br class="d-none d-lg-block"> interesar</h2>
                </div>

                <div class="col-12 col-lg-8 mt-4 mt-lg-0">
                    <div class="slider-compra">

                        <div id="slider-compra-prev" class="slider-compra-prev"> 
                            <span><i class="fas fa-arrow-left"></i></span> 
                        </div>

                        <div class="owl-carousel owl-theme" id="owl-carousel-compra">
                            <div class="item" >
                                <h5>Compra Bitcoin al instante sin ID</h5>
                                <a href="#" class="">Saber más <span><i class="fas fa-chevron-right"></i></span> </a>
                            </div>
                            <div class="item" >
                                <h5>Compra Bitcoin al instante sin ID</h5>
                                <a href="#" class="">Saber más <span><i class="fas fa-chevron-right"></i></span> </a>
                            </div>
                            <div class="item" >
                                <h5>Compra Bitcoin al instante sin ID</h5>
                                <a href="#" class="">Saber más <span><i class="fas fa-chevron-right"></i></span> </a>
                            </div>
                        </div>

                        <div id="slider-compra-dots" class="mt-3 slider-compra-dots">
                            <div class="owl-dot active"><span></span></div>
                            <div class="owl-dot"><span></span></div>
                            <div class="owl-dot"><span></span></div>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}


    </div>

    {{-- <footer class="lading-footer py-5 text-center ">
       <div class="container">
            <img src="assets/img/navbar-landing-page/logo-nav.png" alt="">
            <div class="d-flex justify-content-center mt-4 flex-wrap">
                <a href="#" class="link-green m-3" >Crear cuenta gratis</a>
                <a href="#" class="link-green m-3" >Inicio de sesión</a>
                <a href="#" class="link-green m-3" >Contacto</a>
            </div>
            <span class="line"></span>
            <div class="d-flex justify-content-center flex-wrap">
                <a href="#" class=" link-white m-3">DameCoins © 2020 All Rights Reserved.</a>
                <a href="#" class=" link-white m-3">Terms and conditions</a>
                <a href="#" class=" link-white m-3">Refund Policy</a>
                <a href="#" class=" link-white m-3">AML Policy</a>
            </div>
       </div>
    </footer> --}}


  </body>
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>


    <script>
     
        var menu =  document.getElementById('menu-landing');
        window.addEventListener('scroll', function(){
            if(window.pageYOffset > 70){
                menu.classList.add('navbar-landing-fixed')
            }else{
                menu.classList.remove('navbar-landing-fixed')
            }
        })

        var toggle = document.getElementById('toggle-menu');
        toggle.addEventListener('click', function(){
           
            if(window.pageYOffset > 70){
                menu.classList.add('navbar-landing-fixed')
            }else{
                menu.classList.toggle('navbar-landing-fixed')
            }
        })
        
   

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