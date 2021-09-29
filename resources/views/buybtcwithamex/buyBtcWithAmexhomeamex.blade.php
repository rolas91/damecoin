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
          @lang('buyBtcWithAmex.buydivisa')<span class="text-green">@lang('buyBtcWithAmex.paydivisa')</span>
          </h1>
          <p class="text-white mb-0 text-justify">
          @lang('buyBtcWithAmex.textwhite')
          </p>
          <p class="text-white text-justify">
          @lang('buyBtcWithAmex.textwhiteone')
          </p>

          <ul class="list-points points-green text-white mt-3 mb-5 mb-lg-0 pr-0 pr-xl-3">
            <li>
          @lang('buyBtcWithAmex.pay')
            </li>
            <li>
          @lang('buyBtcWithAmex.get')
            </li>
            <li>
          @lang('buyBtcWithAmex.sell')
            </li>
          </ul>
        </div>

        <div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-0 col-xl-6 offset-xl-1 d-flex align-items-center">
          <form class="main-card">
            <div class="row">
              <div class="col-md-12">
                <h5>@lang('buyBtcWithAmex.tobuy')</h5>

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

                <small id="buyHelp" class="form-text text-muted mb-2">@lang('buyBtcWithAmex.minimunone')</small>
              </div>

              <div class="col-md-12 text-right">
                <div class="switch-inputs">
                  <img src="{{ asset('img/landing/icons/switch-vertical.png') }}" class="img-fluid">
                </div>
              </div>

              <div class="col-md-12">
                <h5>@lang('buyBtcWithAmex.iwanttobuy')</h5>

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

                <small id="buyHelp" class="form-text text-muted mb-2">@lang('buyBtcWithAmex.minimuntwo')</small>
              </div>
            </div>

            <h5 class="title-divider"></h5>

            <div class="row">
              <div class="col-md-12">
                <h5>@lang('buyBtcWithAmex.direction')</h5>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Dirección" name="address">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-light-blue-gradient btn-lg w-100 mt-4 mb-2" style="z-index: 1;position: relative;">
              @lang('buyBtcWithAmex.paywithneteller')
              <img src="{{ asset('img/landing/icons/chevron-right.png') }}" class="right">
            </button>

            <div class="text-center mt-3">
              <a href="#">@lang('buyBtcWithAmex.moremethodofpay')</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>