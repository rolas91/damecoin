
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
@include('home_usuario.partials.modals.modalMercadopagoInactivo')
  <div class="card form-crypto" style="background-color: #f5f7fb">
    <div class="card-body">
      <div class="panel panel-info mt-1">
        <form action="{{url('process_payment_mp')}}" method="POST"  id="paymentPayMp" role="form" style="padding:5px">									
              <!--fila name lastname-->
               <div class="row margin-info">   
                    <div class='col-sm-6 formx mb-3'>
                         <input
                          type="text"
                          data-recurly="first_name"
                          name="name"
                          id="namex"
                          class="form-control  mb-3 mb-md-0 mb-lg-0 bg-white"
                          placeholder="@lang('index.form_name') "
                          required="required">
                     </div>
                    <div class='col-sm-6 formx'>
                          <input
                              type="text"
                              id="lastnamex"
                              data-recurly="last_name"
                              name="lastnamex"
                              class="form-control  mb-3 mb-md-0 mb-lg-0 bg-white"
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
                                  id="emailx"
                                  name="email"
                                  class="form-control  mb-3 mb-md-0 mb-lg-0 bg-white"
                                  required="required"
                                            placeholder="@lang('index.form_email')">
                    </div>

                    <div class='col-sm-6 formx mb-3'>
                                   <input
                                   type="text"
                                   id="postal"
                                   name="postal"
                                   class="form-control  mb-3 mb-md-0 mb-lg-0 bg-white"
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
 			       			    id="direccion"
 			       			    name="direccion"
 			       			    class="form-control  mb-3 mb-md-0 mb-lg-0 bg-white"
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
                              id="ciudad"
                              name="ciudad"
                              class="form-control  mb-3 mb-md-0 mb-lg-0 bg-white"

                              required="required"
                                        placeholder="@lang('index.form_ciudad')">

                    </div>
                    <div class='col-sm-6 formx mb-3'>
                              {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                              'form-control mb-3 mb-md-0 mb-lg-0 bg-white', 'placeholder' => __('index.form_country') ,
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
 					        	id="phone"
 					        	name="phone"
 					        	class="form-control  mb-3 mb-md-0 mb-lg-0 bg-white"
 					        	required="required"
 					        	    placeholder="@lang('index.form_phone')">        
						 </div> 
 					      </div>
					</div>
				</div>	 

			 </div>
			 
		
  <div class="row mt-2 align-items-center">
      <div class="col-md-12">
        <button class="btn btn-success btn-block mb-4 font-weight-bold" style="margin:0!important" type="submit"> @lang('home_buy.payment-mp',["cripto"=>$getCriptodefault->code, "metodo" => $nameMetodo])<br><span style="font-size: 12px">@lang('home_buy.comision', ["comision"=>$limit_pay[0]->comision])</span></button>  <br>
      </div>
      <div class="col-md-12">
          <img width="100%" src="{{asset('img/bannermp.jpeg')}}" alt="">
      </div>        
  </div>
  <br>
  
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
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
//startinputtelf
   var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
   var input = document.querySelector("#phone");
   var iti= window.intlTelInput(input, {
     // any initialisation options go here
     utilsScript: "{{ asset('tel/utils.js') }}"
   });
   //endinputtel
document.querySelector('#paymentPayMp').addEventListener('submit', function (event) {
event.preventDefault();

let payment_state = '{{$payment_state->state}}'

if(payment_state == 1){
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
calculateMinimumMercadopago(currency,totalx).then(()=>{

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
  url: "/payment_pay_mp_index",
	method: 'post',
	data: data,
	dataType: 'json',
	});

		ajax.done(function (data) {
		
		console.log(data)
		if (data.error=="true"){
		swal({
		    text: data.code,
		    icon: "error",
		  });
		}

		if (data.success=="true"){
      window.location.href="{{config('payment.APP_BASE_URL_MP_INIT')}}"+data.url;
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
		text: "{{ __('home_buy.minimun_faster') }}"+ data.min ,
		icon: "error",
		});

		});
}else{
  $("#minimum_mercadopago").text('{{$limit_pay[0]->mercadopago_minimum}}')
  $("#mercadopagoInactivo").modal("show")
}
 //validando phone
 

});

function checkDigit(event) {
      var code = (event.which) ? event.which : event.keyCode;

      if ((code < 48 || code > 57) && (code > 31)) {
          return false;
      }

      return true;
  }

function totalPay() {
  if ($("input[type='radio'].radioBtnClass").is(':checked')){
          totalx = $("input[type='radio'].radioBtnClass:checked").val();  
        }else{
          totalx = $("#persoCurrency").val();
        }
         return totalx;
     }

function calculateMinimumMercadopago(currency,total){
      
      return new Promise((resolve, reject) => {
          jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token':  "{{ csrf_token() }}",
                }
          });
           $.post("/calculate-minimun-mercadopago", { "currency": currency,"amount":total,"card": true})
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