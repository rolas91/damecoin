<style>
    .font-size{
        font-size: 30px!important;
    }
</style>
<div class="modal fade" id="westernUnionPaymentModal" tabindex="-1" role="dialog" aria-labelledby="westernUnionPaymentLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content" style="background: #ecf0f5;">
           <div class="modal-header" style="padding: 20px 30px 10px;">
               <h4 class="modal-title" id="westernUnionPaymentLabel">WESTERN UNION</h4>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;font-size: 30px;padding: 0;">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>

           <div class="modal-body" style="padding: 20px 30px;">
               <div class="text-center mb-2">
                   <img loading="lazy" src="https://lh3.googleusercontent.com/r1qrqwYTNX0x1fN_0Xty0JWzkKBgad0RylI6rmGsRg144dvrRoKuZFqMJssOHhaPtA" class="img-fluid" style="width:200px;height:200px" alt="">
               </div>
               <h4 class="text-center" style="font-weight: normal;">
                   {{ __('home_buy.western_union') }}
               </h4>
           </div>
       </div>
   </div>
</div>

@extends('layouts.landing', [
'title' => 'Skrill'
])
<script type="text/javascript">
   var totalx;
</script>
@section('content')
<section id="home" >
   @include('partials.landing.header')

   <div class="container">
   <div class="row">
   <div class="col-12 col-lg-5">
      <div>
         <img src="/img/emptylogo.png" id="imageBtcTop" width="50" height="50">
      </div>
      <h2 class="text-white font-size" id="subTitleCrypto">
        @lang('index.title_new_left2')
    </h2>
    <p class="text-white mb-2 text-justify p-description">
        @lang('index.new_sub_title') 
    </p>
    <p class="text-white mb-2 text-justify p-description">
        @lang('index.new_sub_title2')
    </p>
      <a href="{{ route('new-register') }}" class="btn btn-light-blue-gradient">@lang('index_freeacount.h2')</a>
      <ul class="list-points points-green text-white mt-3 mb-5 mb-lg-0 pr-0 pr-xl-3">
         <li class="p-description">
            @lang('index.mesagge1')
         </li>
         <li class="p-description">
            @lang('index.mesagge2')
         </li>
         <li class="p-description">
            @lang('index.mesagge3') {{$getCriptodefault->code}} @lang('index.mesagge3-1') {{$getCurrencyUser->code}} @lang('index.mesagge3-2')
         </li>
      </ul>
   </div>
   <div class="col-12 col-lg-7 mt-4">
      <div class="main-card">

         <div class="row" id="buyContainer">

            <div class="col-md-6">
               <h6>@lang('index.buydivisa')</h6>
               <div class="form-group form-group-with-select mb-0">
                  <div class="form-control" id="buy" aria-describedby="buyHelp" style="width: 152px;">{{$getCriptodefault->code}}</div>
                  <div class="select-wrapper">
                     {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                     'id' => 'getCryptos',
                     'class' => 'form-control',
                     'style' => 'width: 145px'
                     ])!!}
                  </div>
               </div>
               <small id="buyHelp" class="form-text mb-2 small text-danger d-none">Minimum 250 USD</small>
            </div>
            <div class="col-md-6 p-md-0">
               <h6>@lang('index.paydivisa')</h6>
               <div class="form-group form-group-with-select">
                  <div class="form-control"  >{{$getCurrencyUser->code}}</div>
                  <div class="select-wrapper">
                     {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                     'id' => 'getCurrencies',
                     'class' => 'form-control'])!!}
                  </div>
               </div>
            </div>
         </div>
         <h6 class="title-divider mb-2"><span>@lang('index.mount')</span></h6>
         <div class="container_prices_list">
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong></strong> {{Session::get('error')}}
            </div>
            @endif
            <div class="d-flex flex-wrap">
               @foreach($getPanel as $index => $panel)
               <div class="col-md-6 padding-md-0 
                  {{($index == 0) ? 'pl-0' : ''}}
                  {{($index == 1) ? 'pr-0' : ''}}
                  {{($index == 2) ? 'pl-0' : ''}}
                  {{($index == 3) ? 'pr-0' : ''}}">
                  <div class="custom-control custom-radio radio-amount">
                     @if($index == 2)
                     <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}" name="amount" class="custom-control-input radioBtnClass person" checked>
                     @else
                     <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}" name="amount" class="custom-control-input radioBtnClass person">
                     @endif
                     <label class="custom-control-label" for="{{$panel['id']}}">
                     <span>
                     <small>@lang('index.pay')</small>
                     <strong>{{$panel["pagar"]}}
                     {{$getCurrencyUser->code}}</strong>
                     </span>
                     <span class="d-inline ml-2 mr-2 pt-3 iqual">=</span>
                     <span>
                     <small>@lang('index.get')</small>
                     <strong>{{$panel["recibir"]}}
                     {{$getCriptodefault->code}}</strong>
                     </span>
                     </label>
                  </div>
               </div>
               @endforeach
            </div>
            <h6 class="title-divider mb-2"><span>@lang('index.otherQuantity')</span></h6>
            <div class="row" id="numbers-one">
               <div class="col-md-6">
                  <div class="radio-amount-new pb-0">
                     <div class="areaCl d-flex">
                        <input type="radio" id="customBuy" name="amount" class="custom-control-input radioBtnClassCustom person" value="{{$default['pay']}}" >
                        <label class="custom-control-label" for="customBuy">
                        <span class="small text-muted">@lang('index.get'):</span>
                        </label>
                     </div>
                  </div>
                  <div class="input-group input-group-cantidad mb-3">
                    <input type="text" class="form-control" id="persoCrypto" value="{{$default['recibe']}}" onKeyPress="return soloNumeros(event)" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                      <span class="input-group-text">
                          <img class="mr-1" id="imgCryp" src="{{asset('img/1.png')}}" alt="">
                          {{$getCriptodefault->name}}
                      </span>
                    </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <span class="small d-block mb-0 text-muted">@lang('index.pay'):</span>
                  <div class="input-group input-group-cantidad mb-3">
                    <input type="text" class="form-control" id="persoCurrency" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)" onkeyup="document.getElementById('customBuy').value=this.value; newChecked(this);" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                      <span class="input-group-text">
                          <img class="mr-1"  id="imgDiv" src="{{asset('img/1.png')}}" alt="">
                          {{$getCurrencyUser->name}}
                      </span>
                    </div>
                  </div>
               </div>
            </div>
            @include('partials.formWester')

         </div>
      </div>
   </div>
</section>
<div class="container mt-5">
   <p class="text-center">
      @lang('index.new_sub_title3')
   </p>
</div>
<script type="text/javascript">
   var currencyIS = '{{$getCurrencyUser['code']}}';
</script>
@include('index_parts_new.fees')
@include('index_parts_new.behavior')
@include('index_parts_new.about')
@include('index_parts_new.process')
@include('index_parts_new.features')
@include('index_parts_new.attention')
@include('index_parts_new.freeacount')
@include('index_parts_new.questions')
@include('index_parts_new.review')
@include('index_parts_new.freeacount2')
@include('partials.landing.footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
   var payObj = {continuePerson:0};
   $(document).ready(() => {
     var actualityCrypto = $('#buyContainer #getCryptos').val();
     var txtCrypto = $('#getCryptos option:selected').text();
     actualityDivisa = $('#getCurrencies').val();
     var icon = cryptoIconHome(actualityCrypto);
     var icon2 = cryptoIconHome(actualityDivisa);
     $('#crytp').html('{{ $metodo }}');

     $("#imageBtcTop").attr('src', icon);
     $("#imgCryp").attr('src', icon);
     $("#imgDiv").attr('src', icon2);
     

     $("#buyCryptoTop").text(txtCrypto.replace(/ *\([^)]*\) */g, ""));
   
     localStorage.setItem('img_crypto', icon);
     localStorage.setItem('name_scrypto', txtCrypto.replace(/ *\([^)]*\) */g, ""));
     console.log("ddd", actualityCrypto)
        console.log(txtCrypto)
   });
   
   
   function cryptoIconHome(name){
       return `https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/${name.toLocaleLowerCase()}.png`;
   }
   
   
   
   $("#persoCrypto").focus(function() {
    //totalPay();
       //alert($(this).val());
       //if(has)
         // alert("si");
         $('.radioBtnClass').each(function()
         {
           $(this).prop('checked', false);
         })
   });
   
   $("#persoCurrency").focus(function() {
       //alert($(this).val());
       //if(has)
         // alert("si");
         $('.radioBtnClass').each(function()
         {
           $(this).prop('checked', false);
         })
   });
   
   
   $('.radioBtnClass').click(function() {

      totalPay();

       //alert($(this).val());
       //if(has)
      if ($(this).hasClass('person')){
         // alert("si");
          //$("#persoCrypto").removeAttr("disabled");
          //$("#persoCurrency").removeAttr("disabled");
      }else{
           //$("#persoCrypto").attr("disabled","disabled");
           //$("#persoCurrency").attr("disabled","disabled");
   
      }
   
      $("#customBuy").removeAttr('checked');
   
     //$("#persoCrypto").attr("disabled","disabled");
     //$("#persoCurrency").attr("disabled","disabled");
   
   });
   
   //CUSTOM BUY
   
   $(".areaCl").click(() => {
   
       $("#customBuy").val($("#persoCurrency").val());
   
       $("#persoCrypto").removeAttr("disabled");
       $("#persoCurrency").removeAttr("disabled");
   }); 
   
   //CUSTOM BUY
   
   $('#persoCrypto').click(function(){
       totalPay();
       $('#persoCrypto').prop('disabled', false);
   });
   
   
   $("#getCurrencies").change(function () {
         var str = $(this).val();
         var currency  = str.toLowerCase();
         var xcrypto=$("#getCryptos").val();
         var crypto = xcrypto.toLowerCase();
         var pais="{{ $pais }}";
         var metodo = '{{ $metodo }}';
         redireccion(crypto,currency,metodo);
     });
     function redireccion(crypto,currency,metodo){
        @if(app()->getLocale()=="de")
            // window.location='/kauf-'+crypto+'/with-card-in-'+currency;
            window.location = `/Kaufen-${crypto}/${currency}/mit/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="ae")
            // window.location='/يشترى-'+crypto+'/with-credit-card-in-'+currency;
            window.location = `/يشترى-${crypto}/${currency}/مع/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="hi")
            // window.location='/खरीद सकते हैं-'+crypto+'/चुनाव-कार्ड-इन-'+currency;
            window.location = `/खरीद-${crypto}/${currency}/साथमें/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="es")
            // window.location='/buy-'+crypto+'/con-tarjeta-en-'+currency;
            window.location = `/comprar-${crypto}/${currency}/con/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="en")
            // window.location='/buy-'+crypto+'/with-credit-card-in-'+currency;
            window.location = `/buy-${crypto}/${currency}/with/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="fr")
            // window.location='/acheter-'+crypto+'/avec-card-in-'+currency;
            window.location = `/acheter-${crypto}/${currency}/avec/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="ru")
            // window.location='/купить-'+crypto+'/с-карта-в-'+currency;
            window.location = `/купить-${crypto}/${currency}/сучастием/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="it")
            // window.location='/acquistare-'+crypto+'/con-card-in-'+currency;
            window.location = `/acquistare-${crypto}/${currency}/con/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="jp")
            // window.location='/買う-'+crypto+'/con-カードイン-'+currency;
            window.location = `//購入-${crypto}/${currency}/と/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="th")
            // window.location='/ซื้อ-'+crypto+'/กับบัตรใน-'+currency;
            window.location = `/ซื้อ-${crypto}/${currency}/ด้วย/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="cz")
            // window.location='/koupit-'+crypto+'/s-kartou-'+currency;
            window.location = `/Koupit-${crypto}/${currency}/s/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="pt")
            // window.location='/comprar-'+crypto+'/com-cartão-'+currency;
            window.location = `/comprar-${crypto}/${currency}/com/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="kr")
            // window.location='/사다-'+crypto+'/카드-인-'+currency;
            window.location = `/구입-${crypto}/${currency}/와/westernUnion/{{app()->getLocale()}}`;
        @endif

        @if(app()->getLocale()=="ch")
            // window.location='/买-'+crypto+'/与-卡-在-'+currency;
            window.location = `/购买-${crypto}/${currency}/与/westernUnion/{{app()->getLocale()}}`;
        @endif
        @if(app()->getLocale()=="se")
            // window.location='/köpa-'+crypto+'/with-credit-card-in-'+currency;
            window.location = `/köpa-${crypto}/${currency}/med/westernUnion/{{app()->getLocale()}}`;
        @endif
     }
     $("#getCryptos").change(function () {
         var str = $(this).val();
         var crypto = str.toLowerCase();
         var xcurren=$("#getCurrencies").val();
         var currency = xcurren.toLowerCase();
         //var pais="venezuela";
         var pais="{{ $pais }}";
         var metodo = '{{ $metodo }}';

         redireccion(crypto,currency,metodo);
     });

     
     
   
     $("#persoCrypto").keyup(function () {
      totalPay();
     var crypto=$(this).val();
     var defaultCurrency='{{$default['pay']}}';
     var defaultCripto='{{$default['recibe']}}';
     var totalCurrency=parseFloat((defaultCurrency*crypto)/defaultCripto);
     var totalCurrency=totalCurrency.toFixed(2);
     if(isNaN(totalCurrency)){
         totalCurrency=0;
         totalCurrency=totalCurrency.toFixed(2);
         $("#persoCurrency").val(totalCurrency);
     }else{
         $("#persoCurrency").val(totalCurrency);
     }

     $("#pay").text(totalCurrency + " " + actualityDivisa)

   });
   
   $("#persoCurrency").keyup(function () {
       var currency=$(this).val();
       var defaultCurrency='{{$default['pay']}}';
       var defaultCripto='{{$default['recibe']}}';
       var totalCrypto=parseFloat((currency*defaultCripto)/defaultCurrency);
   
       var totalCrypto=totalCrypto.toFixed(7);
       if(isNaN(totalCrypto)){
           totalCrypto=0;
           totalCrypto=totalCrypto.toFixed(7);
           $("#persoCrypto").val(totalCrypto);
       }else{
           $("#persoCrypto").val(totalCrypto);
       }

       
   });
   
   $("#idioma").change(function () {
       var xcurren=$("#getCurrencies").val();
       var currency = xcurren.toLowerCase();
       var xcrypto=$("#getCryptos").val();
       var crypto = xcrypto.toLowerCase();
       var method = 'westerUnion';
       var lang = $(this).val();

       var prefix = 'metodo';      

       window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
    //    window.location = `/buy-${crypto}/${currency}/with/westerUnion/${lang}`;
   });
   $("#idioma2").change(function () {
      var xcurren=$("#getCurrencies").val();
       var currency = xcurren.toLowerCase();
       var xcrypto=$("#getCryptos").val();
       var crypto = xcrypto.toLowerCase();
       var metodo = '{{ $metodo }}';
       var lang = $(this).val();

       window.location = `/buy-${crypto}/${currency}/with/westerUnion/${lang}`;

   });
   
   function soloNumeros(e){

          key = e.keyCode || e.which;
          tecla = String.fromCharCode(key).toLowerCase();
          letras = " 1234567890";
          especiales = [8,37,39,46];
   
          tecla_especial = false
          for(var i in especiales){
               if(key == especiales[i]){
                   tecla_especial = true;
                   break;
               }
   
         }
   
   
         if(letras.indexOf(tecla)==-1 && !tecla_especial){
           return false;
         }
       }
   
   var style = {
     base: {
       color: '#32325d',
       fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
       fontSmoothing: 'antialiased',
       fontSize: '16px',
       '::placeholder': {
         color: '#aab7c4'
       }
     },
     invalid: {
       color: '#fa755a',
       iconColor: '#fa755a'
     }
   };
   
   
   function newChecked(th){
     $("input[type='radio']").removeAttr('checked');
     $("#customBuy").attr('checked','checked');
     totalPay();
     console.log(th);
   }
   
   
   $("#persoCurrency").click(() =>{
      $("input[type='radio']").removeAttr('checked');
      $("#customBuy").attr('checked','checked');
      totalPay();
   });
   
   $("#persoCrypto").click(() =>{
      totalPay();
      $("input[type='radio']").removeAttr('checked');
      $("#customBuy").attr('checked','checked');
   });
   
   
   
   
   
</script>
<!--section end -->
@endsection
@section('scripts')
@endsection