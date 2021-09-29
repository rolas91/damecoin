<section id="home" class="home-buy-sell" style="background: url('{{ asset('img/landing/bg/buy-sell.svg') }}');">
    @include('partials.landing.headerBuySellBtc')
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-5">
          <img src="{{ asset('img/landing/icons/bitcoins-fill-md.png') }}" alt="Bitcoins" style="height: 75px;">
          <h1 class="text-white">
          @lang('buySellBtc.compravende')
          </h1>
          <p class="text-white mb-0 text-justify">
          @lang('buySellBtc.compre')
          </p>
          <p class="text-white text-justify">
          @lang('buySellBtc.requiere')
          </p>

          <ul class="list-points points-green text-white mt-3 mb-5 mb-lg-0 pr-0 pr-xl-3">
            <li>
            @lang('buySellBtc.tras')
            </li>
            <li>
            @lang('buySellBtc.podras')
            </li>
            <li>
            @lang('buySellBtc.podrasvender')
            </li>
          </ul>
        </div>

        <div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-0 col-xl-6 offset-xl-1">
          <form class="main-card">
            <div class="row">
              <div class="col-md-6">
                <h5>@lang('buySellBtc.quierocomprar')</h5>

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

                <small id="buyHelp" class="form-text text-muted mb-2">@lang('buySellBtc.minimo')</small>
              </div>
              <div class="col-md-6">
                <h5>@lang('buySellBtc.pagas')<</h5>

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

            <h5 class="title-divider">@lang('buySellBtc.montosugeridos')</h5>

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

            <h5 class="title-divider">@lang('buySellBtc.otra')</h5>

            <div class="row">
              <div class="col-md-6">
                <span>@lang('buySellBtc.quiero')</span>
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

            <h5 class="title-divider"><span>@lang('buySellBtc.compains')</span></h5>

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
              @lang('buySellBtc.compains')
            </button>

            <h5 class="title-divider"><span>o</span></h5>

            <div class="row">
              <div class="col-md-6 my-2">
                <a href="#" class="btn btn-blue w-100" style="height: 100%;display: flex;align-items: center;">
                  <img src="{{ asset('img/landing/icons/paypal.png') }}" class="left-icon">
                  @lang('buySellBtc.paypal')
                </a>
              </div>
              <div class="col-md-6 my-2">
                <a href="#" class="btn btn-blue w-100" style="font-size: 14px;display: flex;white-space: normal;align-items: center;padding: 8px 20px;text-align: left;line-height: 1;">
                  <img src="{{ asset('img/landing/icons/western-union.png') }}" class="left-icon">
                  @lang('buySellBtc.wester')
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>