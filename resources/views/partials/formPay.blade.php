<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            Please create a free account first and log in to make a purchase. 
            <a class="link" href="/signup" style="    background: #4f8aff;
               color: white;
               padding: 5px 12px;
               border-radius: 9px;
               font-size: 15px;">SIGN UP</a>
            I already have an account
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="minandmax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <span class="txt-color-landing">Sorry, your operation cannot continue.</span>
            <ul class="ul p-0 m-0 mb-2 mt-2">
               <li class="d-block">
                  Minimum amount: <b>USD {{$limit_pay[0]->card_minimum}}</b> <span class="itemFiat">(232.22 <b id="fiatModal"></b>)</span>
               </li>
               <li class="d-block">
                  Maximum amount: <b> USD {{$limit_pay[0]->card_maximum}}</b>  <span class="itemFiat2">(9833.22 <b id="fiatmodal2"></b>)</span>
               </li>
            </ul>
            <span class="small">
            Please correct the amount and try again. Remember that you can make the purchase in multiple card payments if you need it or log in and use bank transfer for large amounts (+10,000 USD). Thanks for using Damecoins.
            </span>
         </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modalFailTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <span class="txt-color-landing">Transaction declined! </span>
            <ul class="ul p-0 m-0 mb-2 mt-2">
               <li class="d-block">
                 Money was not charged. Reason: Limited requests We recommend you to contact your bank or to try a different card. 
               </li>
               <li class="d-block">
                 Please be aware that for your security you only have a limited number of payment attempts per card per day￼. Input carefully.
               </li>
               
            </ul>
         </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
   </div>
</div>


<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="sweetAlert">
               <div class="icon success animate">
                  <span class="line tip animateSuccessTip"></span>
                  <span class="line long animateSuccessLong"></span>
                  <div class="placeholder"></div>
                  <div class="fix"></div>
               </div>
               <h2>Congratulations, your purchase is complete</h2>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="Problem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="icon error animateErrorIcon">
               <span class="x-mark animateXMark">
               <span class="line left"></span>
               <span class="line right"></span>
               </span>
            </div>
            <h2>There was a problem, try in a moment</h2>
         </div>
      </div>
   </div>
</div>
<div class="row d-none">
   <div class="col-md-12">
      <div class="form-row">
         <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px;padding: 0 25px;">
         @lang('index.paycard')
         </label>
      </div>
   </div>
</div>
<div class="col-md-12 pl-0 pr-0">
   <div class="form-crypto">
      <div class="card-body p-0">
         <div class="panel panel-default mt-2">
            <!-- action="{{route('payment-pay')}}" -->
            <!--<div class="w-100 pl-4 pr-4" id="paypal-button-container"></div>-->
            <input type="hidden" name="pricecurrency" id="pricecurrency" value="{{$panel['pagar']}}">
            <input type="hidden" name="min_limit" value="{{$limit_pay[0]->card_minimum}}">
            <input type="hidden" name="max_limit" value="{{$limit_pay[0]->card_maximum}}">
            <!-- onsubmit="onGetCardNonce(event)" -->
            <form
               action="{{route('payment-pay')}}"
               method="POST"
               id="paymentPay"
               role="form" >
               

               <div class="row sign">
                  <div class="col-12">
                     <h6 class="title-divider mb-2" style="padding:0;">
                        <span style="background:transparent;">@lang('index.paycard')</span>
                     </h6>
                  </div>
                  <div class='col-sm-6 formx mb-3'>
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
                        class="form-control mb-3 mb-md-0 mb-lg-0"
                        placeholder="@lang('index.form_lastname')"
                        required="required">
                  </div>
                  <!-- </div> <div class="row"> -->
                  <div class='col-sm-6 formx'>
                     <input
                        type="email"
                        value=""
                        id="emailx"
                        name="email"
                        class="form-control mb-3 mb-md-0 mb-lg-0"
                        required="required"
                        placeholder="@lang('index.form_email')">
                  </div>
                  <div class='col-sm-6 formx'>
                     {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                     'form-control', 'placeholder' => __('index.form_country') ,
                     'required'=>'required' ])!!}
                  </div>
                  <div class="row justify-content-center pt-2">
                     <div class="col-sm-12 col-12 p-25">
                        <small style="color:#20509e;">* @lang('index.form_email_text')</small>
                     </div>
                  </div>
               </div>
               <!--tarjeta-->
               <!--<div class="row p-25 d-none">
                  <div class="col-md-12 mb-3 mt-4">
                     <label for="validationCustomUsername" class="small text-muted m-0">@lang('index.card_type')</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text" style="background: #f5f7fb;
                              border: none">
                           <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
                           </span>
                        </div>
                        {!!Form::select('card_type', [ "VISA"=>"VISA", "MASTERCARD"=>"MASTERCARD",
                        "AMEX"=>"AMEX", "CABAL"=>"CABAL", "NARANJA"=>"NARANJA", "CENCOSUD"=>"CENCOSUD",
                        "SHOPPING"=>"SHOPPING", "ARGENCARD"=>"ARGENCARD"], ' ', [ 'id' => 'card_type',
                        'class' => 'form-control', 'required'=>'required' ])!!}
                     </div>
                  </div>
                  </div>-->
               <!--tarjeta-->
               <div class="row p-25">
                  <div class="col-md-6 mb-3 mt-4">
                     <label for="validationCustomUsername" class="small text-muted m-0">@lang('index.tarjeta')</label>
                     <div class="input-group d-flex">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="icon_Container">
                           <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
                           </span>
                        </div>
                        <div id="cc" class="w-custom-card"></div>
                     </div>
                  </div>
                  <div class="col-md-4 mt-4">
                    
                     <div class="d-flex justify-content-between">
                        <div class="w-50">
                           <label for="validationCustomUsername" class="small text-muted m-0">
                          @lang('index.fecha')</label>
                          <div id="sq-expiration-date" class="w-100"></div>
                        </div>
                        <div class="w-45">
                           <label for="validationCustomUsername" class="small text-muted m-0">
                          @lang('index.cvv')</label>
                          <div id="cv" class="w-100"></div>
                        </div>
                        
                        
                     </div>
                  </div>
                  <div class="col-md-2 mb-3 mt-4">
                     <label for="validationCustomUsername" class="small text-muted m-0">Postal code</label>
                     <div class="input-group">
                        
                        <div id="sq-postal-code" class="w-100"></div>
                     </div>
                  </div>
                  <div class="col-md-12 mt-2">
                     <button
                        class="btn btn-success btn-block mb-4 font-weight-bold"
                        id="confirm-purchase"  data-toggle="modal" data-target="#exampleModal">
                     @lang('index.paybottom')
                     {{ $getCriptodefault->code }}</button>
                     <div class="img-form mt-3 text-center">
                        <img class="img-fluid" src="/img/1-payment.png" alt="">
                        <img class="img-fluid" src="/img/2-payment.png" alt="">
                        <img class="img-fluid" src="/img/3-payment.png" alt="">
                        <img class="img-fluid" src="/img/4-payment.png" alt="">
                        <img class="img-fluid" src="/img/5-payment.png" alt="">
                        <img class="img-fluid" src="/img/6-payment.png" alt="">
                     </div>
                  </div>
               </div>
               <!--fecha de caducidad-->
               
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function GetCardType(number)
   {
       // visa
       var re = new RegExp("^4");
       if (number.match(re) != null)
           return "Visa";
   
       // Mastercard 
       // Updated for Mastercard 2017 BINs expansion
        if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number)) 
           return "Mastercard";
   
       // AMEX
       re = new RegExp("^3[47]");
       if (number.match(re) != null)
           return "AMEX";
   
       // Discover
       re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
       if (number.match(re) != null)
           return "Discover";
   
       // Diners
       re = new RegExp("^36");
       if (number.match(re) != null)
           return "Diners";
   
       // Diners - Carte Blanche
       re = new RegExp("^30[0-5]");
       if (number.match(re) != null)
           return "Diners - Carte Blanche";
   
       // JCB
       re = new RegExp("^35(2[89]|[3-8][0-9])");
       if (number.match(re) != null)
           return "JCB";
   
       // Visa Electron
       re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
       if (number.match(re) != null)
           return "Visa Electron";
   
       return "";
   }
</script>
<script>
   document
       .querySelector('#paymentPay')
       .addEventListener('submit', function (event) {
          event.preventDefault();
   
       });
   function checkDigit(event) {
       var code = (event.which)
           ? event.which
           : event.keyCode;
   
       if ((code < 48 || code > 57) && (code > 31)) {
           return false;
       }
   
       return true;
   }
   
   
   function calculateMinimumFasterx(currency, total) {
   
       return new Promise((resolve, reject) => {
           jQuery.ajaxSetup({
               headers: {
                   'X-CSRF-Token': "{{ csrf_token() }}"
               }
           });
           $
               .post("/calculate-minimun-faster", {
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
<script>
   function totalPay() {
   
   
    var currencyShow = $("#getCurrencies").val();
    var amount_radio = $("input[name='amount']:checked").val();
   
   
   
    if(currencyShow != 'USD'){
     $(".itemFiat").css('display', 'inline-block');
     $(".itemFiat2").css('display', 'inline-block');
    }
   
   
   
    if(amount_radio){
         console.log('aqui estoy ok');
        totalx = amount_radio;
    } else {
   
   
        if ($("input[type='radio'].person").is(':checked')) {
            //alert("si person");
            totalx = $("input[type='radio'].radioBtnClass:checked").val();
        } else {
            totalx = $("#persoCurrency").val();
            //console.log(totalx);
        }
   
       
    }
   
   return;
   
    if(currencyShow == 'COP' ||
        currencyShow == 'CLP' ||
        currencyShow == 'ARS' ||
        currencyShow == 'PEN' ||
        currencyShow == 'BOB' ||
        currencyShow == 'CRC' ||
        currencyShow == 'GTQ' ||
        currencyShow == 'HNL' ||
        currencyShow == 'NIO' ||
        currencyShow == 'PYG' ||
        currencyShow == 'DOP' ||
        currencyShow == 'UYU' ||
        currencyShow == 'CKK' ||
        currencyShow == 'IDR' ||
        currencyShow == 'ZAR' ||
        currencyShow == 'TRY' ||
        currencyShow == 'KRW' ||
        currencyShow == 'AED'){
   
        var privateCurrency = totalx;
   
         $.ajax({
             url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=${currencyShow}&to=USD&amount=${privateCurrency}`,   
             dataType: 'jsonp',
             success: function(data) {
                 console.log(data);
                 pricesInModal();
                 var usd_converter = data.result.toFixed(2);
   
                 if(usd_converter >= Number($("input[name='min_limit']").val()) &&
                   usd_converter <= Number($("input[name='max_limit']").val())){
                   if($(".block-pay").length){
                     $(".block-pay").remove();
                   }

                   $("#confirm-purchase").removeAttr('disabled');

                 } else {
   
                   if(!$("#paypal-button-container .block-pay").length){
   
   
                     if($("#paypal-button-container iframe").height() >= 200){
                       $("#paypal-button-container").append('<div class="block-pay height-pay"></div>');
                     } else {
                       $("#paypal-button-container").append('<div class="block-pay"></div>');
                     }
   
                     $("#minandmax").modal();
                     $("#confirm-purchase").attr('disabled', 'disabled');
   
                   }
                 }
   
                 $("#pricecurrency").val(data.result.toFixed(2));
             }
         }); 
   
   
     }else{
   
        var privateCurrency = totalx;
   
        $.ajax({
             url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=${currencyShow}&to=USD&amount=${privateCurrency}`,   
             dataType: 'jsonp',
             success: function(data) {
                 console.log(data);
                
                 var usd_converter = data.result;
                 var usd_converter_show = usd_converter;
   
                 pricesInModal();
   
                   setTimeout(() => {
   
   
   
   
                     if(usd_converter_show >= Number($("input[name='min_limit']").val())
                       && usd_converter_show <=  Number($("input[name='max_limit']").val())) {
                       
                       if($(".block-pay").length){
                         $(".block-pay").remove();
                       }
   
                       $("#pricecurrency").val(totalx);
                       $("#confirm-purchase").removeAttr('disabled');
   
                     } else {
                       if(!$("#paypal-button-container .block-pay").length){
   
                         if($("#paypal-button-container iframe").height() >= 200){
                           $("#paypal-button-container").append('<div class="block-pay height-pay"></div>');
                         } else {
                           $("#paypal-button-container").append('<div class="block-pay"></div>');
                         }
   
                         $("#minandmax").modal();
                         $("#confirm-purchase").attr('disabled', 'disabled');

                       }

                       $("#pricecurrency").val(data.result.toFixed(2));
   
                     }
   
                   }, 200);
   
                 
   
             }
         }); 
   
         
   
         
     }
   
   
     function pricesInModal(){
                   $.ajax({
                       url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=USD&to=${currencyShow}&amount=${Number($("input[name='min_limit']").val())}`,   
                           dataType: 'jsonp',
                           success: function(data) {
                              var _minium = data.result
                              var _minium_show = _minium.toFixed(0);
                              if(currencyShow != 'USD'){
                               $(".itemFiat").html(`(${_minium_show} ${currencyShow})`)
                              }
                           }
                       }); 
   
                     $.ajax({
                           url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=USD&to=${currencyShow}&amount=${Number($("input[name='max_limit']").val())}`,   
                           dataType: 'jsonp',
                           success: function(data) {
                              var _minium = data.result
                              var _minium_show = _minium.toFixed(0);
   
                              if(currencyShow != 'USD'){
                                 $(".itemFiat2").html(`(${_minium_show} ${currencyShow})`)
                              }
                           }
                       }); 
     }
   
   }
   
   totalPay();
   
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



          /*const verificationDetails = { 
            intent: 'CHARGE', 
            billingContact: {
              givenName: $("#namex").val(),
              familyName: $("#lastnamex").val()
            }
          };*/    

          const verificationDetails = { 
            intent: 'CHARGE', 
            amount: formatMoney($("#pricecurrency").val()), 
            currencyCode: 'USD', 
            billingContact: {
              givenName: $("#namex").val(),
              familyName: $("#lastnamex").val()
            }
          };    


         paymentForm.verifyBuyer(
             nonce, 
             verificationDetails, 
             function(err, verificationResult) {
              if (err == null) {
                console.log(verificationResult);
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
                    amount: formatMoney($("#pricecurrency").val())
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
                      name: $("#namex").val(),
                      lastname: $("#lastnamex").val(),
                      email: $("#emailx").val(),
                      amount: formatMoney($("#pricecurrency").val()),
                      country: $("#countryx").val(),
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

                    $("#success").modal('show');
                    
                  });
     
                })
                .catch(err => {
                    if(err.title){
                        $("#modalFailTransaction").modal('show');
                        $("#modalFailTransaction .txt-color-landing").text(err.title);
                        $("#modalFailTransaction ul").html('Please verify your card details well, remember that we limit daily purchase request attempts');
                       // console.log(JSON.parse(err.result));
                    } else {
                        $("#modalFailTransaction").modal('show');
                    }
                    
                    /*console.log('aquiiii mostraremos el error debajo de esta linea se mostrara el error');
                    console.log(err);*/
                  
                  //console.error(err);
                  //alert('Payment failed to complete!\nCheck browser developer console for more details');
                });

              }
        }); 



   
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
     paymentForm.requestCardNonce();
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
</script>