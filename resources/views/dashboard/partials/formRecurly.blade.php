<form action="/processrecurlyhome" method="POST" id="paymentRecurly" name="myForm">

  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" value='{{$getCriptodefault->id}}' name="crypto">
  <input type="hidden" value='{{$getCurrencyUser->id}}' name="currency">

  
 
  @include('home_usuario.partials.paypal')

  <div class="row">
    <div class="col-md-12 paymentRecurly" style="{{ (!$payment_state->state) ? 'opacity:0.4' : '' }}">
      <input type="hidden" name="first" value="{{Auth::user()->name}}" data-recurly="first_name" id="first_name">
      <input type="hidden" name="last" value="{{Auth::user()->lastName}}" data-recurly="last_name" id="last_name">
      <input type="hidden" value="{{Auth::user()->country->cod_iso2}}" data-recurly="country" id="country">
      <input type="hidden" name="three-d-secure-token" id="three-d-secure-token">
      <input type="hidden" name="recurly-token" id="recurly-token">
      <input type="hidden" name="recurly-account-code" id="recurly-account-code">
      <div class="row" style="">
        <div id="recurly-elements">
        </div>
      </div>

      <input type="hidden" name="recurly-token" data-recurly="token">
      <!-- Used to display form errors. -->
      <div id="card-errors" role="alert" style="color:red"></div>
    </div>
  </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="paymentVender" style="margin-bottom: 20px;margin-left:0px;">
        <ul style="display: flex;list-style: none;margin-left:0px;">
          <li style="align-items: center;display: flex"><img src="{{asset('img/vender5.png')}}" alt="" width="80px">
          </li>
          <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender6.png')}}" alt=""
              width="80px"></li>
          <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender1.png')}}" alt=""
              width="80px"></li>
          <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender2.png')}}" alt=""
              width="80px"></li>
          <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender3.png')}}" alt=""
              width="50px"></li>
          <li style="margin-left:10px;align-items: center;display: flex"><img src="{{asset('img/vender4.png')}}" alt=""
              width="80px"></li>
        </ul>
      </div>
    </div>
  </div>


  <div class="row">


    <div class="col-md-6">
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
      <button class="btn btn-primary" id="buycrypto">@lang('index.paybottom')
        {{ $getCriptodefault->code }}</button>
    </div>
  </div>

  @if (!General::paymentState('recurly'))

  <div class="row">
    <div class="col-md-8 alert alert-warning" role="alert">
      <p>
        Apologizes, our card payment system is currently under maintenance. Please come back in a few days to purchase
        crypto using credit or debit card (card system is being upgraded and it may take a few days). If you need to
        purchase right now, please signup or login for paying by bank transfer (we have bank accounts available in USA,
        UK, Europe and Hong Kong) or ask our 24/7 Chat Support about payment by PayPal if bank transfer does not fit
        your needs! Thank you for using Damecoins.
      </p>
    </div>
  </div>
  @endif

</form>

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
    //publicKey: 'ewr1-9UIs5E1Bb1ryICWwg8csXY', //test
    
    required: ["cvv"],

});

	let button = document.getElementById("buycrypto");
	let recurlyStatus = {{ (!$payment_state->state) ? 'true' : 'false' }};
	//console.log(recurlyStatus);
	if(recurlyStatus === true){
		button.disabled = true;
	} else {
		button.disabled = false;
	}



const elements = recurly.Elements();
const cardElement = elements.CardElement();
cardElement.attach('#recurly-elements');


document.querySelector('#paymentRecurly').addEventListener('submit', function (event) {
   
    event.preventDefault();
            amount = totalxx();
            currency = '{{ $getCurrencyUser->code }}';
            card_type = true;
            
              if ($("input[type='checkbox']#total").is(':checked')) {
                if ($("input[type='radio'].radioBtnClass").is(':checked')) {
                  if ($("input[type='radio'].person").is(':checked')){
                    //alert("si person");
                    totalx = $("#persoCurrency").val();
                  }else{
                   totalx = $("input[type='radio'].radioBtnClass:checked").val();
                   //console.log(totalx);
                  }
                 }
                       // alert(totalx);  
                    var formu = document.getElementById('processcompra');
                    var total = document.createElement('input');
                    total.setAttribute('type', 'hidden');
                    total.setAttribute('name', 'total');
                    total.setAttribute('value', totalx);
                    var wallet = document.createElement('input');
                    wallet.setAttribute('type', 'hidden');
                    wallet.setAttribute('name', 'wallet');
                    wallet.setAttribute('value', 'true');
                   // form.appendChild(hiddenInput);
                    formu.appendChild(total);
                    formu.appendChild(wallet);
                    // Submit the form
                    formu.submit();
              }else{

                 calculateMinimum(amount,currency,card_type).then(()=>{

                    const form = this;

                    error = document.getElementById('card-errors');
                    error.innerHTML = '';
                    //isoCode=$('#getCountry').val();
                   // $('#country').val(isoCode);

                    recurly.token(elements, form, function (err, token) {
                    
                          if (err) {
                              error.innerHTML = 'The following fields appear to be invalid: ' + err.fields.join(', ');
                        
                          } else {
                            recurlyToken(token.id);
                        
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
              }) 

            }

});

function recurlyToken(token) {
    if ($("input[type='radio'].radioBtnClass").is(':checked')) {
         if ($("input[type='radio'].person").is(':checked')){
           //alert("si person");
           totalx = $("#persoCurrency").val();
         }else{
          totalx = $("input[type='radio'].radioBtnClass:checked").val();
          //console.log(totalx);
         }
    }
    var form = document.getElementById('paymentRecurly');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'token');
    hiddenInput.setAttribute('value', token);
    var total = document.createElement('input');
    total.setAttribute('type', 'hidden');
    total.setAttribute('name', 'total');
    total.setAttribute('value', totalx);
    var wallet = document.createElement('input');
    wallet.setAttribute('type', 'hidden');
    wallet.setAttribute('name', 'wallet');
    wallet.setAttribute('value', 'false');
    form.appendChild(hiddenInput);
    form.appendChild(total);
    form.appendChild(wallet);
    // Submit the form
    form.submit();
}

</script>