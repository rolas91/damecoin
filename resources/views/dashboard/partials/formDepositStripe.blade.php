	
<div class="row">
	<div class="col-md-6">
		<form action="/processdeposit" method="post" id="deposit" >
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $default->id }}">
          <div class="row">
            <div class="col-sm-12">
                <p>@lang('home_deposit.quanty')</p>
            </div>
         </div>    
            <div class="row" style="background-color:#ccc;padding:20px;margin:5px">   
            <div class='col-sm-6'>
                <div class="input-group">
                    <input id="totalD" class='form-control' type="number" name='monto'  required autocomplete="off">
                 {{--    <span class="input-group-addon" style="background-color:#367fa9;color:#fff;font-weight:bold"><i class="glyphicon">{{$default->code}}</i></span> --}}
                     <div class="input-group-prepend">
                            <div class="input-group-text color-input">{{$default->code}}</div>
                      </div>
                  </div>
              </div>
        </div>
        <br>
        <div class="row">
                <div class="col-md-6">
                    <p>@lang('home_deposit.mesagge')</p>
                </div>
                
        </div>
        <div class="row" style="background-color:#f0f0f0;padding:20px;margin:2px">
          <div class='col-sm-12'>
              <div class="form-row" style="background-color:#fff;padding:10px">
                      <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                      </div>      
                      <!-- Used to display form errors. -->
                      <div id="card-errors" role="alert" style="color:red"></div>
              </div>
		  </div> 
	   </div>
	   <div class="row">
            <div class="col-sm-6">
			<div class="paymentVender" style="margin-bottom: 20px;margin-left:0px;">
                    <ul style="display: flex;list-style: none;margin-left:0px;">
                      <li style="align-items: center;display: flex"><img src="{{asset('img/vender5.png')}}" alt=""
                          width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender6.png')}}" alt="" width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender1.png')}}" alt="" width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender2.png')}}" alt="" width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender3.png')}}" alt="" width="50px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender4.png')}}" alt="" width="80px"></li>
                    </ul>
                  </div>
               </div>

        </div>
        <div class="row" style="margin:4px"> 
            <div class='col-sm-12'>
                <input type="hidden"  name='currency' value=" {{$default->id}}">
                <p class="final">@lang('home_deposit.total') <span id="total"> </span> {{$default->code}}</p> 
			 <!--
			 <p class="final">@lang('home_deposit.comision') {{ $default->detailCurrency->comision_abono }}%: <span id="comision"></span>  {{$default->code}}</p> 
		  -->
			 <button type="submit"  id="xxx" class='btn btn-warning mibuttom pull-right'>@lang('home_deposit.bottondeposit')  {{$default->code}}</button>
            </div>  
        </div>
    </form>
   </div>
</div>	

	<script>
     var stripe = Stripe('{{  General::publicStripeKeys()}}');
	// Create an instance of Elements.
	
	var elements = stripe.elements({
	  locale: '{{ App::getLocale() }}',
	});
	
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
	var card = elements.create('card', {hidePostalCode: true,style: style});
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
	
	var form = document.getElementById('deposit');
	form.addEventListener('submit', function(event) {

	  event.preventDefault();

	    amount = $('input[name="monto"]').val()
	    currency = '{{ $default->code }}';
	    card_type= true;

	    calculateMinimum(amount,currency,card_type).then(()=>{
	        @if($default->secure=="1")
	        stripe.createToken(card).then(function(result) {
	          if (result.error) {
	            // Inform the user if there was an error.
	            var errorElement = document.getElementById('card-errors');
	            errorElement.textContent = result.error.message;
	          } else {
	            var data = {
	              '_token':$("#_token").val(),
	              'total':$("#totalD").val(),
	              'stripeToken':result.token.id,
	              'currency':'{{ $default->code }}',
	          }

	          var ajax = $.ajax({
	          url: "/paymentintenthome",
	          method: 'post',
	          data: data,
	          dataType: 'json',
	          });
	          ajax.done(function (data) {
	            if(data.error=="true"){
	              alert(data.type);
	              var errorElement = document.getElementById('card-errors');
	              errorElement.textContent = data.type;
	             // $(".spinner").fadeOut('fast');
	             // return;
	              }
	              var clientSecret=data.client_secret;
	              stripe.handleCardPayment(
	                        clientSecret,
	                        card
	                  ).then(function(result) {
	                      if (result.error) {
	                          alert(result.error.message);
	                      } else if (result.paymentIntent && result.paymentIntent.status === 'succeeded') {
	                        //stripeTokenHandler(result.paymentIntent.id);
	                       securePayment(clientSecret,result.paymentIntent.id);
	                  }

	                  });


	          });
	          ajax.fail(function () {


	          });


	            // Send the token to your server.
	            //stripeTokenHandler(result.token);
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
	            stripeTokenHandler(result.token.id);
	          }
	        });
	        @endif
	    })
	    .catch(dataMini => {
	        console.log("fallo");
	        console.log(dataMini);
	         swal({
	            text: "{{ __('home_buy.minimun', ['type' => 'CARD' ]) }}"+' ('+dataMini.limit+' USD)',
	            icon: "error",
	          });
	    });

	});
	
	// Submit the form with the token ID.
	/*
	var form = document.getElementById('deposit');
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
*/


// Submit the form with the token ID.
function stripeTokenHandler(token) {
    //alert(token);
        var form = document.getElementById('deposit');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token);
        form.appendChild(hiddenInput);
        form.submit();
        
}

function securePayment(secretx,resultx) {

        // Insert the token ID into the form so it gets submitted to the server
        var form =  document.getElementById('deposit');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', resultx);
/*
        var total = document.createElement('input');
        total.setAttribute('type', 'hidden');
        total.setAttribute('name', 'total');
	   total.setAttribute('value', totalx);
	   */

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
        //form.appendChild(total);
        form.appendChild(secure);
        form.appendChild(secret);
        form.appendChild(result);
        form.submit();
	   }
	   
     </script>