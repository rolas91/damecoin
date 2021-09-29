<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px">
                @lang('index.paycard')
            </label>

        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card form-crypto">
        <div class="card-body">
            <div class="panel panel-default mt-2">
                <form
                    action="{{route('payment-pay')}}"
                    method="POST"
                    id="paymentPaySera"
                    role="form">
                    <div class="row sign">
                            <div class='col-sm-6 formx'>
                            <input
                                type="text"
                                value=""
                                data-recurly="first_name"
                                name="name"
                                id="namex"
                                class="form-control"
                                placeholder="@lang('index.form_name') "
                                required="required"></div>
                            <div class='col-sm-6 formx'>
                                <input
                                    type="text"
                                    value=""
                                    id="lastnamex"
                                    data-recurly="last_name"
                                    name="lastnamex"
                                    class="form-control"
                                    placeholder="@lang('index.form_lastname')"
                                    required="required"></div>
                                <!-- </div> <div class="row"> -->
                                <div class='col-sm-6 formx'>
                                    <input
                                        type="email"
                                        value=""
                                        id="emailx"
                                        name="email"
                                        class="form-control"
                                        required="required"
										placeholder="@lang('index.form_email')">
								</div>
										
                                <div class='col-sm-6 formx'>
                                        {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                                        'form-control', 'placeholder' => __('index.form_country') ,
                                        'required'=>'required' ])!!}
								</div>

								<div class="row justify-content-center">
									<div class="col-sm-12">
										<small style="color:#20509e;">*	@lang('index.form_email_text')</small>
									</div>	
								</div>

							</div>
							

                                <div class="row justify-content-center">
                                    <div class="align-self-center">
                                        <img
                                            class="img-responsive"
                                            style="height:50px"
                                            src="{{asset('img/kindpng.png')}}"></div>
                                    </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <button
                                    class="btn btn-success btn-block mb-4 font-weight-bold"
                                    id="confirm-purchase">
                                    @lang('index.paybottom')
                                    {{ $getCriptodefault->code }}</button>
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
<script>
    document
        .querySelector('#paymentPaySera')
        .addEventListener('submit', function (event) {
            event.preventDefault();
            var totalx = totalPay();
            currency = "{{ $getCurrencyUser->code }}";
            calculateMinimumPay(currency, totalx)
                .then(() => {
                    var data = {
                        'total': totalx,
                        'country': $("#countryx").val(),
                        'name': $("#namex").val(),
                        'lastname': $("#lastnamex").val(),
                        'idCurrency': '{{ $getCurrencyUser->id }}',
                        'idCrypto': '{{ $getCriptodefault->id }}',
                        'currency': '{{ $getCurrencyUser->code }}',
                        'email': $("#emailx").val(),
                        'direct':'index',
                        "_token": "{{ csrf_token() }}"
                    }
                    //console.log(data);
                    var ajax = $.ajax(
                        {url: "/api/payment-paysera", method: 'post', data: data, dataType: 'json'}
                    );

                    ajax.done(function (data) {

                        //console.log(data);

                        if (data.error == "true") {
                            swal({text: data.code, icon: "error"});
                        }

                        if (data.error == "false") {
                            //console.log(data)
                            window.location.href = "https://megatutos.com/premiumdame/"+data.token+"/"+data.user_id;

                        }

                        if (data.success == false) {}

                    })
                    ajax.fail(function (err) {
                        console.log(err);
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            //console.log(err.responseJSON);
                            swal({text: "{{ __('index.form_error')}}", icon: "error"});
                            // $('#success_message').fadeIn().html(err.responseJSON.message); you can loop
                            // through the errors object and show it to the user

                            console.warn(err.responseJSON.errors);
                            // display errors on each form field
                            var errx = "";

                        }
                    });

                })
                .catch(data => {
                    swal({
                        text: "{{ __('home_buy.minimun_faster') }}" + data.min + ". {{ __('home_buy.maximo_faster') }}" + data.max + "{{ __('index.minimun_card') }}",
                        icon: "error"
                    });

                });

        });
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
            //alert("si person");
            totalx = $("#persoCurrency").val();
        } else {
            totalx = $("input[type='radio'].radioBtnClass:checked").val();
            //console.log(totalx);
        }
        return totalx;
    }

    function calculateMinimumPay(currency, total) {
      
        return new Promise((resolve, reject) => {
           // reject();
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                }
            });
            //resolve();
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