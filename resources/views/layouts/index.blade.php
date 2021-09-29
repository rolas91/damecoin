@extends('layouts.app')
@section('meta_title')
    <title>{{ $meta['title'] }}</title>
@overwrite
@section('meta_tags')
    <!-- Seo Tags -->
    <meta name="description" content="  {{ $meta['descripcion'] }}">
    <meta name="keywords" content="{{ $meta['key'] }}">
    <meta name="robots" content="index, follow"> 
    <meta property="og:image" content="{{asset('img/damecoins/facebooklinkpreview.png')}}" />
    <meta property="og:image:width" content="963" />
    <meta property="og:image:height" content="540" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:description" content="{{ $meta['descripcion'] }}" />
    <!-- /Seo Tags -->
@overwrite
 @section('content')
<!-- section -->
<section class="hero-section">
    <div class="container">
        <div class="row">
                <div class="col-md-5 hero-text">
                        <h2>Compra <span>Bitcoins</span> <br>con tarjeta al instante</h2>
                        <h4>DameCoins. Sin necesidad de ningún conocimiento previo. Compra bitcoins y otras criptodivisas en minutos con tu tarjeta.</h4>
                        <form  style="display:none;"  class="hero-subscribe-from">
                            <input type="text" placeholder="Enter your email">
                            <button class="site-btn sb-gradients">Get Started</button>
                        </form>
                </div>
                <div class="col-md-7" ng-app="appIndex" ng-controller="indexCtrl">
                <!--selects dinamicos-->
                <div class="row">
                    <div class="col-md-6">
                    <p class="subt">@lang('index.buydivisa')</p>
                    <div class="inner-addon left-addon">
                            <i class="glyphicon">{{$getCriptodefault->code}}</i>
                            {!!Form::select('getCryptos', $getCryptos, $getCriptodefault -> code, [
                    'id' => 'getCryptos',
                    'class' => 'form-control'
                ])!!}
                        </div>

                    
                    </div>
                    <div class="col-md-6">
                    <p class="subt">@lang('index.paydivisa')</p>
                    <div class="inner-addon left-addon">
                            <i class="glyphicon">{{$getCurrencyUser->code}}</i>
                            {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser -> code, [
                    'id' => 'getCurrencies',
                    'class' => 'form-control'
                ])!!}
                             </div>
                    

                </div>
                </div>
                <!--selects dinamicos-->
                <!--panel-->
                <div class="row">
                    <div class="col-md-12">
                    <div>
                    <p class="textcomi">@lang('index.textcomision')</p>

                    <p class="subt">@lang('index.buycantidad')</p>
                   
                    @forelse($getPanel as $panel)
                    <div class='row panelx'>
                        <div class='col-md-6'>
                        <p class="subt1">@lang('index.get')</p>
                        <p class="titulo">
                             {{$panel["recibir"]}}
                            {{$getCriptodefault->code}}
                        </p>
                        
                        </div>
                        <div class='col-md-5'>
                        <p class="subt1">@lang('index.pay')</p>
                        <p class="titulo">
                            {{$panel["pagar"]}}
                            {{$getCurrencyUser->code}}
                            </p>
                             </div>
                        <div class='col-md-1'>
                        {{Form::radio("item",$panel["pagar"],$panel["default"],["class" => "form-group radioBtnClass"])}}
                        </div>
                    </div>
                    @empty
                    <p>nada</p>
                    @endforelse
                    <div class="row">
                    </div>
                    
                    <div class='row panelx' >
                        <div class='col-md-3'>
                            <p class="other">@lang('index.otherquantity')</p>
                        </div>
                        <div class='col-md-4'>

                            <div class="inner-addon right-addon">
                                <i class="glyphicon">{{$getCriptodefault->code}}</i>
                                <input type="text" disabled value="{{$default['recibe']}}" class="form-control" maxlength="15"  id="persoCrypto" onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class='col-md-4' >

                        <div class="inner-addon right-addon">
                                <i class="glyphicon">{{$getCurrencyUser->code}}</i>
                                <input type="text" disabled value="{{$default['pay']}}" class="form-control" maxlength="10" id="persoCurrency" onKeyPress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class='col-md-1'>
                        {{Form::radio("item",1000,false,["class" => "form-group radioBtnClass person","id"=>"person"])}}
                        </div>
                    </div>
                        </div>
                </div>
                </div>
                <form action="/process" method="POST" id="payment-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
                    <input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">
                    <label for="" class="subt">@lang('index.dataaccount')</label>
                    <div class="row sign">
                        <div class='col-sm-6 formx'>
                            <input
                                type="text"
                                value=''
                                name="name"
                                class="form-control"
                                placeholder="Nombre" 
                                required></div>
                            <div class='col-sm-6 formx'>
                                <input
                                    type="text"
                                    value=''
                                    name="lastname"
                                    class="form-control"
                                  placeholder="Apellidos" required>
                           </div>
                                  <!--  </div>
                    <div class="row">
                    -->
                        <div class='col-sm-6 formx'>
                            <input
                                type="text"
                                value=''
                                name="email"
                                class="form-control" required
                                placeholder="Email"></div>
                            <div class='col-sm-6 formx'>
                                    {!!Form::select('country', $getCountry, '', [
                                        'id' => 'getCountry',
                                        'class' => 'form-control',
                                        'placeholder' => 'País',
                                        'required'=>'required'
                                    ])!!}
                                </div>
                    </div>
                    <div class="form-row">
                    <label for="card-element" class="subt">
                        @lang('index.paycard')
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <div class="row total">
                    <div class="col-md-7" id="finalx">
                           <p>
                                @lang('index.mesagge1',["divisa"=> $getCriptodefault->code ]) 
                           </p> 
                           <p>
                                @lang('index.mesagge2',["divisa"=> $getCriptodefault->code ]) 
                           </p> 
                            <p>
                                @lang('index.mesagge3',["divisa"=> $getCriptodefault->code ,"currency"=> $getCurrencyUser->code ]) 
                            </p> 
                    </div>
                    <div class="col-md-5 pull-right">
                            <button class="btn btn-primary mibuttom pull-right" >@lang('index.paybottom') {{ $getCriptodefault->code }}</button>
                    </div>
                </div>
                 </form>
                
               
                <!--total-->
                
                <div class='row '>
                    <div class='col-sm-6'>

                    </div>
                    <div class='col-sm-6'>
                        <!--
                   <p class='totalx'> Total: @{{selectedUser().pagar}} <b>@{{currency}}</b></p> 
                   <p class='totalx'>Recibiras @{{selectedUser().recibir}}<b> @{{crypto}}</b></p>
                   <section layout="row"  layout-align="right right">
                   <md-button class="md-raised md-primary" ng-click='pay()'>Comprar @{{crypto}} </md-button>
                   </section>
                -->

                    </div>
                
                </div>
                
                <!--total-->
            </div>
        </div>
    </div>
</section>

@include('index_parts.about')

@include('index_parts.features') 

@include('index_parts.process') 

@include('index_parts.facts') 

@include('index_parts.team') 

@include('index_parts.review') 



<script>
//radioBtnClass
$('.radioBtnClass').click(function() {
    //alert($(this).val());
    //if(has)
   if ($(this).hasClass('person')){
      // alert("si");
       $("#persoCrypto").removeAttr("disabled");
       $("#persoCurrency").removeAttr("disabled");
   }else{
        $("#persoCrypto").attr("disabled","disabled");
        $("#persoCurrency").attr("disabled","disabled");

   }
});
$('.panelx').click(function() {
//alert("si");
console.log($(this));

$(this).find("input[type='radio'].radioBtnClass").click();
});

$('.panelx').mouseover(function()  {
    $(this).css('background-color','rgb(219, 226, 249)');

});
$('.panelx').mouseout(function()  {
    
    $(this).css('background-color','#e7edff');
});

$("#persoCrypto").keyup(function () {
    var defaultxxx= $("#converx").val();
    var crypto=$(this).val();
    var totalCurrency=(crypto/defaultxxx)*{{$getCurrencyUser->detailCurrency->max_deposito}};
    var totalCurrency=totalCurrency.toFixed(2);
    $("#persoCurrency").val(totalCurrency);
    //console.log(defaultxxx);
});
$("#persoCurrency").keyup(function () {
    console.log("normal"+$("#converx").val());
    var defaultxxx= parseFloat($("#converx").val());
    var defaultxxx= defaultxxx.toPrecision(7);
    var crypto=parseFloat($(this).val());
   // var crypto= crypto.toPrecision(7);
    var totalCrypto=parseFloat(crypto*defaultxxx)/{{$getCurrencyUser->detailCurrency->max_deposito}};
    //var totalCrypto=Math.floor(totalCrypto);
    var totalCrypto=totalCrypto.toFixed(7);
    if(isNaN(totalCrypto)){
        totalCrypto=0;
        totalCrypto=totalCrypto.toFixed(7);
        $("#persoCrypto").val(totalCrypto);
       
    }else{
        
        $("#persoCrypto").val(totalCrypto);
    }
    
    //console.log(defaultxxx);
});

  $("#getCurrencies").change(function () {
        var str = $(this).val();
        var currency = str.toLowerCase();
        var xcrypto=$("#getCryptos").val();
        var crypto = xcrypto.toLowerCase();
        var pais="{{ $pais }}";
       // window.location = "/" + crypto + "/" + currency;
        window.location='/comprar-'+crypto+'/con-tarjeta-en-'+currency;
    });
    $("#getCryptos").change(function () {
        var str = $(this).val();
        var crypto = str.toLowerCase();
        var xcurren=$("#getCurrencies").val();
        var currency = xcurren.toLowerCase();
        //var pais="venezuela";
        var pais="{{ $pais }}";
        //window.location = "/" + crypto + "/" + currency;
        window.location='/comprar-'+crypto+'/con-tarjeta-en-'+currency;
    });

var stripe = Stripe('pk_test_9xNXo61OfyqVdw04MCm7X7uh005iImuXO3');
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
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
// Create an instance of the card Element.
var card = elements.create('card',
 {hidePostalCode: true,style: style}
 );
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
  
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
            if ($("input[type='radio'].person").is(':checked')){
                //alert("si person");
                totalx = $("#persoCurrency").val();
              }else{
               totalx = $("input[type='radio'].radioBtnClass:checked").val();
               //console.log(totalx);
              }
            //console.log(token);
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        var total = document.createElement('input');
        total.setAttribute('type', 'hidden');
        total.setAttribute('name', 'total');
        total.setAttribute('value', totalx);
        form.appendChild(hiddenInput);
        form.appendChild(total);
       
        // Submit the form
        form.submit();
        

}
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
</script>
<!--section end -->
@endsection

@section('scripts')

@endsection



