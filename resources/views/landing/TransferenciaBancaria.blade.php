@extends('layouts.landing2')

@section('content')
    @include('partials.landing.transfe.section_one')
    {{-- @include('partials.landing.transfe.section_two') --}}
    @include('partials.landing.transfe.section_three')
    {{-- @include('partials.landing.transfe.section_four') --}}
    @include('partials.landing.transfe.section_five')
    @include('partials.landing.transfe.section_six')
    @include('partials.landing.transfe.section_seven')
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
      var method = null;
    
    var prefix = 'Convert';      

    window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
        });

        $("#idioma2").change(function () {
            var lang = $(this).val();

      window.location= '/convert-' + crypto + '-to-' + currency+'/'+lang;

        });

        $(document).ready(function(){
            let valor = $('#getCryptos').val();
            let actualityDivisa = $('#getCurrencies').val();
            
            var icon2 = cryptoIconHome(actualityDivisa);
            var icon = cryptoIconHome(valor);
            
            $("#imageBtcTop").attr('src', icon);
            $("#imgDiv").attr('src', icon2);
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
                var pais = "{{ $pais }}";

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }
                
                redireccion(crypto,currency);
            });

            $("#getCurrencies").change(function () {

                var str = $(this).val();
                var currency  = str.toLowerCase();
                var xcrypto=$("#getCryptos").val();
                var crypto = xcrypto.toLowerCase();
                var pais="{{ $pais }}";

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }

                redireccion(crypto,currency);
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
                var pais = "{{ $pais }}";

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }
                
                redireccion(crypto,currency);
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

                redireccion(crypto,currency);
            });
        /*Formulario2*/
        
            $('#amount').keyup(function()
            {
                let crytptoAmount = $(this).val();

                let convertAmount = null;

                let defaultCripto = "{{ $getCriptodefault->code }}";
                let defaultCurrency = "{{ $getCurrencyUser->code }}";

                var url = `{{ url('/convert/${crytptoAmount}/${convertAmount}/${defaultCripto}/${defaultCurrency}') }}`;

                $.get(url,(res) => {
                    let pay = res.pagar;
                    let recibe = res.recibe;

                    let result = parseFloat((pay * crytptoAmount) / recibe);
                    let calculo = result.toFixed(2);

                    if(isNaN(calculo))
                    {
                        calculo = 0;

                        calculo = calculo.toFixed(2);

                        $("#convert").val(calculo);
                    }else{
                        $("#convert").val(calculo);
                    }
                });
            });

            $('#convert').keyup(function()
            {
                let crytptoAmount = null;

                let convertAmount = $(this).val();

                let defaultCripto = "{{ $getCriptodefault->code }}";
                let defaultCurrency = "{{ $getCurrencyUser->code }}";

                var url = `{{ url('/convert/${crytptoAmount}/${convertAmount}/${defaultCripto}/${defaultCurrency}') }}`;

                $.get(url,(res) => {
                    let pay = res.pagar;
                    let recibe = res.recibe;

                    let result = parseFloat((convertAmount * recibe) / pay);
                    let calculo = result.toFixed(7);

                    if(isNaN(calculo))
                    {
                        calculo = 0;

                        calculo = calculo.toFixed(7);

                        $("#amount").val(calculo);
                    }else{
                        $("#amount").val(calculo);
                    }
                });
            });


        function redireccion(crypto,currency){
            @if(app()->getLocale()=="de")
                window.location= '/konvertieren-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            @endif

            @if(app()->getLocale()=="ae")
                window.location= '/تحويل-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            @endif

            @if(app()->getLocale()=="hi")
                window.location= '/धर्मांतरित-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            @endif

            @if(app()->getLocale()=="es")
            window.location= '/convertir-' + crypto + '-a-eu-' + currency+'/{{app()->getLocale()}}';
            @endif
            
            @if(app()->getLocale()=="en")
                window.location= '/convert-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            @endif

            @if(app()->getLocale()=="fr")
                window.location= '/convertir-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            @endif

            @if(app()->getLocale()=="ru")
                window.location= '/перерабатывать-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            @endif

            @if(app()->getLocale()=="it")
                window.location= '/convertire-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
                
            @endif
            
            @if(app()->getLocale()=="jp")
                window.location= '/変換する-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
                
            @endif

            @if(app()->getLocale()=="th")
                window.location= '/แปลง-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
                
            @endif

            @if(app()->getLocale()=="cz")
                window.location= '/konvertovat-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
                
            @endif

            @if(app()->getLocale()=="pt")
                window.location= '/converter-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
                
            @endif

            @if(app()->getLocale()=="kr")
                window.location= '/변하게하다-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            
            @endif

            @if(app()->getLocale()=="ch")
                window.location= '/兑换-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';

            @endif

            @if(app()->getLocale()=="se")
                window.location= '/konvertera-' + crypto + '-to-' + currency+'/{{app()->getLocale()}}';
            @endif
        }

        // function paypal(){
        //     currency = '{{ $getCurrencyUser->code }}';
        //         calculateMinimumPaypal(currency).then((data)=>{
        //             swal( "{{__('index.message_paypal')}}" +" min: "+ data.minUsd+" ("+ data.min+")" + "{{__('index.message_paypal1')}}", {
        //                 buttons: {
        //                     free: {
        //                         text: "{{ __('index.cancel_paypal')}}",
        //                         value: "cancel",
        //                     },
        //                 login: {
        //                     text: "{{ __('index.min_paypal')}}" +" min("+ data.minUsd+")" ,
        //                     value: "paypal",
        //                 },
        //             },
        //         })
        //         .then((value) => {
        //             switch (value) {
        //                     case "paypal":
        //                     window.location="{{ $paypal_state->url }}";
        //                     //swal("Login", "success");
        //                 break;

        //                 case "cancel":
        //                 break;
        //             }
        //         });
        //     })
        //     .catch(data => {
        //     /*
        //         swal({
        //             text: "{{ __('home_buy.minimun', ['type' => 'CARD' ]) }}"+' ('+data.limit+' USD)',
        //             icon: "error",
        //         });
        //     */
        //     });
        // }

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