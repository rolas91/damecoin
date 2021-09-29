@extends('layouts.admin_user')
@section('meta_title')
<title>{{ $meta['title'] }}</title>
@overwrite
@section('meta_tags')
<!-- Seo Tags -->
<meta name="description" content="  {{ $meta['descripcion'] }}">
<meta name="keywords" content="{{ $meta['key'] }}">
<meta name="robots" content="index, follow">
<meta property="og:type" content="website" />
<meta property="og:image" content="{{asset('img/damecoins/facebooklinkpreview.jpg')}}" />
<meta property="og:url" content="https://damecoins.com/" />
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:title" content="{{ $meta['title'] }}" />
<meta property="og:description" content="{{ $meta['descripcion'] }}" />
<!-- /Seo Tags -->
@overwrite

@section('content')
<!--<script src="{{ asset('js/qrcode.js')}}"></script>-->
<script src="https://js.recurly.com/v4/recurly.js"></script>
<link href="https://js.recurly.com/v4/recurly.css" rel="stylesheet" type="text/css">

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			@lang('home_buy.header')
			<small></small>
		</h1>
	</section>

	<section class="content">
		@if(Session::has('error'))
    		<div class="alert alert-danger alert-dismissible " role="alert">
    			<strong>!</strong> {{Session::get('error')}}
    			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
    			</button>
    		</div>
		@endif

        <div class="row">
    		<div class="col-md-8">
               <div class="alert alert-danger" role="alert" style="display: none">
                  Apologizes, our card payment system is currently under maintenance. Please come back in a few days to purchase crypto using credit or debit card (card system is being upgraded and it may take a few days). If you need to purchase right now, please signup or login for paying by PayPal or by bank transfer (we have bank accounts available in USA, UK, Europe, Hong Kong, China, Australia...)  Feel free to ask our 24h Chat Support!
               <!-- For payments by credit or debit card, please make the payment on the home page of Damecoins.com.  Make sure to enter the same email address as your current Damecoins account so that the purchase is instantly linked to your account.  We are working hard to implement the new form directly here for your convenience as soon as possible.  Sorry for the inconvenience.
               -->
            </div>
    			<div class="row">
    				<div class='col-sm-6'>
    					<p class="subt">@lang('index.buydivisa')</p>

    					<div class="input-group">
    						<div class="input-group-prepend">
    							<div class="input-group-text color-input">{{$getCriptodefault->code}}</div>
    						</div>
    						{!!Form::select('getCryptos', $getCryptos,$getCriptodefault->id, [
    						'id' => 'getCryptos',
    						'class' => 'form-control'
    						])!!}
    					</div>
    				</div>
    				<div class='col-sm-6'>
    					<p class="subt">@lang('index.paydivisa')</p>
    					<div class="input-group">
    						<div class="input-group-prepend">
    							<div class="input-group-text color-input">{{$getCurrencyUser->code}}</div>
    						</div>
    						{!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->id, [
    						'id' => 'getCurrencies',
    						'class' => 'form-control'
    						])!!}
    					</div>
    				</div>
    			</div>

    			<form action="/processcomprax" method="post" id="processcompra">
    				<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    				<input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
    				<input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">
    			</form>

    			<p class="textcomi">@lang('index.textcomision')</p>

    			<p class="subt">@lang('index.buycantidad')</p>

    			@forelse($getPanel as $panel)
        			<div class='panelx'>
                        <div class="row d-flex">
            				<div class='col-xs-5 col-sm-5 col-md-6 '>
            					<p class="subt1">@lang('index.get')</p>
            					<p class="titulo">
            						{{$panel["recibir"]}}
            						{{$getCriptodefault->code}}
            					</p>
            				</div>
            				<div class='col-xs-5 col-sm-5 col-md-5'>
            					<p class="subt1">@lang('index.pay')</p>
            					<p class="titulo">
            						{{$panel["pagar"]}}
            						{{$getCurrencyUser->code}}
            					</p>
            				</div>
            				<div class='col-xs-2 col-sm-2 col-md-1 xms d-flex align-items-center justify-content-center'>
            					{{Form::radio("item",$panel["pagar"],$panel["default"],["class" => "form-group radioBtnClass mt-0"])}}
            				</div>
                        </div>
        			</div>
    			@empty
    			    <p></p>
    			@endforelse

    			<div class='panelx'>
                    <div class="row d-flex">
        				<div class='col-md-3'>
        					<p class="other">@lang('index.otherquantity')</p>
        				</div>
        				<div class='col-md-4'>
        					<div class="input-group mb-2">
        						<input type="text" value="{{$default['recibe']}}" class="form-control" maxlength="15"
        							id="persoCrypto" onKeyPress="return soloNumeros(event)">
        						<div class="input-group-prepend">
        							<div class="input-group-text color-input">{{$getCriptodefault->code}}</div>
        						</div>
        					</div>
        				</div>
        				<div class='col-md-4'>
        					<div class="input-group mb-2">
        						<input type="text" value="{{$default['pay']}}" class="form-control" maxlength="10"
        							id="persoCurrency" onKeyPress="return soloNumeros(event)">
        						<div class="input-group-prepend">
        							<div class="input-group-text color-input">{{$getCurrencyUser->code}}</div>
        						</div>
        					</div>
        				</div>
        				<div class='col-md-1 d-flex align-items-center justify-content-center'>
        					{{Form::radio("item",1000,false,["class" => "form-group radioBtnClass mt-0 person","id"=>"person"])}}
        				</div>
                    </div>
    			</div>

    			@if($getTotalDivisa>0)
        			<div class="row" style='border:solid 1px #ccc;padding:5px;margin:10px!important;border-radius:8px'>
        				<div class='col-sm-7'>
        					<p> @lang('home_buy.paycartera')
        						{{ $getTotalDivisa}} {{$getCurrencyUser->code}}
        					</p>
        				</div>
        				<div class='col-sm-2'>
        					{{Form::checkbox("item",$getTotalDivisa,false,["class" => "form-group","id"=>"total"])}}
        				</div>
                        <div class='col-sm-3'>
                            <form action="/processcomprax" method="POST" id="paymentCartera" role="form">
                                <div class="row sign">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
                                    <input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">

                                    <div class="col-md-12 paymentRecurly mb-2">
                                        <button class="btn btn-success btn-buy font-weight-bold"
                                            id="confirm-purchase">
                                            <span class="spinner-grow spinner-grow-sm d-none" role="status"
                                                aria-hidden="true"></span>
                                            <span class="sr-only">Loading...</span>
                                            <span class="sendtext">@lang('index.paybottom') {{ $getCriptodefault->code }}</span>
                                        </button>
                                        <!--<div class="text-danger small d-none">
                                            Our card processing system is under temporary maintenance. Please use other methods like PayPal or bank transfer in between. The system will be back online shortly. Sorry for the inconvenience caused. The Damecoins team.
                                        </div>-->
                                    </div>
                                </div>
                            </form>
                        </div>

                        <script>
                            /*
                            checkbox.addEventListener('change', (event) => {
                              	let button = document.getElementById("buycrypto");
                              	if (event.target.checked) {
                              		//alert('checked');
                              		button.disabled = false;
                              	} else {
                              		if(recurlyStatus === true){
                              			button.disabled = true;
                              		} else {
                              			button.disabled = false;
                              		}
                              		//alert('not checked');
                              	}
                              });
                            */
                            document.querySelector('#paymentCartera').addEventListener('submit', function (event) {
                               event.preventDefault();
                               amount = TotalAmount();
                               currency = '{{ $getCurrencyUser->code }}';
                               card_type = true;
                            //    alert(amount);
                            //    return;
                                if ($("input[type='checkbox']#total").is(':checked')) {
                                    if ($("input[type='radio'].radioBtnClass").is(':checked')) {
                                        if ($("input[type='radio'].person").is(':checked')){
                                            //alert("si person");
                                            totalx = $("#persoCurrency").val();
                                        }else{
                                            totalx = $("input[type='radio'].radioBtnClass:checked").val();
                                            //console.log(totalx);
                                        }
                                    }

                                    // alert(totalx);
                                    var formu = document.getElementById('processcompra');
                                    var total = document.createElement('input');
                                    total.setAttribute('type', 'hidden');
                                    total.setAttribute('name', 'total');
                                    total.setAttribute('value', totalx);
                                    var wallet = document.createElement('input');
                                    wallet.setAttribute('type', 'hidden');
                                    wallet.setAttribute('name', 'wallet');
                                    wallet.setAttribute('value', 'true');
                                    // form.appendChild(hiddenInput);
                                    formu.appendChild(total);
                                    formu.appendChild(wallet);
                                    // Submit the form
                                    formu.submit();
                                }
                            });
                        </script>
        			</div>
    			@else
        			<div class="alert alert-info">
        				@lang('home_buy.sinsaldocartera') {{$getCurrencyUser->code}}
        			</div>
    			@endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                
                <!-- AQUI ESTAMOS TRABAJANDO include('home_usuario.partials.formStripeWebchat') -->
                    
                <!-- AQUI ESTAMOS TRABAJANDO -->
                {{-- 
                @include('home_usuario.partials.formBuyStripe')
                 --}}

  
                @include('home_usuario.partials.payment.formUnitPay')
                
                {{-- @if (General::paymentState('stripe'))
                @include('home_usuario.partials.formBuyStripe')
                @endif
                
                @if (General::paymentState('payu'))
                    @include('home_usuario.partials.formPayUHome')
                @endif
                --}}

                {{-- <div class="row">
                   <div class="col-md-12 d-flex justify-content-center mb-2">
                      <span>Or</span> 
                    </div>
                </div>    
                @include('partials.formPayPal')
                <div class="row">
                   <div class="col-md-12 d-flex justify-content-center mb-2">
                      <span>Or</span> 
                    </div>
                </div> 
                @include('partials.formPayWestern') --}}

                @include('partials.bootonModal2')

                  <!-- se quito deposit de compra -->

{{--  
                @include('partials.infoPay')

                --}}
                
            </div>
        </div>

    </section>
     <!--transferencia-->
     <div class="row" style="margin:10px">
        <div class="col-sm-12">
              <h2 class="page-header">
                  @lang('home_deposit.mesaggetransfe1')
               </h2>
            <p>@lang('index.subtitleAllPopups')</p>
           <p>@lang('home_deposit.mesaggetransfe2') </p>
        </div>
     </div>
     <section class="invoice">
        <div class="row">
           <div class="col-xs-12">
              <h2 class="page-header">
                 <i class="fa fa-globe"></i> @lang('home_deposit.transferencia')
              </h2>
           </div>
        </div>
        @if(Session::has('msg'))
        <div class="alert alert-danger alert-dismissible " role="alert">
           <strong>!</strong> {{Session::get('msg')}}
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
        </div>
        @endif
        @php
           $i = 0;
        @endphp
        @forelse ($banks as $bank)
        <form action="/processtransfe" method="POST" class="form-horizontal" enctype="multipart/form-data">
           {{ csrf_field() }}
           <input type="hidden" name="id" value="{{ $default->id }}">
           <div class="row invoice-info">
              <div class="col-sm-6 invoice-col">
                 <p style="font-size:2em"> {{ $bank->title }}</p>
                 <p><span style="font-weight:bold">@lang('home_deposit.destinatario')</span> {{ $bank->destinatary }}</p>
                 <p><span style="font-weight:bold">@lang('home_deposit.banco') </span>{{ $bank->name }}</p>
                 <p><span style="font-weight:bold">@lang('home_deposit.country') </span>{{ $bank->country }}</p>
                 <p><span style="font-weight:bold">@lang('home_deposit.swift')</span>{{ $bank->swift }}</p>
                 <p><span style="font-weight:bold">@lang('home_deposit.acount')</span> {{ $bank->numero_cuenta }}</p>
                 <address>
                    {{--    <strong>Damecoins, Inc.</strong><br>Phone: (804) 123-123<br> --}}
                    <p><span style="font-weight:bold">Concept: </span> <span style="color:red"> {{$concept}}</span></p>
                    Email: info@damecoins.com
                 </address>
              </div>
              <div class="col-sm-6 invoice-col">
                 <div class="row">
                    <div class="col-sm-6">
                       <label>@lang('home_deposit.totalt')</label>
                       <div class="input-group">
                          <input id="totalT{{$i}}" class='form-control' type="number" name='montot' required
                             autocomplete="off" value="{{ $limit }}" min="{{ $limit }}" onkeyup="totalT({{$i}})">
                          <div class="input-group-prepend">
                             <div class="input-group-text color-input">{{$default->code}}</div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-sm-12">
                       <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}">
                          <label>@lang('home_deposit.recibo')</label>
                          <div class="col-md-12">
                             <input type="file" name="img" class="form-control" required>
                             @if ($errors->has('img'))
                             <span class="help-block">
                             <strong>{{ $errors->first('img') }}</strong>
                             </span>
                             @endif
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class='col-sm-12'>
                       <input type="hidden" name='currency' value=" {{$default->id}}">
                       <p class="final">@lang('home_deposit.totalt1') <span id="totalt{{$i}}"> </span> {{$default->code}}</p>
                       <p style="display:none;" class="final">
                          @lang('home_deposit.comisiont'){{ $default->detailCurrency->comision_abono }} %:<span
                          id="comisiont{{$i}}"></span> {{$default->code}} 
                       </p>
                       <p style="text-align:justify">@lang('home_deposit.mesaggetransfe') {{$default->code}} </p>
                    </div>
                 </div>
              </div>
           </div>
           <div class="row no-print">
              <div class="col-xs-12">
                 <button type="submit" class="btn btn-warning pull-right" style="margin-right: 2px;">
                 <i class="fa fa-download"></i> @lang('home_deposit.bottontransfe')
                 </button>
              </div>
           </div>
        </form>
        <hr color="#ccc" style="background-color: red!important;">
        @php
            $i++;
        @endphp
        @empty
        @endforelse
     </section>
  </section>
</div>

<script>
      //Esta funcion no estaba -- se agrego nueva
      // No borrar
      function TotalAmount(){
        if ($("input[type='radio'].person").is(':checked')){
            //alert("si person");
            totalx = $("#persoCurrency").val();
        }else{
            totalx = $("input[type='radio'].radioBtnClass:checked").val();
            //console.log(totalx);
        }
       return totalx;
    }

     // $("#totalT").keyup(function(){
        for (let i = 0; i < parseInt({{ count($banks) }}); i++) {
            totalT(i);
         }
      // });
   
      function totalT(i){
          
          var currency=parseFloat($(`#totalT${i}`).val());

          var comision=parseFloat({{ $default->detailCurrency->comision_abono  }});
          if(isNaN(currency)){
            comision=mytoFixed(0,`comisiont${i}`);
            comision=mytoFixed(0,`totalt${i}`);
          }else{
              var comi=((currency*comision)/100);
              // var total=currency-comi;
              var total = currency;
              //console.log(comi);
              comision=mytoFixed(comi,`comisiont${i}`);
              comision=mytoFixed(total,`totalt${i}`);
          }
      }
   
      function mytoFixed(valor,variable){
          valor=valor.toFixed(2);
          if(isNaN(valor)){
            valor=0;
            valor=valor.toFixed(2);
            $("#"+variable+"").text(valor);
          }else{
            $("#"+variable+"").text(valor);
            //$("#venta").text(valor);
          }
      }


    $("input[type='checkbox']#total").change(function() {
        if(this.checked) {
          $('#method-pay').css('display','none')
          $('#method-pay-tab').css('display','none')
          $('#button-pay').css('display', 'block');
        }
        else{
          $('#method-pay').css('display','block')
          $('#method-pay-tab').css('display','flex')
          $('#card-tab').addClass('active');
          $('#wechat-tab').removeClass('active');
          $('#settings').removeClass('active');
          $('#favourite').addClass('active');
        }
    });

    $('#wechat-tab').click(function() {

        $('#button-pay').css('display', 'none');
    });

    $('#card-tab').click(function() {

        $('#button-pay').css('display', 'block');
    });

    $('.panelx').click(function() {
        // $("#person").trigger("click");
        $(this).find("input[type='radio'].radioBtnClass").click();
    });

    $('.panelx').mouseover(function()  {
        $(this).css('background-color','rgb(219, 226, 249)');
    });

    $('.panelx').mouseout(function()  {
        $(this).css('background-color','#e7edff');
    });

    var cartera=false;
    var totalx=0;

    totalx = $("input[type='radio'].radioBtnClass:checked").val();
    $('#pagar').click(function () {
        if ($("input[type='radio'].radioBtnClass").is(':checked')) {
         totalx = $("input[type='radio'].radioBtnClass:checked").val();
            console.log(totalx);
        }
        //pago con cartera
        if ($("input[type='checkbox']#total").is(':checked')) {
           // var total = $("input[type='checkbox']#total:checked").val();
            cartera=true;
            //console.log(card_type);
        }

        var total = $('<input type=hidden name=total />').val(totalx);
        var wallet = $('<input type=hidden name=wallet />').val(cartera);
        $('#processcompra').append(wallet).append(total).submit();
    });

    $(".compra") // select the radio by its id
        .change(function () { // bind a function to the change event
        if ($(this).is(":checked")) { // check if the radio is checked
            var val = $(this).val(); // retrieve the value
            console.log(val);
        }
    });

    $("#getCurrencies").change(function () {
        //console.log($(this).val()); console.log($("#getCryptos").val());
        window.location = "/buy/" + $("#getCryptos").val() + "/" + $(this).val();
        // alert("vendor/"+$("#getCryptos").val()+"/"+$(this).val());
    });

    $("#getCryptos").change(function () {
        //console.log($(this).val()); console.log($("#getCurrencies").val());
        window.location = "/buy/" + $(this).val() + "/" + $("#getCurrencies").val();
        //alert("vendor/"+$(this).val()+"/"+$("#getCurrencies").val());
    });

    $("#persoCrypto").keyup(function () {
        var defaultxxx= '{{ $default['cryptox'] }}';
        var crypto=$(this).val();
        var totalCurrency=(crypto/defaultxxx)*{{$getCurrencyUser->detailCurrency->max_deposito}};
        var totalCurrency=totalCurrency.toFixed(2);
        $("#persoCurrency").val(totalCurrency);
    });

    $("#persoCurrency").keyup(function () {
        console.log("normal"+$("#converx").val());
        var defaultxxx= parseFloat('{{$default['cryptox']}}');
        var defaultxxx= defaultxxx.toPrecision(7);
        var crypto=parseFloat($(this).val());

        var totalCrypto=parseFloat(crypto*defaultxxx)/{{$getCurrencyUser->detailCurrency->max_deposito}};

        var totalCrypto=totalCrypto.toFixed(7);
        if(isNaN(totalCrypto)){
            totalCrypto=0;
            totalCrypto=totalCrypto.toFixed(7);
            $("#persoCrypto").val(totalCrypto);

        }else{

            $("#persoCrypto").val(totalCrypto);
        }
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

    function closeModal(){
      $('#qr').hide();
      // var qrcode = QRCode("qrcode").clear();
      location.reload();
    }

    $('#wechat').click(function() {
        $('#spinner').show();

        amount = TotalAmount();

        currency = '{{ $getCurrencyUser->code }}';

        card = false;
        calculateMinimum(amount,currency).then(()=>{

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });

        $.post("/wechat-change-divisa", { "amount" : amount , "currency" : currency })
            .done(function( data ) {
                amount = Math.round(data);
                pagarWeChat(amount);
            });
        })
        .catch(data => {
            $('#spinner').hide();
            swal({
                text: "{{ __('home_buy.minimun', ['type' => 'WeChat' ]) }}"+' ('+data.limit+' USD)',
                icon: "error",
            });
        });;
    });


    function calculateMinimum(amount ,currency, card){
        return new Promise((resolve, reject) => {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
             $.post("/wechat-calculate-minimun", { "amount" : amount ," currency": currency, "card": card})
              .done(function( data ) {
                if(data.data== 'false'){
                    reject(data);
                }
                resolve();
            });
        });
    }

    var MAX_POLL_COUNT = 30;
    var pollCount = 0;

    function pagarWeChat(amount){
        // var stripe = Stripe(key);
        var stripe = Stripe('{{  General::publicStripeKeys()}}');
        // var stripe = Stripe('pk_test_GnfTz7pty6zVKM8e3Chwar6G');

        stripe.createSource({
            type: 'wechat',
            amount: amount+'00',
            currency: 'hkd',
            statement_descriptor: '488 WEB MONEY',
        }).then(function(data) {
            pollForSourceStatus(data);
            // window.open(data.source.wechat.qr_code_url)
            $('#spinner').hide();

            var qrcode = new QRCode(document.getElementById("qrcode"), {
                width : 200,
                height : 200,
                text: data.source.wechat.qr_code_url,
            });
            $('#qr').show();
        });
    }

    function pollForSourceStatus(data) {
        // var stripe = Stripe(key);
        var stripe = Stripe('{{  General::publicStripeKeys()}}');
        // var stripe = Stripe('pk_test_GnfTz7pty6zVKM8e3Chwar6G');

        stripe.retrieveSource({id: data.source.id, client_secret:  data.source.client_secret}).then(function(result) {
            var source = result.source;
            if (source.status === 'chargeable') {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });

                var crypto = '{{ $getCriptodefault->id }}';
                var currencyForm = '{{ $getCurrencyUser->id }}';
                var amount = TotalAmount();

                var param = { 'source' : data , 'crypto' : crypto , 'currency_form': currencyForm , 'amount': amount};

                console.log(param);
                $.post("/wechat-charge", param)
                    .done(function( data ) {
                      swal({
                        title: "Transaction Success!",
                        text: "Please Continue!",
                        icon: "success",
                        button: true,
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                           closeModal();
                        };
                      });
                    });
            } else if (source.status === 'pending' && pollCount < MAX_POLL_COUNT) {
                // Try again in a second, if the Source is still `pending`:
                pollCount += 1;
                setTimeout(function () {
                    pollForSourceStatus(result)
                }, 10000);
                console.log(result)
            } else {
                console.log('rechazado')
                console.log(result)
                closeModal();
                // Depending on the Source status, show your customer the relevant message.
            }
        });
    }
    const checkbox = document.getElementById('total')

  
</script>
<!--section end -->
@endsection