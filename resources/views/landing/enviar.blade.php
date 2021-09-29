

@extends('layouts.landing3enviar')

@section('content')
<div class="section-circunstancia" >
    <div class="banner-principal-two">
        @include('partials.landing.buy-btc-without.leftSectionSend') <!-- Seccion izquierda y panel -->
        @include('partials.landing.buy-btc-without.section_two') <!--Paso a paso -->
        @include('partials.landing.buy-btc-without.section_three') <!--Preguntas frecuentes -->
        @include('partials.landing.buy-btc-without.section_six')      <!--Funcionalidades -->
        <!-- Banner crear cuenta -->
        <div class="container-fluid banner-card-large ">
            <div class="container">
                <div class="row text-banner"> 
                    <h2 >@lang('index.netaccount')</h2>
                    
                </div>
               <img class="img-1 d-none d-xl-block" src="{{ asset('img/Detallewallet1.png') }}" alt="">
               <img class="img-2 d-none d-xl-block" src="{{ asset('img/Rectangle124.png') }}" alt="">
            </div>  
        </div>
        <!-- fin banner -->
        <!-- Check de confianza -->
        <div class="banner-confia py-5">
            <div class="container">
                <h2 class="font-weight-bold text-center">Por qué la gente confía en Damecoins</h2>
            
                <div class="row">
                    <div class="col-12 col-md-3 text-center mt-4">
                        <span class="icon"><i class="fas fa-check"></i></span>
                        <strong>@lang('index.soculta')</strong>
                    </div>
                    <div class="col-12 col-md-3 text-center mt-4">
                        <span class="icon"><i class="fas fa-check"></i></span>
                        <strong>@lang('index.v5min')</strong>
                    </div>
                    <div class="col-12 col-md-3 text-center mt-4">
                        <span class="icon"><i class="fas fa-check"></i></span>
                        <strong>@lang('index.atencion365')</strong>
                    </div>
                    <div class="col-12 col-md-3 text-center mt-4">
                        <span class="icon"><i class="fas fa-check"></i></span>
                        <strong>@lang('index.paginsta')</strong>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Check -->
        
        @include('partials.landing.buy-btc-without.section_nine')  <!-- Interes -->
        
        </div>    
@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>


        $("#idioma").change(function () {
        var xcurren=$("#getMethods option:selected").text();
        var currency = xcurren.toLowerCase();
        currency = currency.replace(" ","");
        var xcrypto=$("#getCryptosss").val();
        var crypto = xcrypto.toLowerCase();
        var lang = $(this).val();
        

            if(lang=="de"){
                window.location= '/senden-' + crypto + '-su-' + currency;
            }
             if(lang=="ae"){
                 window.location= '/إرسال-' + crypto + '-إلى-' + currency;
             }
 
             if(lang=="hi"){
                 window.location= '/संदेश-' + crypto + '-सेवामेरे-' + currency;
             }
 
             if(lang=="es"){
             window.location= '/convertir-' + crypto + '-a-' + currency;
             }
             
             if(lang=="en"){
                 window.location= '/send-' + crypto + '-to-' + currency;
             }
 
             if(lang=="fr"){
                 window.location= '/envoyer-' + crypto + '-à-' + currency;
             }
 
             if(lang=="ru"){
                 window.location= '/отправьте-' + crypto + '-на-' + currency;
             }
 
             if(lang=="it"){
                 window.location= '/invia-' + crypto + '-ad-' + currency;
                 
             }
             
             if(lang=="jp"){
                 window.location= '/送信-' + crypto + '-に-' + currency;
                 
             }
 
             if(lang=="th"){
                 window.location= '/สภาพแวดล้อม-' + crypto + '-ก-' + currency;
                 
             }
 
             if(lang=="cz"){
                 window.location= '/poslat-' + crypto + '-na-' + currency;
                 
             }
 
             if(lang=="pt"){
                 window.location= '/envie-' + crypto + '-para-' + currency;
                 
             }
 
             if(lang=="kr"){
                 window.location= '/보내다-' + crypto + '-...에-' + currency;
             
             }
 
             if(lang=="ch"){
                 window.location= '/发送-' + crypto + '-到-' + currency;
 
             }
 
             if(lang=="se"){
                 window.location= '/skicka-' + crypto + '-till-' + currency;
             }
             
        
  //   var prefix = 'Convert';      
 
    // window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
         });

        $(document).ready(function(){
            let valor = $('#getCryptoss').val();
            var icon = cryptoIconHome(valor);
            $("#imageBtcTop").attr('src', icon);
        })

        function cryptoIconHome(name){
            return `https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/${name.toLocaleLowerCase()}.png`;
        } 

        function soloNumeros(e)
        {
            var key = window.Event ? e.which : e.keyCode
            return ((key >= 48 && key <= 57) || (key==8))
        }

        /*Formulario1*/
            //Cuando le das a otra cantidad desmarca los check de la seccion de arriba
            $("#personasCryptos").focus(function() {
                $('.radioBtnClass2').each(function()
                {
                    $(this).prop('checked', false);
                })
                $("input[type='radio'].person").prop('checked', true)
            });

            //Cuando le das a otra cantidad desmarca los check de la seccion de arriba
            $("#personasCurrencys").focus(function()
            {
                $('.radioBtnClass2').each(function()
                {
                    $(this).prop('checked', false);
                })
            });

            $("#personasCurrencys").keyup(function () {
                var currency=$(this).val();
                var defaultCurrency=  '{{$default["pay"]}}';
                var defaultCripto= '{{$default["recibe"]}}';
                var totalCrypto=parseFloat((currency*defaultCripto)/defaultCurrency);

                var totalCrypto=totalCrypto.toFixed(7);
                if(isNaN(totalCrypto)){
                    totalCrypto=0;
                    totalCrypto=totalCrypto.toFixed(7);
                    $("#personasCryptos").val(totalCrypto);
                }else{
                    $("#personasCryptos").val(totalCrypto);
                }
                // $("#pay").text(currency + " " + actualityDivisa)
            });

            $("#personasCryptos").keyup(function () {
                var crypto=$(this).val();
                var defaultCurrency= '{{$default['pay']}}';
                var defaultCripto= '{{$default['recibe']}}';
                var totalCurrency=parseFloat((defaultCurrency*crypto)/defaultCripto);
                var totalCurrency=totalCurrency.toFixed(2);
                if(isNaN(totalCurrency)){
                    totalCurrency=0;
                    totalCurrency=totalCurrency.toFixed(2);
                    $("#personasCurrencys").val(totalCurrency);
                }else{
                    $("#personasCurrencys").val(totalCurrency);
                }
                // $("#pay").text(totalCurrency + " " + actualityDivisa)
                $("#customBuy").val(totalCurrency)
            });

            $("#getCryptosss").change(function () {

                var str = $(this).val();
                console.log("1")
                var crypto = str.toLowerCase();
                console.log(crypto);
                var method = $("#getMethods option:selected").text();

                var metodo = method.toLowerCase();
                redireccion(crypto,metodo);
            });

            $("#getMethods").change(function () {

                var str = $("#getMethods option:selected").text();
                let f = str.indexOf(" ", 0);
                var cadenaNueva = str.toLocaleLowerCase();
                if(f != -1){
                    if(str == 'Western Union'){
                        cadenaNueva = "westerUnion";
                    }else{
                       cadenaNueva =  str.split(" ").join("");
                    }
                }

                var xcrypto=$("#getCryptosss").val();
                var crypto = xcrypto.toLowerCase();
                console.log(cadenaNueva);

                redireccion(crypto,cadenaNueva);
            });
            
            
        /*Formulario1*/

        /*Formulario 2*/
            //Cuando le das a otra cantidad desmarca los check de la seccion de arriba
            $("#persoCrypto").focus(function() {
                $('.radioBtnClass').each(function()
                {
                    $(this).prop('checked', false);
                })
                $("input[type='radio'].person").prop('checked', true)
            });

            //Cuando le das a otra cantidad desmarca los check de la seccion de arriba
            $("#persoCurrency").focus(function()
            {
                $('.radioBtnClass').each(function()
                {
                    $(this).prop('checked', false);
                })
            });

            $("#persoCurrency").keyup(function () {
                var currency=$(this).val();
                var defaultCurrency=  '{{$default['pay']}}';
                var defaultCripto= '{{$default['recibe']}}';
                var totalCrypto=parseFloat((currency*defaultCripto)/defaultCurrency);

                var totalCrypto=totalCrypto.toFixed(7);
                if(isNaN(totalCrypto)){
                    totalCrypto=0;
                    totalCrypto=totalCrypto.toFixed(7);
                    $("#persoCrypto").val(totalCrypto);
                }else{
                    $("#persoCrypto").val(totalCrypto);
                }
                // $("#pay").text(currency + " " + actualityDivisa)
            });

            $("#persoCrypto").keyup(function () {
                var crypto=$(this).val();
                var defaultCurrency= '{{$default['pay']}}';
                var defaultCripto= '{{$default['recibe']}}';
                var totalCurrency=parseFloat((defaultCurrency*crypto)/defaultCripto);
                var totalCurrency=totalCurrency.toFixed(2);
                if(isNaN(totalCurrency)){
                    totalCurrency=0;
                    totalCurrency=totalCurrency.toFixed(2);
                    $("#persoCurrency").val(totalCurrency);
                }else{
                    $("#persoCurrency").val(totalCurrency);
                }
                $("#customBuy").val(totalCurrency)
            });

            $('#sendMonto').submit(function(event){ 
                var comission = ($('#comission').val()/100) * $('input#montoCrypto').val() ;

                if($('input#cryptoDisponible').val() < $('input#montoCrypto').val() + comission){
                 $('#errorMonto').show();
                 event.preventDefault();
                }
               $('#transaccionExitosa').show();
            });
            $('#cerrar').click(function(){
                $('#errorMonto').hide();
            })

           
            window.setTimeout(function() {
                $("#transaccionExitosa").fadeTo(700, 0).slideUp(700, function(){
                    $(this).remove(); 
                });
            }, 7000);
            $('#montoCrypto').keyup(function(){
                var value = $(this).val();
                if(value != ''){
                    $('.panelComision').show();
                    $('.actualform').text(value);
                    comision = (value * ($('#comission').val()/100));
                    total = value - comision;
                    $('#comi').text(comision);
                    $('#total').text(total);
                }else{
                    $('.panelComision').hide();
                }
                
            }).keyup();

            
        /*Formulario2*/

        function redireccion(crypto,metodo){
            @if(app()->getLocale()=="de")
                window.location= '/Kaufen-' + crypto + '-ohne_Auftrag/'+ metodo;
            @endif

            @if(app()->getLocale()=="ae")
                window.location= '/يشترى-' + crypto + '-بدون عمولة/'+ metodo;
            @endif

            @if(app()->getLocale()=="hi")
                window.location= '/खरीद-' + crypto + '-without_commission/'+ metodo;
            @endif

            @if(app()->getLocale()=="es")
            window.location= '/enviar-' + crypto + '-a-' + metodo;
            @endif
            
            @if(app()->getLocale()=="en")
                window.location= '/buy-' + crypto + '-without_commision/'+ metodo;
            @endif

            @if(app()->getLocale()=="fr")
                window.location= '/acheter-' + crypto + '-sans_commission/'+ metodo;
            @endif

            @if(app()->getLocale()=="ru")
                window.location= '/купить-' + crypto + '-без_комиссии/'+ metodo;
            @endif

            @if(app()->getLocale()=="it")
                window.location= '/acquistare-' + crypto + '-senza_commissione/'+ metodo;
                
            @endif
            
            @if(app()->getLocale()=="jp")
                window.location= '/購入-' + crypto + '-without_commission/'+ metodo;
                
            @endif

            @if(app()->getLocale()=="th")
                window.location= '/ซื้อ-' + crypto + '-without_commision/'+ metodo;
                
            @endif

            @if(app()->getLocale()=="cz")
                window.location= '/buy-' + crypto + '-without_commision/'+ metodo;
                
            @endif

            @if(app()->getLocale()=="pt")
                window.location= '/comprare-' + crypto + '-without_commission/'+ metodo;
                
            @endif

            @if(app()->getLocale()=="kr")
                window.location= '/buy-' + crypto + '-without_commision/'+ metodo;
            
            @endif

            @if(app()->getLocale()=="ch")
                window.location= '/购买-' + crypto + '-没有佣金/'+ metodo;

            @endif

            @if(app()->getLocale()=="se")
                window.location= '/köpa-' + crypto + '-utan_kommission/'+ metodo;
            @endif
        }
        

        function paypal(){
            currency = '{{ $getCurrencyUser->code }}';
                calculateMinimumPaypal(currency).then((data)=>{
                    swal( "{{__('index.message_paypal')}}" +" min: "+ data.minUsd+" ("+ data.min+")" + "{{__('index.message_paypal1')}}", {
                        buttons: {
                            free: {
                                text: "{{ __('index.cancel_paypal')}}",
                                value: "cancel",
                            },
                        login: {
                            text: "{{ __('index.min_paypal')}}" +" min("+ data.minUsd+")" ,
                            value: "paypal",
                        },
                    },
                })
                .then((value) => {
                    switch (value) {
                            case "paypal":
                            window.location="{{ $paypal_state->url }}";
                            //swal("Login", "success");
                        break;

                        case "cancel":
                        break;
                    }
                });
            })
            .catch(data => {
            /*
                swal({
                    text: "{{ __('home_buy.minimun', ['type' => 'CARD' ]) }}"+' ('+data.limit+' USD)',
                    icon: "error",
                });
            */
            });
        }


        function newPaypal()
        {
            // console.log('no he entrado');
            currency = '{{ $getCurrencyUser->code }}';
            calculateMinimumPaypal(currency)
            .then((data) => {
                // console.log('entre');

                $('#calculatorPaypal').html(`${data.minUsd} (${data.min})`);
                $('#min').html(`min(${data.min})`);
                // $("#ModalPaypal").modal("show");
            })
            .catch(err => console.log(err));
        }

        newPaypal()

        function calculateMinimumPaypal(currency){
            return new Promise((resolve, reject) => {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}",
                    }
                });
                
                $.post("/calculate-minimun-paypal", { "currency": currency})
                .done(function( data ) {
                    if(data.success== 'true'){
                        resolve(data);
                    }
                    reject();
                });
            });
        }

    </script> 
@endsection