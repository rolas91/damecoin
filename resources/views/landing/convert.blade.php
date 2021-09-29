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
    @include('partials.landing.convert.section_ten')
    
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
      var method = '{{ $data[0]->name }}';
    
    var prefix = 'Convert';      

    window.location=`/change/lang/${lang}/${crypto}/${currency}/${method}/${prefix}`;
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
                window.location= '/변하게하다-' + crypto + '-to-eu-' + currency;
            
            @endif

            @if(app()->getLocale()=="ch")
                window.location= '/兑换-' + crypto + '-to-eu-' + currency;

            @endif

            @if(app()->getLocale()=="se")
                window.location= '/konvertera-' + crypto + '-to-eu-' + currency;
            @endif
        }


    </script> 
@endsection