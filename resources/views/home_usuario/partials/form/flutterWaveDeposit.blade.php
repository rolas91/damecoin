
 <link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
 <style>
    .intl-tel-input {
       position: relative;
      display: block!important;*/
   }
   .margin-info{
	   margin-top:3px;
	   margin-bottom: 3px;
   }
   .iti-flag{
	
   }
   .country-list{
	   z-index:999!important;
   }

 </style>
 <div class="row">
      <div class="col-md-8">
          <div class="form-row">
                <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px;padding: 0 25px;">
                          @lang('index.paycard')
                </label>
  
          </div>
      </div>
  </div>
  
  <div class="col-md-8 pl-0 pr-0">
           <div class="form-crypto">
              <div class="card-body p-0">
                 <div class="panel panel-default mt-1" >
                  <form style="margin:2px;padding:5px"
                      action="{{route('payment-pay')}}"
                      method="POST"
                      id="paymentPayx"
                      role="form">
                      <div class="row" style="background-color:#ccc;padding:20px;margin:5px">
                         <div class='col-sm-10'>
                           <div class="input-group">
                             <input id="totalD" class='form-control' type="number" name='monto' required
                               autocomplete="off">
                             {{--    <span class="input-group-addon" style="background-color:#367fa9;color:#fff;font-weight:bold"><i class="glyphicon">{{$default->code}}</i></span>
                             --}}
                             <div class="input-group-prepend">
                               <div class="input-group-text color-input">{{$default->code}}</div>
                             </div>
                           </div>
                         </div>
                       </div>
                      
 
                       <div class="row sign">   
 
                            <div class='col-sm-12 formx mb-3'>
                             <input
                                 type="text"
                                 value=""
                                 id="direccion"
                                 name="direccion"
                                 class="form-control  mb-3 mb-md-0 mb-lg-0"
                                 required="required"
                                           placeholder="@lang('index.form_direccion')">
                            </div>
 
                              
                                                    
                              <div class='col-sm-6 formx'>
                                   <!--
                                     <input type="tel" id="phone" class="form-control  mb-3 mb-md-0 mb-lg-0"  placeholder="@lang('index.form_phone')">
                                   -->
                                     <input
                                     type="tel"
                                     value=""
                                     id="phone"
                                     name="phone"
                                     class="form-control  mb-3 mb-md-0 mb-lg-0"
                                     required="required"
                                               placeholder="@lang('index.form_phone')">   
                                
                            </div>
                       </div>   

                         <div class="row justify-content-center ">
                              <div class="col-sm-12">

                                   <small style="color:#20509e;">* 	@lang('index.form_veridi_info')</small>
                              </div>	
                         </div>
                        
                             <!--        
                         <div class="row justify-content-center ">
                            <div class="col-sm-12">
                                <img
                                    class="img-responsive"
                                    style="height:50px"
                                    src="{{asset('img/kindpng.png')}}">
                            </div>
                         </div>
                    -->
  
                                                  <div class="row m-2">
                                                      
                                                      </div>
  
                                                      <div class="row m-2">
                                                          <div class="col-md-12 mt-1">
                                                              <button
                                                                  class="btn btn-success btn-block mb-1 font-weight-bold"
                                                                  id="confirm-purchase">
                                                                  @lang('home_deposit.payment-tarjta',["cripto"=>$default->code])
                                                                 
                                                                 {{-- @lang('index.paybottom')
                                                                  {{ $getCriptodefault->code }}
                                                                --}}
                                                                </button> 
                                                                  <br>
                                                                  @if(General::flutterConvertDefault())
                                                                  <p class="text-green text-center">
                                                                   {{ General::flutterMensaje() }}
                                                                   </p>
                                                                @endif
                                                          </div>
                                                          <div class="img-form mt-3 text-center">
                                                                 <img class="img-fluid" src="/img/1-payment.png" alt="">
                                                                 <img class="img-fluid" src="/img/2-payment.png" alt="">
                                                                 <img class="img-fluid" src="/img/3-payment.png" alt="">
                                                                 <img class="img-fluid" src="/img/4-payment.png" alt="">
                                                                 <img class="img-fluid" src="/img/5-payment.png" alt="">
                                                                 <img class="img-fluid" src="/img/6-payment.png" alt="">
                                                              </div>
                                                      </div>

                         
                  </form>
                 </div>
          </div>
      </div>
  </div>
  <script src="{{ asset('tel/intlTelInput.js') }}" ></script>
  <script>
      var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
    var input = document.querySelector("#phone");
    var iti= window.intlTelInput(input, {
      // any initialisation options go here
      utilsScript: "{{ asset('tel/utils.js') }}"
    });
  </script>
  <script>
      document
          .querySelector('#paymentPayx')
          .addEventListener('submit', function (event) {
               event.preventDefault();
              //validando phone
               if (input.value.trim()) {
                 if (iti.isValidNumber()) {
                  var numberPhone = iti.getNumber();
 
 
                 } else {
 
                   var errorCode = iti.getValidationError();
                   var x=errorMap[errorCode];
                   swal({text: "{{ __('index.form_phone') }}" + ":"+x, icon: "error"}); 
                   return;
 
                 }
               }else{
 
                   swal({text: "Invalid " + "{{ __('index.form_phone') }}", icon: "error"});
                   return;
               }
               //endvalid phone

               var totalx = $('input[name="monto"]').val();

               currency = "{{ $getCurrencyUser->code }}";
               calculateMinimumFaster(currency, totalx)
                 .then(() => {
                     var data = {
                         'total': totalx,
                         'country': $("#countryx").val(),
                         //'dni': $("#dni").val(),
                         'ciudad': $("#ciudad").val(),
                         'direccion': $("#direccion").val(),
                         'phone': numberPhone,
                         'dir':"deposit",
                        // 'postal': $("#postal").val(),
                         'idCurrency': '{{ $getCurrencyUser->id }}',
                         'idCrypto': '{{ $default->id }}',
                         'currency': '{{ $getCurrencyUser->code }}',
                        
                         "_token": "{{ csrf_token() }}"
                     }
 
 
                     var ajax = $.ajax(
                         {url: "/paymentsharebuy", method: 'post', data: data, dataType: 'json'}
                     );
                     ajax.done(function (data) {
                         if (data.error == "true") {
                              swal({text: data.code, icon: "error"});
                          }

                          if (data.success == "false") {
                              swal({text: data.code, icon: "error"});
                          }
                          if (data.success == "true") {
                              window.location.href = data.url;
                          }
                          
                      })
                      ajax.fail(function (err) {
                          console.log(err);
                          if (err.status == 422) { // when status code is 422, it's a validation issue
                              //console.log(err.responseJSON);
                               swal({text: "{{ __('index.form_error')}}", icon: "error"});
                           }
                       });
                   })
                   .catch(data => {
                      swal({
                       text: "{{ __('home_buy.minimun_faster') }}"+ data.min +". "+ "{{ __('home_buy.maximo_faster') }}" +data.max ,
                         icon: "error",
                      });
                   });
          });
          
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
      function checkDigit(event) {
          var code = (event.which)
              ? event.which
              : event.keyCode;
          if ((code < 48 || code > 57) && (code > 31)) {
              return false;
          }
          return true;
      }
 /*
      function totalPayF() {
          var totalxx;
         if ($("input[type='radio'].person").is(':checked')) {
             totalxx= $("input[type='radio'].person:checked").val();
         } else {
              totalxx = $("#persoCurrency").val();
         }
         return totalxx;
     }*/

     function totalPayF(){
        if ($("input[type='radio'].person").is(':checked')){
            //alert("si person");
            totalx = $("#persoCurrency").val();
        }else{
            totalx = $("input[type='radio'].radioBtnClass:checked").val();
            //console.log(totalx);
        }
       return totalx;
    }
 
      function calculateMinimumFaster(currency, total) {
          return new Promise((resolve, reject) => {
              jQuery.ajaxSetup({
                  headers: {
                      'X-CSRF-Token': "{{ csrf_token() }}"
                  }
              });
              $
                  .post("/calculate-minimun-flutter", {
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