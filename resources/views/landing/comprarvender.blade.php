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
<div class="modal fade" id="ModalPaypal" tabindex="-1" role="dialog" aria-labelledby="westernUnionPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="westernUnionPaymentLabel">PAYPAL</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px 30px">
                <div class="text-center mb-2">
                    <img loading="lazy" src="https://d31dn7nfpuwjnm.cloudfront.net/images/valoraciones/0033/7299/Como_retirar_dinero_de_PayPal_en_Colombia.png?1555502328" class="img-fluid" alt="" style="width: 200px">
                </div>
        
                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    {{__('index.message_paypal')}}
                    min: <span id="calculatorPaypal"></span> <br>
                    {{__('index.message_paypal1')}} 
                </div>
        
                <div style="background-color: rgba(183, 205, 232, 1);font-size: 21px;border-radius: 5px 5px 0px 0px;;padding: 10px;"><p style="margin-bottom: 0px;">
                    @lang('index.sendMoneyPaypal')</p><span style="font-weight: bold;color: #003187;">paypal-deposits@damecoins.co.uk</span><br>
                    {{-- @lang('index.sendMoneyPaypal')</p><span style="font-weight: bold;color: #003187;">paypal@damecoins.co.uk</span><br> --}}
                </div>
        
                <div style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                    {{ __('index.message_paypal3') }}
                    <br>
                </div>
        
                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    <strong class="text-danger">
                        {{__('index.message_paypal2')}}
                    </strong>
                </div>
                
        
                <div class="mt-2">
                    <center>
                        <button class="color" data-dismiss="modal" aria-label="Close" style="padding: 8PX 24PX;background-color: #cecece;">Cancel</button>
                        <a href="https://www.paypal.com/signin" target="_blank" class="color">PayPal.com Login</a>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-body">
             Please create a free account first and log in to make a purchase. 
             <a class="link" href="/signup" style="    background: #4f8aff;
                color: white;
                padding: 5px 12px;
                border-radius: 9px;
                font-size: 15px;">SIGN UP</a>
             I already have an account
          </div>
       </div>
    </div>
 </div>

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

@extends('layouts.landing2')

@section('content')

<div class="section-comprar-vender">
        
    @include('partials.landing.comprarvender.section_one')
    @include('partials.landing.comprarvender.section_two')
    @include('partials.landing.comprarvender.section_three')
    @include('partials.landing.comprarvender.section_four')
    @include('partials.landing.comprarvender.section_five')
    @include('partials.landing.comprarvender.section_six')

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

      var prefix = 'CompraVenta';      
      var method = '{{ $metodo }}';

       window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
       
   });
   $("#idioma2").change(function () {
      var lang = $(this).val();
      window.location='/lang/'+lang;
   });

// $("#idioma").change(function () {
//        var xcurren=$("#getCurrencies").val();
//        var currency = xcurren.toLowerCase();
//        var xcrypto=$("#getCryptos").val();
//        var crypto = xcrypto.toLowerCase();
//        var lang = $(this).val();
//        var method = '{{ $data->name }}';
    
//        var prefix = 'CompraVenta';      

//        window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
//         });

//         $("#idioma2").change(function () {
//             var xcurren=$("#getCurrencies").val();
//        var currency = xcurren.toLowerCase();
//        var xcrypto=$("#getCryptos").val();
//        var crypto = xcrypto.toLowerCase();
//        var lang = $(this).val();
//        var method = '{{ $data->name }}';

//       window.location= `/buy-sell-${crypto}-${currency}-with/${lang}`;

//         });

        $(document).ready(function(){
            let valor = $('#getCryptos').val();
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
                var defaultCurrency=  '{{$default['pay']}}';
                var defaultCripto= '{{$default['recibe']}}';
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

            $("#getCryptos").change(function () {

                var str = $(this).val();
                var crypto = str.toLowerCase();
                var xcurren = $("#getCurrencies").val();

                var currency = xcurren.toLowerCase();
                var pais="venezuela";
               

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }
                var method = '{{ $data->name }}';

                redireccion(crypto,currency,method);
            });

            $("#getCurrencies").change(function () {

                var str = $(this).val();
                var currency  = str.toLowerCase();
                var xcrypto=$("#getCryptos").val();
                var crypto = xcrypto.toLowerCase();
                

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }

                console.log(currency);
                var method = '{{ $data->name }}';

                redireccion(crypto,currency,method);
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
                // $("#pay").text(totalCurrency + " " + actualityDivisa)
                $("#customBuy").val(totalCurrency)
            });

            $("#getCryptoss").change(function () {

                var str = $(this).val();
                var crypto = str.toLowerCase();
                var xcurren = $("#getCurrenciess").val();

                var currency = xcurren.toLowerCase();
                var pais="venezuela";
               

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }
                var method = '{{ $data->name }}';
                
                redireccion(crypto,currency,method);

            });

            $("#getCurrenciess").change(function () {

                var str = $(this).val();
                var currency  = str.toLowerCase();
                var xcrypto=$("#getCryptoss").val();
                var crypto = xcrypto.toLowerCase();
                

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }

                console.log(currency);
                
                var method = '{{ $data->name }}';

                redireccion(crypto,currency,method);
            });
        /*Formulario2*/

        function redireccion(crypto,currency,method){
            @if(app()->getLocale()=="de")
                window.location= `/Kaufen-verkaufen-${crypto}-${currency}-mit-${method}`;
            @endif

            @if(app()->getLocale()=="ae")
                window.location= `/??????????-????????-${crypto}-${currency}-????-${method}`;
            @endif

            @if(app()->getLocale()=="hi")
                window.location= `/????????????-???????????????-${crypto}-${currency}-??????????????????-${method}`;
            @endif

            @if(app()->getLocale()=="es")
            window.location= '/buy-sell-' + crypto + '-'+ currency+'-with-'+method+'';
            @endif
            
            @if(app()->getLocale()=="en")
                window.location= `/comprar-vender-${crypto}-${currency}-con-${method}`;
            @endif

            @if(app()->getLocale()=="fr")
                window.location= `/acheter-vendre-${crypto}-${currency}-avec-${method}`;
            @endif

            @if(app()->getLocale()=="ru")
                window.location= `/????????????-??????????????????-${crypto}-${currency}-??????????????????-${method}`;
            @endif

            @if(app()->getLocale()=="it")
                window.location= `/acquistare-vendere-${crypto}-${currency}-con-${method}`;
                
            @endif
            
            @if(app()->getLocale()=="jp")
                window.location= `/??????-??????-${crypto}-${currency}-???-${method}`;
                
            @endif

            @if(app()->getLocale()=="th")
                window.location= `/????????????-?????????-${crypto}-${currency}-????????????-${method}`;
                
            @endif

            @if(app()->getLocale()=="cz")
                window.location= `/Koupit-prodat-${crypto}-${currency}-s-${method}`;
                
            @endif

            @if(app()->getLocale()=="pt")
                window.location= `/comprar-vender-${crypto}-${currency}-com-${method}`;
                
            @endif

            @if(app()->getLocale()=="kr")
                window.location= '/buy-sell-' + crypto + '-'+ currency+'-with-'+method+'';
            
            @endif

            @if(app()->getLocale()=="ch")
                window.location= `/??????-???-${crypto}-${currency}-???-${method}`;

            @endif

            @if(app()->getLocale()=="se")
                window.location= `/k??pa-s??lja-${crypto}-${currency}-med-${method}`;
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
                            // window.location="{{ $paypal_state->url }}";
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