@extends('layouts.landing', [
'title' => 'Skrill'
])
<script type="text/javascript">
   var totalx;
</script>
@section('content')
<div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="z-index: 100000">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px 30px">
                <span>@lang('index.detect', ['pais' => $paisIp])</span>
            </div>
        </div>
    </div>
</div>

<section id="home" >
   @include('partials.landing.header')
   <div class="container">
   <div class="row">
   <div class="col-12 col-lg-5">
      <div>
         <img src="/img/emptylogo.png" id="imageBtcTop" width="50" height="50">
          <img src="{{asset('/banderas/'.$reg)}}" id="imageBtcTop" width="50"> 
      </div>
      <h2 class="text-white" id="subTitleCrypto">
        @lang('index.title_new_left3')
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
         <li class="p-description">
            @lang('index.mesagge4')
         </li>
      </ul>
   </div>
   <div class="col-12 col-lg-7 mt-4">
        <div class="main-card">
            @include("landing.partials.buyContainer")
            @include("landing.partials.priceContainer")
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
   console.log('{{$pais}}')
   console.log('{{$countryIp}}')

   $(document).ready(() => {
    if('{{$pais}}' !== '{{$countryIp}}' && '{{$countryIp}}' != "-"){
        $('#warning').modal('toggle')
    }

     var actualityCrypto = $('#buyContainer #getCryptos').val();
     var txtCrypto = $('#getCryptos option:selected').text();
     actualityDivisa = $('#getCurrencies').val();
     var icon = cryptoIconHome(actualityCrypto);
     var icon2 = cryptoIconHome(actualityDivisa);
     var pais='{{$pais}}';

     $("#imageBtcTop").attr('src', icon);
     $("#imgCryp").attr('src', icon);
     $("#imgDiv").attr('src', icon2);
     $("#country").text(pais)

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
         let pais = '{{$pais}}'
         
         cambiarDivisa(currency)
        .then((data) => {
            window.location.reload();
        })
        .catch(err => console.log(err));
      
         //redireccion(crypto,pais.toLowerCase());
     });

     function cambiarDivisa(currency){
        return new Promise((resolve, reject) => {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}",
                }
            });

            $.post("/cambiar-divisa", { "currency": currency})
            .done(function( data ) {

                if(data.success){
                    resolve(data);
                }
            reject();
            });
        });
     }

     function redireccion(crypto,country){
        @if(app()->getLocale()=="de")
            // window.location='/kauf-'+crypto+'/with-card-in-'+currency;
            window.location = `/Kaufen-${crypto}-im-${country}`;
        @endif

        @if(app()->getLocale()=="ae")
            // window.location='/يشترى-'+crypto+'/with-credit-card-in-'+currency;
            window.location = `/للشراء-${crypto}-في-${country}`;
        @endif

        @if(app()->getLocale()=="hi")
            // window.location='/खरीद सकते हैं-'+crypto+'/चुनाव-कार्ड-इन-'+currency;
            window.location = `/खरीद-${crypto}-में-${country}`;
        @endif

        @if(app()->getLocale()=="es")
            // window.location='/buy-'+crypto+'/con-tarjeta-en-'+currency;
            window.location = `/comprar-${crypto}-en-${country}`;
        @endif

        @if(app()->getLocale()=="en")
            // window.location='/buy-'+crypto+'/with-credit-card-in-'+currency;
            window.location = `/buy-${crypto}-in-${country}`;
        @endif

        @if(app()->getLocale()=="fr")
            // window.location='/acheter-'+crypto+'/avec-card-in-'+currency;
            window.location = `/acheter-${crypto}-dans-${country}`;
        @endif

        @if(app()->getLocale()=="ru")
            // window.location='/купить-'+crypto+'/с-карта-в-'+currency;
            window.location = `/купить-${crypto}-в-${country}`;
        @endif

        @if(app()->getLocale()=="it")
            // window.location='/acquistare-'+crypto+'/con-card-in-'+currency;
            window.location = `/acquistare-${crypto}-nel-${country}`;
        @endif

        @if(app()->getLocale()=="jp")
            // window.location='/買う-'+crypto+'/con-カードイン-'+currency;
            window.location = `//購入-${crypto}-に-${country}`;
        @endif

        @if(app()->getLocale()=="th")
            // window.location='/ซื้อ-'+crypto+'/กับบัตรใน-'+currency;
            window.location = `/ซื้อ-${crypto}-ใน-${country}`;
        @endif

        @if(app()->getLocale()=="cz")
            // window.location='/koupit-'+crypto+'/s-kartou-'+currency;
            window.location = `/koupit-${crypto}-v-${country}`;
        @endif

        @if(app()->getLocale()=="pt")
            // window.location='/comprar-'+crypto+'/com-cartão-'+currency;
            window.location = `/comprar-${crypto}-no-${country}`;
        @endif

        @if(app()->getLocale()=="kr")
            // window.location='/사다-'+crypto+'/카드-인-'+currency;
            window.location = `/구입-${crypto}-에-${country}`;
        @endif

        @if(app()->getLocale()=="ch")
            // window.location='/买-'+crypto+'/与-卡-在-'+currency;
            window.location = `/买-${crypto}-在-${country}`;
        @endif
        @if(app()->getLocale()=="se")
            // window.location='/köpa-'+crypto+'/with-credit-card-in-'+currency;
            window.location = `/köpa-${crypto}-i-${country}`;
        @endif
     }
     $("#getCryptos").change(function () {
         var str = $(this).val();
         var crypto = str.toLowerCase();
         var xcurren=$("#getCurrencies").val();
         var currency = xcurren.toLowerCase();
         let pais = '{{$pais}}'

         redireccion(crypto,pais.toLowerCase());
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
   
   // $("#idioma").change(function () {
   //     var xcurren=$("#getCurrencies").val();
   //     var currency = xcurren.toLowerCase();
   //     var xcrypto=$("#getCryptos").val();
   //     var crypto = xcrypto.toLowerCase();
   //     var lang = $(this).val();
   //     window.location = `/buy-${crypto}with/${lang}`;
   // });
   // $("#idioma2").change(function () {
   //    var xcurren=$("#getCurrencies").val();
   //     var currency = xcurren.toLowerCase();
   //     var xcrypto=$("#getCryptos").val();
   //     var crypto = xcrypto.toLowerCase();
   //     var lang = $(this).val();

   //     window.location = `/buy-${crypto}/${currency}/with/${lang}`;

   // });


    $("#detect-pais").on('click', function(){
        var xcurren=$("#getCurrencies").val();
       var xcrypto=$("#getCryptos").val();
       var crypto = xcrypto.toLowerCase();
        var cod_iso2 = '{{$cod_iso2Ip}}'
        let pais = '{{$paisIp}}'
        
        redireccion(crypto, pais[0].toLowerCase() + pais.slice(1))
 
    })

   $("#idioma").change(function () {
       var xcurren=$("#getCurrencies").val();
       var xcrypto=$("#getCryptos").val();
       var crypto = xcrypto.toLowerCase();
       var lang = $(this).val();
        var cod_iso2 = '{{$cod_iso2}}'
    
        window.location=`pais/lang/${lang}/${crypto}/${cod_iso2}`;

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