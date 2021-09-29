
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
	 .flag-container{
		z-index: 9999;
	 }


 </style>
<div class="col-md-12">
  <div class="card form-crypto">
    <div class="card-body">
      <div class="panel panel-info mt-1">
        <form action="{{route('payment-pay-buy')}}" method="POST"  id="paymentPayHome" role="form" style="padding:5px">									
              <!--fila name lastname-->
               <div class="row margin-info">   
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
               </div>
               <!--fila name lastname-->
                <!--email postal -->
               <div class="row margin-info">
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
               </div>   
                <!--email postal -->  
               <div class="row margin-info">
 			     <div class='col-sm-12 formx mb-3'>
						<div class="input-group">
 			       			<input
 			       			    type="text"
 			       			    value=""
 			       			    id="direccion"
 			       			    name="direccion"
 			       			    class="form-control  mb-3 mb-md-0 mb-lg-0"
 			       			    required="required"
								  placeholder="@lang('index.form_direccion')">
						</div>
 			     </div>
                </div>
                
                 <!--city country-->
               <div class="row margin-info  "> 
                    <div class='col-sm-6 formx mb-3'>
                              <input
                              type="text"
                              value=""
                              id="ciudad"
                              name="ciudad"
                              class="form-control  mb-3 mb-md-0 mb-lg-0"
                              required="required"
                                        placeholder="@lang('index.form_ciudad')">

                    </div>
                    <div class='col-sm-6 formx mb-3'>
                              {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                              'form-control mb-3 mb-md-0 mb-lg-0', 'placeholder' => __('index.form_country') ,
                               'required'=>'required' ])!!}               
                    </div>
               </div>   
               
                 <!--city country-->

			 
		      <div class="row margin-info">
				<div class="col-md-12">
					<div class="d-flex">
 					      <div class='input-group col-sm-8 ' style="padding-left:0;">
							
							<div class="input-group" >
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
					</div>
				</div>	 

			 </div>
			 
		
  <div class="row mt-2">
              <div class="col-md-12">
             <button class="btn btn-success btn-block mb-4 font-weight-bold" type="submit"> @lang('home_buy.payment-tarjta',["cripto"=>$getCriptodefault->code])</button>  <br>
              </div>    
  </div>
  
  <div class="row">
      <div class="col-md-12 " >
        
              <ul style="display: flex;list-style: none;padding:0!important;margin:0!important;">

                <li style="align-items: center;display: flex">
                     <img src="{{asset('img/vender5.png')}}" alt=""
                    width="80px">
                </li>

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

  <script src="{{ asset('tel/intlTelInput.js') }}" ></script>
<script>
//startinputtelf
   var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
   var input = document.querySelector("#phone");
   var iti= window.intlTelInput(input, {
     // any initialisation options go here
     utilsScript: "{{ asset('tel/utils.js') }}"
   });
   //endinputtel
document.querySelector('#paymentPayHome').addEventListener('submit', function (event) {
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
var totalx=totalPay();
currency="{{ $getCurrencyUser->code }}";
calculateMinimumFasterx(currency,totalx).then(()=>{

	var data = {
	'total':totalx,
	'phone':numberPhone,
     'country': $("#countryx").val(),
     'name': $("#namex").val(),
     'email': $("#emailx").val(),
     'lastname': $("#lastnamex").val(),
	'ciudad': $("#ciudad").val(),
	'direccion': $("#direccion").val(),
	'postal':$("#postal").val(),
	'idCurrency':'{{ $getCurrencyUser->id }}',
	'idCrypto':'{{ $getCriptodefault->id }}',
	'currency': '{{ $getCurrencyUser->code }}',
	"_token": "{{ csrf_token() }}",
	"direct":"index"
	};

	var ajax = $.ajax({
	//url: "/payment-pay-buy",
  url: "/payment-pay-revo-index",
	method: 'post',
	data: data,
	dataType: 'json',
	});

		ajax.done(function (data) {
		
		
		if (data.error=="true"){
		swal({
		    text: data.code,
		    icon: "error",
		  });
		}

		if (data.success=="true"){
		
		  window.location.href="{{ env("APP_BASE_URL_REVO") }}"+data.url;
		
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

function totalPay() {
         if ($("input[type='radio'].person").is(':checked')) {
             totalx= $("input[type='radio'].radioBtnClass:checked").val();
         } else {
              totalx = $("#persoCurrency").val();
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