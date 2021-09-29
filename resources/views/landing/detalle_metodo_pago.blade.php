
@extends('layouts.landing2')

@section('content')

<div class="section-detalle-metodo-pago">

    @include('partials.landing.detalle_metodo_pago.section_one')
    @include('partials.landing.detalle_metodo_pago.section_two')
    @include('partials.landing.detalle_metodo_pago.section_three')
    @include('partials.landing.detalle_metodo_pago.section_four')
    @include('partials.landing.detalle_metodo_pago.section_five')
    @include('partials.landing.detalle_metodo_pago.section_six')
    @include('partials.landing.detalle_metodo_pago.section_seven')
</div>
@endsection

@section('js')
    <script>

        $(document).ready(function(){
            let valor = $('#getCryptosss').val();
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

        $("#idioma").change(function () {
       var xcurren=$("#getCurrenciesss").val();
       var currency = xcurren.toLowerCase();
       var xcrypto=$("#getCryptosss").val();
       var crypto = xcrypto.toLowerCase();
       var lang = $(this).val();
    //    window.location = `/buy-${crypto}/${currency}/with/${metodo}/${lang}`;
       window.location= '/detalle_metodo_pago/' + crypto + '/' + currency +'/'+lang;
        });
        $("#idioma2").change(function () {
            var lang = $(this).val();
       window.location= '/detalle_metodo_pago/' + crypto + '/' + currency +'/'+lang;

            // window.location='/lang/'+lang;
        });

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

            $("#getCryptosss").change(function () {

                var str = $(this).val();
                var crypto = str.toLowerCase();
                var xcurren = $("#getCurrenciesss").val();

                var currency = xcurren.toLowerCase();
                var pais="venezuela";
                var pais = "{{ $pais }}";

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }

                redireccion(crypto,currency);
            });

            $("#getCurrenciesss").change(function () {

                var str = $(this).val();
                var currency  = str.toLowerCase();
                var xcrypto=$("#getCryptosss").val();
                var crypto = xcrypto.toLowerCase();
                var pais="{{ $pais }}";

                if(typeof text === 'string')
                {
                    var currency = xcurren.toLowerCase();
                }

                console.log(currency);

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

                console.log(currency);

                redireccion(crypto,currency);
            });
        /*Formulario2*/



        function redireccion(crypto,currency){
            @if(app()->getLocale()=="de")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif

            @if(app()->getLocale()=="ae")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif

            @if(app()->getLocale()=="hi")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif

            @if(app()->getLocale()=="es")
            window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif
            
            @if(app()->getLocale()=="en")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif

            @if(app()->getLocale()=="fr")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif

            @if(app()->getLocale()=="ru")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif

            @if(app()->getLocale()=="it")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
                
            @endif
            
            @if(app()->getLocale()=="jp")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
                
            @endif

            @if(app()->getLocale()=="th")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
                
            @endif

            @if(app()->getLocale()=="cz")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
                
            @endif

            @if(app()->getLocale()=="pt")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
                
            @endif

            @if(app()->getLocale()=="kr")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            
            @endif

            @if(app()->getLocale()=="ch")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;

            @endif

            @if(app()->getLocale()=="se")
                window.location= '/detalle_metodo_pago/' + crypto + '/' + currency;
            @endif
        }

    </script> 
@endsection