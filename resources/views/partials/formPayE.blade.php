<div class="col-md-12">
    <div class="card form-crypto">
        <div class="card-body">
            <div class="panel panel-default mt-2">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="align-self-center">
                        <img class="img-responsive" style="height:50px" src="{{asset('img/kindpng.png')}}">
                        </div>
                    </div>
                    <div class="form-row">

                  
                        <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px">
                            Pay With Credit Card (max. 500 USD per transaction. If want to purchase more please pay several times)
                        </label>

                    </div>
                </div>
                <form action="{{route('payment-pay')}}" method="POST" id="paymentPayE" role="form">
                    <div class="row sign">
                        <div class='col-sm-6 formx'>
                            <input type="text" value="" data-recurly="first_name" name="name" id="name"
                                class="form-control" placeholder="@lang('index.form_name') " required></div>
                        <div class='col-sm-6 formx'>
                            <input type="text" value="" id="lastname" data-recurly="last_name" name="lastname"
                                class="form-control" placeholder="@lang('index.form_lastname')" required>
                        </div>
                        <!--  </div>
                                  <div class="row">
                                  -->
                        <div class='col-sm-6 formx'>
                            <input type="email" value="" id="email" name="email" value="houltman@gmail.com"
                                class="form-control" required placeholder="@lang('index.form_email')">

                        </div>
                        <div class='col-sm-6 formx'>
                            {!!Form::select('country', $getCountry, '', [
                            'id' => 'getCountry',
                            'class' => 'form-control',
                            'placeholder' => __('index.form_country') ,
                            'required'=>'required'
                            ])!!}
                        </div>
                        <div class="col-12 mt-2">
                            <button class="btn btn-success btn-buy btn-block font-weight-bold"
                                id="confirm-purchase">
                                <span class="spinner-grow spinner-grow-sm d-none" role="status"
                                    aria-hidden="true"></span>
                                <span class="sr-only">Loading...</span>
                                <span class="sendtext">@lang('index.paybottom') {{ $getCriptodefault->code }}</span>
                            </button>
                        </div>
                        <div class="row total mt-1">
	                    	<div class="col-12" id="finalx">
	                    		<p>
	                    			@lang('index.mesagge1',["cripto"=> $getCriptodefault->code ])
	                    		</p>

	                    		<p>
	                    			@lang('index.mesagge2',["divisa"=> $getCriptodefault->code ])
	                    		</p>

	                    		<p>
	                    			@lang('index.mesagge3',["divisa"=> $getCriptodefault->code ,"currency"=> $getCurrencyUser->code ])
	                    		</p>
	                    	</div>

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
    document.querySelector('#paymentPayE').addEventListener('submit', function (event) {
        let total = $("input[name=item]:checked").val();
        event.preventDefault();
        if(total === '1000'){
            total = document.querySelector('#persoCurrency').value;
        }
     //  document.querySelector('.btn-buy').getElementsByClassName("spinner-grow")[0].classList.remove("d-none");
     //   document.querySelector('.btn-buy').disabled = true;
      //  document.querySelector('.btn-buy').getElementsByClassName("sendtext")[0].innerHTML = "Procesando";
         //alert(total);
         currency = '{{ $getCurrencyUser->code }}';
         
    calculateMinimumFaster(currency,total).then((data)=>{
         let minimo=500;
        

        console.log(total);

        var data = {
            'country':$("#getCountry").val(),
            'name': $("#name").val(),
            'lastname':$("#lastname").val(),
            'idCurrency':'{{ $getCurrencyUser->id }}',
            'idCrypto':'{{ $getCriptodefault->id }}',
            'currency': '{{ $getCurrencyUser->code }}',
            'email':$("#email").val(),
            'total': total,
            'direct':"index",
            "_token": "{{ csrf_token() }}",
            }
        // console.log(data);
        var ajax = $.ajax({
                url: "../api/paymentresult",
                method: 'post',
                data: data,
                dataType: 'json',
            });

            ajax.done(function (data) {

            // console.log(data);

            //console.log(data);

            if (data.error==true){
                alert(data.code);   
            }

            if (data.success=="true"){

                window.location.href = data.payment_url;
                console.log('Llegó bien');
                
            }

            if (data.success=="false"){

            

            }

            })
            ajax.fail(function(err) {
            if (err.status == 422) { // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                // $('#success_message').fadeIn().html(err.responseJSON.message);
                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
            });
        })

.catch(data => {
   
     swal({
        text: "{{ __('home_buy.minimun_faster', ['type' => 'CARD' ]) }}"+' ('+data.min+' USD)' + "{{ __('home_buy.maximo_faster') }}" + '('+data.max+' USD)',
        icon: "error",
      });
      
});

function calculateMinimumFaster(currency,total){
              
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



});
</script>