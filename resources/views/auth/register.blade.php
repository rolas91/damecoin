@extends('layouts.landing', [
  'title' => 'Registro'
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
          <form class="main-card p-25-all" method="POST" action="/register">
          {{ csrf_field() }}
            <h3 class="mb-4">@lang('signup.header')</h3>

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
            @endforeach

            <div class="form-group">
              <label for="name">@lang('signup.name')</label>
              <input type="text" class="form-control" placeholder="@lang('signup.name')" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
              <label for="name">@lang('signup.lastName')</label>
              <input type="text" class="form-control" placeholder="@lang('signup.lastName')" name="lastname" value="{{ old('lastname') }}" required>
            </div>

            <div class="form-group">
              <label for="email">@lang('signup.email')</label>
              <input type="email" class="form-control" placeholder="@lang('signup.email')" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
              <label for="email" class="col-md-12 control-label p-0">@lang('signup.country')</label>
              <div class="col-md-12 p-0">
                      {!!Form::select('country', $getCountry, '', [
                          'id' => 'getCountry',
                          'class' => 'form-control',
                          'placeholder' => __('signup.country'),
                          'required'=>'required'
                      ])!!}
              
                  @if ($errors->has('country'))
                      <span class="help-block">
                          <strong>{{ $errors->first('country') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

            <div class="form-group">
              <label for="password">@lang('signup.password')</label>
              <input type="password" class="form-control" placeholder="@lang('signup.password')" name="password" required>
            </div>

            <div class="form-group">
              <label for="password">@lang('signup.confirm')</label>
              <input type="password" class="form-control" placeholder="@lang('signup.confirm')" name="password_confirmation" required>
            </div>

            <div class="form-group d-flex justify-content-center">
                <div class="g-recaptcha" 
             data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
              </div>
            </div>

  

            <h5 class="title-divider mt-4"></h5>

            <button type="submit" class="btn btn-green w-100 mb-3 mt-2">
              @lang('signup.buttom')
            </button>

            <div class="card text-center my-4" style="border: 0;background: var(--grey);border-radius: 8px;">
              <div class="card-body">
                <!--<p class="m-0">
                  ¿Ya tienes una cuenta en Damecoins?
                </p>-->
                <a href="{{ route('new-login') }}" class="text-dark-primary underlined">@lang('header.iniciar')</a>
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