<div class="section-metodo-pago">

  @yield('content')
        
  {{-- <div class=" banner-principal banner ">
    <div class="container">
          <div class="row">
              <div class="col-12 col-lg-6">
                  <img class="icon-coin" src="{{ asset('assets/img/metodo-pago/bitcoint.png')}}" alt="">
                  <h2 class="text-white font-weight-bold">Compra Bitcoins con <br class="d-none d-lg-block">
                      <span class="color-green">cualquier metodo de <br class="d-none d-lg-block">
                          pago</span>
                  </h2>
                  <p class="text-white">
                      En Damecoins puedes comprar casi cualquier cryptomoneda con casi cualquier metodo de pago, manejamos mas 20 metedos de pago, dividididos en manuales y automaticos
                  </p>
                  <a href="#second-section" class="btn  link-gradient-blue">Ver todos los metodos de pago</a>

                  <ul class="list-check pt-4">
                      <li> <span class="icon mr-2"></span> Compra fácilmente bitcóin</li>
                      <li> <span class="icon mr-2"></span> Guarda tus bitcoines y vales SLP en un lugar seguro
                      </li>
                      <li> <span class="icon mr-2"></span> Gráficos en tiempo real</li>
                  </ul>

              </div>
              <div class="col-12 col-lg-6 mt-4  text-center">
                  <img class="img-principal" src="{{ asset('assets/img/metodo-pago/img-principal.png')}}" alt="">
              </div>
          </div>
    </div>

  </div> --}}

  {{-- <div class="first-section px-lg-5">
      <div class="card">
          <div class="card-body pt-4">
              <h5 class="text-white">¿Ya tienes una billetera? Compra Bitcoin al Instante</h5>

              <div class="row mt-3">
                  <div class="col-12 col-md-5">

                      <div class="row">
                          <div class="col-12 col-md-6">
                              <div class="form-group">
                                  <small class="text-white" >Nombres</small>
                                  <input type="text" class="form-control" id="exampleFormControlInput1">
                              </div>
                          </div>
                          <div class="col-12 col-md-6">
                              <div class="form-group">
                                  <small class="text-white" >Apellidos</small>
                                  <input type="text" class="form-control" id="exampleFormControlInput1">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-12 col-md-6">
                              <div class="form-group">
                                  <small class="text-white" >Email</small>
                                  <input type="text" class="form-control" id="exampleFormControlInput1">
                              </div>
                          </div>
                          <div class="col-12 col-md-6">
                              <div class="form-group">
                                  <small class="text-white">Selecion un pais</small>
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
                      </div>
          

                  </div>
                  <div class="col-12 col-md-7">

                      <div class="row">
                          <div class="col-12 col-md-6">
                              <div class="form-group">
                                  <small class="text-white">¿Qué divisa quieres comprar?</small>
                                  <div class="container-select-list">
                                      <div class="icon"> 
                                          <span class="mr-2">BTC </span>
                                          <span><i class="fas fa-angle-down"></i></span>
                                      </div>
                                      <select class="selectpicker" data-live-search="true">
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Bitcoin (BTC)">
                                              Bitcoin (BTC)</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Bitcoin (BTC)">
                                              Bitcoin (BTC)</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Bitcoin (BTC)">
                                              Bitcoin (BTC)</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-md-6">
                              <div class="form-group">
                                  <small class="text-white" >¿En qué divisa quieres pagar?</small>
                                  <div class="container-select-list">
                                      <div class="icon"> 
                                          <span class="mr-2">USD </span>
                                          <span><i class="fas fa-angle-down"></i></span>
                                      </div>
                                      <select class="selectpicker" data-live-search="true">
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Dolares americanos">
                                              Dolares americanos</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Dolares americanos">
                                              Dolares americanos</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Dolares americanos">
                                              Dolares americanos</option>
                                          </select>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-12 col-md-4">
                              <div class="form-group">
                                  <small>Numero de tarjeta</small>
                                  <input type="text" class="form-control" placeholder="---- ---- ---- ----" >
                              </div>
                          </div>
                          <div class="col-12 col-md-3">
                              <div class="form-group">
                                  <small>Fecha Exp.</small>
                                  <div class="input-group input-group-fecha mb-3">
                                      <input type="text" class="form-control" placeholder="MM / YYYY" >
                                      <div class="input-group-append">
                                        <span class="input-group-text"> <img class="img-fluid" src="{{ asset('assets/img/formulario/calendar.png')}}" alt=""></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-md-2">
                              <div class="form-group">
                                  <small>CVV</small>
                                  <input type="text" class="form-control" placeholder="- - -" >
                              </div>
                          </div>
                          <div class="col-12 col-md-3">
                              <div class="form-group">
                                  <br>
                                 <button  class="btn text-decoration-none button-gradient-blue mx-auto mt-0"> <img class="mr-1" src="{{ asset('assets/img/metodo-pago/Group13.png')}}" alt=""> Comp. instantanea</button>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

          </div>
      </div>
  </div> --}}

  {{-- <div class="second-section corte-1 py-4" id="second-section">
     <div class="container ">
          <h2 class="text-center font-weight-bold ">Conoce nuestros metodos de <br class="d-none d-lg-block"> pago disponibles</h2>
          <ul class="nav nav-tabs filter-card mt-4" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#Todos" role="tab" aria-controls="Todos" aria-selected="true">Todos</a>
              </li>
              <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Automaticos" role="tab" aria-controls="Automaticos" aria-selected="false">Automaticos</a>
              </li>
              <li class="nav-item" role="presentation">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Manuales" role="tab" aria-controls="Manuales" aria-selected="false">Manuales</a>
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="Todos" role="tabpanel" aria-labelledby="home-tab">
         
                  <div class="row ">

                      @if (count($cryp) > 0)
                          @foreach ($cryp as $item)    
                              <div class="col-12 col-md-6 col-lg-4 mt-4">
                                  <div class="card card-metodo-pago">
                                      <div class="card-header d-flex justify-content-between align-items-start ">
                                      <span><img class="img-fluid" src="{{ asset('uploads/img/'.$item->img)}}" alt=""></span> 

                                      @if($item->status == 1)
                                      <span class="tipo bg-green">Automatico</span>
                                      @else
                                      <span class="tipo bg-blue">Manual</span>
                                      @endif
                                      </div>
                                      <div class="card-body pt-0">
                                          <h5 class="card-title "><strong>{{ $item->name }}</strong></h5>
                                          <p class="card-text">
                                              {{ $item->description }}
                                          </p>
                                          <a href="#" class="btn-link">Ver metodo de pago <span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                      </div>
                                  </div>
                              </div>
                          @endforeach    
                      @endif                      
                  </div>
         
              </div>
              <div class="tab-pane fade" id="Automaticos" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                      @if (count($cryp) > 0)
                          @foreach ($cryp as $item)  
                              @if ($item->status == 1)
                                  <div class="col-12 col-md-6 col-lg-4 mt-4">
                                      <div class="card card-metodo-pago">
                                          <div class="card-header d-flex justify-content-between align-items-start ">
                                          <span><img class="img-fluid" src="{{ asset('uploads/img/'.$item->img)}}" alt=""></span> 

                                          @if($item->status == 1)
                                          <span class="tipo bg-green">Automatico</span>
                                          @else
                                          <span class="tipo bg-blue">Manual</span>
                                          @endif
                                          </div>
                                          <div class="card-body pt-0">
                                              <h5 class="card-title "><strong>{{ $item->name }}</strong></h5>
                                              <p class="card-text">
                                                  {{ $item->description }}
                                              </p>
                                              <a href="#" class="btn-link">Ver metodo de pago <span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                          </div>
                                      </div>
                                  </div>
                              @endif
                          @endforeach    
                      @endif
                  </div>
              </div>
              <div class="tab-pane fade" id="Manuales" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="row">
                      
                      @if (count($cryp) > 0)
                          @foreach ($cryp as $item)  
                              @if ($item->status == 0)
                                  <div class="col-12 col-md-6 col-lg-4 mt-4">
                                      <div class="card card-metodo-pago">
                                          <div class="card-header d-flex justify-content-between align-items-start ">
                                          <span><img class="img-fluid" src="{{ asset('uploads/img/'.$item->img)}}" alt=""></span> 

                                          @if($item->status == 1)
                                          <span class="tipo bg-green">Automatico</span>
                                          @else
                                          <span class="tipo bg-blue">Manual</span>
                                          @endif
                                          </div>
                                          <div class="card-body pt-0">
                                              <h5 class="card-title "><strong>{{ $item->name }}</strong></h5>
                                              <p class="card-text">
                                                  {{ $item->description }}
                                              </p>
                                              <a href="#" class="btn-link">Ver metodo de pago <span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                          </div>
                                      </div>
                                  </div>
                              @endif
                          @endforeach    
                      @endif
                  </div>
              </div>
          </div>
     </div>
  </div> --}}

  {{-- <div class="section-three section-comprar py-4">
      <div class="container ">
          <h2 class="text-center font-weight-bold ">¿ Cómo comprar con <br class="d-none d-lg-block">
              en Damecoins.com ?</h2>

          <div class="row justify-content-around">
              <div class="col-12 col-md-6 col-lg-3 compra-card mt-4">
                  <span class="arrow-right"><span>1</span></span>
                  <p class="mt-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint nemo maxime ipsum dignissimos commodi accusamus dolorem perferendis natus fugit! Sapiente eaque deleniti tempora ipsum dolor culpa fugit? Deleniti, cum quos!</p>
                  <a href="#" class="text-center">Crea una cuenta <br class="d-none d-lg-block"> gratis</a>
              </div>
              <div class="col-12 col-md-6 col-lg-3 compra-card mt-4">
                  <span class="arrow-right"><span>2</span></span>
                  <p class="mt-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint nemo maxime ipsum dignissimos commodi accusamus dolorem perferendis natus fugit! Sapiente eaque deleniti tempora ipsum dolor culpa fugit? Deleniti, cum quos!</p>
                  <a href="#" class="text-center">Crea una cuenta <br class="d-none d-lg-block"> gratis</a>
              </div>
              <div class="col-12 col-md-6 col-lg-3 compra-card mt-4">
                  <span><span>3</span></span>
                  <p class="mt-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint nemo maxime ipsum dignissimos commodi accusamus dolorem perferendis natus fugit! Sapiente eaque deleniti tempora ipsum dolor culpa fugit? Deleniti, cum quos!</p>
                  <a href="#" class="text-center">Crea una cuenta <br class="d-none d-lg-block"> gratis</a>
              </div>
          </div>
          
      </div>
  </div> --}}

  
  {{-- <div class="section-four corte-2 ">
      <div class="container py-5">
          <div class="card banner-card-one">
              <div class="card-body ">
                  <h2 class=" font-weight-bold ">Crea una cuenta gratis <br class="d-none d-lg-block" >
                       en damecoins</h2>
                  <a href="#" class="btn text-decoration-none link-gradient-blue mx-auto py-2 px-3 mt-3"> <img class="mr-2" src="{{ asset('assets/img/navbar-landing-page/nave.png')}}" alt=""> Crear cuenta gratis</a>

                  <img class="img-1 d-none d-xl-block" src="{{ asset('assets/img/metodo-pago/img-1.png')}}" alt="">
                  <img class="img-2 d-none d-xl-block" src="{{ asset('assets/img/metodo-pago/img-2.png')}}" alt="">

              </div>
          </div>
      </div>
  </div> --}}

  {{-- <div class="container py-4">
      <h2 class="text-center font-weight-bold">Por que comprar con <br class="d-none d-lg-block"> Damecoins</h2>

    <div class="container-card-comprar">
        
      <div class="card card-comprar mt-4">
          <div class="card-header py-2">
            <img src="{{ asset('assets/img/metodo-pago/icon-dolar.svg')}}" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title">Una divisa digital</h5>
            <p class="card-text">Puedes acceder a la plataforma sin límites desde cualquier dispositivo y comprar o vender tus Bitcoins cómodamente</p>
          </div>
      </div>

      <div class="card card-comprar mt-4">
          <div class="card-header py-2">
            <img src="{{ asset('assets/img/metodo-pago/icon-dolar.svg')}}" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title">Una divisa digital</h5>
            <p class="card-text">Puedes acceder a la plataforma sin límites desde cualquier dispositivo y comprar o vender tus Bitcoins cómodamente</p>
          </div>
      </div>

      <div class="card card-comprar mt-4">
          <div class="card-header py-2">
            <img src="{{ asset('assets/img/metodo-pago/icon-dolar.svg')}}" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title">Una divisa digital</h5>
            <p class="card-text">Puedes acceder a la plataforma sin límites desde cualquier dispositivo y comprar o vender tus Bitcoins cómodamente</p>
          </div>
      </div>

      <div class="card card-comprar mt-4">
          <div class="card-header py-2">
            <img src="{{ asset('assets/img/metodo-pago/icon-dolar.svg')}}" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title">Una divisa digital</h5>
            <p class="card-text">Puedes acceder a la plataforma sin límites desde cualquier dispositivo y comprar o vender tus Bitcoins cómodamente</p>
          </div>
      </div>

      <div class="card card-comprar mt-4">
          <div class="card-header py-2">
            <img src="{{ asset('assets/img/metodo-pago/icon-dolar.svg')}}" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title">Una divisa digital</h5>
            <p class="card-text">Puedes acceder a la plataforma sin límites desde cualquier dispositivo y comprar o vender tus Bitcoins cómodamente</p>
          </div>
      </div>

      <div class="card card-comprar mt-4">
          <div class="card-header py-2">
            <img src="{{ asset('assets/img/metodo-pago/icon-dolar.svg')}}" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title">Una divisa digital</h5>
            <p class="card-text">Puedes acceder a la plataforma sin límites desde cualquier dispositivo y comprar o vender tus Bitcoins cómodamente</p>
          </div>
      </div>

    </div>

  </div> --}}

  {{-- <div class="section-six py-4 corte-1-blue">

    <div class="container ">
          <div class="row">
              <div class="col-12 col-lg-5">
                  <img src="{{ asset('assets/img/metodo-pago/Group17.png')}}" alt="">
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
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Bitcoin (BTC)">
                                              Bitcoin (BTC)</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Bitcoin (BTC)">
                                              Bitcoin (BTC)</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Bitcoin (BTC)">
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
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Dolares americanos">
                                              Dolares americanos</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Dolares americanos">
                                              Dolares americanos</option>
                                          <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Dolares americanos">
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
                                            <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt="">
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
                                            <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt="">
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
                                        <span class="input-group-text"> <img class="img-fluid" src="{{ asset('assets/img/formulario/calendar.png')}}" alt=""></span>
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
                             <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle117.png')}}" alt="">
                             <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle118.png')}}" alt="">
                             <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle119.png')}}" alt="">
                             <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle120.png')}}" alt="">
                             <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle121.png')}}" alt="">
                             <img class="img-fluid" src="{{ asset('assets/img/formulario/Rectangle122.png')}}" alt="">
                         </div>

                         <div class="d-flex justify-content-center align-items-center mt-3 container-or">
                             <span>Or</span>
                         </div>


                         <div class="row">
                              <div class="col-12 col-md-6">
                                  <button class="btn btn-primary btn-primary-custom btn-block">
                                      <img class="mr-2" src="{{ asset('assets/img/formulario/paypal1.png')}}" alt="">
                                      Pay with Paypal
                                  </button>
                              </div>
                              <div class="col-12 col-md-6 mt-3 mt-md-0">
                                  <button class="btn btn-primary btn-primary-custom btn-block">
                                      <img class="mr-2" src="{{ asset('assets/img/formulario/Capa11.png')}}" alt="">
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