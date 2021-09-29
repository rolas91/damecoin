<style>
    .test{
        display: none;        
    }
</style>

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
             <a href="/login">I already have an account</a>
          </div>
       </div>
    </div>
 </div>


<div class="row">
     <div class="col-md-12">
         <div class="form-row">
               <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px;padding: 0 25px;">
                         @lang('index.paycard')
               </label>
 
         </div>
     </div>
 </div>
 <!--
 http://localhost:8000/flutewave?status=successful&tx_ref=bitethtx-019203&transaction_id=1772869
-->
 <div class="col-md-12 pl-0 pr-0">

        {{-- <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
            <input type="hidden" name="public_key" value="FLWPUBK_TEST-SANDBOXDEMOKEY-X" />
            <input type="hidden" name="customer[email]" value="houltman@gmail.com" />
            <input type="hidden" name="customer[phone_number]" value="0900192039940" />
            <input type="hidden" name="customer[name]" value="Jesse Pinkman" />
            <input type="hidden" name="tx_ref" value="bitethtx-019203" />
            <input type="hidden" name="amount" value="34" />
            <input type="hidden" name="currency" value="USD" />
            <input type="hidden" name="meta[token]" value="54" />
            <input type="hidden" name="redirect_url" value="http://localhost:8000/flutewave" />
            
            <button type="submit">CHECKOUT</button> 
          </form> --}}
          <div class="form-crypto" style="">
             <div class="card-body p-0">
                <div class="panel panel-default mt-1" >
                 <form
                     action="{{route('payment-pay')}}"
                     method="POST"
                     id="paymentPay"
                     role="form">
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
                             <div class='col-sm-6 formx mb-3' style="display:none">
                                     <input
                                         type="text"
                                         value=""
                                         id="dni"
                                         name="dni"
                                         class="form-control  mb-3 mb-md-0 mb-lg-0"
                                         required="required"
                                                   placeholder="@lang('index.form_identificacion')">
                            </div>

                            <div class='col-sm-6 formx'>
                                <input
                                    type="email"
                                    value=""
                                    id="emailx"
                                    name="email"
                                    class="form-control  mb-3 mb-md-0 mb-lg-0"
                                    required="required"
                                              placeholder="@lang('index.form_email')">
                           </div>

                           <div class='col-sm-12 formx mb-3' style="display:none">
                            <input
                                type="text"
                                value=""
                                id="direccion"
                                name="direccion"
                                class="form-control  mb-3 mb-md-0 mb-lg-0"
                                required="required"
                                          placeholder="@lang('index.form_direccion')">
                           </div>

                             <div class='col-sm-6 formx mb-3'>
                                    <input
                                    type="text"
                                    value=""
                                    id="postal"
                                    name="postal"
                                    class="form-control  mb-3 mb-md-0 mb-lg-0"
                                    required="required"
                                              placeholder="@lang('index.form_postal')">
                                   
                            
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

                             <div class='col-sm-6 formx' style="display:none">
                                    <input type="tel" id="phone" class="form-control  mb-3 mb-md-0 mb-lg-0"  placeholder="@lang('index.form_phone')">
                                    <!--
                                    <input
                                    type="tel"
                                    value=""
                                    id="phone"
                                    name="phone"
                                    class="form-control  mb-3 mb-md-0 mb-lg-0"
                                    required="required"
                                              placeholder="@lang('index.form_phone')">   
                             -->     
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
                                     <div class="row m-2" style="display:none">
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
 
                                     <!--tarjeta-->
                                     <div class="row m-2">
                                         <div class="col-md-12 mb-1">
                                             <label for="validationCustomUsername">@lang('index.tarjeta')</label>
                                             <div class="input-group">
                                                 <div class="input-group-prepend">
                                                     <span class="input-group-text" id="">
                                                         <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
                                                     </span>
                                                 </div>
                                                 <input
                                                     onkeypress="return checkDigit(event)"
                                                     maxlength="19"
                                                     type="text"
                                                     class="form-control"
                                                     id="cc"
                                                     placeholder="41111-1111-1111-1111"
                                                     required="required"></div>
                                             </div>
                                         </div>
                                         <!--fecha de caducidad-->
                                         <div class="row m-2">
                                             <div class="col-md-12 mb-1">
                                                 <label for="validationCustomUsername">@lang('index.fecha')</label>
                                                 <div class="row">
                                                     <div class="input-group col-6" >
                                                         <div class="input-group-prepend">
                                                             <span class="input-group-text" id="">
                                                                 <i class="fa fa-calendar-o" style="color:rgb(6, 88, 118)"></i>
                                                             </span>
                                                         </div>
                                                         <input
                                                             onkeypress="return checkDigit(event)"
                                                             name="code_expire_month"
                                                             required="required"
                                                             id="mm"
                                                             value=""
                                                             type="tel"
                                                             pattern="[0-9]*"
                                                             spellcheck="false"
                                                             autocapitalize="none"
                                                             autocorrect="off"
                                                             class="form-control valid"
                                                             placeholder="Month(MM)"
                                                             title="Month(MM)"
                                                             maxlength="2"
                                                             aria-required="true"
                                                             autocomplete="cc-exp-month"
                                                             style="border-radius: 4px;padding-left: 35px;font-size: 14px;"
                                                             aria-invalid="false"></div>
 
                                                         <div class="input-group col-6">
                                                             <div class="input-group-prepend">
                                                                 <span class="input-group-text" id="">
                                                                     <i class="fa fa-calendar" style="color:rgb(6, 88, 118)"></i>
                                                                 </span>
                                                             </div>
                                                             <input
                                                                 onkeypress="return checkDigit(event)"
                                                                 name="code_expire_year"
                                                                 required="required"
                                                                 id="yy"
                                                                 value=""
                                                                 type="tel"
                                                                 pattern="[0-9]*"
                                                                 spellcheck="false"
                                                                 autocapitalize="none"
                                                                 autocorrect="off"
                                                                 class="form-control"
                                                                 placeholder="Year(AA)"
                                                                 title="Year(AA)"
                                                                 maxlength="2"
                                                                 aria-required="true"
                                                                 autocomplete="cc-exp-year"
                                                                 style="border-radius: 4px;padding-left: 35px;font-size: 	14px;"></div>
                                                         </div>
                                                     </div>
                                                 </div>
 
                                                 <div class="row m-2">
                                                     <div class="col-md-12 mb-1">
                                                         <label for="validationCustomUsername">@lang('index.cvv')</label>
                                                         <div class="input-group">
                                                             <div class="input-group-prepend">
                                                                 <span class="input-group-text" id="">
                                                                     <i class="fa fa-lock" style="color:rgb(6, 88, 118)"></i>
                                                                 </span>
                                                             </div>
                                                             <input
                                                                 onkeypress="return checkDigit(event)"
                                                                 type="text"
                                                                 class="form-control"
                                                                 id="cv"
                                                                 value=""
                                                                 name="cvv"
                                                                 placeholder="CVV"
                                                                 style=""
                                                                 maxlength="4"
                                                                 required="required"
                                                                 aria-required="true"></div>
                                                         </div>
                                                     </div>
 
                                                     <div class="row m-2">
                                                         <div class="col-md-12 mt-1">
                                                             
                                                             <a href="javascript:void(0)" class="btn btn-success btn-block mb-1 font-weight-bold" data-toggle="modal" data-target="#exampleModal">
                                                                @lang('index.paybottom')
                                                             </a>
                                                            <!--
                                                             <button
                                                                 class="btn btn-success btn-block mb-1 font-weight-bold"
                                                                 id="confirm-purchase">
                                                                 @lang('index.paybottom')
                                                                 {{ $getCriptodefault->code }}</button> 
                                                            -->
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
            {{-- Botones nuevos  --}}
            {{-- START Quitar Display:none --}}
                <div id="quitarClass" class="mb-4 test">
                    @include('partials.bootonPayU')
                </div>
            {{-- END --}}
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
         .querySelector('#paymentPay')
         .addEventListener('submit', function (event) {
            //  event.preventDefault();
            // //validando phone
            //  if (input.value.trim()) {
            //    if (iti.isValidNumber()) {
            //     var numberPhone = iti.getNumber();


            //    } else {

            //      var errorCode = iti.getValidationError();
            //      var x=errorMap[errorCode];
            //      swal({text: "{{ __('index.form_phone') }}" + ":"+x, icon: "error"}); 
            //      return;

            //    }
            //  }else{

            //      swal({text: "Invalid " + "{{ __('index.form_phone') }}", icon: "error"});
            //      return;
            //  }
            //  //endvalid phone
            //  var totalx = totalPay();
            //  currency = "{{ $getCurrencyUser->code }}";
            //  calculateMinimumFasterx(currency, totalx)
                //  .then(() => {
                //      var data = {
                //          'total': totalx,
                //          'cv': $("#cv").val(),
                //          'mm': $("#mm").val(),
                //          'yy': $("#yy").val(),
                //          'cc': $("#cc").val(),
                //          'card_type': $("#card_type").val(),
                //          'country': $("#countryx").val(),
                //          'name': $("#namex").val(),
                //          'lastname': $("#lastnamex").val(),
                //          'dni': $("#dni").val(),
                //          'ciudad': $("#ciudad").val(),
                //          'direccion': $("#direccion").val(),
                //          'phone': numberPhone,
                //          'postal': $("#postal").val(),
                //          'idCurrency': '{{ $getCurrencyUser->id }}',
                //          'idCrypto': '{{ $getCriptodefault->id }}',
                //          'currency': '{{ $getCurrencyUser->code }}',
                //          'email': $("#emailx").val(),
                //          "_token": "{{ csrf_token() }}"
                //      }

                //      var ajax = $.ajax(
                //          {url: "/payment-pay", method: 'post', data: data, dataType: 'json'}
                //      );
                //      ajax.done(function (data) {
                         //console.log(data); console.log(data);
                    //      if (data.error == "true") {
                    //          swal({text: data.code, icon: "error"});
                    //      }
                    //      if (data.success == "true") {
                    //          window.location.href = "https://damecoins.com/login";
                    //      }
                    //      if (data.success == false) {}
                    //  })
                    //  ajax.fail(function (err) {
                    //      console.log(err);
                    //      if (err.status == 422) { // when status code is 422, it's a validation issue
                             //console.log(err.responseJSON);
                            //  swal({text: "{{ __('index.form_error')}}", icon: "error"});
                             // $('#success_message').fadeIn().html(err.responseJSON.message); you can loop
                             // through the errors object and show it to the user
                            //  console.warn(err.responseJSON.errors);
                             // display errors on each form field
                            //  var errx = "";
                        //  }
                    //  });
                //  })
                //  .catch(data => {
                //     swal({
                //      text: "{{ __('home_buy.minimun_faster') }}"+ data.min +". "+ "{{ __('home_buy.maximo_faster') }}" +data.max ,
  	            //     icon: "error",
	            //    });
                //  });
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

     function totalPay() {
         if ($("input[type='radio'].person").is(':checked')) {
             totalx= $("input[type='radio'].radioBtnClass:checked").val();
         } else {
              totalx = $("#persoCurrency").val();
         }
         return totalx;
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