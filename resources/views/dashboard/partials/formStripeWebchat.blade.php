<form action="/processcomprax" method="post" id="payment-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
    <input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">

              <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px">
                            @lang('index.paycard')
                        </label>
                        <div id="card-element" style="margin:8px!important">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
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

     </div>
   

      <div class="row total">
          <div class="col-md-7" id="finalx">
                  <div class="col-md-12 mb-4" style="margin-bottom: 20px;">
                          <button class="btn btn-primary mibuttom pull-right" id="button-pay" 
                            style="" >
                              @lang('index.paybottom') {{ $getCriptodefault->code }}
                            </button>
                  </div>
               
          </div>
      </div>

    </form>

      <script>

var stripe = Stripe('{{  General::publicStripeKeys()}}');
        // Create an instance of Elements.
        
        var elements = stripe.elements({
          locale: '{{ App::getLocale() }}',
        });
        

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
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            amount = totalxx();
            currency = '{{ $getCurrencyUser->code }}';
            card_type = true;
            
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
              }else{
                calculateMinimum(amount,currency,card_type).then(()=>{

                  @if($getCurrencyUser->secure=="1")   
                   stripe.createToken(card).then(function(result) {
                      if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        $(".spinner").fadeOut('fast'); 
                      } 
                      else {
                        $(".spinner").fadeIn('fast'); 
                          var data = {
                              '_token':$("#_token").val(),
                              'total':totalxx(),
                              'stripeToken':result.token.id,
                              'currency':'{{ $getCurrencyUser->code }}',
                          }

                          var ajax = $.ajax({
                          url: "/paymentintenthome",
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
                                        card
                                  ).then(function(result) {
                                      if (result.error) {
                                          alert(result.error.message);
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
                .catch(dataMinimun => {
                    console.log("fallo");
                    console.log(dataMinimun);
                      swal({
                        text: "{{ __('home_buy.minimun', ['type' => 'CARD' ]) }}"+' ('+dataMinimun.limit+' USD)',
                        icon: "error",
                      }).then((value) => {
                        location.reload();
                      });
                });
              }//end secure off

        
        });
        

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
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
                var wallet = document.createElement('input');
                wallet.setAttribute('type', 'hidden');
                wallet.setAttribute('name', 'wallet');
                wallet.setAttribute('value', 'false');
                form.appendChild(hiddenInput);
                form.appendChild(total);
                form.appendChild(wallet);
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