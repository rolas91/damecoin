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
 
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-body">
             Please create a free account first and log in to make a purchase. 
             <a class="link" href="/signup" style="    background: #4f8aff;
                color: white;
                padding: 5px 12px;
                border-radius: 9px;
                font-size: 15px;">SIGN UP</a>
             I already have an account
          </div>
       </div>
    </div>
 </div>
 
 <div class="modal fade" id="viewExample" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             View example
          </div>
          <div class="modal-body">
            
          </div>
       </div>
    </div>
 </div>
 
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

<div class=" banner-principal-two ">
    <div class="container" style="margin-top: 5%">
          <div class="row">
              <div class="col-12 col-lg-5">

                  <div class="d-flex justify-content-start align-items-center ">
                      {{-- <img class="icon-coin" src="assets/img/detalle-metodo-pago/5a3a27023146b31.png" alt=""> --}}
                      <img class="icon-coin" src="{{ asset('assets/img/form-transferencia/Group185.png') }}" alt="">
                  </div>
                 
                  <h2 class="text-white font-weight-bold mt-3">
                    @lang('index.TransfeBank')
                    {{-- @lang('index.title_new_left2') --}}
                  </h2>
                  <p class="text-white">
                    {{-- @lang('index.new_sub_title') --}}
                  </p>

                  
                  <ul class="list-punto-light mt-4">
                    <li class="p-description">
                        @lang('index.mesagge1')
                     </li>
                     <li class="p-description">
                        @lang('index.mesagge2')
                     </li>
                     <li class="p-description">
                        @lang('index.mesagge3') {{$getCriptodefault->code}} @lang('index.mesagge3-1') {{$getCurrencyUser->code}} @lang('index.mesagge3-2')
                     </li>
                  </ul>

              </div>
              
              <div class="col-12 col-lg-7 mt-4">
                  <div class="card card-compra-instantanea ">
                      <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-md-6 ">
                                <strong>@lang('index.buydivisa')</strong>
    
                                <div class="container-select-list mt-2">
                                    <div class="icon"> 
                                        <span class="mr-2">{{$getCriptodefault->code}} </span>
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>
                                    {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                                        'id' => 'getCryptosss',
                                        'class' => 'selectpicker'
                                        ])
                                    !!}
                                </div>
    
    
                            </div>
                            <div class="col-12 col-md-6 ">
                                <strong >@lang('index.paydivisa')</strong>
    
                                <div class="container-select-list mt-2">
                                    <div class="icon"> 
                                        <span class="mr-2" id="pay" >{{$getCurrencyUser->code}} </span>
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>
                                    {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                                        'id' => 'getCurrenciesss',
                                        'class' => 'selectpicker'
                                    ])!!}
                                </div>
    
                            </div>
                        </div>

                        <h6  class="font-weight-bold mt-3">@lang('index.mount')</h6>

                        <div class="row">
                            @foreach($getPanel as $index => $panel)
                                <div class="col-12 col-md-6 mt-3">
                                    <div class="input-radio-option">
                                        @if($index == 2)
                                            <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}"  class="radioBtnClass2"  name="amount" checked>
                                        @else
                                            <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}"  class="radioBtnClass2"  name="amount">
                                        @endif
    
                                    
                                        <div class="card-radio">
                                            <div class="icon mr-auto"></div>
                                            <p>
                                                <small>@lang('index.pay')</small> <br>
                                                <span>
                                                    {{$panel["pagar"]}}
                                                    {{$getCurrencyUser->code}}
                                                </span>
                                            </p>
                                            <p class="signo">=</p>
                                            <p>
                                                <small>@lang('index.get')</small> <br>
                                                <span>
                                                    {{$panel["recibir"]}}
                                                    {{$getCriptodefault->code}}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
    
                                </div>
                            @endforeach
                        </div>

                        <h6  class="font-weight-bold mt-3">@lang('index.otherQuantity')</h6>


                        <div class="row">
                            <div class="col-12 col-md-6">
    
                                <div class="input-group input-group-cantidad mb-3">
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="personasCryptos" aria-describedby="buyHelp" value="{{$default['recibe']}}" onKeyPress="return soloNumeros(event)">
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                          {{-- <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt=""> --}}
                                          {{$getCriptodefault->name}}
                                      </span>
                                    </div>
                                  </div>
    
                            </div>
                            <div class="col-12 col-md-6">
    
                                <div class="input-group input-group-cantidad mb-3">
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)" id="personasCurrencys" onkeyup="document.getElementById('customBuy').value=this.value; newChecked(this);">
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                          {{-- <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt=""> --}}
                                          {{$getCurrencyUser->name}}
                                      </span>
                                    </div>
                                  </div>
    
                            </div>
                        </div>

                        <div class="row card-transferencia py-3 ">
                            <div class="col-12 d-flex justify-content-start align-items-center flex-wrap">
                                <img class="mr-3" src="assets/img/form-transferencia/Group185.png" alt="">
                                <h5 class="font-weight-bold">@lang('index.TransfeBank')</h5>
                                <small class="ml-auto font-size-xsmall color-succes"> <img src="assets/img/formWesternUnion/alert-circle1.png" alt=""> 
                                    Minimum 400 USD (368.23 EUR)</small>
                            </div>

                            <div class="col-12 mt-3">
                                <p class="font-size-small m-0">Bank Transfer Minimun deposit amount: min: 400 USD (337.88 EUR) If you send less money your wallet will not be charged. Do not test with small amounts, those won't be processed as the server is saturated!  Your Damecoins Wallet will be added value in 1-3h Speed it up by talking to our 24/7 chat. </p>
                            </div>

                            <div class="col-12 mt-3">
                                <p class="m-0 font-weight-bold font-size-normal color-succes ">
                                    Transfer the amount to one of the following banks:
                                </p>

                                @foreach ($banks as $item)
                                    <div class="container-small-acordion mt-2">
                                        <input type="radio" name="banco" id="">
                                        <div class="datos">
                                        <img src="assets/img/form-transferencia/Ellipse13.png" alt="">
                                        <div class="">
                                                <p class="font-size-normal m-0">{{ $item->name }}</p>
                                                <div class="info ">
                                                    <p class="font-size-small my-0 mr-2">Banck account: {{ $item->numero_cuenta }}</p>
                                                    <p class="font-size-small my-0 mr-2">Swift: {{ $item->swift }}</p>
                                                    <p class="font-size-small my-0  ">ABA: {{ $item->swift }}</p>
                                                </div>
                                        </div>
                                        <span class="icon"><i class="fas fa-angle-down"></i></span>
                                        </div>
                                    </div>                                    
                                @endforeach

                            </div>


                            <div class="col-12 mt-3">
                                <div class="card-pasos">
                                    <span class="icon line">1</span>
                                    <div class="d-flex justify-content-start align-items-center flex-wrap">
                                        <div>
                                            <h6>Upload you receipt</h6>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#viewExample">View example</a>
                                        </div>
                                        <input type="file" required name="file" id="file" class="btn btn-secondary btn-secondary-custom mx-auto ml-lg-auto mr-lg-0 px-4 font-size-normal">
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mt-3">
                                 <div class="card-pasos">
                                    <span class="icon">2</span>
                                    <div class="container-email-2">
                                         <div>
                                            <h6>@lang('index.correoElectronico')</h6>
                                            <p class="font-size-small">@lang('index.sinAccount')
                                                <a class="font-size-small" href="#">@lang('index.register')</a> )</p>
                                         </div>
                                         <div>
                                             <input type="email" class="form-control" placeholder="Email" id="email2" name="email2" required>
                                             <span style="color:red;" id='emailRequired'></span>
                                         </div>
                                    </div>
                                 </div>
                            </div>

                            <div class="col-12 mt-3">
                                <p class="m-0">
                                    @lang('index.verificamos')
                                </p>


                            </div>

                            <div class="col-12 mt-3">
                                <a href="javascript:void(0)" class="btn btn-block button-gradient-blue-large py-3 " id="botomShowModal" >
                                    @lang('buyWithSkrill.sendpay')
                                </a>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-center align-items-center flex-wrap ">

                                    <strong class="m-0 mr-2 color-succes h4 font-weight-bold contador"></strong>
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
                        
                        {{-- <div class="d-flex justify-content-center align-items-center mt-3 container-or">
                            <span>Or</span>
                        </div> --}}
                        
                        {{-- @include('partials.formPayU') --}}

                       {{-- <button class="btn btn-primary btn-blue-custom btn-block  py-3">Compra instantanea con tarjeta</button> --}}

                       <div class="img-form mt-3">
                           <img class="img-fluid" src="assets/img/formulario/Rectangle117.png" alt="">
                           <img class="img-fluid" src="assets/img/formulario/Rectangle118.png" alt="">
                           <img class="img-fluid" src="assets/img/formulario/Rectangle119.png" alt="">
                           <img class="img-fluid" src="assets/img/formulario/Rectangle120.png" alt="">
                           <img class="img-fluid" src="assets/img/formulario/Rectangle121.png" alt="">
                           <img class="img-fluid" src="assets/img/formulario/Rectangle122.png" alt="">
                       </div>
 
                       <div class="row justify-content-lg-between mt-3">
                            <div class="d-flex justify-content-center align-items-center flex-wrap mt-3" style="width: 100%;">
                                <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.comiciones')</p>
                                <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.inmediato')</p>
                                <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.proceso')</p>
                            </div>

                            <center style="width: 100%;">
                                <a href="#" class=" link " >@lang('index.verMetodos')</a>
                            </center>
                      </div>
                  </div>
              </div>
          </div>
    </div>
  </div>

  @section('js')
      
  <script type="text/javascript">


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
          let file = $('#file').val();
          
          if(email == '' || email == null || file == '' || file == null)
          {
             $('#email2').css({"border": "1px solid red"})
             $('#emailRequired').html('Required');
             $('#fileRequired').html('Required');
             
    
             setTimeout(() => {
                $('#emailRequired').html('');
                $('#fileRequired').html('');
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
          let file = $('#file')[0].files[0];
    
          
          
          if(email == null || email == '' || name == null || name == '' || lastname == null || lastname == '' || getCountry == null || getCountry == '') return false;
    
          var totalx = totalPay();
          var formData = new FormData();
          formData.append('img',file);
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
                console.log(res);
                $("#createModal").modal("hide");
                $("#success").modal("show");
    
                //  Limpia Campos
                $('#email2').val('');
                $('#email').val('');
                $('#name').val('');
                $('#lastname').val('');
                $('#getCountry').val('');
                
                setTimeout(() => {
                   //Redireccion
                   window.location.href = '/login';
                }, 10000);
             }
          });
       });
       
    
       function GetCardType(number)
       {
           // visa
           var re = new RegExp("^4");
           if (number.match(re) != null)
               return "Visa";
       
           // Mastercard 
           // Updated for Mastercard 2017 BINs expansion
            if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number)) 
               return "Mastercard";
       
           // AMEX
           re = new RegExp("^3[47]");
           if (number.match(re) != null)
               return "AMEX";
       
           // Discover
           re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
           if (number.match(re) != null)
               return "Discover";
       
           // Diners
           re = new RegExp("^36");
           if (number.match(re) != null)
               return "Diners";
       
           // Diners - Carte Blanche
           re = new RegExp("^30[0-5]");
           if (number.match(re) != null)
               return "Diners - Carte Blanche";
       
           // JCB
           re = new RegExp("^35(2[89]|[3-8][0-9])");
           if (number.match(re) != null)
               return "JCB";
       
           // Visa Electron
           re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
           if (number.match(re) != null)
               return "Visa Electron";
       
           return "";
       }
    </script>
    <script>
       function checkDigit(event) {
           var code = (event.which)
               ? event.which
               : event.keyCode;
       
           if ((code < 48 || code > 57) && (code > 31)) {
               return false;
           }
       
           return true;
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
    
       function totalPay() {
          var totalx = null;
          if ($("input[type='radio'].person").is(':checked')) {
             totalx= $("input[type='radio'].radioBtnClass:checked").val();
          } else {
             totalx = $("#persoCurrency").val();
          }
          return totalx;
       }
    
       // function totalPay() {
       
       
       //  var currencyShow = $("#getCurrencies").val();
       //  var amount_radio = $("input[name='amount']:checked").val();
       
       
       
       //  if(currencyShow != 'USD'){
       //   $(".itemFiat").css('display', 'inline-block');
       //   $(".itemFiat2").css('display', 'inline-block');
       //  }
       
       
       
       //  if(amount_radio){
       //       console.log('aqui estoy ok');
       //      totalx = amount_radio;
       //  } else {
       
       
       //      if ($("input[type='radio'].person").is(':checked')) {
       //          //alert("si person");
       //          totalx = $("input[type='radio'].radioBtnClass:checked").val();
       //      } else {
       //          totalx = $("#persoCurrency").val();
       //          //console.log(totalx);
       //      }
       
           
       //  }
       
       // return;
       
       //  if(currencyShow == 'COP' ||
       //      currencyShow == 'CLP' ||
       //      currencyShow == 'ARS' ||
       //      currencyShow == 'PEN' ||
       //      currencyShow == 'BOB' ||
       //      currencyShow == 'CRC' ||
       //      currencyShow == 'GTQ' ||
       //      currencyShow == 'HNL' ||
       //      currencyShow == 'NIO' ||
       //      currencyShow == 'PYG' ||
       //      currencyShow == 'DOP' ||
       //      currencyShow == 'UYU' ||
       //      currencyShow == 'CKK' ||
       //      currencyShow == 'IDR' ||
       //      currencyShow == 'ZAR' ||
       //      currencyShow == 'TRY' ||
       //      currencyShow == 'KRW' ||
       //      currencyShow == 'AED'){
       
       //      var privateCurrency = totalx;
       
       //       $.ajax({
       //           url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=${currencyShow}&to=USD&amount=${privateCurrency}`,   
       //           dataType: 'jsonp',
       //           success: function(data) {
       //               console.log(data);
       //               pricesInModal();
       //               var usd_converter = data.result.toFixed(2);
       
       //               if(usd_converter >= Number($("input[name='min_limit']").val()) &&
       //                 usd_converter <= Number($("input[name='max_limit']").val())){
       //                 if($(".block-pay").length){
       //                   $(".block-pay").remove();
       //                 }
    
       //                 $("#confirm-purchase").removeAttr('disabled');
    
       //               } else {
       
       //                 if(!$("#paypal-button-container .block-pay").length){
       
       
       //                   if($("#paypal-button-container iframe").height() >= 200){
       //                     $("#paypal-button-container").append('<div class="block-pay height-pay"></div>');
       //                   } else {
       //                     $("#paypal-button-container").append('<div class="block-pay"></div>');
       //                   }
       
       //                   $("#minandmax").modal();
       //                   $("#confirm-purchase").attr('disabled', 'disabled');
       
       //                 }
       //               }
       
       //               $("#pricecurrency").val(data.result.toFixed(2));
       //           }
       //       }); 
       
       
       //   }else{
       
       //      var privateCurrency = totalx;
       
       //      $.ajax({
       //           url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=${currencyShow}&to=USD&amount=${privateCurrency}`,   
       //           dataType: 'jsonp',
       //           success: function(data) {
       //               console.log(data);
                    
       //               var usd_converter = data.result;
       //               var usd_converter_show = usd_converter;
       
       //               pricesInModal();
       
       //                 setTimeout(() => {
       
       
       
       
       //                   if(usd_converter_show >= Number($("input[name='min_limit']").val())
       //                     && usd_converter_show <=  Number($("input[name='max_limit']").val())) {
                           
       //                     if($(".block-pay").length){
       //                       $(".block-pay").remove();
       //                     }
       
       //                     $("#pricecurrency").val(totalx);
       //                     $("#confirm-purchase").removeAttr('disabled');
       
       //                   } else {
       //                     if(!$("#paypal-button-container .block-pay").length){
       
       //                       if($("#paypal-button-container iframe").height() >= 200){
       //                         $("#paypal-button-container").append('<div class="block-pay height-pay"></div>');
       //                       } else {
       //                         $("#paypal-button-container").append('<div class="block-pay"></div>');
       //                       }
       
       //                       $("#minandmax").modal();
       //                       $("#confirm-purchase").attr('disabled', 'disabled');
    
       //                     }
    
       //                     $("#pricecurrency").val(data.result.toFixed(2));
       
       //                   }
       
       //                 }, 200);
       
                     
       
       //           }
       //       }); 
       
             
       
             
       //   }
       
       
       //   function pricesInModal(){
       //                 $.ajax({
       //                     url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=USD&to=${currencyShow}&amount=${Number($("input[name='min_limit']").val())}`,   
       //                         dataType: 'jsonp',
       //                         success: function(data) {
       //                            var _minium = data.result
       //                            var _minium_show = _minium.toFixed(0);
       //                            if(currencyShow != 'USD'){
       //                             $(".itemFiat").html(`(${_minium_show} ${currencyShow})`)
       //                            }
       //                         }
       //                     }); 
       
       //                   $.ajax({
       //                         url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=USD&to=${currencyShow}&amount=${Number($("input[name='max_limit']").val())}`,   
       //                         dataType: 'jsonp',
       //                         success: function(data) {
       //                            var _minium = data.result
       //                            var _minium_show = _minium.toFixed(0);
       
       //                            if(currencyShow != 'USD'){
       //                               $(".itemFiat2").html(`(${_minium_show} ${currencyShow})`)
       //                            }
       //                         }
       //                     }); 
       //   }
       
       // }
       
       totalPay();

       function soloNumeros(e)
        {
            var key = window.Event ? e.which : e.keyCode
            return ((key >= 48 && key <= 57) || (key==8))
        }


    </script>
    {{-- <script type="text/javascript">
       // Create and initialize a payment form object
       const paymentForm = new SqPaymentForm({
         // Initialize the payment form elements
         
         //TODO: Replace with your sandbox application ID
         applicationId: "sq0idp-AFZo2JItZ8N9mO8iDJK3Gw",
         locationId: "LECCFVTG2RB0H",
         inputClass: 'sq-input',
         autoBuild: false,
         // Customize the CSS for SqPaymentForm iframe elements
         inputStyles: [{
             fontSize: '16px',
             lineHeight: '24px',
             padding: '16px',
             placeholderColor: '#a0a0a0',
             backgroundColor: 'transparent',
         }],
         // Initialize the credit card placeholders
         cardNumber: {
             elementId: 'cc',
             placeholder: 'Card Number'
         },
         cvv: {
             elementId: 'cv',
             placeholder: 'CVV'
         },
         expirationDate: {
             elementId: 'sq-expiration-date',
             placeholder: 'MM/YY'
         },
         postalCode: {
             elementId: 'sq-postal-code',
             placeholder: 'Postal'
         },
         // SqPaymentForm callback functions
         callbacks: {
             /*
             * callback function: cardNonceResponseReceived
             * Triggered when: SqPaymentForm completes a card nonce request
             */
             cardNonceResponseReceived: function (errors, nonce, cardData) {
             if (errors) {
                 // Log errors from nonce generation to the browser developer console.
                 console.error('Encountered errors:');
                 errors.forEach(function (error) {
                     console.error('  ' + error.message);
                 });
                 alert('Please write the corresponding information well');
                 return;
             }
    
    
    
              /*const verificationDetails = { 
                intent: 'CHARGE', 
                billingContact: {
                  givenName: $("#namex").val(),
                  familyName: $("#lastnamex").val()
                }
              };*/    
    
              const verificationDetails = { 
                intent: 'CHARGE', 
                amount: formatMoney($("#pricecurrency").val()), 
                currencyCode: 'USD', 
                billingContact: {
                  givenName: $("#namex").val(),
                  familyName: $("#lastnamex").val()
                }
              };    
    
    
             paymentForm.verifyBuyer(
                 nonce, 
                 verificationDetails, 
                 function(err, verificationResult) {
                  if (err == null) {
                    console.log(verificationResult);
                    //TODO: Move existing Fetch API call here
    
                    fetch('https://damecoins.sunicoin.org/gateway/squareup/process', {
                      method: 'POST',
                      headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                      },
                      body: JSON.stringify({
                        nonce: nonce,
                        token: verificationResult.token,
                        amount: formatMoney($("#pricecurrency").val())
                      })
                    })
                    .catch(err => {
                      //$("#modalFailTransaction").modal('show');
                      //alert('Too many failed transactions. Please try again tomorrow.');
                    })
                    .then(response => {
                      if (!response.ok) {
                        return response.json().then(errorInfo => Promise.reject(errorInfo)); //UPDATE HERE
                      }
                      return response.json(); //UPDATE HERE
                    })
                    .then(data => {
    
                      fetch('/payment-pay', {
                        method: 'POST',
                        headers: {
                          'Accept': 'application/json',
                          'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                          name: $("#namex").val(),
                          lastname: $("#lastnamex").val(),
                          email: $("#emailx").val(),
                          amount: formatMoney($("#pricecurrency").val()),
                          country: $("#countryx").val(),
                          idCurrency: '{{ $getCurrencyUser->id }}',
                          idCrypto: '{{ $getCriptodefault->id }}',
                          currency: '{{ $getCurrencyUser->code }}',
                          "_token": "{{ csrf_token() }}"
                        })
                      })
                      .catch(er => {
                      })
                      .then(resx => {
                        if (!resx.ok) {
                          return resx.json().then(errorInfo => Promise.reject(errorInfo)); //UPDATE HERE
                        }
                        return resx.json(); //UPDATE HERE
                      })
                      .then(show => {
    
                        $("#success").modal('show');
                        
                      });
         
                    })
                    .catch(err => {
                        if(err.title){
                            $("#modalFailTransaction").modal('show');
                            $("#modalFailTransaction .txt-color-landing").text(err.title);
                            $("#modalFailTransaction ul").html('Please verify your card details well, remember that we limit daily purchase request attempts');
                           // console.log(JSON.parse(err.result));
                        } else {
                            $("#modalFailTransaction").modal('show');
                        }
                        
                        /*console.log('aquiiii mostraremos el error debajo de esta linea se mostrara el error');
                        console.log(err);*/
                      
                      //console.error(err);
                      //alert('Payment failed to complete!\nCheck browser developer console for more details');
                    });
    
                  }
            }); 
    
    
    
       
             }
         }
       });
       
       
       
       // onGetCardNonce is triggered when the "Pay $1.00" button is clicked
       function onGetCardNonce(event) {
    
        /* if($("#namex").val() == ''){
           $("#namex").addClass('sq-input--error');
         }
    
         if($("#lastnamex").val() == ''){
           $("#lastnamex").addClass('sq-input--error');
         }
    
         if($("#emailx").val() == ''){
           $("#emailx").addClass('sq-input--error');
         }
    
         if($("#countryx").val() == ''){
           $("#countryx").addClass('sq-input--error');
         }*/
    
         // Don't submit the form until SqPaymentForm returns with a nonce
         event.preventDefault();
         // Request a nonce from the SqPaymentForm object
         paymentForm.requestCardNonce();
       }
       
       paymentForm.build();
       //TODO: paste code from step 1.1.4
    
       function numberWithCommas(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    
    
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
    </script> --}}
  @endsection
