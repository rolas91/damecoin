   <div class="col-md-12">
          <div class="card form-crypto">
            <div class="card-body">
              <div class="panel panel-info mt-2" style="border:solid 1px #ccc">
                <form action="{{route('payment-pay-buy')}}" method="POST"  id="paymentPayHome" role="form" style="padding:25px">									
					<div class="d-flex justify-content-center">
                        <div class="align-self-center">
                        <img class="img-responsive" style="height:50px" src="{{asset('img/kindpng.png')}}">
                        </div>
                     </div>
									
							<!--tarjeta-->
					<div class="row">
						<div class="col-md-12 mb-3">
					    	<label for="validationCustomUsername">@lang('index.card_type')</label>
					    	<div class="input-group">
					    	   <div class="input-group-prepend">
					    	     <span class="input-group-text" id="">
								  <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
								</span>
					    	   </div>
					    	   {!!Form::select('card_type', [
							   "VISA"=>"VISA",
							   "MASTERCARD"=>"MASTERCARD",
							   "AMEX"=>"AMEX",
							   "CABAL"=>"CABAL",
							   "NARANJA"=>"NARANJA",
							   "CENCOSUD"=>"CENCOSUD",
							   "SHOPPING"=>"SHOPPING",
							   "ARGENCARD"=>"ARGENCARD"], ' ', [
                                'id' => 'card_type',
                                'class' => 'form-control',
								'required'=>'required'
                            ])!!}
					    	</div>
					    </div>
					</div>

					<!--tarjeta-->
					<div class="row">
						<div class="col-md-12 mb-3">
					    	<label for="validationCustomUsername">@lang('index.tarjeta')</label>
					    	<div class="input-group">
					    	   <div class="input-group-prepend">
					    	     <span class="input-group-text" id="">
								  <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
								</span>
					    	   </div>
					    	   <input onkeypress="return checkDigit(event)" maxlength="19" type="text" class="form-control" id="cc" placeholder="41111-1111-1111-1111" required>
					    	   
					    	</div>
					    </div>
					</div>
							<!--fecha de caducidad-->
					<div class="row">

						<div class="col-md-12 mb-3">
					    	<label for="validationCustomUsername">@lang('index.fecha')</label>
								<div class="d-flex">

									<div class="input-group col-md-6">
					    			   <div class="input-group-prepend">
					    			     <span class="input-group-text" id="">
										 <i class="fa fa-calendar-o" style="color:rgb(6, 88, 118)"></i>
										</span>
					    			   </div>
									   <input onkeypress="return checkDigit(event)" name="code_expire_month" required id="mm" value="" type="tel" pattern="[0-9]*" spellcheck="false" autocapitalize="none" autocorrect="off" class="form-control valid" placeholder="Mes(MM)" title="Month(MM)" maxlength="2" aria-required="true" autocomplete="cc-exp-month" style="border-radius: 4px;padding-left: 35px;font-size: 14px;" aria-invalid="false">
					    			</div>

									<div class="input-group col-md-6">
										<div class="input-group-prepend">
					    				     <span class="input-group-text" id="">
											 <i class="fa fa-calendar" style="color:rgb(6, 88, 118)"></i>
											</span>
					    				   </div>
										<input onkeypress="return checkDigit(event)"name="code_expire_year" required id="yy" value="" type="tel" pattern="[0-9]*" 	spellcheck="false" autocapitalize="none" autocorrect="off" class="form-control" 	placeholder="Year(AA)" title="Year(AA)" maxlength="2" aria-required="true" 	autocomplete="cc-exp-year" style="border-radius: 4px;padding-left: 35px;font-size: 	14px;">
									</div>
                                 </div>
					    </div>
					</div>

					<div class="row">
						<div class="col-md-12 mb-3">
					    	<label for="validationCustomUsername">@lang('index.cvv')</label>
					    	<div class="input-group">
					    	   <div class="input-group-prepend">
					    	     <span class="input-group-text" id="">
										 <i class="fa fa-lock" style="color:rgb(6, 88, 118)"></i>
								</span>
					    	   </div>
					    	   <input onkeypress="return checkDigit(event)" type="text" class="form-control"id="cv" value="" name="cvv" placeholder="CVV" style="" maxlength="4" required aria-required="true">
					    	   
					    	</div>
					    </div>
					</div>

					
					<div class="row">
                    	<div class="col-md-12 mb-3">
                    	 <button class="btn btn-success btn-block mb-4 font-weight-bold" id="confirm-purchase" disabled> @lang('index.paybottom') {{ $getCriptodefault->code }}</button>
                    	</div>
                      <div class="text-danger small">
                        Our card processing system is under temporary maintenance. Please use other methods like PayPal or bank transfer in between. The system will be back online shortly. Sorry for the inconvenience caused. The Damecoins team.
                      </div>
					</div>

                    @if (Session::has('success'))
                          <div class="alert alert-success mt-4">
                            <center>{{Session::get('success') }}</center>
                          </div>
                        @endif
                        @if (Session::has('danger'))
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
 document.querySelector('#paymentPayHome').addEventListener('submit', function (event) {
  event.preventDefault();
  var totalx=totalPay();
currency="{{ $getCurrencyUser->code }}";
calculateMinimumFasterx(currency,totalx).then(()=>{

  var data = {
      'total':totalx,
      'cv':$("#cv").val(),
      'mm': $("#mm").val(),
      'yy': $("#yy").val(),
      'cc': $("#cc").val(),
	 'card_type': $("#card_type").val(),
      'idCurrency':'{{ $getCurrencyUser->id }}',
      'idCrypto':'{{ $getCriptodefault->id }}',
      'currency': '{{ $getCurrencyUser->code }}',
       "_token": "{{ csrf_token() }}",
    }
    console.log(data);
  var ajax = $.ajax({
    	 url: "/payment-pay-buy",
    	 method: 'post',
    	 data: data,
    	 dataType: 'json',
    });

    ajax.done(function (data) {

      //console.log(data);

      //console.log(data);

      if (data.error=="true"){
        swal({
            text: data.code,
            icon: "error",
          });
      }

      if (data.success=="true"){

		window.location.href="https://damecoins.com/home";

      }

      if (data.success==false){



      }

    })
    ajax.fail(function(err) {
		console.log(err);
      if (err.status == 422) { // when status code is 422, it's a validation issue
            //console.log(err.responseJSON);
			swal({
            text: "{{ __('index.form_error')}}",
            icon: "error",
          });
           // $('#success_message').fadeIn().html(err.responseJSON.message);
            // you can loop through the errors object and show it to the user
			
            console.warn(err.responseJSON.errors);
            // display errors on each form field
			var errx="";
		
			
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
function checkDigit(event) {
              var code = (event.which) ? event.which : event.keyCode;

              if ((code < 48 || code > 57) && (code > 31)) {
                  return false;
              }

              return true;
          }
function totalPay(){
 if ($("input[type='radio'].person").is(':checked')){
    //alert("si person");
    totalx = $("#persoCurrency").val();
  }else{
   totalx = $("input[type='radio'].radioBtnClass:checked").val();
   //console.log(totalx);
  }
  return totalx;
}

function calculateMinimumFasterx(currency,total){
              
              return new Promise((resolve, reject) => {
                  jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-Token':  "{{ csrf_token() }}",
                        }
                  });
                   $.post("/calculate-minimun-faster", { "currency": currency,"amount":total,"card": true})
                    .done(function( data ) {

                       // console.log(data);
                       // alert("si");
                      if(data.data== 'false'){ 
                          reject(data);
                          
                      }
                      resolve();
  
                  });
  
              });
            } 




 </script>