<style>
    @media only screen and (max-width:362px){
       .content-text-btn
       {
          font-size: 15px!important;
       }
    }
 </style>
 
 <link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
 <style>
    .intl-tel-input {
       position: relative;
       display: block;
   }
 
   #card_type, #cc, #mm, #yy, #cv, #sq-expiration-date, #sq-postal-code {
     background: #d8d9dc!important
 }
 </style>
 
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
 
 
 {{-- Create Acc --}}
 <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">New Orden</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
             <div class="form-group">
                <label for="name">@lang('signup.name')</label>
                <input type="text" class="form-control" placeholder="@lang('signup.name')" name="name" id="name" value="{{ old('name') }}" required>
              </div>
  
              <div class="form-group">
                <label for="name">@lang('signup.lastName')</label>
                <input type="text" class="form-control" placeholder="@lang('signup.lastName')" name="lastname" id="lastname" value="{{ old('lastname') }}" required>
              </div>
  
              <div class="form-group">
                <label for="email">@lang('signup.email')</label>
                <input type="email" class="form-control" placeholder="@lang('signup.email')" name="email" id="email" value="{{ old('email') }}" required>
              </div>
  
              <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                <label for="email" class="col-md-12 control-label p-0">@lang('signup.country')</label>
                <div class="col-md-12 p-0">
                        {!!Form::select('country', $getCountry, '', [
                            'id' => 'getCountry',
                            'class' => 'form-control',
                            'placeholder' => __('signup.country'),
                            'required'=>'required'
                        ])!!}
                
                    @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>
             </div>
 
             <div style="color:red;"  id="msgError"></div>
   
          </div>
          <div class="modal-footer">
             <button type="submit" class="btn btn-green w-100 mb-3 mt-2" id="botom">
                @lang('index.btonComprar')
             </button>
         </div>
       </div>
    </div>
 </div>
 {{-- End Create Acc --}}
 
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
                <h2>Congratulations, your purchase is complete.
 
                   <br>
 
                   please verify your email, we will send you a password</h2>
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
             <input type="hidden" name="pricecurrency" id="pricecurrency" value="{{$panel['pagar']}}">
             <input type="hidden" name="min_limit" value="{{$limit_pay[0]->card_minimum}}">
             <input type="hidden" name="max_limit" value="{{$limit_pay[0]->card_maximum}}">
             <form
                method="POST"
                id="paymentPay"
                role="form" >
                
 
                <div class="row sign">
                   <div class="col-md-12 d-flex justify-content-start align-items-center flex-wrap">
                      <img class="mr-3" src="{{asset('assets/img/formSkrill/WeChat.png')}}" alt="">
                      <h5 class="font-weight-bold">@lang('index.pagoconWechat')</h5>
                      <small class="ml-auto font-size-xsmall"> <img src="{{asset('img/alert-circle.png')}}" alt="">  <span id="calculatorWechatUp">{{$result['minUsd']}}({{$result['min']}})</span></small>
                  </div>
 
                  <div class="col-md-12 mt-3">
                      <p class="mx-0 font-size-small">
                          @lang('index.TextGeneric1') 
                          <span id="minWechatP">{{$result['minUsd']}}({{$result['min']}})</span>
                         @lang('index.TextGeneric2') 
                      </p>
                      <p class="text-center font-weight-bold">Receiver's full name（收款人姓名）: 陈竞翔</p>
                  </div>
 
                  <div class="col-md-12 ">
                      <div>
                           <div class="card-pasos ">
                            <span class="icon line">1</span>
                            <div class="card-blue p-2" style="background: #22ab39;">
                               <p class=" font-size-normal m-0 color-black">@lang('index.enviar') <span class="h6 color-black" id="pay"></span> @lang('index.usd')</p>
                               <p class=" h6 m-0">
                                    <div>
                                        <img width="70%" src="{{asset('/methodpayQR/'.$result['imagen'])}}" alt="" id="wechatAccount">
                                     </div>
                               </p>
                            </div>
                        </div>
 
                        <div class="card-pasos mt-3">
                            <span class="icon">2</span>
                            <div class="container-email-2">
                               <div class="row">
                                  <div class="col-6">
                                      <h6>@lang('index.correoElectronico')</h6>
                                      <p class="font-size-small">@lang('index.sinAccount')
                                      <a class="font-size-small" href="#">@lang('index.register')</a> )</p>
                                  </div>
                                  <div class="col-6">
                                     <input type="text" class="form-control2" placeholder="Email" id="email2">
                                     <span style="color:red;" id='requireds'></span>
                                  </div>
                               </div>
                           </div>
                        </div>
                      </requiredsv>
                  </div>
                           
                  <div class="col-md-12 mt-3">
                      <p class="m-0">
                         @lang('index.verificamos')
                      </p>
                  </div>
 
                  <div class="col-md-12 mt-3">
                      <a href="javascript:void(0)" class="btn btn-block button-gradient-blue-large py-3 " id="botomShowModal">
                        @lang('index.confirmarPagoWechat')
                     </a>
                  </div>
 
                  <div class="col-md-12 mt-3">
                      <div class="d-flex justify-content-center align-items-center flex-wrap ">
 
                          <strong class="m-0 mr-2 color-succes h4 font-weight-bold contador" ></strong>
                          <small class="m-0 font-size-xsmall color-succes">@lang('index.quedan')</small>
 
                          <div class="progress progress-gradient ml-2">
                              <div class="progress-bar " role="progressbar"id="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
 
                      </div>
 
                      <p class="font-size-small text-muted text-center m-0 mt-2">
                         @lang('index.crypto')
                      </p>
 
                  </div>
                </div>
             </form>
             <div class="col-md-12 " style="border: 10px solid transparent;">
                <p style="border-bottom: 1px solid #3F7FBF;"><br></p>
             </div>
 
          </div>
       </div>
    </div>
 </div>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

 <script type="text/javascript">
 $(document).ready(function(){
        let scrAlipay = '{{$limit_pay[0]->qr_alipay}}'
        let scrWechat = '{{$limit_pay[0]->qr_wechat}}'

        console.log($("#container-qrs"))
        $("#container-qrs").append(`
          <img class="size_qr" src="/methodpayQR/qr_index_new.jpg" data-toggle="modal" data-target="#QrPayPaymentModal" />
          <img class="size_qr" src="/methodpayQR/${scrWechat}" data-toggle="modal" data-target="#WechatPayPaymentModal" onclick="newWechatpay()"/>
          <img class="size_qr" src="/methodpayQR/${scrAlipay}" data-toggle="modal" data-target="#AlipayPaymentModal" onclick="newAlipay()"/>
        `)
    })
 
 var Time = 15 * 60; // 900s // 15 Minutos
 var progressBar = Time;
 
 setInterval(() => {
    
       if(Time == 0) {
 
          // bloked();
          return false;
       };
       
       --Time;
       var sec, min, hour;
 
       if(Time<3600){
          var a = Math.floor(Time/60); //minutes
          var b = Time%60; //Time
 
          min = a < 10 ? `0${a}`: a;
 
          sec = b < 10 ? `0${b}`: b;
 
          $('.contador').html(`00:${min}:${sec}`);
       }
 
       var cont = parseInt((Time * 100) / progressBar);
 
       $('#progressbar').width(`${cont}%`);
 
    }, 1000);
 
    $('#botomShowModal').click(() => {
       let email = $('#email2').val();
 
       if(email == '' || email == null)
       {
          $('#email2').css({"border": "1px solid red"})
 
          $('#requireds').html('Required');
 
          setTimeout(() => {
             $('#email2').css('');
             $('#requireds').html('');
          }, 5000);
          
          return false;
       }else{
          $('#email').val(email);
          $("#createModal").modal("show");
       }
    });
    $('#botom').click(() => {
       let email = $('#email').val();
       let name = $('#name').val();
       let lastname = $('#lastname').val();
       let getCountry = $('#getCountry').val();
 
       if(email == null || email == '' || name == null || name == '' || lastname == null || lastname == '' || getCountry == null || getCountry == '') return false;
 
       var totalx = totalPay();
       var formData = new FormData();
       formData.append('email',email);
       formData.append('surname',lastname);
       formData.append('country',getCountry);
       formData.append('name',name);
       formData.append('amount',totalx);
       formData.append("idCurrency", '{{ $getCurrencyUser->id }}');
       formData.append("idCrypto", '{{ $getCriptodefault->id }}',);
       formData.append( "currency", '{{ $getCurrencyUser->code }}');
       formData.append("_token", "{{ csrf_token() }}");
       formData.append( "method", '{{ $metodo }}');
 
       let url = "{{ url('/registerForm') }}";
 
       $.ajax({
          url: url,
          type: 'post',
          data: formData,
          dataType: 'JSON',
          contentType: false,
          processData: false,
          success: function(res) {
             if(res.status == 1)
             {
                // Cierra modal
             $("#createModal").modal("hide");
                
                //Activa modal
                $("#success").modal("show");
 
                //Limpia Campos
                $('#email2').val('');
                $('#email').val('');
                $('#name').val('');
                $('#lastname').val('');
                $('#getCountry').val('');
                
                setTimeout(() => {
                   //Redireccion
                   window.location.href = '/login';
                }, 10000);
             }else{
                $("#problem").modal("show");
                $("#createModal").modal("hide");
             }
          }
       });
    });
 
 
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
       var totalx = null;
       if ($("input[type='radio'].person").is(':checked')) {
          totalx= $("input[type='radio'].radioBtnClass:checked").val();
       } else {
          totalx = $("#persoCurrency").val();
       }
       return totalx;
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