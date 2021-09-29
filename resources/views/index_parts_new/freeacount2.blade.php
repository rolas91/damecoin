<section>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 text-center">
        <img src="{{ asset('img/landing/06.png') }}" class="img-fluid">
        <h2 class="text-dark-primary">@lang('index_freeacount.h2')</h2>
        <p>
            @lang('index_freeacount.h2_p')
        </p>
        <a href="{{ route('new-register') }}" class="btn btn-light-blue-gradient">
          <img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
          @lang('header.signup')
        </a>
      </div>
    </div>
  </div>
</section>