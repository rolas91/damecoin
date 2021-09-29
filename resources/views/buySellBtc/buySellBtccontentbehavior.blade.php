<section id="behavior-buy-sell-btc">
    {{-- <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <img src="{{ asset('img/landing/bg/money-squared.png') }}">
          <div class="row">
            <div class="col-md-6 bordered-md-right">
              <h2>@lang('buySellBtc.cotizacion')</h2>
            </div>
            <div class="col-md-6">
              is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
            </div>
          </div>

          <div class="card card-behavior-buy-sell-btc">
            <div class="card-body">
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="d-flex" id="imagenCrypto">
                    <img src="{{ asset('img/landing/icons/bitcoins-fill.png') }}" style="width: 40px;height: 40px;">
                    <div>
                      <h2 style="font-size: 30px" class="mb-0">BTC</h2>
                    </div>
                  </div>
                  @lang('buySellBtc.valor')
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

            @lang('buySellBtc.valor')
            <h4 class="mb-0">USD 2.523.089</h4>
            <span class="text-green">
              216.10 USD (2.17%)
            </span>
          </div>
        </div>
      @endfor
    </div>
  </section>