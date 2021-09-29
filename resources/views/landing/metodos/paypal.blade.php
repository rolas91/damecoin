<link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
<style>
   @media only screen and (max-width:362px){
      .content-text-btn
      {
         font-size: 15px!important;
      }
   }
   <style>
   .intl-tel-input {
      position: relative;
      display: block;
  }

  #card_type, #cc, #mm, #yy, #cv, #sq-expiration-date, #sq-postal-code {
    background: #d8d9dc!important
}
</style>


<div class="modal fade" id="modalFailTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <span class="txt-color-landing">Transaction declined! </span>
            <ul class="ul p-0 m-0 mb-2 mt-2">
               <li class="d-block">
                 Money was not charged. Reason: Limited requests We recommend you to contact your bank or to try a different card. 
               </li>
               <li class="d-block">
                 Please be aware that for your security you only have a limited number of payment attempts per card per day￼. Input carefully.
               </li>
               
            </ul>
         </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
   </div>
</div>


{{-- Create Acc --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">New Orden</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label for="name">@lang('signup.name')</label>
               <input type="text" class="form-control" placeholder="@lang('signup.name')" name="name" id="name" value="{{ old('name') }}" required>
             </div>
 
             <div class="form-group">
               <label for="name">@lang('signup.lastName')</label>
               <input type="text" class="form-control" placeholder="@lang('signup.lastName')" name="lastname" id="lastname" value="{{ old('lastname') }}" required>
             </div>
 
             <div class="form-group">
               <label for="email">@lang('signup.email')</label>
               <input type="email" class="form-control" placeholder="@lang('signup.email')" name="email" id="email" value="{{ old('email') }}" required>
             </div>
 
             <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
               <label for="email" class="col-md-12 control-label p-0">@lang('signup.country')</label>
               <div class="col-md-12 p-0">
                       {!!Form::select('country', $getCountry, '', [
                           'id' => 'getCountry',
                           'class' => 'form-control',
                           'placeholder' => __('signup.country'),
                           'required'=>'required'
                       ])!!}
               
                   @if ($errors->has('country'))
                       <span class="help-block">
                           <strong>{{ $errors->first('country') }}</strong>
                       </span>
                   @endif
               </div>
            </div>

            <div id="msgError"></div>
  
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-green w-100 mb-3 mt-2" id="botom">
               @lang('index.btonComprar')
            </button>
        </div>
      </div>
   </div>
</div>
{{-- End Create Acc --}}

<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="sweetAlert">
               <div class="icon success animate">
                  <span class="line tip animateSuccessTip"></span>
                  <span class="line long animateSuccessLong"></span>
                  <div class="placeholder"></div>
                  <div class="fix"></div>
               </div>
               <h2>Congratulations, your purchase is complete.

                  <br>

                  please verify your email, we will send you a password</h2>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="Problem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="icon error animateErrorIcon">
               <span class="x-mark animateXMark">
               <span class="line left"></span>
               <span class="line right"></span>
               </span>
            </div>
            <h2>There was a problem, try in a moment</h2>
         </div>
      </div>
   </div>
</div>
<div class="row d-none">
   <div class="col-md-12">
      <div class="form-row">
         <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px;padding: 0 25px;">
         @lang('index.paycard')
         </label>
      </div>
   </div>
</div>
<div class="col-md-12 pl-0 pr-0">
   <div class="form-crypto">
      <div class="card-body p-0">
         <div class="panel panel-default mt-2">
              {{-- 
            <input type="hidden" name="pricecurrency" id="pricecurrency" value="{{$panel['pagar']}}">
            <input type="hidden" name="min_limit" value="{{$limit_pay[0]->card_minimum}}">
            <input type="hidden" name="max_limit" value="{{$limit_pay[0]->card_maximum}}">
            --}}
            <form
               method="POST"
               id="paymentPay"
               role="form" >
               

               <div class="row sign">
                  <div class="col-md-12 d-flex justify-content-start align-items-center flex-wrap">
                     <img class="mr-3" src="{{asset('img/Ellipse58Paypal.png')}}" alt="">
                     <h5 class="font-weight-bold">@lang('index.pagoPaypal')</h5>
                     <small class="ml-auto font-size-xsmall"> <img src="{{asset('img/alert-circle.png')}}" alt="">  {{ $data->amount }} USD ({{ $default['conversor'] }} EUR)</small>
                 </div>

                 <div class="col-md-12 mt-3">
                     <p class="mx-0 font-size-small">
                         @lang('index.TextGeneric1') 
                        {{ $data->amount }} USD ({{ $default['conversor'] }} EUR)
                        @lang('index.TextGeneric2') 
                     </p>
                 </div>

                  <div class="col-md-12 ">
                     <div>
                        <div class="card-pasos ">
                           <span class="icon line">1</span>
                           <div class="card-blue p-2">
                              <p class=" font-size-normal m-0 color-succes">@lang('index.enviar') <span class="h6 color-succes" id="pay"></span> @lang('index.usd')</p>
                              <p class=" h6 m-0">{{ $limit_pay[0]->paypal_email}}</p>
                           </div>
                     </div>

                     <div class="card-pasos mt-3">
                           <span class="icon">2</span>
                           <div class="container-email-2">
                              <div class="row">
                                 <div class="col-6">
                                    <h6>@lang('index.correoElectronico')</h6>
                                    <p class="font-size-small">@lang('index.sinAccount')
                                    <a class="font-size-small" href="#">@lang('index.register')</a> )</p>
                                 </div>
                                 <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Email" id="email2">
                                    <span style="color:red;" id='emailRequired'></span>
                                 </div>
                              </div>
                        </div>
                     </div>
                     </requiredsv>
                  </div>

                 <div class="col-md-12 mt-3">
                     <p class="m-0">
                        @lang('index.verificamos')
                     </p>
                 </div>

                 <div class="col-md-12 mt-3">
                    <a href="javascript:void(0)"  class="btn btn-block button-gradient-blue-large py-3 " id="botomShowModal">
                   
                        @lang('buyWithSkrill.sendpay')
                     </a>
                 </div>

                 <div class="col-md-12 mt-3">
                     <div class="d-flex justify-content-center align-items-center flex-wrap ">

                         <strong class="m-0 mr-2 color-succes h4 font-weight-bold contador" ></strong>
                         <small class="m-0 font-size-xsmall color-succes">@lang('index.quedan')</small>

                         <div class="progress progress-gradient ml-2">
                             <div class="progress-bar " role="progressbar" id="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                         </div>

                     </div>

                     <p class="font-size-small text-muted text-center m-0 mt-2">
                        @lang('index.crypto')
                     </p>

                 </div>
               </div>
            </form>

          

         </div>
      </div>
   </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
        let scrAlipay = '{{$limit_pay[0]->qr_alipay}}'
        let scrWechat = '{{$limit_pay[0]->qr_wechat}}'

        console.log($("#container-qrs"))
        $("#container-qrs").append(`
          <img class="size_qr" src="/methodpayQR/qr_index_new.jpg" data-toggle="modal" data-target="#QrPayPaymentModal" />
          <img class="size_qr" src="/methodpayQR/${scrWechat}" data-toggle="modal" data-target="#WechatPayPaymentModal" onclick="newWechatpay()"/>
          <img class="size_qr" src="/methodpayQR/${scrAlipay}" data-toggle="modal" data-target="#AlipayPaymentModal" onclick="newAlipay()"/>
        `)
    })
var Time = 15 * 60; // 900s // 15 Minutos
var progressBar = Time;

   setInterval(() => {
   
      if(Time == 0) {

         // bloked();
         return false;
      };
      
      --Time;
      var sec, min, hour;

      if(Time<3600){
         var a = Math.floor(Time/60); //minutes
         var b = Time%60; //Time

         min = a < 10 ? `0${a}`: a;

         sec = b < 10 ? `0${b}`: b;

         $('.contador').html(`00:${min}:${sec}`);
      }

      var cont = parseInt((Time * 100) / progressBar);

      $('#progressbar').width(`${cont}%`);

   }, 1000);

   $('#btn-from').click(function(e){
      e.preventDefault();
   });

   $('#botomShowModal').click(function() {
      let email = $('#email2').val();
     // alert("si");
      if(email == '' || email == null)
      {
         $('#email2').css({"border": "1px solid red"})
         $('#emailRequired').html('Required');

         setTimeout(() => {
            $('#emailRequired').html('');
         }, 5000);
         
         return false;
      }else{
         $('#email').val(email);
         $("#createModal").modal("show");
      }
   });



   
</script>

