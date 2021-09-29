<!--superpay-->
<div class="row">
  <div class="col-md-6">
    <form action="{{route('payment-pay-buy')}}" method="post" id="paymentPayDeposit" name="paymentPayDeposit" style="padding:25px">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{ $default->id }}">
      <input type="hidden" name="first" value="{{Auth::user()->name}}" data-recurly="first_name"
        id="first_name">
      <input type="hidden" name="last" value="{{Auth::user()->lastName}}" data-recurly="last_name"
        id="last_name">
      <input type="hidden" value="{{Auth::user()->country->cod_iso2}}" data-recurly="country"
        id="country">

      <div class="row">
        <div class="col-md-6">
          <p>@lang('home_deposit.quanty')</p>
        </div>
      </div>

      <div class="row" style="background-color:#ccc;padding:20px;margin:5px">
        <div class='col-sm-10'>
          <div class="input-group">
            <input id="totalD" class='form-control' type="number" name='monto' required
              autocomplete="off">
            {{--    <span class="input-group-addon" style="background-color:#367fa9;color:#fff;font-weight:bold"><i class="glyphicon">{{$default->code}}</i></span>
            --}}
            <div class="input-group-prepend">
              <div class="input-group-text color-input">{{$default->code}}</div>
            </div>
          </div>
        </div>
      </div>

    <div class="card-body">
                    <div class="panel panel-info" style="padding:20px!important;border:solid 1px #ccc">

          <div class="d-flex justify-content-center">
                        <div class="align-self-center">
                        <img class="img-responsive" style="height:50px" src="{{asset('img/kindpng.png')}}">
                        </div>
                     </div>

          <div class="d-flex justify-content-center">
                        <div class="align-self-center">
                 <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px">
                      @lang('index.paycard')
              </label>
                        </div>
                     </div>



              <!--tarjeta-->
          <div class="row">
            <div class="col-md-12 mb-3">
                <label for="validationCustomUsername">@lang('index.card_type')</label>
                <div class="input-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text" id="">
                  <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
                </span>
                   </div>
                   {!!Form::select('card_type', [
                 "VISA"=>"VISA",
                 "MASTERCARD"=>"MASTERCARD",
                 "AMEX"=>"AMEX",
                 "CABAL"=>"CABAL",
                 "NARANJA"=>"NARANJA",
                 "CENCOSUD"=>"CENCOSUD",
                 "SHOPPING"=>"SHOPPING",
                 "ARGENCARD"=>"ARGENCARD"], ' ', [
                                'id' => 'card_type',
                                'class' => 'form-control',
                'required'=>'required'
                            ])!!}
                </div>
              </div>
          </div>
              
          <!--tarjeta-->
          <div class="row">
            <div class="col-md-12 mb-3">
                <label for="validationCustomUsername">@lang('index.tarjeta')</label>
                <div class="input-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text" id="">
                  <i class="fa fa-credit-card" style="color:rgb(6, 88, 118)"></i>
                </span>
                   </div>
                   <input onkeypress="return checkDigit(event)" maxlength="19" type="text" class="form-control" id="cc" placeholder="41111-1111-1111-1111" required>
              
                </div>
              </div>
          </div>
              <!--fecha de caducidad-->
          <div class="row">
              
            <div class="col-md-12 mb-3">
                <label for="validationCustomUsername">@lang('index.fecha')</label>
                <div class="d-flex">
              
                  <div class="input-group col-md-6">
                       <div class="input-group-prepend">
                         <span class="input-group-text" id="">
                     <i class="fa fa-calendar-o" style="color:rgb(6, 88, 118)"></i>
                    </span>
                       </div>
                     <input onkeypress="return checkDigit(event)" name="code_expire_month" required id="mm" value="" type="tel" pattern="[0-9]*" spellcheck="false" autocapitalize="none" autocorrect="off" class="form-control valid" placeholder="Mes(MM)" title="Month(MM)" maxlength="2" aria-required="true" autocomplete="cc-exp-month" style="border-radius: 4px;padding-left: 35px;font-size: 14px;" aria-invalid="false">
                    </div>
              
                  <div class="input-group col-md-6">
                    <div class="input-group-prepend">
                           <span class="input-group-text" id="">
                       <i class="fa fa-calendar" style="color:rgb(6, 88, 118)"></i>
                      </span>
                         </div>
                    <input onkeypress="return checkDigit(event)"name="code_expire_year" required id="yy" value="" type="tel" pattern="[0-9]*" 	spellcheck="false" autocapitalize="none" autocorrect="off" class="form-control" 	placeholder="Year(AA)" title="Year(AA)" maxlength="2" aria-required="true" 	autocomplete="cc-exp-year" style="border-radius: 4px;padding-left: 35px;font-size: 	14px;">
                  </div>
                                 </div>
              </div>
          </div>
              
          <div class="row">
            <div class="col-md-12 mb-3">
                <label for="validationCustomUsername">@lang('index.cvv')</label>
                <div class="input-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text" id="">
                     <i class="fa fa-lock" style="color:rgb(6, 88, 118)"></i>
                </span>
                   </div>
                   <input onkeypress="return checkDigit(event)" type="text" class="form-control"id="cv" value="" name="cvv" placeholder="CVV" style="" maxlength="4" required aria-required="true">
              
                </div>
              </div>
          </div>
              
              
          <div class="row">
                      <div class="col-md-12 mb-3">
                       <button class="btn btn-success btn-block mb-4 font-weight-bold" id="confirm-purchase"> @lang('home_deposit.mesagge') {{ $default->code }}</button>
                      </div>
          </div>


          </div>
      </div>
  </div>
</div>
<script>

  document.querySelector('#paymentPayDeposit').addEventListener('submit', function (event) {
    event.preventDefault();
    var totalx = $('input[name="monto"]').val();
    currency="{{ $default->code }}";
  
    calculateMinimumFasterx(currency,totalx).then(()=>{
    
      var data = {
          'total':totalx,
          'cv':$("#cv").val(),
          'mm': $("#mm").val(),
          'yy': $("#yy").val(),
          'cc': $("#cc").val(),
       'card_type': $("#card_type").val(),
          'idCurrency':'{{ $default->id }}',
          'idCrypto':'{{ $default->id }}',
          'currency': '{{ $default->code }}',
           "_token": "{{ csrf_token() }}",
        }
        console.log(data);
      var ajax = $.ajax({
           url: "/payment-pay-deposit",
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
      
               window.location.href="https://damecoins.com/home";
      
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
        text: "{{ __('home_buy.minimun_faster') }}"+ data.min +". "+ "{{ __('home_buy.maximo_faster') }}" +data.max,
        icon: "error",
        });
      
  });
  
  });

</script>