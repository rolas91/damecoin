<script src="https://js.stripe.com/v3/"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="col-md-12 p-0">
    <div class="card form-crypto">
        <div class="card-body">
            <div class="panel panel-default mt-2">
                <form
                    action="{{route('payment-pay')}}"
                    method="POST"
                    id="paymentPay"
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
                                required="required">
                        </div>
                        <div class='col-sm-6 formx'>
                            <input
                                type="text"
                                value=""
                                id="lastnamex"
                                data-recurly="last_name"
                                name="lastnamex"
                                class="form-control"
                                placeholder="@lang('index.form_lastname')"
                                required="required">
                        </div>
                            <!-- </div> <div class="row"> -->
                        <div class='col-sm-6 formx pt-2'>
                            <input
                                type="email"
                                value=""
                                id="emailx"
                                name="email"
                                class="form-control"
                                required="required"
                                placeholder="@lang('index.form_email')">
                        </div>
                                    
                        <div class='col-sm-6 formx pt-2'>
                            {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                            'form-control height-control', 'placeholder' => __('index.form_country') ,
                            'required'=>'required' ])!!}
                        </div>
					</div>
							

                    <div class="row justify-content-center">
                        <div class="align-self-center">
                            </div>
                        </div>

                        <!--tarjeta-->
                        <div class="row">
                            <div class="col-md-12 mb-3 pt-3">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row">    
                                    <div id="card-element" style="margin:5px!important;padding-left: 12px; padding-right:12px" class="w-100 form-control py-2"></div>                  
                                    <div id="card-errors" role="alert" style="color:red" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-green btn-lg w-100 mt-4 mb-2" style="z-index: 1;position: relative;">
                            <img src="{{ asset('img/landing/icons/bitcoins.png') }}" class="left-icon" id="confirm-purchase">
                            @lang('index.paybottom') {{ $getCriptodefault->code }}
                        </button>
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

    var stripe = Stripe('{{General::publicStripeKeys()}}');
    // Create an instance of Elements.
    var elements = stripe.elements({
        locale: '{{ App::getLocale() }}',
    }
    );

    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var card = elements.create('card',{
        hidePostalCode: true,
        style: style
        }
    );

    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    }); 

    document.querySelector('#paymentPay').addEventListener('submit', function (event) {

            event.preventDefault();
            var totalx = totalPay();
            currency = "{{ $getCurrencyUser->code }}";
            calculateMinimumFasterx(currency, totalx)
                .then(() => {
                    var data = {
                        'total': totalx,
                        //'cv': $("#cv").val(),
                        //'mm': $("#mm").val(),
                        //'yy': $("#yy").val(),
                        //'cc': $("#cc").val(),
                        'card': card,
                        'card_type': $("#card_type").val(),
                        'country': $("#countryx").val(),
                        'name': $("#namex").val(),
                        'lastname': $("#lastnamex").val(),
                        'idCurrency': '{{ $getCurrencyUser->id }}',
                        'idCrypto': '{{ $getCriptodefault->id }}',
                        'currency': '{{ $getCurrencyUser->code }}',
                        'email': $("#emailx").val(),
                        "_token": "{{ csrf_token() }}"
                    }

                    //EdinsonCS - 28/08/2020
                    console.log(data);
                    
                    var ajax = $.ajax(
                        {url: "/payment-pay", method: 'post', data: data, dataType: 'json'}
                    );

                    ajax.done(function (data) {

                        //console.log(data); console.log(data);

                        if (data.error == "true") {
                            swal({text: data.code, icon: "error"});
                        }

                        if (data.success == "true") {

                            window.location.href = "https://damecoins.com/new-login";

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
        let sw = false;
        $("input[type = 'radio'").each(function(){
            if($(this).is(':checked')){
            totalx = $(this).attr('id');
            sw = true;
            }
        })

        if(sw == false){
            totalx = $(".person").val();
        }
        //console.log(totalx);
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