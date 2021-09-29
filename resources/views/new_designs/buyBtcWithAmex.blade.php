@extends('layouts.landing', [
  'title' => 'Landing'
])

@section('content')
  <section id="home-amex" class="home-buy-sell">
    <img src="{{ asset('img/landing/bg/neteller.png') }}" class="amex-bg">
    @include('partials.landing.headerBuySellBtc')
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-5">
          <div class="mb-3">
            <img src="{{ asset('img/landing/icons/bitcoins-fill-md.png') }}" alt="Bitcoins" style="height: 70px;">
            <img src="{{ asset('img/landing/icons/switch.png') }}" alt="Switch" class="px-2" style="height: 45px;">
            <img src="{{ asset('img/landing/icons/neteller.png') }}" alt="Neteller" style="height: 70px;">
          </div>

          <h1 class="text-white">
            Compra Bitcoins con <span class="text-green">Neteller al instante</span>
          </h1>
          <p class="text-white mb-0 text-justify">
            Compre al instante Bitcoin y otras criptomonedas con su tarjeta (tarjeta de crédito, tarjeta de débito y tarjeta de regalo compatibles), PayPal, Western Union o transferencia bancaria internacional (tenemos cuentas bancarias en los EE. UU., Reino Unido, Europa y Hong Kong). ¡Ahorre dinero y maximice las ganancias con nuestras tarifas ultra económicas, inferiores al 97% de los intercambios, y disfrute de uno de los catálogos de criptografía más ricos de Internet con más de 300 monedas disponibles!
          </p>
          <p class="text-white text-justify">
            No se requiere verificación de identificación o KYC para transacciones cuyo valor no exceda los 50,000 USD.
          </p>

          <ul class="list-points points-green text-white mt-3 mb-5 mb-lg-0 pr-0 pr-xl-3">
            <li>
              Tras el pago los BTC serán instantáneamente añadidos a tu cartera en DameCoins.
            </li>
            <li>
              Podrás acceder a tu cartera simplemente iniciando sessión. Recibirás un email con los datos de acceso al instante.
            </li>
            <li>
              Podrás vender tus BTC en cualquier momento y depositar el dinero a tu cuenta bancaria en COP(dependiendo del país, puede tardar de 1 a 5 días en llegar a tu cuenta bancaria).
            </li>
          </ul>
        </div>

        <div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-0 col-xl-6 offset-xl-1 d-flex align-items-center">
          <form class="main-card">
            <div class="row">
              <div class="col-md-12">
                <h5>Quiero comprar:</h5>

                <div class="form-group form-group-with-select mb-0">
                  <input type="text" class="form-control" id="buy" aria-describedby="buyHelp">
                  <div class="select-wrapper">
                    <select class="form-control">
                      <option>BTC (Bitcoin)</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>

                <small id="buyHelp" class="form-text text-muted mb-2">Minimos 100USD*</small>
              </div>

              <div class="col-md-12 text-right">
                <div class="switch-inputs">
                  <img src="{{ asset('img/landing/icons/switch-vertical.png') }}" class="img-fluid">
                </div>
              </div>

              <div class="col-md-12">
                <h5>Quiero comprar:</h5>

                <div class="form-group form-group-with-select">
                  <input type="text" class="form-control" id="pay">
                  <div class="select-wrapper">
                    <select class="form-control">
                      <option>USD (Dolares)</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>

                <small id="buyHelp" class="form-text text-muted mb-2">Minimos 100USD*</small>
              </div>
            </div>

            <h5 class="title-divider"></h5>

            <div class="row">
              <div class="col-md-12">
                <h5>Direción de Bitcoins Billetera</h5>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Dirección" name="address">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-light-blue-gradient btn-lg w-100 mt-4 mb-2" style="z-index: 1;position: relative;">
              Paga con Neteller ahora
              <img src="{{ asset('img/landing/icons/chevron-right.png') }}" class="right">
            </button>

            <div class="text-center mt-3">
              <a href="#">Ver más métodos de pago</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section id="buy-neteller-instantly">
    <div class="container">
      <h4 class="mb-4">¿Ya tienes una billetera? Compra Bitcoin al Instante</h4>

      <div class="row">
        <div class="col-md-6 col-xl-3">
          <label>Quiero comprar:</label>

          <div class="form-group form-group-with-select mb-0">
            <input type="text" class="form-control" id="buy" aria-describedby="buyHelp">
            <div class="select-wrapper">
              <select class="form-control">
                <option>BTC (Bitcoin)</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>

          <small id="buyHelp" class="form-text mb-2">Minimos 100USD*</small>
        </div>
        <div class="col-md-6 col-xl-3">
          <label>Pagas:</label>

          <div class="form-group form-group-with-select">
            <input type="text" class="form-control" id="pay">
            <div class="select-wrapper">
              <select class="form-control">
                <option>USD (Dolares)</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-8 pt-2 col-xl-4">
          <div class="form-group multi-input mt-4 mb-1">
            <img src="{{ asset('img/landing/icons/credit-card.png') }}" class="prefix">
            <input type="text" class="form-control" placeholder="Número de tarjeta" name="card_number">
            <input type="text" class="form-control" placeholder="MM / YY" name="due_date" style="max-width: 25%;">
            <input type="text" class="form-control" placeholder="CVC" name="cvc" style="max-width: 17%;">
          </div>

          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="anonymous">
            <label class="form-check-label" for="anonymous">
              <small>Government & Bank statement 100% Anonymous</small>
            </label>
          </div>
        </div>
        <div class="col-md-4 col-xl-2 pl-xl-0 pr-xl-0 pt-2">
          <button type="submit" class="btn btn-light-blue-gradient w-100 mt-4" style="z-index: 1;position: relative;">
              Compra instantanea
          </button>
        </div>
      </div>
    </div>
  </section>

  <section id="how-to-buy-with-netseller">
    <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3 text-center">
            <div class="mb-3">
              <img src="{{ asset('img/landing/icons/bitcoins-fill-md.png') }}" alt="Bitcoins" style="height: 70px;">
              <img src="{{ asset('img/landing/icons/switch.png') }}" alt="Switch" class="px-2" style="height: 45px;">
              <img src="{{ asset('img/landing/icons/neteller.png') }}" alt="Neteller" style="height: 70px;border-radius: 50%;box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.16);">
            </div>

            <h1>¿Cómo comprar con Neteller?</h1>
            <p>Con Damecoins, puedes comprar Bitcoin de forma fácil, rápida y segura.</p>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-md-6 col-lg-4">
            <div class="card mb-3">
              <div class="card-body">
                <div class="d-flex">
                  <span class="step">1</span>
                  <h5 class="text-dark-primary">Crea una cuenta en Damecoins.com</h5>
                </div>
                <p class="mb-0 mt-3">
                  Is simply dummy text of the printing and typesetting industry.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card mb-3">
              <div class="card-body">
                <div class="d-flex">
                  <span class="step">2</span>
                  <h5 class="text-dark-primary">Crea una cuenta en Damecoins.com</h5>
                </div>
                <p class="mb-0 mt-3">
                  Is simply dummy text of the printing and typesetting industry.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card mb-3">
              <div class="card-body">
                <div class="d-flex">
                  <span class="step">3</span>
                  <h5 class="text-dark-primary">Crea una cuenta en Damecoins.com</h5>
                </div>
                <p class="mb-0 mt-3">
                  Is simply dummy text of the printing and typesetting industry.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="benefits-buy-sell">
    <div class="container">
      <h1 class="text-center">¿Por qué comprar con Damecoins?</h1>
      <p class="text-center">
        ¿Primera experiencia con criptodivisas? Estás en buenas manos.
      </p>

      <div class="row mt-5">
        <div class="col-md-6 col-lg-4">
          <div class="card-benefit">
            <img src="{{ asset('img/landing/bg/money-bitcoins.png') }}">
            <h4>Móvil</h4>
            <p>
              Puedes acceder a la plataforma sin límites desde cualquier dispositivo y comprar o vender tus Bitcoins cómodamente
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card-benefit">
            <img src="{{ asset('img/landing/bg/money-bitcoins.png') }}">
            <h4>Cifrado seguro</h4>
            <p>
              DameCoins cuenta con encriptación SSL para proteger todas tus transacciones. Nunca almacenamos datos de tu tarjeta. Puedes estar tranquilo.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card-benefit">
            <img src="{{ asset('img/landing/bg/money-bitcoins.png') }}">
            <h4>Cartera</h4>
            <p>
              Para ver tu Cartera, simplemente inicia sesión en DameCoins. Podrás ver cuántas divisas tienes y retirar EUR a tu cuenta bancaria al instante.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card-benefit">
            <img src="{{ asset('img/landing/bg/money-bitcoins.png') }}">
            <h4>Atención 24h por chat</h4>
            <p>
              Sabemos que el mundo de las criptomonedas puede ser confuso. Nuestro equipo de atención al cliente está disponible 24/7 en español para que preguntes cualquier duda que pueda surgirte.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card-benefit">
            <img src="{{ asset('img/landing/bg/money-bitcoins.png') }}">
            <h4>Compra y venta instantáneas</h4>
            <p>
              Evita esperar días por trasferencias bancarias lentas. En DameCoins la compra de BTC es instantánea usando tu tarjeta.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card-benefit">
            <img src="{{ asset('img/landing/bg/money-bitcoins.png') }}">
            <h4>100% Hispano</h4>
            <p>
              DameCoins es una plataforma 100% hispana con sede en Madrid, España. Toda la atención la recibirás en español, sin riesgos de empresas en países fuera de jurisdicción.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="free-account-buy-neteller">
    <div class="container">
      <div class="row">
        <div class="col-md-5 d-flex flex-column align-items-start justify-content-center">
          <h2 class="text-white mb-4 mt-5 mt-md-0">Crea una cuenta gratis en Damecoins</h2>
          <a href="{{ route('register') }}" class="btn btn-blue-gradient shadow-sm">
            <img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
            Crear cuenta gratis
          </a>
        </div>
        <div class="col-md-6 offset-md-1">
          <img src="{{ asset('img/landing/07.png') }}" class="img-fluid mt-5">
        </div>
      </div>
    </div>

    <img src="{{ asset('img/landing/bg/waves2.png') }}" class="waves">
  </section>

  <section id="payment-methods-buy-sell">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2 class="mb-4">Conoce todos nuestros metodos de pago</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
          </p>
          <a href="#" class="btn btn-blue-gradient shadow-sm">
            Ver todos
          </a>
        </div>
        <div class="col-md-8 d-flex align-items-center mt-5 mt-md-0" style="position: inherit;">
          <a href="#" class="btn btn-blue-gradient" id="payment-methods-carousel-prev-button">
            <i class="fa fa-arrow-left"></i>
          </a>

          <div class="payment-methods-carousel-wrapper">
            <div id="payment-methods-carousel">
              @for($i=0; $i < 8; $i++)
                <div>
                  <div class="card">
                    <div class="card-body text-white">
                      <div class="row mb-4">
                        <div class="col-8">
                          <span class="payment-method-logo">
                            <img src="{{ asset('img/landing/logos/skrill.png') }}">
                          </span>
                        </div>

                        <div class="col-4 text-right">
                          <span class="text-green">FREE</span>
                        </div>
                      </div>

                      <h4 class="mb-0">Paypal</h4>
                      <small>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                      </small>
                    </div>
                  </div>
                </div>
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
    <img src="{{ asset('img/landing/bg/bg-diagonal-bottom.png') }}" class="img-bottom">
  </section>

  <section id="faqs">
    <div class="container">
      <h2 class="text-dark-primary text-center mb-5">@lang('index_questions.title')</h2>

      <div class="accordion row" id="faqsAccordionNeteller">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header" id="heading01">
              <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#collapse01" aria-expanded="true" aria-controls="collapse01">
                @lang('index_questions.q1')
              </button>
              <img src="{{ asset('img/landing/icons/chevron-up.png') }}">
            </div>

            <div id="collapse01" class="collapse show" aria-labelledby="heading01" data-parent="#faqsAccordionNeteller">
              <div class="card-body">
                  @lang('index_questions.r1')
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="heading02">
              <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse02" aria-expanded="false" aria-controls="collapse02">
                @lang('index_questions.q2')
              </button>
              <img src="{{ asset('img/landing/icons/chevron-up.png') }}">
            </div>

            <div id="collapse02" class="collapse" aria-labelledby="heading02" data-parent="#faqsAccordionNeteller">
              <div class="card-body">
                  @lang('index_questions.r2')
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="heading03">
              <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                @lang('index_questions.q3')
              </button>
              <img src="{{ asset('img/landing/icons/chevron-up.png') }}">
            </div>

            <div id="collapse03" class="collapse" aria-labelledby="heading03" data-parent="#faqsAccordionNeteller">
              <div class="card-body">
                  @lang('index_questions.r3')
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-header" id="heading04">
              <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse04" aria-expanded="false" aria-controls="collapse04">
                @lang('index_questions.q4')
              </button>
              <img src="{{ asset('img/landing/icons/chevron-up.png') }}">
            </div>

            <div id="collapse04" class="collapse" aria-labelledby="heading04" data-parent="#faqsAccordionNeteller">
              <div class="card-body">
                  @lang('index_questions.r4')
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="heading05">
              <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse05" aria-expanded="false" aria-controls="collapse05">
                @lang('index_questions.q6')
              </button>
              <img src="{{ asset('img/landing/icons/chevron-up.png') }}">
            </div>

            <div id="collapse05" class="collapse" aria-labelledby="heading05" data-parent="#faqsAccordionNeteller">
              <div class="card-body">
                  @lang('index_questions.r6')
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="heading06">
              <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse06" aria-expanded="false" aria-controls="collapse06">
                @lang('index_questions.q8')
              </button>
              <img src="{{ asset('img/landing/icons/chevron-up.png') }}">
            </div>

            <div id="collapse06" class="collapse" aria-labelledby="heading06" data-parent="#faqsAccordion">
              <div class="card-body">
                  @lang('index_questions.r8')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="buy-now-with-card">
    <div class="container bg-white">
      <div class="text-center">
        <img src="{{ asset('img/landing/bg/money-squared.png') }}">
      </div>
      <h1 class="text-center">¿Ya tienes una Billetera?</h1>
      <p class="text-center">
        Compra Bitcoin al instante con tu tarjeta de credito.
      </p>
    </div>

    <div class="bg-dark mt-5">
      <img src="{{ asset('img/landing/bg/bg-diagonal-top.png') }}" class="img-top">
      <div class="container ">
        <div class="row">
          <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
            <form class="main-card">
              <div class="row">
                <div class="col-md-6">
                  <h5>Quiero comprar:</h5>

                  <div class="form-group form-group-with-select mb-0">
                    <input type="text" class="form-control" id="buy" aria-describedby="buyHelp">
                    <div class="select-wrapper">
                      <select class="form-control">
                        <option>BTC (Bitcoin)</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>

                  <small id="buyHelp" class="form-text text-muted mb-2">Minimos 100USD*</small>
                </div>
                <div class="col-md-6">
                  <h5>Pagas:</h5>

                  <div class="form-group form-group-with-select">
                    <input type="text" class="form-control" id="pay">
                    <div class="select-wrapper">
                      <select class="form-control">
                        <option>USD (Dolares)</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <h5 class="title-divider"><span>Montos sugeridos</span></h5>

              <div class="row">
                <div class="col-md-6">
                  <div class="custom-control custom-radio radio-amount">
                    <input type="radio" id="amount1" name="amount" class="custom-control-input">
                    <label class="custom-control-label" for="amount1">
                      <span>
                        <small>Pagas</small>
                        <strong>100 USD</strong>
                      </span>
                      <img src="{{ asset('img/landing/arrow.png') }}">
                      <span>
                        <small>Recibes</small>
                        <strong>0.0095954 BTC</strong>
                      </span>
                    </label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="custom-control custom-radio radio-amount">
                    <input type="radio" id="amount2" name="amount" class="custom-control-input">
                    <label class="custom-control-label" for="amount2">
                      <span>
                        <small>Pagas</small>
                        <strong>100 USD</strong>
                      </span>
                      <img src="{{ asset('img/landing/arrow.png') }}">
                      <span>
                        <small>Recibes</small>
                        <strong>0.0095954 BTC</strong>
                      </span>
                    </label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="custom-control custom-radio radio-amount">
                    <input type="radio" id="amount3" name="amount" class="custom-control-input">
                    <label class="custom-control-label" for="amount3">
                      <span>
                        <small>Pagas</small>
                        <strong>100 USD</strong>
                      </span>
                      <img src="{{ asset('img/landing/arrow.png') }}">
                      <span>
                        <small>Recibes</small>
                        <strong>0.0095954 BTC</strong>
                      </span>
                    </label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="custom-control custom-radio radio-amount">
                    <input type="radio" id="amount4" name="amount" class="custom-control-input">
                    <label class="custom-control-label" for="amount4">
                      <span>
                        <small>Pagas</small>
                        <strong>100 USD</strong>
                      </span>
                      <img src="{{ asset('img/landing/arrow.png') }}">
                      <span>
                        <small>Recibes</small>
                        <strong>0.0095954 BTC</strong>
                      </span>
                    </label>
                  </div>
                </div>
              </div>

              <h5 class="title-divider"><span>Otra cantidad</span></h5>

              <div class="row">
                <div class="col-md-6">
                  <span>Quiero comprar:</span>
                  <div class="form-group form-group-with-select mb-0">
                    <input type="text" class="form-control" id="buy" aria-describedby="buyHelp">
                    <div class="select-wrapper">
                      <select class="form-control">
                        <option>BTC (Bitcoin)</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <span>Pagas:</span>
                  <div class="form-group form-group-with-select">
                    <input type="text" class="form-control" id="pay">
                    <div class="select-wrapper">
                      <select class="form-control">
                        <option>USD (Dolares)</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <h5 class="title-divider"><span>Compra Instantanea</span></h5>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <img src="{{ asset('img/landing/icons/email.png') }}" class="prefix">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group multi-input">
                    <img src="{{ asset('img/landing/icons/credit-card.png') }}" class="prefix">
                    <input type="text" class="form-control" placeholder="Número de tarjeta" name="card_number">
                    <input type="text" class="form-control" placeholder="MM / YY" name="due_date" style="max-width: 20%;">
                    <input type="text" class="form-control" placeholder="CVC" name="cvc" style="max-width: 20%;">
                  </div>
                </div>
              </div>

              <img src="{{ asset('img/landing/safe-logos.png') }}" class="img-fluid">

              <button type="submit" class="btn btn-green btn-lg w-100 mt-4 mb-2" style="z-index: 1;position: relative;">
                <img src="{{ asset('img/landing/icons/bitcoins.png') }}" class="left-icon">
                Compra instantanea
              </button>

              <h5 class="title-divider"><span>o</span></h5>

              <div class="row">
                <div class="col-md-6 my-2">
                  <a href="#" class="btn btn-blue w-100" style="height: 100%;display: flex;align-items: center;">
                    <img src="{{ asset('img/landing/icons/paypal.png') }}" class="left-icon">
                    Pagar con Paypal
                  </a>
                </div>
                <div class="col-md-6 my-2">
                  <a href="#" class="btn btn-blue w-100" style="font-size: 14px;display: flex;white-space: normal;align-items: center;padding: 8px 20px;text-align: left;line-height: 1;">
                    <img src="{{ asset('img/landing/icons/western-union.png') }}" class="left-icon">
                    Pagar con Western Union
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="features-amex">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2 class="mb-4 text-white">También te puede interesar</h2>
        </div>
        <div class="col-md-8 d-flex align-items-center mt-5 mt-md-0" style="position: inherit;">
          <a href="#" class="btn btn-blue-gradient" id="features-amex-carousel-prev-button">
            <i class="fa fa-arrow-left"></i>
          </a>

          <div class="features-amex-carousel-wrapper">
            <div id="features-amex-carousel">
              @for($i=0; $i < 8; $i++)
                <div>
                  <div class="card">
                    <div class="card-body">
                      <h5>Compra Bitcoin al instante sin ID</h5>
                      <a href="#">
                        Saber más
                        <img src="{{ asset('img/landing/icons/chevron-right-blue.png') }}" class="d-inline-block ml-2" style="height: 13px;">
                      </a>
                    </div>
                  </div>
                </div>
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('partials.landing.footerBuySellBtc')
@endsection


@section('scripts')
@endsection