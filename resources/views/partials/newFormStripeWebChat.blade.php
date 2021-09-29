<script src="https://js.stripe.com/v3/"></script>

<div class="col-md-12 p-0">
    <div class="card form-crypto">
        <div class="card-body">
            <div class="panel panel-default mt-2">
                <form
                    action="/process"
                    method="POST"
                    id="payment-form" name="myForm">
                    <input type="hidden" name="_token"  id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
                    <input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">
                    <label for="" class="subt" style="margin-top:5px">@lang('index.dataaccount')</label>
                    <div class="row sign">
                        <div class='col-sm-6 formx'>
                            <input
                                type="text"
                                value=""
                                data-recurly="first_name"
                                name="name"
                                id="namex"
                                class="form-control"
                                placeholder="@lang('index.form_name') "
                                required="required">
                        </div>
                        <div class='col-sm-6 formx'>
                            <input
                                type="text"
                                value=""
                                id="lastnamex"
                                data-recurly="last_name"
                                name="lastnamex"
                                class="form-control"
                                placeholder="@lang('index.form_lastname')"
                                required="required">
                        </div>
                            <!-- </div> <div class="row"> -->
                        <div class='col-sm-6 formx pt-2'>
                            <input
                                type="email"
                                value=""
                                id="emailx"
                                name="email"
                                class="form-control"
                                required="required"
                                placeholder="@lang('index.form_email')">
                        </div>
                        <div class='col-sm-6 formx pt-2'>
                            {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                            'form-control height-control', 'placeholder' => __('index.form_country') ,
                            'required'=>'required' ])!!}
                        </div>
          </div>
              

                    <div class="row justify-content-center">
                        <div class="align-self-center">
                            </div>
                        </div>

                        <!--tarjeta-->
                        <div class="row">
                            <div class="col-md-12 mb-3 pt-3">
                                <label for="validationCustomUsername">@lang('index.card_type')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">
                                            <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
                                        </span>
                                    </div>
                                    {!!Form::select('card_type', [ "VISA"=>"VISA", "MASTERCARD"=>"MASTERCARD",
                                    "AMEX"=>"AMEX", "CABAL"=>"CABAL", "NARANJA"=>"NARANJA", "CENCOSUD"=>"CENCOSUD",
                                    "SHOPPING"=>"SHOPPING", "ARGENCARD"=>"ARGENCARD"], ' ', [ 'id' => 'card_type',
                                    'class' => 'form-control', 'required'=>'required' ])!!}
                                </div>
                            </div>
                        </div>

                                <!--tarjeta-->
                        <div class="row">dassa
                            <div class="col-md-12">
                                <div class="form-row">    
                                    <div id="card-element" style="margin:5px!important;padding-left: 12px; padding-right:12px" class="w-100 form-control py-2"></div>                  
                                    <div id="card-errors" class="small text-danger mt-2" role="alert" ></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-green btn-lg w-100 mt-4 mb-2" style="z-index: 1;position: relative;">
                            <svg class="spinner" viewBox="0 0 50 50">
                              <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                            </svg>
                            <div class="txt">
                                <img src="{{ asset('img/landing/icons/bitcoins.png') }}" class="left-icon" id="confirm-purchase">
                                @lang('index.paybottom') {{ $getCriptodefault->code }}
                            </div>
                        </button>
                        </div>
                    </div>


                    @if (Session::has('success'))
                        <div class="alert alert-success mt-4">
                            <center>{{Session::get('success') }}</center>
                        </div>
                    @endif @if (Session::has('danger'))
                        <div class="alert alert-danger mt-4">
                            <center>
                                {{ Session::get('danger') }}
                            </center>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<script>

            
var stripe = Stripe('{{  General::publicStripeKeys()}}');
// Create an instance of Elements.
var elements = stripe.elements({
    locale: '{{ App::getLocale() }}',
}
);
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
 {
     hidePostalCode: true,
     style: style
    }
 );
 
 function totalxx() {
        let sw = false;
        $("input[type = 'radio'").each(function(){
            if($(this).is(':checked')){
            totalx = $(this).attr('id');
            sw = true;
            }
        })

        if(sw == false){
            totalx = $(".person").val();
        }
        //console.log(totalx);
        return totalx;
    }

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
    console.log(event.error.message)
  } else {
    displayError.textContent = '';
  }
});
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

    amount = totalxx();
    currency = '{{ $getCurrencyUser->code }}';
    card_type= true;
    
    console.log(amount, currency, card_type)

    calculateMinimum(amount,currency,card_type).then(()=>{

          @if($getCurrencyUser->secure=="1") 

            //UI  
            $(".spinner").fadeIn('fast'); 
            $(".txt").css('opacity','0');
            //UI  

            stripe.createToken(card).then(function(result) {

                if (result.error) {
                  // Inform the user if there was an error.
                   var errorElement = document.getElementById('card-errors');
                   errorElement.textContent = result.error.message;
                    
                   //UI   
                   $(".spinner").fadeOut('fast'); 
                   $(".txt").css('opacity','1');
                   $(".is-complete").css('color','red');
                    //UI  
                
                } else {
                    var data = {
                        '_token':$("#_token").val(),
                        'total':totalxx(),
                        'stripeToken':result.token.id,
                        'name': $("#name").val() +" "+$("#lastname").val(),
                        'email':$("#email").val(),
                        'currency':'{{ $getCurrencyUser->code }}',
                    };
                    var ajax = $.ajax({
                        url: "/paymentintent",
                        method: 'post',
                        data: data,
                        dataType: 'json',
                        });
                        //4000 0000 0000 3063
                        ajax.done(function (data) {
                            if(data.error=="true"){
                                alert(data.type);
                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = data.type;
                                $(".spinner").fadeOut('fast'); 
                                return;
                            }
                            var clientSecret=data.client_secret;
                            stripe.handleCardPayment(
                                      clientSecret,
                                      card,
                                ).then(function(result) {
                                    if (result.error) {
                                        alert(result.error.message);
                                        $(".spinner").fadeOut('fast'); 
                                    } else if (result.paymentIntent && result.paymentIntent.status === 'succeeded') {
                                      securePayment(clientSecret,result.paymentIntent.id);
                                }
                                  
                                });
                    
                        });
                        ajax.fail(function () {
                                      
                        });
                }
              });

          @else
          
          stripe.createToken(card).then(function(result) {

            //$(".spinner").fadeIn('hide'); 

            if (result.error) {
              // Inform the user if there was an error.
              var errorElement = document.getElementById('card-errors');
              errorElement.textContent = result.error.message;
            } else {
              // Send the token to your server.
              stripeTokenHandler(result.token);
            }


          });
          
          @endif
        
    })
    .catch(data => {
        console.log("fallo");
        console.log(data);
         swal({
            text: "{{ __('home_buy.minimun', ['type' => 'CARD' ]) }}"+' ('+data.limit+' USD)',
            icon: "error",
          });
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
function securePayment(secretx,resultx) {
    //alert(resultx.id);
    //console.log(resultx);
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
        hiddenInput.setAttribute('value', "");

        var total = document.createElement('input');
        total.setAttribute('type', 'hidden');
        total.setAttribute('name', 'total');
        total.setAttribute('value', totalx);

        var secure = document.createElement('input');
        secure.setAttribute('type', 'hidden');
        secure.setAttribute('name', 'secure');
        secure.setAttribute('value', "true");

        var secret = document.createElement('input');
        secret.setAttribute('type', 'hidden');
        secret.setAttribute('name', 'secret');
        secret.setAttribute('value', secretx);

        var result = document.createElement('input');
        result.setAttribute('type', 'hidden');
        result.setAttribute('name', 'result');
        result.setAttribute('value', resultx);

        form.appendChild(hiddenInput);
        form.appendChild(total);
        form.appendChild(secure);
        form.appendChild(secret);
        form.appendChild(result);
        form.submit();
}

let formApplyColor = () => {

    alert('ok');

}


</script>     