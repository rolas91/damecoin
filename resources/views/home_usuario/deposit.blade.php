@extends('layouts.admin_user')
@section('meta_title')
<title>{{ $meta['title'] }}</title>
@overwrite
@section('meta_tags')
<!-- Seo Tags -->
<meta name="description" content="  {{ $meta['descripcion'] }}">
<meta name="keywords" content="{{ $meta['key'] }}">
<meta name="robots" content="index, follow">
<meta property="og:type" content="website" />
<meta property="og:image" content="{{asset('img/damecoins/facebooklinkpreview.jpg')}}" />
<meta property="og:url" content="https://damecoins.com/" />
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:title" content="{{ $meta['title'] }}" />
<meta property="og:description" content="{{ $meta['descripcion'] }}" />
<style type="text/css">
   #cc, #sq-expiration-date, #cv,
   #sq-postal-code{
   background: white;
   }
   .sq-input--error{
   border: 1px solid #E02F2F!important;
   }
   .sq-input--focus{
   border: 1px solid #4A90E2;
   }
</style>
<!-- /Seo Tags -->
@overwrite
@section('content')
<!--
<script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
-->
<!--
   <script src="{{ asset('js/qrcode.js')}}"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   -->
<!--
   //activar recurly
   <script src="https://js.recurly.com/v4/recurly.js"></script>
   <link href="https://js.recurly.com/v4/recurly.css" rel="stylesheet" type="text/css">
   -->
<!-- section -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @lang('home_deposit.header')
         <small></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/home"><i class="fa fa-dashboard"></i> @lang('home_deposit.deposit') </a></li>
      </ol>
   </section>
   <section class="content">
      <!--
         @if(Session::has('msg'))
          <div class="row">
                  <div class="col-md-12">
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong></strong> {{Session::get('msg')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                          <h2></h2>
                  </div>
          </div>
         @endif
         
         @if(Session::has('error'))
          <div class="row">
                  <div class="col-md-12">
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong></strong> {{Session::get('error')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                          <h2></h2>
                  </div>
          </div>
         @endif
         -->
      @if(Session::has('error'))
      <div class="alert alert-danger alert-dismissible " role="alert">
         <strong>!</strong> {{Session::get('error')}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif
      <div class="row">
         <div class="col-md-8">
          <div class="alert alert-danger" role="alert" style="display: none">
               Apologizes, our card payment system is currently under maintenance. Please come back in a few days to purchase crypto using credit or debit card (card system is being upgraded and it may take a few days). If you need to purchase right now, please signup or login for paying by PayPal or by bank transfer (we have bank accounts available in USA, UK, Europe, Hong Kong, China, Australia...)  Feel free to ask our 24h Chat Support!
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-xs-12">
            {{-- <p>@lang('home_deposit.currency')</p> --}}
         </div>
      </div>
      <div class="row">
         {{-- <div class='col-sm-8 col-md-8 col-xs-12'>
            {!!Form::select('getCurrencies', $getCurrencies, $default->id, ['id' => 'getCurrencies','class' =>
            'form-control'
            ])!!}
         </div> --}}
      </div>
      <!--
      <div class="row">
         <div class='col-sm-10 col-md-6 col-xs-12' style="background: #dedede;margin: 1em;display: none;">
            <form class="form" style="padding-top:2em;" onsubmit="onGetCardNonce(event)">
               <div class="row">
                  <div class="col-md-6" style="display: flex;margin-bottom: 0.5em;">
                     <input id="totalD" class='form-control' type="number" name='monto' required
                        autocomplete="off">
                     <div class="input-group-prepend">
                        <div class="input-group-text color-input">{{$default->code}}</div>
                     </div>
                  </div>
               </div>
               <div class="row" style="display: none;">
                  <div class="contentCard col-md-6">
                     <div class="contentCard">
                        <label for="validationCustomUsername" class="small text-muted m-0">@lang('index.tarjeta')</label>
                        <div id="cc" class="w-custom-card" style="background: white;"></div>
                     </div>
                  </div>
                  <div class="contentCard col-md-6" style="display: flex;">
                     <div>
                        <label for="validationCustomUsername" class="small text-muted m-0">
                        @lang('index.fecha')</label>
                        <div id="sq-expiration-date" class="w-100"></div>
                     </div>
                     <div>
                        <label for="validationCustomUsername" class="small text-muted m-0">
                        @lang('index.cvv')</label>
                        <div id="cv" class="w-100"></div>
                     </div>
                     <div class="contentCard">
                        <label for="validationCustomUsername" class="small text-muted m-0">Postal code</label>
                        <div id="sq-postal-code" class="w-100"></div>
                     </div>
                  </div>
               </div>
               <div class="row" tyle="display: none;">
                  <div class="col-sm-6">
                     <div class="paymentVender" style="margin-bottom: 20px;margin-left:0px;">
                        <ul style="display: flex;list-style: none;margin-left:0px;">
                           <li style="align-items: center;display: flex"><img src="http://localhost:8000/img/vender5.png" alt="" width="80px"></li>
                           <li style="margin-left:10px;align-items: center;display: flex"><img src="http://localhost:8000/img/vender6.png" alt="" width="80px"></li>
                           <li style="margin-left:10px;align-items: center;display: flex"><img src="http://localhost:8000/img/vender1.png" alt="" width="80px"></li>
                           <li style="margin-left:10px;align-items: center;display: flex"><img src="http://localhost:8000/img/vender2.png" alt="" width="80px"></li>
                           <li style="margin-left:10px;align-items: center;display: flex"><img src="http://localhost:8000/img/vender3.png" alt="" width="50px"></li>
                           <li style="margin-left:10px;align-items: center;display: flex"><img src="http://localhost:8000/img/vender4.png" alt="" width="80px"></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row" style="display: none;">
                  <input type="hidden" name='currency' value=" {{$default->id}}">
                  <p class="final">@lang('home_deposit.total') <span id="total"> </span> {{$default->code}}</p>
               </div>
               <div style="padding-bottom:1em;" style="display: none;">
                  <button
                     class="btn btn-success btn-block mb-4 font-weight-bold"
                     id="confirm-purchase"  data-toggle="modal" style="margin-top:2em;">
                  @lang('index.paybottom')
                  </button>
               </div>
            </form>
         </div>
      </div>
   -->
      <br>
   {{-- aqui itegracion payU --}}
   @include('home_usuario.partials.form.flutterWaveDeposit')
   
         <!--superpay-->
      <div class="row">
         <div class="col-md-8 text-center" style="display:none">
            <span>Or</span>
         </div>
      </div>
      <div class="row">
         <div class="col-md-8">
            <div class="tab-content theme-tab-profile-content theme-profile-bg">
               <div role="tabpanel" class="{{App::getLocale() != 'ch' ? 'tab-pane active':'tab-pane'}}" id="favourite" style="display:block!important;">
                  <ul class="media-list" id="profileFavouritesList">
                     <div class="row">
                        <div class="col-md-12">
                           {{-- <div class="form-row">
                               Paypal 
                              @if($paypal_state)
                              <div class="d-flex justify-content-center"
                                 style="margin: 1.5rem 0; {{ (!$paypal_state->status) ? 'display:none !important' : '' }}">
                                 <a href="{{ $paypal_state->url }}" class="btn btn-primary"
                                    target="{{ $paypal_state->target }}">
                                 <i class="fa fa-paypal "></i> Pay With PayPal
                                 </a>
                                 <a class="btn btn-primary" data-toggle="modal" data-target="#ModalPaypal">
                                    <i class="fa fa-paypal "></i> Pay With PayPal
                                 </a>
                              </div>
                              @endif
                              <div class="row mb-2">
                                 <div class="col-md-12 text-center mb-2">
                                    <span>Or</span>
                                 </div>
                                 <!--
                                    <div class="col-md-12 text-center mb-2">
                                        <img loading="lazy" src="https://lh3.googleusercontent.com/r1qrqwYTNX0x1fN_0Xty0JWzkKBgad0RylI6rmGsRg144dvrRoKuZFqMJssOHhaPtA" class="img-fluid" height="50" alt="">
                                    </div>
                                    -->
                                 <div class="col-md-12 text-center paymentRecurly">
                                    <button class="btn btn-primary btn-buy" data-toggle="modal" data-target="#westernUnionPaymentModal">
                                    @lang('index.paybottom_western') 
                                    </button>
                                 </div>
                              </div>
                           </div>
                           {{--  
                           @include('home_usuario.partials.formPayDeposit')
                           --}} 

                           @include('partials.bootonModal2') <br><br>
                        </div>
                     </div>
                     <div class="row" style="margin:4px">
                        <div class='col-sm-12'>
                           <p style="text-align:justify">@lang('home_deposit.mesagge1',["currency"=>$default->code])
                           </p>
                           <p style="text-align:justify">@lang('home_deposit.mesagge2') </p>
                           <p style="text-align:justify">@lang('home_deposit.mesagge3') </p>
                           <p style="text-align:justify">@lang('index.mesagge4') </p>
                        </div>

                     </div>
                     </form>
                  </ul>
               </div>
               <div role="tabpanel" class="{{App::getLocale() == 'ch' ? 'tab-pane active':'tab-pane '}}" id="settings"
                  style="margin-bottom:20px;">
                  <center>
                     <div style="display:none;margin-top: 40px;margin-bottom:40px">
                        <img src="{{asset('img/wechatpay.png')}}" alt="" width="250px" style="margin-bottom:20px">
                        <button class="btn btn-success" id="wechat"
                        {{!$payment_state->state ? 'disabled': ''}}>Pay</button>
                     </div>
                  </center>
                  <div class="row" style="margin:4px">
                     <div class='col-sm-5'>
                        <p style="text-align:justify">@lang('home_deposit.mesagge1',["currency"=>$default->code]) </p>
                        <p style="text-align:justify">@lang('home_deposit.mesagge2') </p>
                        <p style="text-align:justify">@lang('home_deposit.mesagge3') </p>
                     </div>
                     <div class='col-sm-7'>
                        <input type="hidden" name='currency' value=" {{$default->id}}">
                        <p class="final">@lang('home_deposit.total') <span id="total2"> </span> {{$default->code}}</p>
                        {{--  
                        <p class="final">@lang('home_deposit.comision') {{ $default->detailCurrency->comision_abono }}%:
                           <span id="comision2"></span> {{$default->code}}
                        </p>
                        --}}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <!--transferencia-->
      <div class="row" style="margin:10px">
         <div class="col-sm-12">
               <h2 class="page-header">
                   @lang('home_deposit.mesaggetransfe1')
                </h2>
                <p>@lang('index.subtitleAllPopups')</p>
            <p>@lang('home_deposit.mesaggetransfe2') </p>
         </div>
      </div>
      <section class="invoice">
         <div class="row">
            <div class="col-xs-12">
               <h2 class="page-header">
                  <i class="fa fa-globe"></i> @lang('home_deposit.transferencia')
               </h2>
            </div>
         </div>
         @if(Session::has('msg'))
         <div class="alert alert-danger alert-dismissible " role="alert">
            <strong>!</strong> {{Session::get('msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         @endif
         @php
            $i = 0;
         @endphp
         @forelse ($banks as $bank)
         <form action="/processtransfe" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $default->id }}">
            <div class="row invoice-info">
               <div class="col-sm-6 invoice-col">
                  <p style="font-size:2em"> {{ $bank->title }}</p>
                  <p><span style="font-weight:bold">@lang('home_deposit.destinatario')</span> {{ $bank->destinatary }}</p>
                  <p><span style="font-weight:bold">@lang('home_deposit.banco') </span>{{ $bank->name }}</p>
                  <p><span style="font-weight:bold">@lang('home_deposit.country') </span>{{ $bank->country }}</p>
                  <p><span style="font-weight:bold">@lang('home_deposit.swift')</span>{{ $bank->swift }}</p>
                  <p><span style="font-weight:bold">@lang('home_deposit.acount')</span> {{ $bank->numero_cuenta }}</p>
                  <address>
                     {{--    <strong>Damecoins, Inc.</strong><br>Phone: (804) 123-123<br> --}}
                     <p><span style="font-weight:bold">Concept: </span> <span style="color:red"> {{$concept}}</span></p>
                     Email: info@damecoins.com
                  </address>
               </div>
               <div class="col-sm-6 invoice-col">
                  <div class="row">
                     <div class="col-sm-6">
                        <label>@lang('home_deposit.totalt')</label>
                        <div class="input-group">
                           <input id="totalT{{$i}}" class='form-control' type="number" name='montot' required
                              autocomplete="off" value="{{ $limit }}" min="{{ $limit }}" onkeyup="totalT({{$i}})">
                           <div class="input-group-prepend">
                              <div class="input-group-text color-input">{{$default->code}}</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}">
                           <label>@lang('home_deposit.recibo')</label>
                           <div class="col-md-12">
                              <input type="file" name="img" class="form-control" required>
                              @if ($errors->has('img'))
                              <span class="help-block">
                              <strong>{{ $errors->first('img') }}</strong>
                              </span>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class='col-sm-12'>
                        <input type="hidden" name='currency' value=" {{$default->id}}">
                        <p class="final">@lang('home_deposit.totalt1') <span id="totalt{{$i}}"> </span> {{$default->code}}</p>
                        <p style="display:none;" class="final">
                           @lang('home_deposit.comisiont'){{ $default->detailCurrency->comision_abono }} %:<span
                           id="comisiont{{$i}}"></span> {{$default->code}} 
                        </p>
                        <p style="text-align:justify">@lang('home_deposit.mesaggetransfe') {{$default->code}} </p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row no-print">
               <div class="col-xs-12">
                  <button type="submit" class="btn btn-warning pull-right" style="margin-right: 2px;">
                  <i class="fa fa-download"></i> @lang('home_deposit.bottontransfe')
                  </button>
               </div>
            </div>
         </form>
         <hr color="#ccc" style="background-color: red!important;">
         @php
             $i++;
         @endphp
         @empty
         @endforelse
      </section>
   </section>
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
                   @lang('index.sendMoneyPaypal')</p><span style="font-weight: bold;color: #003187;">paypal@damecoins.co.uk</span><br>
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
            currency = '{{ $default->code }}';
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
   /*
   	recurly.configure({
       publicKey: 'ewr1-koFsJQMJ0Xf43SBJsB17u9',//live
       //publicKey: 'ewr1-9UIs5E1Bb1ryICWwg8csXY', //test
   
       required: ["cvv"],
   
   });
   
   
   const elements = recurly.Elements();
   const cardElement = elements.CardElement();
   cardElement.attach('#recurly-elements');
   */
   /*
   document.querySelector('#processdepositrecurly').addEventListener('submit', function (event) {
   	    amount = $('input[name="monto"]').val()
   	    currency = '{{ $default->code }}';
   	    card_type= true;
   	    event.preventDefault();
   		//	calculateMinimumFaster(currency,amount).then((data)=>{
   		calculateMinimumFasterx(currency,amount).then((data)=>{
   			var datax = {
   	             '_token':"{{ csrf_token() }}",
   	             'total':amount,
   	             'idCurrency':'{{ $default->id }}',
   							 'idCurrency':'{{ $default->id }}',
   	             'idCrypto':333,//para deposit relleno
   	             'direct':"deposit",
   	             //'stripeToken':result.token.id,
   	             'currency':'{{ $default->code }}',
   	        };
   
   			//alert("si");
   
               // alert("si");
   			var ajax = $.ajax({
                   url: "/paymentresulthome",
                   method: 'post',
                   data: datax,
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
   });
   */
   
   function calculateMinimumFasterx(currency,total){
     return new Promise((resolve, reject) => {
         jQuery.ajaxSetup({
               headers: {
                   'X-CSRF-Token':  "{{ csrf_token() }}",
               }
         });
          $.post("/calculate-minimun-faster", { "currency": currency,"amount":total,"card": true})
           .done(function( data ) {
             if(data.data== 'false'){
                 reject(data);
   
             }
             resolve();
   
         });
   
     });
   }
   
    	valor();
    	// totalT();
   
      $("#getCurrencies").change(function () {
          window.location = "/deposit/" + $(this).val();
          // alert("vendor/"+$("#getCryptos").val()+"/"+$(this).val());
      });
   
      $("#totalD").keyup(function(){
          valor();
      });
   
      function valor(){
          var currency=parseFloat($("#totalD").val());
          var comision=parseFloat({{ $default->detailCurrency->comision_abono  }});
          if(isNaN(currency)){
            comision=mytoFixed(0,"comision");
            comision=mytoFixed(0,"total");
             comision=mytoFixed(0,"comision2");
            comision=mytoFixed(0,"total2");
          }else{
              var comi=((currency*comision)/100);
              // var total=currency-comi;
              var total = currency;
              //console.log(comi);
              comision=mytoFixed(comi,"comision");
              comision=mytoFixed(total,"total");
              comision=mytoFixed(comi,"comision2");
              comision=mytoFixed(total,"total2");
          }
      }
   
      // $("#totalT").keyup(function(){
         for (let i = 0; i < parseInt({{ count($banks) }}); i++) {
            totalT(i);
         }
      // });
   
      function totalT(i){
          var currency=parseFloat($(`#totalT${i}`).val());

          var comision=parseFloat({{ $default->detailCurrency->comision_abono  }});
          if(isNaN(currency)){
            comision=mytoFixed(0,`comisiont${i}`);
            comision=mytoFixed(0,`totalt${i}`);
          }else{
              var comi=((currency*comision)/100);
              // var total=currency-comi;
              var total = currency;
              //console.log(comi);
              comision=mytoFixed(comi,`comisiont${i}`);
              comision=mytoFixed(total,`totalt${i}`);
          }
      }
   
      function mytoFixed(valor,variable){
          valor=valor.toFixed(2);
          if(isNaN(valor)){
            valor=0;
            valor=valor.toFixed(2);
            $("#"+variable+"").text(valor);
          }else{
            $("#"+variable+"").text(valor);
            //$("#venta").text(valor);
          }
      }
   
   
   
   function closeModal(){
          $('.modal').hide();
          location.reload();
      }
   
      $('#wechat').click(function() {
   
          if( document.myForm.monto.value == "" ) {
              swal({
                  text: "{{ __('validation.required', ['attribute' =>  __("home_deposit.quanty")]) }}",
                  icon: "error",
              });
              document.myForm.monto.focus() ;
              return false;
          }
   
          $('#spinner').show();
          amount = $('input[name="monto"]').val()
          currency = '{{ $default->code }}';
          card = false;
   
          calculateMinimum(amount,currency, card).then(()=>{
              jQuery.ajaxSetup({
                  headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                  }
              });
   
              $.post("/wechat-change-divisa", { "amount" : amount , "currency" : currency })
               .done(function( data ) {
                  amount = Math.round(data);
                  pagarWeChat(amount);
              });
          })
          .catch(data => {
              $('#spinner').hide();
              swal({
                  text: "{{ __('home_buy.minimun', ['type' => 'WeChat' ]) }}"+' ('+data.limit+' USD)',
                  icon: "error",
              });
          });
   
      });
   
      function calculateMinimum(amount ,currency , card) {
          return new Promise((resolve, reject) => {
              jQuery.ajaxSetup({
                  headers: {
                      'X-CSRF-Token': $('input[name="_token"]').val()
                  }
              });
   
              $.post("/wechat-calculate-minimun", { "amount" : amount ," currency": currency, "card": card})
          	.done(function( data ) {
                  console.log(data);
                  if(data.data== 'false'){
                      reject(data);
                  }
                  resolve();
          	});
          });
      }
   
      var MAX_POLL_COUNT = 10;
      var pollCount = 0;
   
      function pagarWeChat(amount){
   
          var stripe = Stripe('{{  General::publicStripeKeys()}}');
   
          stripe.createSource({
              type: 'wechat',
              amount: amount,
              currency: 'hkd',
              statement_descriptor: '488 WEB MONEY',
          }).then(function(data) {
              // handle result.error or result.source
              console.log(data.source.wechat.qr_code_url);
              pollForSourceStatus(data);
              $('#spinner').hide();
   
              // window.open(data.source.wechat.qr_code_url)
   
              var qrcode = new QRCode(document.getElementById("qrcode"), {
                  width : 200,
                  height : 200,
                  text: data.source.wechat.qr_code_url,
              });
              $('#qr').show();
          });
      }
   
      function pollForSourceStatus(data) {
          var stripe = Stripe('{{  General::publicStripeKeys()}}');
   
          console.log(pollCount);
          stripe.retrieveSource({id: data.source.id, client_secret:  data.source.client_secret}).then(function(result) {
              var source = result.source;
              if (source.status === 'chargeable') {
                  // Make a request to your server to charge the Source.
                  // Depending on the Charge status, show your customer the relevant message.
   
                  jQuery.ajaxSetup({
                      headers: {
                          'X-CSRF-Token': $('input[name="_token"]').val()
                      }
                  });
   
   
                  amount = $('input[name="monto"]').val()
                  currency = '{{ $default->id }}';
   
                  var param = { 'source' : data , 'currency': currency , 'amount': amount};
   
                  console.log(param);
                  $.post("/wechat-charge-deposit", param)
                      .done(function( data ) {
                       console.log(data);
   
                       swal({
                           title: "Transaction Success!",
                           text: "Please Continue!",
                           icon: "success",
                           button: true,
                       })
                       .then((willDelete) => {
                           if (willDelete) {
                              closeModal();
                           };
                       });
                   });
            	} else if (source.status === 'pending' && pollCount < MAX_POLL_COUNT) {
                  // Try again in a second, if the Source is still `pending`:
                  pollCount += 1;
                  setTimeout(function () {
                    pollForSourceStatus(result)
                  }, 10000);
                  console.log(result)
            	} else {
                  console.log('rechazado')
                  console.log(result)
                  closeModal();
                  // Depending on the Source status, show your customer the relevant message.
            	}
          });
      }
   
   
   function checkDigit(event) {
                var code = (event.which) ? event.which : event.keyCode;
   
                if ((code < 48 || code > 57) && (code > 31)) {
                    return false;
                }
   
                return true;
            }
   function totalPay(){
   if ($("input[type='radio'].person").is(':checked')){
      //alert("si person");
      totalx = $("#persoCurrency").val();
    }else{
     totalx = $("input[type='radio'].radioBtnClass:checked").val();
     //console.log(totalx);
    }
    return totalx;
   }
   
   function calculateMinimumFasterx(currency,total){
                
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
   
   
   
</script>
<div class="modal" tabindex="-1" id="spinner" tabindex="-1">
   <div class="modal-dialog" style="display: flex;height: 100%;
      width: 100%;">
      <div
         style="display: flex;justify-content: center;align-self: center;align-items: center;width: 100%;height: 100%;">
         <center>
            <span class="fa fa-spinner fa-spin fa-3x" style="color:white"></span>
         </center>
      </div>
   </div>
</div>
<script type="text/javascript">
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
   
         var currency_fiat = '{{ $default->code }}';
         var amount_buy = $("#totalD").val();
        if(currency_fiat != 'USD'){
   
         	$.ajax({
             url: `https://data.fixer.io/api/convert?access_key=27692546960c2e421da5a5513b76491d&from=${currency_fiat}&to=USD&amount=${amount_buy}`,   
              dataType: 'jsonp',
              success: function(data) {

              			var monto_converter = Number(data.result);
              			console.log(monto_converter);

                  	const verificationDetails = { 
				   	            intent: 'CHARGE', 
				   	            amount: formatMoney(monto_converter), 
				   	            currencyCode: 'USD', 
				   	            billingContact: {
				   	              givenName: $("#nameUs").text(),
				   	              familyName: $("#nameLas").text()
				   	            }
				   	        };

				   	        paymentForm.verifyBuyer(
				             nonce, 
				             verificationDetails, 
				             function(err, verificationResult) {
				              if (err == null) {
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
				                    amount: formatMoney(monto_converter)
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
				   
				                	fetch('/paymentresulthome', {
				                    method: 'POST',
				                    headers: {
				                      'Accept': 'application/json',
				                      'Content-Type': 'application/json'
				                    },
				                    body: JSON.stringify({
				                      '_token':"{{ csrf_token() }}",
				                      total: amount_buy,
				                      idCurrency: '{{ $default->id }}',
				                      idCrypto: 333,
				    	              	direct: "deposit",
				    	              	currency: '{{ $default->code }}',
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
				   
				                    if (show.error == true){
					    	                alert(data.code);
					    	            }
					    
					    	            if (show.success == "true"){
					    	                window.location.href = data.payment_url;
					    	                console.log('Llegó bien');
					    	            }
					    
					    	            if (show.success == "false"){
					    
					    	            }
				   
				                  });  
				                
				     
				                })
				                .catch(err => {
				                    if(err.title){
				                        alert('Please verify your card details well, remember that we limit daily purchase request attempts')
				                    } else {
				                        alert('Please verify your card details well, remember that we limit daily purchase request attempts')
				                    }
				   
				                    
				                });
				   
				              }
				        	 });

              }
          }); 
   
   
         } else {
   
   
           const verificationDetails = { 
             intent: 'CHARGE', 
             amount: formatMoney($("#totalD").val()), 
             currencyCode: 'USD', 
             billingContact: {
               givenName: $("#nameUs").text(),
               familyName: $("#nameLas").text()
             }
           };   
   
         	 paymentForm.verifyBuyer(
             nonce, 
             verificationDetails, 
             function(err, verificationResult) {
              if (err == null) {
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
                    amount: formatMoney($("#totalD").val())
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
   
                	fetch('/paymentresulthome', {
                    method: 'POST',
                    headers: {
                      'Accept': 'application/json',
                      'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                      '_token':"{{ csrf_token() }}",
                      total: formatMoney($("#totalD").val()),
                      idCurrency: '{{ $default->id }}',
                      idCrypto: 333,
    	              direct: "deposit",
    	              currency: '{{ $default->code }}',
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
   
                    if (show.error==true){
    	                alert(data.code);
    	            }
    
    	            if (show.success=="true"){
    	                window.location.href = data.payment_url;
    	                console.log('Llegó bien');
    	            }
    
    	            if (show.success=="false"){
    
    	            }
   
                  });  
                
     
                })
                .catch(err => {
                    if(err.title){
                        alert('Please verify your card details well, remember that we limit daily purchase request attempts')
                    } else {
                        alert('Please verify your card details well, remember that we limit daily purchase request attempts')
                    }
   
                    if (err.status == 422) { // when status code is 422, it's a validation issue
    	                $.each(err.responseJSON.errors, function (i, error) {
    	                    var el = $(document).find('[name="'+i+'"]');
    	                    el.after($('<span style="color: red;">'+error[0]+'</span>'));
    	                });
    	            }
                    
                    
                });
   
              }
        	 }); 


         }
   
   
   
   
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
     //
   	 //alert(true);
   	var amount = $('#totalD').val()
   	var currency = '{{ $default->code }}';
   	calculateMinimumFasterx(currency,amount).then((data)=>{
   
   		paymentForm.requestCardNonce();
   
   	}).catch(data => {
   			swal({
   				text: "{{ __('home_buy.minimun_faster', ['type' => 'CARD' ]) }}"+' ('+data.min+' USD)' + "{{ __('home_buy.maximo_faster') }}" + '('+data.max+' USD)',
   				icon: "error",
   			});
   	});
   
   
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
</script>
@include('home_usuario.partials.modals.westernUnionPayment')
<!--section end -->
@endsection