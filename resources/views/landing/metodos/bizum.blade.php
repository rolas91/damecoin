<style>
    @media only screen and (max-width:362px){
       .content-text-btn
       {
          font-size: 15px!important;
       }
    }
 
    .datos-envio {
     background: #fff;
     border-radius: 5px;
     display: grid;
     -webkit-box-align: center;
     -ms-flex-align: center;
     align-items: center;
 }
 </style>
 
 <link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
 <style>
    .intl-tel-input {
       position: relative;
       display: block;
   }
 
   #card_type, #cc, #mm, #yy, #cv, #sq-expiration-date, #sq-postal-code {
     background: #d8d9dc!important
 }
 </style>
 

 
 <div class="modal fade" id="minandmax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-body">
             <span class="txt-color-landing">Sorry, your operation cannot continue.</span>
             <ul class="ul p-0 m-0 mb-2 mt-2">
                <li class="d-block">
                   Minimum amount: <b>USD {{$limit_pay[0]->card_minimum}}</b> <span class="itemFiat">(232.22 <b id="fiatModal"></b>)</span>
                </li>
                <li class="d-block">
                   Maximum amount: <b> USD {{$limit_pay[0]->card_maximum}}</b>  <span class="itemFiat2">(9833.22 <b id="fiatmodal2"></b>)</span>
                </li>
             </ul>
             <span class="small">
             Please correct the amount and try again. Remember that you can make the purchase in multiple card payments if you need it or log in and use bank transfer for large amounts (+10,000 USD). Thanks for using Damecoins.
             </span>
          </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
       </div>
    </div>
 </div>
 
 
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
             <input type="hidden" name="pricecurrency" id="pricecurrency" value="{{$panel['pagar']}}">
             <input type="hidden" name="min_limit" value="{{$limit_pay[0]->card_minimum}}">
             <input type="hidden" name="max_limit" value="{{$limit_pay[0]->card_maximum}}">
             <form
                method="POST"
                id="paymentPay"
                role="form" >
                
 
                <div class="row sign">
                   <div class="col-md-12 d-flex justify-content-start align-items-center flex-wrap">
                      <img class="mr-3" src="{{asset('assets/img/form-bizum/Ellipse58.png')}}" alt="">
                      <h5 class="font-weight-bold">Pago con Bizum</h5>
                      <small class="ml-auto font-size-xsmall"> <img src="{{asset('img/alert-circle.png')}}" alt="">  {{ $data->amount }} USD ({{ $default['conversor'] }} EUR)</small>
                  </div>
 
                   <div class="col-md-12 ">
                      <div>
                         <div class="card-pasos ">
                            <span class="icon line">1</span>
                            <div>
                               <p class="m-0 font-size-small">
                                  Envia los <strong  id="mirror" class="h6">  </strong> <strong>{{ $getCurrencyUser->code }}</strong> al siguiente numero de telefono en los proximos 15 minutos
                               </p>
                               <div class="datos-envio mt-3 p-2">
                                   <div>
                                        <strong class="font-size-small">@lang('index.form_name'):</strong>
                                        <img src="{{ asset('assets/img/formWesternUnion/SamiHalawa.png')}}" alt="">
                                        <span class="font-size-xsmall"><i class="fa fa-long-arrow-right"></i></span>
                                   </div>
                                    <p class="color-succes font-size-small m-0">
                                     @lang('index.solicitarBizum')
                                    </p>
                               </div>
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

 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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


    $('.base').keyup(function() {
      $('#mirror').text($('#persoCurrency').val() ?? '0');
    });

    $('.base').click(function() {
      $('#mirror').text($('#persoCurrency').val() ?? '0');
    });
    

    //////////////////////
    $('.person').click(function(){
      $('#mirror').text($('#' + this.id).val());
    })

    ////////////////////
 
    $('#botomShowModal').click(function() {
       let email = $('#email2').val();
       
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
 
    $('#botom').click(() => {
 
       let email = $('#email').val();
       let name = $('#name').val();
       let lastname = $('#lastname').val();
       let getCountry = $('#getCountry').val();
       
       if(email == null || email == '' || name == null || name == '' || lastname == null || lastname == '' || getCountry == null || getCountry == '') return false;
 
    
       var totalx = totalPay();
       var formData = new FormData();
       formData.append('email',email);
       formData.append('surname',lastname);
       formData.append('country',getCountry);
       formData.append('name',name);
       formData.append('amount',totalx);
       formData.append("idCurrency", '{{ $getCurrencyUser->id }}');
       formData.append("idCrypto", '{{ $getCriptodefault->id }}',);
       formData.append( "currency", '{{ $getCurrencyUser->code }}');
       formData.append("_token", "{{ csrf_token() }}");
       formData.append( "method", '{{ $metodo }}');
 
          let url = "{{ url('/registerForm') }}";
          $.ajax({
             url: url,
             type: 'post',
             data: formData,
             dataType: 'JSON',
             contentType: false,
             processData: false,
             success: function(res) {
                if(res.status == 1)
                {
                   // Cierra modal
                $("#createModal").modal("hide");
                   
                   //Activa modal
                   $("#success").modal("show");
 
                   //Limpia Campos
                   $('#email2').val('');
                   $('#email').val('');
                   $('#name').val('');
                   $('#lastname').val('');
                   $('#getCountry').val('');
                   
                   setTimeout(() => {
                      //Redireccion
                      window.location.href = '/login';
                   }, 10000);
                }else{
                   $("#problem").modal("show");
                   $("#createModal").modal("hide");
                }
             }
          });
    });
    
 </script>
 <script>
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
 
    function totalPay() {
       var totalx = null;
       if ($("input[type='radio'].person").is(':checked')) {
          totalx= $("input[type='radio'].radioBtnClass:checked").val();
       } else {
          totalx = $("#persoCurrency").val();
       }
       return totalx;
    }
 
    
    totalPay();
    
   function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
     try {
       decimalCount = Math.abs(decimalCount);
       decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
 
       const negativeSign = amount < 0 ? "-" : "";
 
       let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
       let j = (i.length > 3) ? i.length % 3 : 0;
 
       return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
     } catch (e) {
       console.log(e)
     }
   };
 </script>