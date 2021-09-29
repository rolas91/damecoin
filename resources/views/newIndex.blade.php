@extends('layouts.landing', [
'title' => 'Landing'
])

<script type="text/javascript">
   var totalx;
</script>
<script>  </script>
@section('content')
<section id="home" >
   @include('partials.landing.header')

   <link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
<style>
   .intl-tel-input {
      position: relative;
      display: block;
  }
</style>

   <div class="container">
   <div class="row">
   <div class="col-12 col-lg-5">
      <!--<div>
         <img src="/img/emptylogo.png" id="imageBtcTop" width="50" height="50">
      </div>-->

      <h3 class="text-white" id="subTitleCrypto" style="margin-top: 22px">
         @lang('index.title_new_left')
      </h3>
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
        @if (Session::has('success'))
               <div class="alert alert-success mt-4">
                  <center>{{Session::get('success') }}</center>
               </div>
               @endif @if (Session::has('danger'))
               <div class="alert alert-danger mt-4">
                  <center>
                     {{ Session::get('danger') }}
                  </center>
               </div>
               @endif
         <div class="row" id="buyContainer">
            <div class="col-md-6">
               <h6>@lang('index.buydivisa')</h6>
               <div class="form-group form-group-with-select mb-0">
                  <div class="form-control" id="buy" aria-describedby="buyHelp">{{$getCriptodefault->code}}</div>
                  <div class="select-wrapper">
                     {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                     'id' => 'getCryptos',
                     'class' => 'form-control'
                     ])!!}
                  </div>
               </div>
               <small id="buyHelp" class="form-text mb-2 small text-danger d-none">Minimum 250 USD</small>
            </div>
            <div class="col-md-6 p-md-0">
               <h6>@lang('index.paydivisa')</h6>
               <div class="form-group form-group-with-select">
                  <div class="form-control" id="pay" >{{$getCurrencyUser->code}}</div>
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
               <!--
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  -->
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
            <!--<div class="col-md-12">
               <div class="custom-control custom-radio radio-amount border-0 ">
               <input type="radio" id="person" name="amount" class="custom-control-input radioBtnClass person" value="{{$panel['default']}}">
                 <label class="custom-control-label d-flex align-items-center flex-wrap" for="person">
                 <div class="col-md-12 col-sm-12">
                   <span>Quiero comprar:</span>
                   <div class="form-group form-group-with-select mb-0">
                     <input type="text" class="form-control" id="persoCrypto" aria-describedby="buyHelp" value="{{$default['recibe']}}" onKeyPress="return soloNumeros(event)">
                     <div class="select-wrapper">
                       <select class="form-control">
                         <option>{{$getCriptodefault->name}}</option>
                       </select>
                     </div>
                   </div>
                 </div>
               
                 <div class="col-md-12 col-sm-12">
                   <span>Pagas:</span>
                   <div class="form-group form-group-with-select mb-0">
                     <input type="text" class="form-control" id="persoCurrency" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)">
                     <div class="select-wrapper">
                       <select class="form-control">
                         <option>{{$getCurrencyUser->name}}</option>
                       </select>
                     </div>
                   </div>
                 </div>
                 </label>
               </div>
               </div>-->
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
                  <div class="form-group form-group-with-select mb-0">
                     <input type="text" class="form-control" id="persoCrypto" aria-describedby="buyHelp" value="{{$default['recibe']}}" onKeyPress="return soloNumeros(event)" onkeyup="totalPay();">
                     <div class="select-wrapper wrapper-select">
                        <select class="form-control" id="obtainCrypto">
                           <option>{{$getCriptodefault->name}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <span class="small d-block mb-0 text-muted">@lang('index.pay'):</span>
                  <div class="form-group form-group-with-select">
                     <input type="text" class="form-control person" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)" id="persoCurrency" onkeyup="document.getElementById('customBuy').value=this.value; newChecked(this);">
                     <div class="select-wrapper wrapper-select">
                        <select class="form-control" id="obtainFiat">
                           <option>{{$getCurrencyUser->name}}</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <h5 class="title-divider d-none"><span>@lang('index.paycard')</span></h5>
          
            @include('partials.form.payment-activo',['dir'=>'index'])
            

            <h5 class="text-center"><span>o</span></h5>

            <div class="row p-25 pb-3">

               @include('partials.bootonModal')
               <p class="text-justify p-3"> <small>*PayPal has its own commission from 2.4% to 3.4%, on top of which we add our commission.  Its high commissions are the reason why most cryptocurrency sites don't support it as a payment method.  We support it but do not recommend it.  To avoid high commissions we recommend that you create a free account and make your payment by bank transfer.  We have accounts in more than 5 countries (Amercia, Asia, Europe, Australia) for your convenience and thus avoid unnecessary commissions</small></p>
            </div>
               
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

{{-- @include('index_parts_new.behavior')--}}

@include('index_parts_new.about')
@include('index_parts_new.process')
@include('index_parts_new.features')
@include('index_parts_new.attention')
@include('index_parts_new.freeacount')
@include('index_parts_new.questions')
@include('index_parts_new.review')
@include('index_parts_new.freeacount2')
@include('partials.landing.footer')
<script>
   var payObj = {continuePerson:0};
   
   $(document).ready(function(){
        let scrAlipay = '{{$limit_pay[0]->qr_alipay}}'
        let scrWechat = '{{$limit_pay[0]->qr_wechat}}'

        console.log($("#container-qrs"))
        $("#container-qrs").append(`
          <img class="size_qr" src="/methodpayQR/qr_index_new.jpg" data-toggle="modal" data-target="#QrPayPaymentModal" />
          <img class="size_qr" src="/methodpayQR/${scrWechat}" data-toggle="modal" data-target="#WechatPayPaymentModal" onclick="newWechatpay()"/>
          <img class="size_qr" src="/methodpayQR/${scrAlipay}" data-toggle="modal" data-target="#AlipayPaymentModal" onclick="newAlipay()"/>
        `)
    })
  //$(document).ready(() => {
  //  var actualityCrypto = $('#buyContainer #getCryptos').val();
  //  var txtCrypto = $('#getCryptos option:selected').text();
  //  var icon = cryptoIconHome(actualityCrypto);
  //  $("#imageBtcTop").attr('src', icon);
  //  $("#buyCryptoTop").text(txtCrypto.replace(/ *\([^)]*\) */g, ""));
  //
  //  localStorage.setItem('img_crypto', icon);
  //  localStorage.setItem('name_scrypto', txtCrypto.replace(/ *\([^)]*\) */g, ""));
  //  console.log("ddd", actualityCrypto)
  //     console.log(txtCrypto)
  //});
   
   
   function cryptoIconHome(name){
       return `https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/${name.toLocaleLowerCase()}.png`;
   }
   $('#buyCryptoTop').html('{{ $getCriptodefault->name }}');
   
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

     // totalPay();

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
       //totalPay();
       $('#persoCrypto').prop('disabled', false);
   });
   
   
   $("#getCurrencies").change(function () {
         var str = $(this).val();
         var currency  = str.toLowerCase();
         var xcrypto=$("#getCryptos").val();
         var crypto = xcrypto.toLowerCase();
         var pais="{{ $pais }}";
         redireccion(crypto,currency);
     });
     function redireccion(crypto,currency){
       @if(app()->getLocale()=="de")
             window.location='/kauf-'+crypto+'/with-card-in-'+currency;
         @endif
   
         @if(app()->getLocale()=="ae")
             window.location='/يشترى-'+crypto+'/with-credit-card-in-'+currency;
         @endif
   
         @if(app()->getLocale()=="hi")
             window.location='/खरीद सकते हैं-'+crypto+'/चुनाव-कार्ड-इन-'+currency;
         @endif
   
         @if(app()->getLocale()=="es")
             window.location='/comprar-'+crypto+'/con-tarjeta-en-'+currency;
         @endif
         @if(app()->getLocale()=="en")
             window.location='/buy-'+crypto+'/with-credit-card-in-'+currency;
         @endif
         @if(app()->getLocale()=="fr")
             window.location='/acheter-'+crypto+'/avec-card-in-'+currency;
         @endif
         @if(app()->getLocale()=="ru")
             window.location='/купить-'+crypto+'/с-карта-в-'+currency;
         @endif
         @if(app()->getLocale()=="it")
             window.location='/acquistare-'+crypto+'/con-card-in-'+currency;
         @endif
         @if(app()->getLocale()=="jp")
             window.location='/買う-'+crypto+'/con-カードイン-'+currency;
         @endif
         @if(app()->getLocale()=="th")
             window.location='/ซื้อ-'+crypto+'/กับบัตรใน-'+currency;
         @endif
         @if(app()->getLocale()=="cz")
             window.location='/koupit-'+crypto+'/s-kartou-'+currency;
         @endif
         @if(app()->getLocale()=="pt")
             window.location='/comprar-'+crypto+'/com-cartão-'+currency;
         @endif
         @if(app()->getLocale()=="kr")
             window.location='/사다-'+crypto+'/카드-인-'+currency;
         @endif
   
         @if(app()->getLocale()=="ch")
             window.location='/买-'+crypto+'/与-卡-在-'+currency;
         @endif
         @if(app()->getLocale()=="se")
             window.location='/köpa-'+crypto+'/with-credit-card-in-'+currency;
         @endif
     }
     $("#getCryptos").change(function () {
         var str = $(this).val();
         var crypto = str.toLowerCase();
         var xcurren=$("#getCurrencies").val();
         var currency = xcurren.toLowerCase();
         //var pais="venezuela";
         var pais="{{ $pais }}";
         redireccion(crypto,currency);
     });
   
     $("#persoCrypto").keyup(function () {
     // totalPay();
     var crypto=$(this).val();
     var defaultCurrency={{$default['pay']}};
     var defaultCripto={{$default['recibe']}};
     var totalCurrency=parseFloat((defaultCurrency*crypto)/defaultCripto);
     var totalCurrency=totalCurrency.toFixed(2);
     if(isNaN(totalCurrency)){
         totalCurrency=0;
         totalCurrency=totalCurrency.toFixed(2);
         $("#persoCurrency").val(totalCurrency);
     }else{
         $("#persoCurrency").val(totalCurrency);
     }
   });
   
   $("#persoCurrency").keyup(function () {
       var currency=$(this).val();
       var defaultCurrency={{$default['pay']}};
       var defaultCripto={{$default['recibe']}};
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
       var lang = $(this).val();
       window.location='/lang/'+lang+'/'+crypto+'/'+currency;
   });
   
   $("#idioma2").change(function () {
       var lang = $(this).val();
       window.location='/lang/'+lang;
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
     //totalPay();
     console.log(th);
   }
   
   
   $("#persoCurrency").click(() =>{
      $("input[type='radio']").removeAttr('checked');
      $("#customBuy").attr('checked','checked');
     // totalPay();
   });
   
   $("#persoCrypto").click(() =>{
      //totalPay();
      $("input[type='radio']").removeAttr('checked');
      $("#customBuy").attr('checked','checked');
   });
   
   
   
   
   
</script>
<!--section end -->
@endsection
@section('scripts')
@endsection