<section id="free-account">
    <div class="container">
      <div class="row">
        <div class="col-md-5 d-none d-md-flex align-items-center offset-md-1">
          <img src="{{ asset('img/landing/05.png') }}" class="img-fluid">
        </div>
        <div class="col-md-5 col-lg-4 offset-lg-2 free-account-card text-center">
          <h2 class="text-white">@lang('index_freeacount.h2')</h2>
          <p class="text-white">
            @lang('index_freeacount.h2_p')
          </p>
          <a href="{{ route('new-register') }}" class="btn btn-light-blue-gradient" style="align-self: center;">
            <img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
            @lang('header.signup')
          </a>
        </div>
      </div>
    </div>
</section>