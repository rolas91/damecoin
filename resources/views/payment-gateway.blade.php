
@extends('layouts.landing', [
  'title' => "Payment"
])

@section('meta_tags')
    <!-- Seo Tags -->
    <meta name="description" content="{{ $meta['descripcion'] }}">
    <meta name="keywords" content="{{ $meta['key'] }}">
    <meta name="robots" content="index, follow">
    <meta property="og:image" content="{{ asset('img/damecoins/facebooklinkpreview.jpg') }}" />
    <meta property="og:image:width" content="963" />
    <meta property="og:image:height" content="540" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:description" content="{{ $meta['descripcion'] }}" />
    <!-- /Seo Tags -->
@overwrite
<style>
    .help-block {
        color: red !important;
    }

    .mail {
        /* color: #20509e !important; */
        color: #8f9bbb !important;
        font-weight: 900;
    }

    .benefits-items {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 0;
    }

    .benefits-item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-bottom: 10px;
        padding-left: 3rem;
    }

    .benefits-item-columns {
        width: 100%;
    }

    .benefits-icon {
        -ms-flex-item-align: start;
        align-self: flex-start;
        color: #fff;
        font-size: 12px;
        border-radius: 50%;
        padding: .2rem .2rem;
        background-color: #00d270;
        margin-right: 15px;
        margin-top: 2px;

    }

    .benefits-text {
        font-size: 15px;
        color: #20509e !important;
        list-style: none;

    }

    .content-text{
        background-color: rgba(3, 3, 3, 0.281);
        text-align: justify;
        padding: 10px;
        border-radius: 5px;
    }
    .content-text2{
        background-color: rgb(17 30 68 / 85%);
        text-align: justify;
        padding: 10px;
        border-radius: 5px;
    }
</style>
@section('content')
<!-- section -->
<section id="auth" style="background: url({{ asset('img/landing/bg/home.png') }})">
    @include('partials.landing.header')
    
    <div class="container">
        
        <div class="row">
            <div class="col-md-10 offset-md-1 px-0 px-md-2 mt-4 mt-md-2">
                <section class="about-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="about-img" style="position: relative; left: 0;">
                                    <img src=" {{ asset('img/about-img.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-12 about-text mt-4 mb-4 px-4 px-md-2 text-white">
                                <h2>@lang('payment-gateway.title')</h2>
                                <div class="content-text" >
                                    <p><b>@lang('payment-gateway.subtitle')</b></p>
                                    <p><b>@lang('payment-gateway.paragraph-1')</b></p>

                                    <p><b>@lang('payment-gateway.paragraph-2')</b></p>

                                    <p><b>@lang('payment-gateway.paragraph-3')</b></p>

                                    <p>@lang('payment-gateway.paragraph-4')</p>

                                    <p>@lang('payment-gateway.paragraph-5')</p>

                                    <p>@lang('payment-gateway.paragraph-6')</p>

                                    <p>@lang('payment-gateway.paragraph-7')</p>
    
                                    <!--<p>@lang('payment-gateway.more-info')</p>
                               
                                    <ul class="benefits-items">
                                        <li class="benefits-item benefits-item-columns">
                                            <span class="benefits-icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <span class="benefits-text text-white">
                                                @lang('payment-gateway.benefit-1')
                                            </span>
                                        </li>
                                        <li class="benefits-item benefits-item-columns">
                                            <span class="benefits-icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <span class="benefits-text text-white">
                                                @lang('payment-gateway.benefit-2')
                                            </span>
                                        </li>
                                        <li class="benefits-item benefits-item-columns">
                                            <span class="benefits-icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <span class="benefits-text text-white">
                                                @lang('payment-gateway.benefit-3')
                                            </span>
                                        </li>
                                        <li class="benefits-item benefits-item-columns">
                                            <span class="benefits-icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <span class="benefits-text text-white">
                                                @lang('payment-gateway.benefit-4')
                                            </span>
                                        </li>
                                        <li class="benefits-item benefits-item-columns">
                                            <span class="benefits-icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <span class="benefits-text text-white">
                                                @lang('payment-gateway.benefit-5')
                                            </span>
                                        </li>
                                    </ul>-->
                                </div>

                                <div class="mt-3 content-text2">
                                    <div class="container">
                                        {{ Form::open(['route' => 'paymentGatewayEmail', 'method' => 'POST', 'id' => "formcontact"]) }}
                                            <span style="font-size: 20px; font-weight: 600">Application form</span>
                                            <br>
                                            @lang('index.testPaymentGateway2')

                                            <div class="row mt-4 flex-column justify-content-center align-items-center">
                                                <div>
                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="ingress">@lang('payment-gateway.benefit-1')</label>
                                                        {{ Form::text('ingress','', ['class' => 'form-control','required'=>'required','placeholder' => '50,000 USD', 'id' => 'ingress', 'value' => old('ingress')]) }}
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="site">@lang('payment-gateway.benefit-2')</label>
                                                        {{ Form::text('site','', ['class' => 'form-control','required'=>'required','placeholder' => 'yourwebsite.com', 'id' => 'site', 'value' => old('site')]) }}
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="business">@lang('payment-gateway.benefit-3')</label>
                                                        {{ Form::text('business','', ['class' => 'form-control', 'id' => 'business','placeholder' => 'Manufacturing, IT, software development, gamble...', 'value' => old('business')]) }}
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="account">@lang('payment-gateway.benefit-4')</label>
                                                        {{ Form::text('account','', ['class' => 'form-control','required'=>'required', 'id' => 'account','placeholder' => 'BTC', 'value' => old('account')]) }}
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="wpp">@lang('payment-gateway.benefit-5')</label>
                                                        {{ Form::text('wpp','', ['class' => 'form-control','required'=>'required', 'id' => 'wpp', 'placeholder' => '+44 20 3856 3532 (Whatsapp)', 'value' => old('wpp')]) }}
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="name">@lang('index.form_name')</label>
                                                        {{ Form::text('name','', ['class' => 'form-control','required'=>'required', 'id' => 'name','placeholder' => 'John', 'value' => old('name')]) }}
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="lastname">@lang('index.form_lastname')</label>
                                                        {{ Form::text('lastname','', ['class' => 'form-control','required'=>'required', 'id' => 'lastname', 'placeholder' => 'Tonks', 'value' => old('lastname')]) }}
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6">
                                                        <label for="email">@lang('index.form_email')</label>
                                                        {{ Form::text('email','', ['class' => 'form-control', 'required'=>'required','id' => 'email', 'placeholder' =>'john.tonks@gmail.com', 'value' => old('email')]) }}
                                                        @if ($errors->has('email'))
                                                            <span class="help-block text-danger" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-xs-10 col-sm-10 col-md-8 col-lg-6 d-flex flex-column" style="color: black">
                                                        <label for="name" style="color: white">@lang('index.form_phone')</label>
                                                        {{ Form::text('phone','', ['class' => 'form-control','required'=>'required', 'placeholder' => '+44 20 3856 3532', 'id' => 'phone', 'value' => old('phone')]) }}
                                                    </div>

                                                    <div class='form-group col-xs-10 col-sm-10 col-md-8 col-lg-6 d-flex flex-column'>
                                                        <label for="country">@lang('index.form_country')</label>
                                                        {!!Form::select('country', $getCountry, '', [ 'id' => 'country', 'class' =>
                                                        'form-control mb-3 mb-md-0 mb-lg-0', 'placeholder' => __('index.form_country') ,
                                                        'required'=>'required' ])!!}               
                                                    </div>
                                                </div>
 
                                                <div class="g-recaptcha"  data-sitekey="6LeNLlwaAAAAAL_EF52qj8UWu5M-hw2SdJgpNemy">
                                                
                                                </div>
                                                @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block text-danger" role="alert">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                                                @endif
                                                <div class="col-md-4 w-100">
                                                    {{ Form::submit(__("index.btnPaymentGatewWayEmail"),['class' => 'btn btn-light-blue-gradient', 'style' => 'width: 100%']) }}
                                                </div>
                                            </div>
                                        {{ Form::close() }}
                                        
                                        @if (Session::has('error_captcha'))
                                                    <div class="alert alert-danger mt-4">
                                                        <center>
                                                            {{Session::get('error_captcha') }}
                                                        </center>
                                                    </div>
                                                @endif

                                        @if (Session::has('success'))
                                            <div class="alert alert-success mt-4">
                                                <center>
                                                    {{Session::get('success') }}
                                                </center>
                                            </div>
                                        @endif @if (Session::has('danger'))
                                            <div class="alert alert-danger mt-4">
                                                <center>
                                                    {{ Session::get('danger') }}
                                                </center>
                                            </div>

                                            <center>
                                                <a href="/signup" class="btn btn-light-blue-gradient">@lang('footer.signup')</a>
                                            </center>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-10 offset-1 mt-3 mb-3">
                                    <img src="{{ asset('img/example-gateway.jpeg') }}" class="img-fluid" alt="">
                                    <p class="px-3" style="font-size: .9rem">
                                        @lang('payment-gateway.example-text')
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('tel/intlTelInput.js') }}" ></script>
<script>
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
    var input = document.querySelector("#phone");
    var iti= window.intlTelInput(input, {
      // any initialisation options go here
      utilsScript: "{{ asset('tel/utils.js') }}"
    });

    document
          .querySelector('#formcontact')
          .addEventListener('submit', function (event) {
              console.log("si")
               event.preventDefault();
              //validando phone
               if (input.value.trim()) {
                 if (iti.isValidNumber()) {
                    var numberPhone = iti.getNumber();
                    $("#formcontact").submit()
 
                 } else {
 
                   var errorCode = iti.getValidationError();
                   var x=errorMap[errorCode];
                   swal({text: "{{ __('index.form_phone') }}" + ":"+x, icon: "error"}); 
                   return;
 
                 }
               }else{
 
                   swal({text: "Invalid " + "{{ __('index.form_phone') }}", icon: "error"});
                   return;
               }
          })
</script>
<!--section end -->
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