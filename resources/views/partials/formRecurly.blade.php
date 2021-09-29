<form action="/processrecurly" method="POST" id="paymentRecurly" name="myForm">
	<div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	</div>
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
	<input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">
	<label for="" class="subt" style="margin-top:5px">@lang('index.dataaccount')</label>
	<div class="row sign">
		<div class='col-sm-6 formx'>
			<input type="text" value="" data-recurly="first_name" name="name" id="name" class="form-control"
				placeholder="@lang('index.form_name') " required></div>
		<div class='col-sm-6 formx'>
			<input type="text" value="" id="lastname" data-recurly="last_name" name="lastname" class="form-control"
				placeholder="@lang('index.form_lastname')" required>
		</div>
		<!--  </div>
                    <div class="row">
                    -->
		<div class='col-sm-6 formx'>
			<input type="email" value="" id="email" name="email" class="form-control" required
				placeholder="@lang('index.form_email')"></div>
		<div class='col-sm-6 formx'>
			{!!Form::select('country', $getCountry, '', [
			'id' => 'getCountry',
			'class' => 'form-control',
			'placeholder' => __('index.form_country') ,
			'required'=>'required'
			])!!}
		</div>
	</div>

	<!-- Tab panes -->
	<div class="tab-content theme-tab-profile-content theme-profile-bg">

		<!-- card -->
		<div role="tabpanel" class="{{App::getLocale() != 'ch' ? 'tab-pane active':'tab-pane'}}"" id=" favourite">
			<ul class="media-list" id="profileFavouritesList">

				<div class="col-md-12 paymentRecurly" style="{{ (!$payment_state->state) ? 'opacity:0.4' : '' }}">

					<input type="hidden" data-recurly="country" id="country">
					<input type="hidden" name="three-d-secure-token" id="three-d-secure-token">
					<input type="hidden" name="recurly-token" id="recurly-token">
					<input type="hidden" name="recurly-account-code" id="recurly-account-code">
					<div class="row" style="">
						<div id="recurly-elements">
						</div>
					</div>

					<div class="three-d-secure-auth-container">

					</div>

					<input type="hidden" name="recurly-token" data-recurly="token">
					<!-- Used to display form errors. -->
					<div id="card-errors" role="alert" style="color:red"></div>
				</div>
		</div>

	</div>
	<div class="row" style="{{ (!$payment_state->state) ? 'opacity:0.4' : '' }}">
		<div class="col-md-12">
			<div class="paymentVender" style="margin-bottom: 20px;margin-left:0px;">
				<ul style="display: flex;list-style: none;margin-left:0px;">
					<li style="align-items: center;display: flex"><img src="{{asset('img/vender5.png')}}" alt=""
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
	</div>
	<div class="row" style="{{ (!$payment_state->state) ? 'opacity:0.4' : '' }}">

	</div>
	<div class="row total">
		<div class="col-md-8" id="finalx">
			<p>
				@lang('index.mesagge1',["divisa"=> $getCriptodefault->code ])
			</p>

			<p>
				@lang('index.mesagge2',["divisa"=> $getCriptodefault->code ])
			</p>

			<p>
				@lang('index.mesagge3',["divisa"=> $getCriptodefault->code ,"currency"=> $getCurrencyUser->code ])
			</p>
		</div>
		<div class="col-md-4">
			<button class="btn btn-primary mibuttom pull-right">@lang('index.paybottom')
				{{ $getCriptodefault->code }}</button>
		</div>
	</div>
	</ul>
	</div>
</form>
{{--
@if (!$payment_state->state)
<div class="col-10 offset-1 alert alert-warning" role="alert">
	<p>
		Apologizes, our card payment system is currently under maintenance. Please come back in a few days to purchase
		crypto using credit or debit card (card system is being upgraded and it may take a few days). If you need to
		purchase right now, please signup or login for paying by bank transfer (we have bank accounts available in USA,
		UK,
		Europe and Hong Kong) or ask our 24/7 Chat Support about payment by PayPal if bank transfer does not fit your
		needs!
		Thank you for using Damecoins.
	</p>
	<p>
		Get a free account now and buy crypto in a few hours after maintenance.
	</p>
	<div class="d-flex justify-content-center">
		<a href="/signup" class="btn mibuttom" style="color:#fff">Create free account</a>
	</div>
</div>
@endif
--}}
</div>


</div>
</div>

<div class="spinner" style="display:none;position: absolute; width: 0px; z-index: 2000000000; left: 50%; top: 50%;"
	role="progressbar">
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-0-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(0deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-1-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(30deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-2-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(60deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-3-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(90deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-4-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(120deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-5-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(150deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-6-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(180deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-7-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(210deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-8-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(240deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-9-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(270deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-10-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(300deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
	<div style="position: absolute; top: -2px; opacity: 0.25; animation: opacity-100-25-11-12 1s linear infinite;">
		<div
			style="position: absolute; width: 12px; height: 5px; background: rgb(76, 76, 76); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center 0px; transform: rotate(330deg) translate(10px, 0px); border-radius: 2px;">
		</div>
	</div>
</div>



<script>


recurly.configure({
   publicKey: 'ewr1-koFsJQMJ0Xf43SBJsB17u9',//live
  // publicKey: 'ewr1-9UIs5E1Bb1ryICWwg8csXY', //test
    
    required: ["cvv"],

});


const elements = recurly.Elements();
const cardElement = elements.CardElement();
cardElement.attach('#recurly-elements');


document.querySelector('#paymentRecurly').addEventListener('submit', function (event) {
  event.preventDefault();
  @if (!$payment_state->state)
        swal("You need a Damecoins free account for purchasing. It is free and will take you only 1 minute. If you already have an account, you can login.", {
        buttons: {
          free: {
            text: "{{ __('header.signup')}}",
            value: "free",
          },
          login: {
            text: "{{ __('header.login')}}",
            value: "login",
          },
        
        },
      })
      .then((value) => {
        switch (value) {
        
          case "login":
            window.location="https://damecoins.com/login";
            //swal("Login", "success");
            break;

          case "free":
            window.location="https://damecoins.com/signup";
            //swal("Free", "success");
            break;

        }
      });
//return;

  @else
  //alert('si');
//return;
    //event.preventDefault();
    amount = totalxx();
    currency = '{{ $getCurrencyUser->code }}';
    card_type= true;
    calculateMinimum(amount,currency,card_type).then(()=>{
        const form = this;
        error = document.getElementById('card-errors');
        error.innerHTML = '';
        isoCode=$('#getCountry').val();
        $('#country').val(isoCode);
          
        recurly.token(elements, form, function (err, token) {
          
              if (err) {
                  error.innerHTML = 'The following fields appear to be invalid: ' + err.fields.join(', ');
                
              } else {
                //verificar si esta activo el secured 3D
                @if($getCurrencyUser->supportrecurly->stripe_account->secure_3d)
                  // alert("secured");
                   processSecure(token.id)
                
                @else
                   // alert(token.id);
                   recurlyToken(token.id);
                
                @endif
                
              }
        });
        
      })
    .catch(data => {
        console.log("fallo");
        console.log(data);
         swal({
            text: "{{ __('home_buy.minimun', ['type' => 'CARD' ]) }}"+' ('+data.limit+' USD)',
            icon: "error",
          });
    });
@endif
});

function processSecure(tokenInit){

    if ($("input[type='radio'].person").is(':checked')){
          
          totalx = $("#persoCurrency").val();
        }else{
         totalx = $("input[type='radio'].radioBtnClass:checked").val();
         
    }

    var data = {
      'total':totalx,
      'tokenRecurly':tokenInit,
      'name': $("#name").val(),
      'lastname':$("#lastname").val(),
      'email':$("#email").val(),
      'country':$("#getCountry").val(),
      'currency':'{{ $getCurrencyUser->id }}',
      'crypto':'{{ $getCriptodefault->id }}',
       "_token": "{{ csrf_token() }}",
    }

    var ajax = $.ajax({
    	 url: "/payment-intent/recurly",
    	 method: 'post',
    	 data: data,
    	 dataType: 'json',
    });

    ajax.done(function (data) {

      //console.log(data);

      if (data.success==true){

        $('#recurly-elements').empty();

        $('#paymentRecurly').empty();

       swal({
            text: data.info,
            icon: "success",
          })
          .then(() => {
            window.location="https://damecoins.com/login";

          });
          
      }

      if (data.success==false){

        swal({
            text: data.info,
            icon: "error",
          })

      }

      if (data.success=='error'){

      swal({
          text: data.info,
          icon: "error",
        })
      
      }

      if (data.secure == true) {
           //console.log(data);
           $('.three-d-secure-auth-container').empty();

           var account = data.account;
           var container = $('.three-d-secure-auth-container');
           container.show();
           const risk = recurly.Risk();
           const threeDSecure = risk.ThreeDSecure({ actionTokenId: data.token_3d });
           threeDSecure.on('error', err => {
               //alert(err);
               console.log("errot3d" + token);
           });

           threeDSecure.on('token', token => {
               // alert(token);
               var tokenSecure = token.id;
               //console.log("yoken3d"+token);
               container.hide();

               $('.three-d-secure-submitting-messagge').show();
               var data = {
                   //'total': 200.00,
                   'token': tokenInit,
                   'tokenSecure': tokenSecure,
                   'account': account,
                   'name': $("#name").val(),
                   'lastname':$("#lastname").val(),
                   'email':$("#email").val(),
                   "_token": "{{ csrf_token() }}",
               }
               var ajax = $.ajax({
                   url: "/process-secure/recurly",
                   method: 'post',
                   data: data,
                   dataType: 'json',
               });
               ajax.done(function(data) {

                 if(data.success==false){
                  swal({
                    text: data.info,
                    icon: "error",
                  });

                 }
                 if (data.success==true){

                  $('#recurly-elements').empty();

                  $('#paymentRecurly').empty();

                  swal({
                      text: data.info,
                      icon: "success",
                    })
                    .then(() => {
                      window.location="https://damecoins.com/login";
                    
                    });

                  }

               })
               ajax.fail(function() {
                   console.log("fail");
               });
           });
           threeDSecure.attach(container[0]);

           // Show the container
           container.show();
       }

              
    });
    ajax.fail(function () {
                  
    });
}
function recurlyToken(token) {
        if ($("input[type='radio'].person").is(':checked')){
          
           totalx = $("#persoCurrency").val();
         }else{
          totalx = $("input[type='radio'].radioBtnClass:checked").val();
          
         }
            //console.log(token);
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('paymentRecurly');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'recurlyToken');
        hiddenInput.setAttribute('value', token);
        var total = document.createElement('input');
        total.setAttribute('type', 'hidden');
        total.setAttribute('name', 'total');
        total.setAttribute('value', totalx);
        form.appendChild(hiddenInput);
        form.appendChild(total);
        // Submit the form
        form.submit();
}
</script>



