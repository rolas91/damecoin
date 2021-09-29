@if(isset($paypal_state))                
                <div class="row" style="{{ (!$paypal_state->status) ? 'display:none !important' : '' }}">
                    <div class="col-md-12 paymentRecurly d-flex justify-content-center mb-2">
                        <!-- <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#paypalModal ">
                            <i class="fa fa-paypal "></i> Pay With PayPal
                        </button> -->

                        <button data-toggle="modal" data-target="#ModalPaypal" class="btn btn-primary" type="button"><i class="fa fa-paypal "></i> Pay With PayPal</button>
                        {{-- <button onclick="paypal()" class="btn btn-primary" type="button"><i class="fa fa-paypal "></i> Pay With PayPal</button> --}}
                        <!-- Modal -->
                        <div class="modal fade" id="paypalModal" tabindex="-1" role="dialog"
                            aria-labelledby="paypalModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paypalModalLabel"><i class="fa fa-paypal"
                                                aria-hidden="true"></i> PayPal
                                            payment steps</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>For paying with PayPal, please follow the next steps:</p>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <ul class="steps">
                                                <li>
                                                    Step 1
                                                    <span class="copy">Login to your PayPal account.</span>
                                                </li>
                                                <li>
                                                    Step 2
                                                    <span class="copy">Find “Send money” and write
                                                        “paypal@damecoins.com” as receiver.</span>
                                                </li>
                                                <li>
                                                    Step 3
                                                    <span class="copy">Send the amount you wish to buy cryptocurrency
                                                        with. (You can compare how
                                                        much crypto will it buy you using the inputs
                                                        for choosing amount). Minimal amount is 500 USD or equivalent.
                                                        You can send in any currency
                                                        you wish.</span>
                                                </li>
                                                <li>
                                                    Step 4
                                                    <span class="copy">IMPORTANT:  Choose SEND TO FAMILY OR FRIENDS. If
                                                        you send us the money in
                                                        “Buying goods or services” mode, we will
                                                        immediately refund it back to you. This is a security measure
                                                        against fraud.</span>
                                                </li>
                                                <li>
                                                    Step 5
                                                    <span class="copy">In transaction notes please write the email you
                                                        have used to signup to
                                                        Damecoins.
                                                        If you have not signed up for a Damecoins account yet, please
                                                        still write your email
                                                        there.</span>
                                                </li>
                                                <li>
                                                    Step 6
                                                    <span class="copy">If you hadn’t signed up yet, please go to
                                                        Damecoins.com/signup and create a
                                                        free Dc account. USE THE SAME EMAIL you
                                                        wrote in PayPal transaction notes.</span>
                                                </li>
                                                <li>
                                                    Step 7
                                                    <span class="copy">Complete the payment. Done! We will credit your
                                                        Damecoins account in less
                                                        than 12h (usually in less than 1h) when our
                                                        Financial Department verifies the payment. You will receive an
                                                        email when your account is
                                                        credited, so you can login
                                                        into Dc and purchase any crypto you want.</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

                
<style>
    .color
    {
        background-color: #7cd1f9;
        color: #fff;
        border: none;
        box-shadow: none;
        border-radius: 5px;
        font-weight: 600;
        font-size: 14px;
        padding: 10px 24px;
        margin: 0;
        cursor: pointer;
    }
</style>

<div class="modal fade" id="ModalPaypal" tabindex="-1" role="dialog" aria-labelledby="westernUnionPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="westernUnionPaymentLabel">PAYPAL</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- <div class="modal-body"  style="padding: 20px 30px">
                <div class="text-center mb-2">
                    <img loading="lazy" src="https://d31dn7nfpuwjnm.cloudfront.net/images/valoraciones/0033/7299/Como_retirar_dinero_de_PayPal_en_Colombia.png?1555502328" class="img-fluid" alt="" style="width: 200px">
                </div>
                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    {{__('index.message_paypal')}}
                    min: <span id="calculatorPaypal"></span> <br>
                    {{__('index.message_paypal1')}} 
                    <br>
                </div>
                
                <div style="background-color: rgba(183, 205, 232, 1); font-size: 13px; border-radius: 5px; padding: 10px;">
                    @lang('index.sendMoneyPaypal') <br> <strong style="font-size: 17px;   font-weight: bold;color: #003187;">paypal@damecoins.co.uk</strong>
                </div>

                <div style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 5px;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                    {{ __('index.message_paypal3') }}
                    <br>
                </div>


                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    <strong class="text-danger">
                        {{__('index.message_paypal2')}} 
                    </strong>
                    <br>
                </div>

                <div class="mt-2">
                    <center>
                        <button class="color" data-dismiss="modal" aria-label="Close" style="
                            padding: 8PX 24PX;
                            background-color: #cecece;
                        ">Cancel</button>
                        <a href="{{ $paypal_state->url }}" target="_blank" class="color">
                            {{ __('index.min_paypal')}} <span id="min"></span>
                        </a>
                        <a href="https://www.paypal.com/signin" target="_blank" class="color">PayPal.com Login</a>
                    </center>
                </div>
            </div> --}}

            <div class="modal-body" style="padding: 20px 30px">
                <div class="text-center mb-2">
                    <img loading="lazy" src="https://d31dn7nfpuwjnm.cloudfront.net/images/valoraciones/0033/7299/Como_retirar_dinero_de_PayPal_en_Colombia.png?1555502328" class="img-fluid" alt="" style="width: 200px">
                </div>
        
                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    {{__('index.message_paypal')}}
                    min: <span id="calculatorPaypal"></span> <br>
                    {{__('index.message_paypal1')}} 
                </div>
        
                <div style="background-color: rgba(183, 205, 232, 1);font-size: 21px;border-radius: 5px 5px 0px 0px;;padding: 10px;"><p style="margin-bottom: 0px;">
                    @lang('index.sendMoneyPaypal')</p><span style="font-weight: bold;color: #003187;">paypal-deposits@damecoins.co.uk</span><br>
                    {{-- @lang('index.sendMoneyPaypal')</p><span style="font-weight: bold;color: #003187;">paypal@damecoins.co.uk</span><br> --}}
                </div>
        
                <div style="background-color: rgb(200 223 251);font-size: 13px;border-radius: 0px 0px 5px 5px;;padding: 10px;font-style: italic;font-weight: bold;color: #1f5594;">
                    {{ __('index.message_paypal3') }}
                    <br>
                </div>
        
                <div style="border-radius: 5px; font-size: 13px; padding: 10px;">
                    <strong class="text-danger">
                        {{__('index.message_paypal2')}}
                    </strong>
                </div>
                
        
                <div class="mt-2">
                    <center>
                        <button class="color" data-dismiss="modal" aria-label="Close" style="padding: 8PX 24PX;background-color: #cecece;">Cancel</button>
                        <a href="https://www.paypal.com/signin" target="_blank" class="color">PayPal.com Login</a>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function newPaypal()
        {
            currency = '{{ $getCurrencyUser->code }}';
            calculateMinimumPaypal(currency)
            .then((data) => {
    
                $('#calculatorPaypal').html(`${data.minUsd} (${data.min})`);
                $('#min').html(`min(${data.min})`);
                // $("#ModalPaypal").modal("show");
            })
            .catch(err => console.log(err));
        }

        newPaypal();
</script>
    
@endsection

<script>

                function paypal(){
  currency = '{{ $getCurrencyUser->code }}';
  calculateMinimumPaypal(currency).then((data)=>{
    swal( "{{__('index.message_paypal')}}" +" min: "+ data.minUsd+" ("+ data.min+")" + "{{__('index.message_paypal1')}}", {
        buttons: {
          free: {
            text: "{{ __('index.cancel_paypal')}}",
            value: "cancel",
          },
          login: {
            text: "{{ __('index.min_paypal')}}" +" min("+ data.minUsd+")" ,
            value: "paypal",
          },

        },
      })
      .then((value) => {
        switch (value) {
          case "paypal":
            window.location="{{ $paypal_state->url }}";
            //swal("Login", "success");
            break;

          case "cancel":
            break;

        }
      });
  })

    .catch(data => {
       /*
         swal({
            text: "{{ __('home_buy.minimun', ['type' => 'CARD' ]) }}"+' ('+data.limit+' USD)',
            icon: "error",
          });
          */
    });

}

function calculateMinimumPaypal(currency){

              return new Promise((resolve, reject) => {

                  jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}",
                        }
                  });

                   $.post("/calculate-minimun-paypal", { "currency": currency})
                    .done(function( data ) {


                      if(data.success== 'true'){
                          //reject(data);
                         // alert("si");
                          resolve(data);
                      }
                      reject();

                  });

              });
            }

</script>

@endif