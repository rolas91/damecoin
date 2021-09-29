{{-- <div class="row justify-content-center">
     <div class="col-md-12 d-flex justify-content-center mb-2">
         <div class="align-self-center">
            <img class="img-responsive" style="height:50px" src="{{asset('img/kindpng.png')}}">
         </div>
      </div>
</div>

<div class="row">
	<div class="col-md-12">
        <form action="{{route('payment-pay')}}" method="POST" id="paymentPayHomeE" role="form">
            <div class="row sign">
                <div class="col-md-12 paymentRecurly d-flex justify-content-center mb-2">
                    <button class="btn btn-success btn-buy font-weight-bold"
                        id="confirm-purchase">
                        <span class="spinner-grow spinner-grow-sm d-none" role="status"
                            aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                        <span class="sendtext">@lang('index.paybottom') {{ $getCriptodefault->code }}</span>
                    </button>
                </div>
            </div>
        </form>
	</div>
</div> --}}

<div class="row mb-2">
    {{-- <div class="col-md-12 text-center mb-2">
        <span>Or</span>
    </div> --}}
    <div class="col-md-12 text-center mb-2">
        <img loading="lazy" src="https://lh3.googleusercontent.com/r1qrqwYTNX0x1fN_0Xty0JWzkKBgad0RylI6rmGsRg144dvrRoKuZFqMJssOHhaPtA" class="img-fluid" height="50" alt="">
    </div>
    <div class="col-md-12 text-center paymentRecurly">
        <button class="btn btn-success btn-buy font-weight-bold" data-toggle="modal" data-target="#westernUnionPaymentModal">
            @lang('index.paybottom') {{ $getCriptodefault->code }}
        </button>
    </div>
</div>

<div class="row">
	<div class="col-md-12" id="finalx">
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

<script>
    document.querySelector('#paymentPayHomeE').addEventListener('submit', function (event) {
        //let total = $("input[name=item]:checked").val();
        let total = totalxx();

       // alert(total);
        event.preventDefault();

        //  document.querySelector('.btn-buy').getElementsByClassName("spinner-grow")[0].classList.remove("d-none");
        //   document.querySelector('.btn-buy').disabled = true;
        //  document.querySelector('.btn-buy').getElementsByClassName("sendtext")[0].innerHTML = "Procesando";
        //alert(total);
        currency = '{{ $getCurrencyUser->code }}';

        //alert(currency);

        calculateMinimumFaster(currency,total).then((data)=>{
            var data = {
                '_token':"{{ csrf_token() }}",
                'total':total,
                'idCurrency':'{{ $getCurrencyUser->id }}',
                'idCrypto':'{{ $getCriptodefault->id }}',
                'direct':"buy",
                //'stripeToken':result.token.id,
                'currency':'{{ $getCurrencyUser->code }}',
            }
            console.log(data);
            //return;
            var ajax = $.ajax({
                url: "/paymentresulthome",
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

        function calculateMinimumFaster(currency,total) {
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