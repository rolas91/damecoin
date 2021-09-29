<section id="how-it-works">
    <div class="container">
      <h2 class="text-center mb-5">@lang('index_process.new_h2')</h2>

      <div class="carousel-steps">
        <div class="step active" onclick="$('#how-it-works-carousel').slick('slickGoTo', 0);">
          <span class="icon">
            <img src="{{ asset('img/landing/icons/wallet.png') }}">
          </span>
          @lang('index_process.step1_new')
        </div>
        <div class="conector">
          <img src="{{ asset('img/landing/icons/triangle.png') }}">
        </div>
        <div class="step" onclick="$('#how-it-works-carousel').slick('slickGoTo', 1);">
          <span class="icon">
            <img src="{{ asset('img/landing/icons/wallet.png') }}">
          </span>
            @lang('index_process.step2_new')
        </div>
        <div class="conector">
          <img src="{{ asset('img/landing/icons/triangle.png') }}">
        </div>
        <div class="step" onclick="$('#how-it-works-carousel').slick('slickGoTo', 2);">
          <span class="icon">
            <img src="{{ asset('img/landing/icons/wallet.png') }}">
          </span>
            @lang('index_process.step3_new')
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 d-flex align-items-center">
          <div id="how-it-works-carousel">
            <div>
              <h3 class="text-primary">@lang('index_process.step1')</h3>
              <p>
                @lang('index_process.step1p')
              </p>
            </div>

            <div>
              <h3 class="text-primary">@lang('index_process.step2')</h3>
              <p>
                @lang('index_process.step2p')
              </p>
            </div>

            <div>
              <h3 class="text-primary">@lang('index_process.step3')</h3>
              <p>
                @lang('index_process.step3p')
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-5 offset-md-1">
          <img src="{{ asset('img/landing/03.png') }}" class="img-fluid">
        </div>
      </div>
    </div>
  </section>