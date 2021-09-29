@extends('layouts.landing', [
  'title' => 'Login'
])

<script src='https://www.google.com/recaptcha/api.js'></script>
@section('content')
  <section id="auth" style="background: url({{ asset('img/landing/bg/home.png') }})">
    @include('partials.landing.header')
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 col-xl-5 d-flex flex-column justify-content-center mb-5 mb-lg-0">
          <h2 class="text-white">
            @lang('index.title_new_left')
          </h2>
          <p class="text-white mb-0 text-justify">
            @lang('index.new_sub_title')
          </p>
          <p class="text-white text-justify">
            @lang('index.new_sub_title4')
          </p>
        </div>

        <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-0 col-xl-6 offset-xl-1">
          <form class="main-card p-25-all" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <h3>@lang('header.iniciar')</h3>

            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach

            <div class="row mt-4">
              <div class="col-md-12">
                <div class="form-group">
                  <img src="{{ asset('img/landing/icons/email.png') }}" class="prefix">
                  <input type="email" class="form-control" placeholder="@lang('signup.email')" name="email" value = "{{old('email')}}" required>
                </div>
              </div>
             
              <div class="col-md-12">
                <div class="form-group">
                  <img src="{{ asset('img/landing/icons/key.png') }}" class="prefix">
                  <input type="password" class="form-control" placeholder="@lang('signup.password')" name="password" required>
                </div>
              </div>
            </div>

            <div class="row mt-4">
           	<div class="col-md-12">
           	    <div class="form-group d-flex justify-content-center">
           	  		<div class="g-recaptcha"  data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
           		</div>
			</div>
		 	</div>
		  </div>

            <button type="submit" class="btn btn-green w-100 mb-4 mt-3">
              @lang('header.login')
            </button>

            <p class="text-center">
              <a href="/password/reset" class="text-dark-primary underlined">@lang('login.forgot')</a>
            </p>

            <h5 class="title-divider d-flex"></h5>

           

            <div class="card text-center my-4" style="border: 0;background: var(--grey);border-radius: 8px;">
              <div class="card-body">
                <p class="m-0">
                  @lang('login.signup')
                </p>
                <a href="{{ route('new-register') }}" class="text-dark-primary underlined">@lang('header.signup')</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
    $("#idioma2").change(function () {
        var lang = $(this).val();
        window.location='/new-index/lang/'+lang;
    });

    var nameCrypto = localStorage.getItem('name_scrypto');
    var d = document.getElementById('buyCryptoTop');

    if(nameCrypto){
      d.innerText = nameCrypto;
    } else {
      d.innerText = 'Bitcoin';
    }

@endsection

@section('footer')
  @include('partials.landing.footer')
@endsection

