<style>
     .color
     {
         background-color: #7cd1f9;
         color: #fff;
         border: none;
         box-shadow: none;
         border-radius: 5px;
         font-weight: 600;
         font-size: 14px;
         padding: 10px 24px;
         margin: 0;
         cursor: pointer;
     }
 </style>
 
 
 @extends('layouts.landing2')
 
 @section('content')
 <div class="section-conversor">

     @include('partials.landing.convert.section_one')  
     
     @include('partials.landing.convert.section_two')
     @include('partials.landing.convert.section_three')
     @include('partials.landing.convert.section_four')
     @include('partials.landing.convert.section_five')
     @include('partials.landing.convert.section_six')
     @include('partials.landing.convert.section_seven')
     @include('partials.landing.convert.section_eight')
      
     @include('partials.landing.convert.section_nine')
     
   
     
     
 </div>
 
 @endsection
 
 
 
 @section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
     <script>
 
         
 $("#idioma").change(function () {
        var xcurren=$("#getCurrencies").val();
        var currency = xcurren.toLowerCase();
        var xcrypto=$("#getCryptos").val();
        var crypto = xcrypto.toLowerCase();
        var lang = $(this).val();

            if(lang=="de"){
                window.location= '/konvertieren-' + crypto + '-to-' + currency;
            }
             if(lang=="ae"){
                 window.location= '/تحويل-' + crypto + '-to-' + currency;
             }
 
             if(lang=="hi"){
                 window.location= '/धर्मांतरित-' + crypto + '-to-' + currency;
             }
 
             if(lang=="es"){
             window.location= '/convertir-' + crypto + '-a-' + currency;
             }
             
             if(lang=="en"){
                 window.location= '/convert-' + crypto + '-to-' + currency;
             }
 
             if(lang=="fr"){
                 window.location= '/convertir-' + crypto + '-to-' + currency;
             }
 
             if(lang=="ru"){
                 window.location= '/перерабатывать-' + crypto + '-to-' + currency;
             }
 
             if(lang=="it"){
                 window.location= '/convertire-' + crypto + '-to-' + currency;
                 
             }
             
             if(lang=="jp"){
                 window.location= '/変換する-' + crypto + '-to-' + currency;
                 
             }
 
             if(lang=="th"){
                 window.location= '/แปลง-' + crypto + '-to-' + currency;
                 
             }
 
             if(lang=="cz"){
                 window.location= '/konvertovat-' + crypto + '-to-' + currency;
                 
             }
 
             if(lang=="pt"){
                 window.location= '/converter-' + crypto + '-to-' + currency;
                 
             }
 
             if(lang=="kr"){
                 window.location= '/변하게하다-' + crypto + '-to-' + currency;
             
             }
 
             if(lang=="ch"){
                 window.location= '/兑换-' + crypto + '-to-' + currency;
 
             }
 
             if(lang=="se"){
                 window.location= '/konvertera-' + crypto + '-to-' + currency;
             }
             
        
  //   var prefix = 'Convert';      
 
    // window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
         });
 
         $("#idioma2").change(function () {
       var lang = $(this).val();
       window.location='/lang/'+lang;
    });
 
         $(document).ready(function(){
             let valor = $('#getCryptos').val();
             let actualityDivisa = $('#getCurrencies').val();
             
             var icon2 = cryptoIconHome(actualityDivisa);
             var icon = cryptoIconHome(valor);
             
             $("#imageBtcTop").attr('src', icon);
             $("#imgDiv").attr('src', icon2);
         })

            var d = new Date();
            var n = d.getFullYear();
            console.log(n);
            $(".anio").text(n);
 
         function cryptoIconHome(name){
             return `https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/${name.toLocaleLowerCase()}.png`;
         }  
 
         function soloNumeros(e)
         {
             var key = window.Event ? e.which : e.keyCode
             return ((key >= 48 && key <= 57) || (key==46))
         }

         $('#amount').keyup(function () {
            console.log($(this).val());
            convert = parseFloat($(this).val()) * {{ $getConvers }}
            $('#convert').text( convert ?? '0');
            
         })



         $("#getCryptos").change(function () {

            var str = $(this).val();
            var crypto = str.toLowerCase();
            console.log(crypto);
            var currency = $("#getCurrencies option:selected").val();

            var currency = currency.toLowerCase();
            redireccion(crypto,currency);
        });
        $("#getCurrencies").change(function () {

            var str = $(this).val();
            var currency = str.toLowerCase();
            var crypto = $("#getCryptos option:selected").val();

            var crypto = crypto.toLowerCase();
            redireccion(crypto,currency);
        });
 
 
 
         function redireccion(crypto,currency){
             @if(app()->getLocale()=="de")
                 window.location= '/konvertieren-' + crypto + '-to-' + currency;
             @endif
 
             @if(app()->getLocale()=="ae")
                 window.location= '/تحويل-' + crypto + '-to-' + currency;
             @endif
 
             @if(app()->getLocale()=="hi")
                 window.location= '/धर्मांतरित-' + crypto + '-to-' + currency;
             @endif
 
             @if(app()->getLocale()=="es")
             window.location= '/convertir-' + crypto + '-a-' + currency;
             @endif
             
             @if(app()->getLocale()=="en")
                 window.location= '/convert-' + crypto + '-to-' + currency;
             @endif
 
             @if(app()->getLocale()=="fr")
                 window.location= '/convertir-' + crypto + '-to-' + currency;
             @endif
 
             @if(app()->getLocale()=="ru")
                 window.location= '/перерабатывать-' + crypto + '-to-' + currency;
             @endif
 
             @if(app()->getLocale()=="it")
                 window.location= '/convertire-' + crypto + '-to-' + currency;
                 
             @endif
             
             @if(app()->getLocale()=="jp")
                 window.location= '/変換する-' + crypto + '-to-' + currency;
                 
             @endif
 
             @if(app()->getLocale()=="th")
                 window.location= '/แปลง-' + crypto + '-to-' + currency;
                 
             @endif
 
             @if(app()->getLocale()=="cz")
                 window.location= '/konvertovat-' + crypto + '-to-' + currency;
                 
             @endif
 
             @if(app()->getLocale()=="pt")
                 window.location= '/converter-' + crypto + '-to-' + currency;
                 
             @endif
 
             @if(app()->getLocale()=="kr")
                 window.location= '/변하게하다-' + crypto + '-to-' + currency;
             
             @endif
 
             @if(app()->getLocale()=="ch")
                 window.location= '/兑换-' + crypto + '-to-' + currency;
 
             @endif
 
             @if(app()->getLocale()=="se")
                 window.location= '/konvertera-' + crypto + '-to-' + currency;
             @endif
         }
 
 
     </script> 
 @endsection