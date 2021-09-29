<section id="payment-methods-buy-sell">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2 class="mb-4">@lang('buyBtcWithAmex.conoce')</h2>
          <p>
            @lang('buyBtcWithAmex.lorem')
          </p>
          <a href="#" class="btn btn-blue-gradient shadow-sm">
            @lang('buyBtcWithAmex.ver')
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
                          <span class="text-green">@lang('buyBtcWithAmex.free')</span>
                        </div>
                      </div>

                      <h4 class="mb-0">@lang('buyBtcWithAmex.paypal')</h4>
                      <small>
                      @lang('buyBtcWithAmex.lorem')
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