<section id="comparison">
    <img src="{{ asset('img/landing/bg/rectangle-blue-rotated.png') }}" class="position-absolute" style="z-index: -1;width: 100%;">
    <div class="container">
      <div class="text-center">
        <img src="{{ asset('img/landing/bg/money-bitcoins2.png') }}" style="width: 100px;">
      </div>

      <h2 class="text-center mt-4">@lang('index_fees.title')</h2>
      <p class="text-center">
        @lang('index_fees.subtitle')
      </p>

      <div class="platform-comparison mt-5">
        <div class="card card-platform-comparison card-platform-comparison-titles">
          <div class="card-body">
            <div class="item">
            </div>
            <div class="item">
                <small>@lang('index_fees.m1')</small>
            </div>
            <div class="item">
                <small>@lang('index_fees.m2')</small>
            </div>
            <div class="item">
                <small>@lang('index_fees.m3')</small>
            </div>
            <div class="item">
                <small>@lang('index_fees.m4')</small>
            </div>
            
          </div>
        </div>

        <div id="comparison-carousel">
          <div class="card card-platform-comparison">
            <div class="card-body">
              <div class="item">
                <img src="{{ asset('img/landing/logos/binance.png') }}" alt="BINANCE" class="img-fluid">
              </div>
              <div class="item">
                <strong class="text-primary">3.99%</strong>
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
            </div>
          </div>

          <div class="card card-platform-comparison">
            <div class="card-body">
              <div class="item">
                <img src="{{ asset('img/landing/logos/coinmama.png') }}" alt="COINMAMA" class="img-fluid">
              </div>
              <div class="item">
                <strong class="text-primary">10.5%</strong>
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
            </div>
          </div>

          <div class="card card-platform-comparison card-platform-comparison-active">
            <div class="card-body">
              <div class="item">
                <img src="{{ asset('img/landing/logos/damecoins.png') }}" alt="DAMECOINS" class="img-fluid">
              </div>
              <div class="item">
                <span class="btn btn-blue" style="cursor: default;">1.99%</span>
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/check-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/check-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/check-circle.png') }}">
              </div>
            </div>
          </div>

          <div class="card card-platform-comparison">
            <div class="card-body">
              <div class="item">
                <img src="{{ asset('img/landing/logos/coinbase.png') }}" alt="COINBASE" class="img-fluid">
              </div>
              <div class="item">
                <strong class="text-primary">3.50%</strong>
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/check-circle.png') }}">
              </div>
            </div>
          </div>

          <div class="card card-platform-comparison">
            <div class="card-body">
              <div class="item">
                <img src="{{ asset('img/landing/logos/btcdirect.png') }}" alt="BTCDIRECT" class="img-fluid">
              </div>
              <div class="item">
                <strong class="text-primary">5%</strong>
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
            </div>
          </div>

          <div class="card card-platform-comparison">
            <div class="card-body">
              <div class="item">
                <img src="{{ asset('img/landing/logos/bitstamp.png') }}" alt="BITSTAMP" class="img-fluid">
              </div>
              <div class="item">
                <strong class="text-primary">5%</strong>
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/close-circle.png') }}">
              </div>
              <div class="item">
                <img src="{{ asset('img/landing/icons/check-circle.png') }}">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="comparison-carousel-dots"></div>
    </div>
  </section>