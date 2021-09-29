@extends('layouts.landing', [
  'title' => 'Iniciar Sesión'
])


@section('content')
  <section id="auth" style="background: url({{ asset('img/landing/bg/home.png') }})">
    @include('partials.landing.header')
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 col-xl-5 d-flex flex-column justify-content-center mb-5 mb-lg-0">
          <h1 class="text-white text-center font-weight-normal">
            Contact
          </h1>
        </div>

        <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-0 col-xl-6 offset-xl-1">
            <img src=" https://damecoins.com/img/about-img.png" alt="">
        </div>
      </div>
    </div>
  </section>

  <div class="w-75" style="margin: 0 auto; color: black !important">
   
      <h2>Contact</h2>
      <p>DAME Banking Group Ltd.  (Part of Trigox Limited) </p>
      <p>27 Old Gloucester Street<br> London, WC1N 3AX
          ,United Kingdom<br> Company Number: 12744787</p>
      <p>+44 20 3856 3532</p>
      <p>info@trigox.com</p>
  </div>
  <div class="d-flex justify-content-center align-items-center">
  <a href="/signup" class="site-btn sb-gradients sbg-line mt-5 mx-auto">@lang('index_about.about_signup')</a>

  </div>
  
@endsection


@section('scripts')

  $("#idioma2").change(function () {
      var lang = $(this).val();
      window.location='/lang/'+lang;
  });

@endsection
@section('footer')
  @include('partials.landing.footer')
@endsection