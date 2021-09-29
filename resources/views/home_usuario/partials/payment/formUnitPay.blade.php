
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
      <div class="panel panel-info mt-2" style="border:solid 1px #ccc">
        <form action="{{route('payment-pay-buy')}}" method="POST"  id="paymentPayUnit" role="form" style="padding:25px">									

          <div class="row">
                   <div class="col-md-12 mb-3">
                     <button class="btn btn-success btn-block mb-4 font-weight-bold" type="submit"> @lang('home_buy.payment-tarjta',["cripto"=>$getCriptodefault->code])</button>  <br>
                       <br>
                   </div>   
          </div>
  
  <div class="row">
      <div class="col-md-12 mb-4" >
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
</form>

      </div>
     </div>
    </div>
  </div>
{{--
  <script src="{{ asset('tel/intlTelInput.js') }}" ></script>
  --}}
<script>
//startinputtelf

document.querySelector('#paymentPayUnit').addEventListener('submit', function (event) {
event.preventDefault();


var totalx=totalPay();
currency="{{ $getCurrencyUser->code }}";
calculateMinimumFasterx(currency,totalx).then(()=>{

	var data = {
	'total':totalx,
	'idCurrency':'{{ $getCurrencyUser->id }}',
	'idCrypto':'{{ $getCriptodefault->id }}',
	'currency': '{{ $getCurrencyUser->code }}',
	"_token": "{{ csrf_token() }}",
	"direct":"buy"
	}

	var ajax = $.ajax({
     url: "/payment-pay-unitpay",
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
		
		  window.location.href=data.url;
		
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

              if(data.data== 'false'){ 
                  reject(data);
                  
              }
              resolve();

          });

      });
    } 




</script>