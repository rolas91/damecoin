<style>
     .test{
         display: none;        
     }
 </style>
 

 
 
 <div class="row">
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
                 <div class="panel panel-default mt-1"  >
                  <form
                  style=""
                      action="{{route('payment-pay')}}"
                      method="POST"
                      id="paymentPayFlutter"
                      role="form" class="p-25 m-4">
                      <div class="row sign">
                              <div class='col-sm-6 formx mb-3'>
                                 <input
                                  type="text"
                                  value=""
                                  data-recurly="first_name"
                                  name="name"
                                  id="namex"
                                  class="form-control  mb-3 mb-md-0 mb-lg-0"
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
                                      class="form-control  mb-3 mb-md-0 mb-lg-0"
                                      placeholder="@lang('index.form_lastname')"
                                      required="required">
                             </div>
                                  <!-- </div> <div class="row"> -->
                             
 
                             <div class='col-sm-6 formx mb-3'>
                                 <input
                                     type="email"
                                     value=""
                                     id="emailx"
                                     name="email"
                                     class="form-control  mb-3 mb-md-0 mb-lg-0"
                                     required="required"
                                               placeholder="@lang('index.form_email')">
                            </div>

                            <div class='col-sm-6 formx'>
 
                                <input
                                type="text"
                                value=""
                                id="ciudad"
                                name="ciudad"
                                class="form-control  mb-3 mb-md-0 mb-lg-0"
                                required="required"
                                          placeholder="@lang('index.form_ciudad')">

                                   
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
 
                             <div class='col-sm-6 formx'>
                                     {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                                     'form-control mb-3 mb-md-0 mb-lg-0', 'placeholder' => __('index.form_country') ,
                                      'required'=>'required' ])!!}               
                             </div>
 
                                          
  
                              <div class="row justify-content-center pt-2">
                                   <div class="col-sm-12">
                                        <small style="color:#20509e;">*	@lang('index.form_email_text')</small><br>
 
                                        <small style="color:#20509e;">* 	@lang('index.form_veridi_info')</small>
                                   </div>	
                              </div>
  
                          </div>
                                     
  
                                  <div class="row justify-content-center p-2">
                                      <div class="align-self-center">
                                          <img
                                              class="img-responsive"
                                              style="height:50px"
                                              src="{{asset('img/kindpng.png')}}">
                                      </div>
                                   </div>
  
                                      <!--tarjeta-->
                                      <!--
                                      <div class="row m-2">
                                          <div class="col-md-12 mb-1">
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
                                   -->
  
                                                      <div class="row m-2">
                                                          <div class="col-md-12 mt-1">
                                                              <button
                                                                  class="btn btn-success btn-block mb-1 font-weight-bold"
                                                                  id="confirm-purchase">
                                                                  @lang('index.paybottom', ['cripto' => $getCriptodefault->code])
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
          .querySelector('#paymentPayFlutter')
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
               var totalx = totalPayF();

               currency = "{{ $getCurrencyUser->code }}";
               calculateMinimumFasterx(currency, totalx)
                 .then(() => {
                     var data = {
                         'total': totalx,
                         'country': $("#countryx").val(),
                         'name': $("#namex").val(),
                         'lastname': $("#lastnamex").val(),
                        // 'dni': $("#dni").val(),
                         'ciudad': $("#ciudad").val(),
                        // 'direccion': $("#direccion").val(),
                         'phone': numberPhone,
                         'dir':"{{ $dir ? $dir : 'index' }}",
                        // 'postal': $("#postal").val(),
                         'idCurrency': '{{ $getCurrencyUser->id }}',
                         'idCrypto': '{{ $getCriptodefault->id }}',
                         'currency': '{{ $getCurrencyUser->code }}',
                         'email': $("#emailx").val(),
                         "_token": "{{ csrf_token() }}"
                     }
 
 
                     var ajax = $.ajax(
                         {url: "/api/paymentshare", method: 'post', data: data, dataType: 'json'}
                     );
                     ajax.done(function (data) {

                          if (data.error == "true") {
                              swal({text: data.code, icon: "error"});
                          }
                          if (data.success == "true") {
                              window.location.href = data.url;
                          }
                          if (data.success == "false") {
                            swal({text: data.code, icon: "error"});
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
 
      function totalPayF() {
          var totalxx;
         if ($("input[type='radio'].person").is(':checked')) {
             totalxx= $("input[type='radio'].radioBtnClass:checked").val();
         } else {
              totalxx = $("#persoCurrency").val();
         }
         return totalxx;
     }
 
      function calculateMinimumFasterx(currency, total) {
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