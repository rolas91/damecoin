<style type="text/css">
   #cc, #sq-expiration-date, #cv,
   #sq-postal-code{
   background: white;
   }
   .sq-input--error{
   border: 1px solid #E02F2F!important;
   }
   .sq-input--focus{
   border: 1px solid #4A90E2;
   }
</style>
<script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
<form action="" method="post" id="payment-form" style="
    background: #dedede;
    padding: 1em;
    border: 1px solid #ecf0f5;
" onsubmit="onGetCardNonce(event)">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
    <input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">

              <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="contentCard col-md-6">
                           <div class="contentCard">
                              <label for="validationCustomUsername" class="small text-muted m-0">@lang('index.tarjeta')</label>
                              <div id="cc" class="w-custom-card" style="background: white;"></div>
                           </div>
                        </div>
                        <div class="contentCard col-md-6" style="display: flex;">
                           <div>
                              <label for="validationCustomUsername" class="small text-muted m-0">
                              @lang('index.fecha')</label>
                              <div id="sq-expiration-date" class="w-100"></div>
                           </div>
                           <div>
                              <label for="validationCustomUsername" class="small text-muted m-0">
                              @lang('index.cvv')</label>
                              <div id="cv" class="w-100"></div>
                           </div>
                           <div class="contentCard">
                              <label for="validationCustomUsername" class="small text-muted m-0">Postal code</label>
                              <div id="sq-postal-code" class="w-100"></div>
                           </div>
                        </div>
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




      <script type="text/javascript">
   // Create and initialize a payment form object
   const paymentForm = new SqPaymentForm({
     // Initialize the payment form elements
     
     //TODO: Replace with your sandbox application ID
     applicationId: "sq0idp-AFZo2JItZ8N9mO8iDJK3Gw",
     locationId: "LECCFVTG2RB0H",
     inputClass: 'sq-input',
     autoBuild: false,
     // Customize the CSS for SqPaymentForm iframe elements
     inputStyles: [{
         fontSize: '16px',
         lineHeight: '24px',
         padding: '16px',
         placeholderColor: '#a0a0a0',
         backgroundColor: 'transparent',
     }],
     // Initialize the credit card placeholders
     cardNumber: {
         elementId: 'cc',
         placeholder: 'Card Number'
     },
     cvv: {
         elementId: 'cv',
         placeholder: 'CVV'
     },
     expirationDate: {
         elementId: 'sq-expiration-date',
         placeholder: 'MM/YY'
     },
     postalCode: {
         elementId: 'sq-postal-code',
         placeholder: 'Postal'
     },
     // SqPaymentForm callback functions
     callbacks: {
         /*
         * callback function: cardNonceResponseReceived
         * Triggered when: SqPaymentForm completes a card nonce request
         */
         cardNonceResponseReceived: function (errors, nonce, cardData) {
         if (errors) {
             // Log errors from nonce generation to the browser developer console.
             console.error('Encountered errors:');
             errors.forEach(function (error) {
                 console.error('  ' + error.message);
             });
             alert('Please write the corresponding information well');
             return;
         }
   
         var currency_fiat = '{{ $getCurrencyUser->code }}';
         var amount_buy = totalxx();
         if(currency_fiat != 'USD'){
   
          $.ajax({
             url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=${currency_fiat}&to=USD&amount=${amount_buy}`,   
              dataType: 'jsonp',
              success: function(data) {

                    var monto_converter = Number(data.result);
                    console.log(monto_converter);

                    const verificationDetails = { 
                        intent: 'CHARGE', 
                        amount: formatMoney(totalxx()),
                        currencyCode: 'USD', 
                        billingContact: {
                          givenName: '{{Auth::user()->name}}',
                          familyName: '{{Auth::user()->lastname}}'
                        }
                    };

                    paymentForm.verifyBuyer(
                     nonce, 
                     verificationDetails, 
                     function(err, verificationResult) {
                      if (err == null) {
                        //TODO: Move existing Fetch API call here
           
                        fetch('https://damecoins.sunicoin.org/gateway/squareup/process', {
                          method: 'POST',
                          headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                          },
                          body: JSON.stringify({
                            nonce: nonce,
                            token: verificationResult.token,
                            amount: formatMoney(totalxx()),
                          })
                        })
                        .catch(err => {
                          //$("#modalFailTransaction").modal('show');
                          //alert('Too many failed transactions. Please try again tomorrow.');
                        })
                        .then(response => {
                          if (!response.ok) {
                            return response.json().then(errorInfo => Promise.reject(errorInfo)); //UPDATE HERE
                          }
                          return response.json(); //UPDATE HERE
                        })
                        .then(data => {
           
                          fetch('/payment-pay', {
                            method: 'POST',
                            headers: {
                              'Accept': 'application/json',
                              'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                              name: '{{Auth::user()->name}}',
                              lastname: '{{Auth::user()->lastname}}',
                              email: '{{Auth::user()->email}}',
                              amount: totalxx(),
                              country: '{{$getCurrencyUser->isoCountry}}',
                              idCurrency: '{{ $getCurrencyUser->id }}',
                              idCrypto: '{{ $getCriptodefault->id }}',
                              currency: '{{ $getCurrencyUser->code }}',
                              "_token": "{{ csrf_token() }}"
                            })
                          })
                          .catch(er => {
                          })
                          .then(resx => {
                            if (!resx.ok) {
                              return resx.json().then(errorInfo => Promise.reject(errorInfo)); //UPDATE HERE
                            }
                            return resx.json(); //UPDATE HERE
                          })
                          .then(show => {
           
                            alert('Congratulations, your purchase is complete');
           
                          });  
                        
             
                        })
                        .catch(err => {
                            if(err.title){
                                alert('Please verify your card details well, remember that we limit daily purchase request attempts')
                            } else {
                                alert('Please verify your card details well, remember that we limit daily purchase request attempts')
                            }
           
                            
                        });
           
                      }
                   });

              }
          }); 
   
   
         } else {
   
   
           const verificationDetails = { 
             intent: 'CHARGE', 
             amount: formatMoney(totalxx()), 
             currencyCode: 'USD', 
             billingContact: {
               givenName: '{{Auth::user()->name}}',
               familyName: '{{Auth::user()->lastname}}'
             }
           };   
   
           paymentForm.verifyBuyer(
             nonce, 
             verificationDetails, 
             function(err, verificationResult) {
              if (err == null) {
                //TODO: Move existing Fetch API call here
   
                fetch('https://damecoins.sunicoin.org/gateway/squareup/process', {
                  method: 'POST',
                  headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                    nonce: nonce,
                    token: verificationResult.token,
                    amount: formatMoney(totalxx()),
                  })
                })
                .catch(err => {
                  //$("#modalFailTransaction").modal('show');
                  //alert('Too many failed transactions. Please try again tomorrow.');
                })
                .then(response => {
                  if (!response.ok) {
                    return response.json().then(errorInfo => Promise.reject(errorInfo)); //UPDATE HERE
                  }
                  return response.json(); //UPDATE HERE
                })
                .then(data => {
   
                  fetch('/payment-pay', {
                    method: 'POST',
                    headers: {
                      'Accept': 'application/json',
                      'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                              name: '{{Auth::user()->name}}',
                              lastname: '{{Auth::user()->lastname}}',
                              email: '{{Auth::user()->email}}',
                              amount: totalxx(),
                              country: '{{$getCurrencyUser->isoCountry}}',
                              idCurrency: '{{ $getCurrencyUser->id }}',
                              idCrypto: '{{ $getCriptodefault->id }}',
                              currency: '{{ $getCurrencyUser->code }}',
                              "_token": "{{ csrf_token() }}"
                    })
                  })
                  .catch(er => {
                  })
                  .then(resx => {
                    if (!resx.ok) {
                      return resx.json().then(errorInfo => Promise.reject(errorInfo)); //UPDATE HERE
                    }
                    return resx.json(); //UPDATE HERE
                  })
                  .then(show => {
                      alert('Congratulations, your purchase is complete');
                  });  
                
                })
                .catch(err => {
                    if(err.title){
                        alert('Please verify your card details well, remember that we limit daily purchase request attempts')
                    } else {
                        alert('Please verify your card details well, remember that we limit daily purchase request attempts')
                    }
                    
                });
   
              }
           }); 


         }
   
   
   
   
        }
     }
   });
   
   
   
   // onGetCardNonce is triggered when the "Pay $1.00" button is clicked
   function onGetCardNonce(event) {
   
    /* if($("#namex").val() == ''){
       $("#namex").addClass('sq-input--error');
     }
   
     if($("#lastnamex").val() == ''){
       $("#lastnamex").addClass('sq-input--error');
     }
   
     if($("#emailx").val() == ''){
       $("#emailx").addClass('sq-input--error');
     }
   
     if($("#countryx").val() == ''){
       $("#countryx").addClass('sq-input--error');
     }*/
   
     // Don't submit the form until SqPaymentForm returns with a nonce
     event.preventDefault();
     // Request a nonce from the SqPaymentForm object
     //
     //alert(true);
    var amount = totalxx();
    var currency = '{{$getCurrencyUser->code}}';
    var card_type= true;
    calculateMinimumMoney(currency,amount,card_type).then((data)=>{
   
      paymentForm.requestCardNonce();
   
    }).catch(data => {
        swal({
          text: "{{ __('home_buy.minimun_faster', ['type' => 'CARD' ]) }}"+' ('+data.min+' USD)' + "{{ __('home_buy.maximo_faster') }}" + '('+data.max+' USD)',
          icon: "error",
        });
    });
   
   
   }
   
   paymentForm.build();
   //TODO: paste code from step 1.1.4
   
   function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   }
   
   
   function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
      decimalCount = Math.abs(decimalCount);
      decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
   
      const negativeSign = amount < 0 ? "-" : "";
   
      let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
      let j = (i.length > 3) ? i.length % 3 : 0;
   
      return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
      console.log(e)
    }
   };



   function calculateMinimumMoney(currency, total) {
   
       return new Promise((resolve, reject) => {
           jQuery.ajaxSetup({
               headers: {
                   'X-CSRF-Token': "{{ csrf_token() }}"
               }
           });
           $.post("/calculate-minimun-faster", {
                   "currency": currency,
                   "amount": total,
                   "card": true
               })
               .done(function (data) {
   
                   // console.log(data); alert("si");
                   if (data.data == 'false') {
                       reject(data);
   
                   }
                   resolve();
   
               });
   
       });
   }

</script>