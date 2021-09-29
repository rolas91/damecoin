<script src="https://js.stripe.com/v3/"></script>

<form action="/process" method="POST" id="payment-form" name="myForm">
  
        <input type="hidden" name="_token"  id="_token" value="{{ csrf_token() }}">
        <input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
        <input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">
        <label for="" class="subt" style="margin-top:5px">@lang('index.dataaccount')</label>
        
          <div class="row sign">
            <div class='col-sm-6 formx'>
                <input
                    type="text"
                    value=''
                    name="name"
                    id="name"
                    class="form-control"
                    placeholder="@lang('index.form_name') " 
                    required>
			      </div>
            <div class='col-sm-6 formx'>
                    <input
                        type="text"
                        value=''
                        id="lastname"
                        name="lastname"
                        class="form-control"
                      placeholder="@lang('index.form_lastname')" required>
			      </div>  
			     
            <div class='col-sm-6 formx'>
                <input
                    type="email"
                    value=''
                    id="email"
                    name="email"
                    class="form-control" required
                    placeholder="@lang('index.form_email')">
			      </div>
			
            <div class='col-sm-6 formx'>
                {!!Form::select('country', $getCountry, '', [
                    'id' => 'getCountry',
                    'class' => 'form-control',
                    'placeholder' =>  __('index.form_country') ,
                    'required'=>'required'
                ])!!}
			      </div>
          </div>

        <div class="col-md-12">
          <div class="form-row">
              <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px">
                  @lang('index.paycard')
              </label>
    
              <div id="card-element" style="margin:8px!important"></div>                  
					    <div id="card-errors" role="alert" style="color:red" ></div>
        </div>

        <div class="paymentVender" style="margin-bottom: 20px;margin-left:0px;">
            <ul style="display: flex;list-style: none;margin-left:0px;">
              <li style="align-items: center;display: flex"><img src="{{asset('img/vender5.png')}}" alt="" width="80px"></li>            
              <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender6.png')}}" alt="" width="80px"></li>
              <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender1.png')}}" alt="" width="80px"></li>
              <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender2.png')}}" alt="" width="80px"></li>
              <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender3.png')}}" alt="" width="50px"></li>
              <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender4.png')}}" alt="" width="80px"></li>                    
            </ul>
				</div>					
      </div>
      <div class="col-md-12">
        <button class="btn btn-primary mibuttom pull-right">@lang('index.paybottom') {{ $getCriptodefault->code }}</button>
      </div>                     
  </form>


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
 
 function totalxx(){
 if ($("input[type='radio'].person").is(':checked')){
    //alert("si person");
    totalx = $("#persoCurrency").val();
  }else{
   totalx = $("input[type='radio'].radioBtnClass:checked").val();
   //console.log(totalx);
  }
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

            $(".spinner").fadeIn('fast'); 
            stripe.createToken(card).then(function(result) {

                if (result.error) {
                  // Inform the user if there was an error.
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;
                   $(".spinner").fadeOut('fast'); 
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
</script>     