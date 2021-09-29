@extends('layouts.landing2')
<link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
<style>
   .intl-tel-input {
      position: relative;
      display: block;
  }

  #card_type, #cc, #mm, #yy, #cv, #sq-expiration-date, #sq-postal-code {
    background: #d8d9dc!important
}

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

@section('content')
    @include('partials.landing.buy-btc.banner-principal')
    
    @include('partials.landing.buy-btc.section-second')
    @include('partials.landing.buy-btc.section-three')
    @include('partials.landing.buy-btc.section-four')
    @include('partials.landing.buy-btc.section-five')
    @include('partials.landing.buy-btc.section-six')
@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript" src="https://rawcdn.githack.com/franz1628/validacionKeyCampo/bce0e442ee71a4cf8e5954c27b44bc88ff0a8eeb/validCampoFranz.js"></script>
    <script>
        function newPaypal()
            {
                currency = '{{ $getCriptodefault->code }}';
                calculateMinimumPaypal(currency)
                .then((data) => {
        
                    $('#calculatorPaypal').html(`${data.minUsd} (${data.min})`);
                    $('#min').html(`min(${data.min})`);
                    // $("#ModalPaypal").modal("show");
                })
                .catch(err => console.log(err));
            }

            newPaypal();
    </script>
        
    <script>
       $('.number').validCampoFranz('0123456789');
       $('input#cvv').attr('maxlength', '3'); 
       $('input#number_tarjet').attr('maxlength', '8'); 

    // $(document).ready(() => {
    //     currency = '{{ $getCurrencyUser->code }}';
    //     calculateMinimumPaypal(currency)
    //     .then((data) => {
    //         console.log(data,'data');
    //     })
    //     .catch(err => console.log(err));
    // });

    $("#getCryptossss").change(function () {
        var str = $(this).val();
        var crypto = str.toLowerCase();
        var xcurren = $("#getCurrenciesssss").val();

        var currency = xcurren.toLowerCase();
        var pais="venezuela";
        var pais = "{{ $pais }}";

        if(typeof text === 'string')
        {
            var currency = xcurren.toLowerCase();
        }
        var method = '{{ $data[0]->name }}';
        redireccion(crypto,currency,method);
    });

    $("#getCurrenciesssss").change(function () {

        var str = $(this).val();
        var currency  = str.toLowerCase();
        var xcrypto=$("#getCryptossss").val();
        var crypto = xcrypto.toLowerCase();
        var pais="{{ $pais }}";

        if(typeof text === 'string')
        {
            var currency = xcurren.toLowerCase();
        }

        var method = '{{ $data[0]->name }}';

        redireccion(crypto,currency,method);
    });

    $("#idioma").change(function () {
       var xcurren=$("#getCurrenciess").val();
       var currency = xcurren.toLowerCase();
       var xcrypto=$("#getCryptoss").val();
       var crypto = xcrypto.toLowerCase();
       var lang = $(this).val();
       var method = '{{ $data[0]->name }}';
    //    window.location= 'buy-' + crypto + '-in-'+ lang +'-'+ currency+ '-'+method;
    var prefix = 'Payments';      

      window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
        });

        $("#idioma2").change(function () {
            var lang = $(this).val();
            var method = '{{ $data[0]->name }}';

       window.location= 'buy-' + crypto + '-in-'+ lang +'-'+ currency+ '-'+method;

        });


        function soloNumeros(e)
        {
            var key = window.Event ? e.which : e.keyCode
            return ((key >= 48 && key <= 57) || (key==8))
        }

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
            $("#pay").text(totalCurrency + " " + actualityDivisa)
            $("#customBuy").val(totalCurrency)
        });

        $("#getCryptoss").change(function () {

            var str = $(this).val();
            var crypto = str.toLowerCase();
            var xcurren = $("#getCurrenciess").val();

            var currency = xcurren.toLowerCase();
            var pais="venezuela";
            var pais = "{{ $pais }}";

            if(typeof text === 'string')
            {
                var currency = xcurren.toLowerCase();
            }
            var method = '{{ $data[0]->name }}';

            
            redireccion(crypto,currency,method);
        });

        $("#getCurrenciess").change(function () {

            var str = $(this).val();
            var currency  = str.toLowerCase();
            var xcrypto=$("#getCryptoss").val();
            var crypto = xcrypto.toLowerCase();
            var pais="{{ $pais }}";

            if(typeof text === 'string')
            {
                var currency = xcurren.toLowerCase();
            }

            var method = '{{ $data[0]->name }}';

            redireccion(crypto,currency,method);
        });

        $(document).ready(function(){
            let valor = $('#getCryptoss').val();
            var icon = cryptoIconHome(valor);
            $("#imageBtcTop").attr('src', icon);
        })

        function cryptoIconHome(name){
            return `https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/${name.toLocaleLowerCase()}.png`;
        }


        function redireccion(crypto,currency,method){
            @if(app()->getLocale()=="de")
                window.location= `/kaufen-${crypto}-im-de-${currency}-${method}`;
            @endif

            @if(app()->getLocale()=="ae")
                window.location= `/للشراء-${crypto}-في-ae-${currency}-${method}`;
            @endif

            @if(app()->getLocale()=="hi")
                window.location= `/खरीदना-${crypto}-में-hi-${currency}-${method}`;
            @endif

            @if(app()->getLocale()=="es")
               window.location= `/comprar-${crypto}-en-es-${currency}-${method}`;
            @endif
            
            @if(app()->getLocale()=="en")
                window.location= `/buy-${crypto}-in-en-${currency}-${method}`;
            @endif

            @if(app()->getLocale()=="fr")
                window.location= `/acheter-${crypto}-dans-fr-${currency}-${method}`;
            @endif

            @if(app()->getLocale()=="ru")
                window.location= `/покупать-${crypto}-в-ru-${currency}-${method}`;
            @endif

            @if(app()->getLocale()=="it")
                window.location= `/comprare-${crypto}-nel-it-${currency}-${method}`;
                
            @endif
            
            @if(app()->getLocale()=="jp")
                window.location= `/購入-${crypto}-に-jp-${currency}-${method}`;
                
            @endif

            @if(app()->getLocale()=="th")
                window.location= `/ซื้อ-${crypto}-ใน-th-${currency}-${method}`;
                
            @endif

            @if(app()->getLocale()=="cz")
                window.location= `/koupit-${crypto}-v-cz-${currency}-${method}`;
                
            @endif

            @if(app()->getLocale()=="pt")
                window.location= `/comprar-${crypto}-no-pt-${currency}-${method}`;
                
            @endif

            @if(app()->getLocale()=="kr")
                window.location= `/구매-${crypto}-에-kr-${currency}-${method}`;
            
            @endif

            @if(app()->getLocale()=="ch")
            window.location= `/买-${crypto}-在-ch-${currency}-${method}`;

            @endif

            @if(app()->getLocale()=="se")
            window.location= `/att_köpa-${divisa}-i-se-${currency}-${method}`;

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

        function soloNumeros(e){
            var key = window.event ? e.which : e.keyCode;
            if (key < 48 || key > 57) {
                //Usando la definición del DOM level 2, "return" NO funciona.
                e.preventDefault();
            }
        }
    </script> 
@endsection