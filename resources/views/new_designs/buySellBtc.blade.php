@extends('layouts.landing', [
  'title' => 'Landing'
])

@section('content')
  <section id="home" class="home-buy-sell" style="background: url('{{ asset('img/landing/bg/buy-sell.svg') }}');">
    @include('partials.landing.headerBuySellBtc')
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-5">
          <img src="{{ asset('img/landing/icons/bitcoins-fill-md.png') }}" alt="Bitcoins" style="height: 75px;">
          <h1 class="text-white">
            Compra y vende Bitcoins <span class="text-green">al instante con Damecoins</span>
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

        <div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-0 col-xl-6 offset-xl-1">
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
  </section>

  <div class="container mt-5">
    <p class="text-center">
      <small>
        Otros pagos alternativos disponibles para su conveniencia son: Visa, Mastercard, Discover, American Express, JCB, UnionPay, Revolut, Venmo, Tarjetas sin OTP o 3D Secure, Paysafecard, Money Gram, Depósito en efectivo, Skrill, Alipay, Wechat Pay, ACH, Amazon Pay, Ebay Gift Card, Flexepin, Apple Pay, Google Pay, Neteller, N26, SEPA, Square, Transferwise, Zelle, Zipay y Yandex Money. Para más detalles, siéntase libre de iniciar un nuevo chat en cualquier momento. Usted es muy importante para nosotros y estamos comprometidos a trabajar junto a usted para satisfacer cualquier necesidad específica. Gracias por confiar en Damecoins.
      </small>
    </p>
  </div>

  <section id="behavior-buy-sell-btc">
    {{-- <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <img src="{{ asset('img/landing/bg/money-squared.png') }}">
          <div class="row">
            <div class="col-md-6 bordered-md-right">
              <h2>Cotización del Bitcoin en el mercado</h2>
            </div>
            <div class="col-md-6">
              is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
            </div>
          </div>

          <div class="card card-behavior-buy-sell-btc">
            <div class="card-body">
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="d-flex">
                    <img src="{{ asset('img/landing/icons/bitcoins-fill.png') }}" style="width: 40px;height: 40px;">
                    <div>
                      <h2 style="font-size: 30px" class="mb-0">BTC</h2>
                    </div>
                  </div>
                  Valor actual
                  <h4 class="mb-0">USD 2.523.089</h4>
                  <span class="text-green">
                    216.10 USD (2.17%)
                  </span>
                </div>

                <div class="col-md-6 pt-3 text-md-right">
                  <span class="flat-radio mr-1">
                    <input type="radio" name="rangeChart" id="rangeChart1" value="1" checked>
                    <label class="form-check-label" for="rangeChart1">
                      1 Sem
                    </label>
                  </span>

                  <span class="flat-radio mr-1">
                    <input type="radio" name="rangeChart" id="rangeChart2" value="2">
                    <label class="form-check-label" for="rangeChart2">
                      1 Mes
                    </label>
                  </span>

                  <span class="flat-radio mr-1">
                    <input type="radio" name="rangeChart" id="rangeChart3" value="3">
                    <label class="form-check-label" for="rangeChart3">
                      3 Mes
                    </label>
                  </span>

                  <span class="flat-radio">
                    <input type="radio" name="rangeChart" id="rangeChart4" value="4">
                    <label class="form-check-label" for="rangeChart4">
                      6 Mes
                    </label>
                  </span>

                  <ul class="inline-list mt-3">
                    <li>
                      24h: <span class="text-green">17%</span>
                      <i class="fa fa-arrow-up text-green"></i>
                    </li>
                    <li>
                      7D: <span class="text-green">17%</span>
                      <i class="fa fa-arrow-up text-green"></i>
                    </li>
                    <li>
                      20D: <span class="text-danger">17%</span>
                      <i class="fa fa-arrow-down text-danger"></i>
                    </li>
                  </ul>
                </div>
              </div>

              <canvas id="chart-results-buy-sell-btc" height="375"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

    <div id="card-behavior-buy-sell-btc-carousel">
      @for($i=0; $i < 5; $i++)
        <div class="card">
          <div class="card-body text-white">
            <div class="row mb-4">
              <div class="col-8">
                <div class="d-flex">
                  <img src="{{ asset('img/landing/icons/eth.png') }}" style="height: 50px;" class="mr-2">
                  <div>
                    <h2 class="mb-0">ETH</h2>
                    <h4 class="mb-0">Ethereum</h4>
                  </div>
                </div>
              </div>

              <div class="col-4 text-right">
                24h: <span class="text-green">17%</span>
                <i class="fa fa-arrow-up text-green"></i>
              </div>
            </div>

            Valor actual
            <h4 class="mb-0">USD 2.523.089</h4>
            <span class="text-green">
              216.10 USD (2.17%)
            </span>
          </div>
        </div>
      @endfor
    </div>
  </section>

  <section id="how-to-buy-sell-btc">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <h3>¿Cómo comprar Bitcoin?</h3>
          <p>Con Damecoins, puedes comprar Bitcoin de forma fácil, rápida y segura.</p>

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

          <a href="{{ route('new-register') }}" class="btn btn-blue-gradient w-100 shadow-sm">
            <img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
            Crear cuenta gratis
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="benefits-buy-sell">
    <img src="{{ asset('img/landing/bg/rectangle-blue-rotated.png') }}" class="position-absolute" style="z-index: -1;width: 100%;">
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

  <section id="free-account-buy-sell">
    <div class="container">
      <div class="card text-center">
        <div class="card-body">
          <h2 class="text-white mb-4">Crea una cuenta gratis en <br> Damecoins</h2>
          <a href="{{ route('register') }}" class="btn btn-blue-gradient shadow-sm">
            <img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
            Crear cuenta gratis
          </a>

          <img src="{{ asset('img/landing/bg/waves2.png') }}" class="waves">
        </div>
      </div>
    </div>
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
  </section>

  <section id="buy-now">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
          <img src="{{ asset('img/landing/05.png') }}" class="img-fluid" style="max-width: 300px;">
          <h2 class="mb-4">Compra Bitcoin instantanemente <br> con tarjeta</h2>
          <a href="{{ route('register') }}" class="btn btn-blue-gradient">
            Comprar ahora
          </a>
        </div>
      </div>
    </div>
  </section>

  @include('partials.landing.footerBuySellBtc')
@endsection


@section('scripts')
@endsection