<h6 class="title-divider mb-2"><span>@lang('index.mount')</span></h6>
<div class="container_prices_list">
          @if(Session::has('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong></strong> {{Session::get('error')}}
          </div>
          @endif
          <div class="d-flex flex-wrap">
             @foreach($getPanel as $index => $panel)
             <div class="col-md-6 padding-md-0 
                {{($index == 0) ? 'pl-0' : ''}}
                {{($index == 1) ? 'pr-0' : ''}}
                {{($index == 2) ? 'pl-0' : ''}}
                {{($index == 3) ? 'pr-0' : ''}}">
                <div class="custom-control custom-radio radio-amount">
                   @if($index == 2)
                   <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}" name="amount" class="custom-control-input radioBtnClass person" checked>
                   @else
                   <input type="radio" id="{{$panel['id']}}" value="{{$panel['pagar']}}" name="amount" class="custom-control-input radioBtnClass person">
                   @endif
                   <label class="custom-control-label" for="{{$panel['id']}}">
                   <span>
                   <small>@lang('index.pay')</small>
                   <strong>{{$panel["pagar"]}}
                   {{$getCurrencyUser->code}}</strong>
                   </span>
                   <span class="d-inline ml-2 mr-2 pt-3 iqual">=</span>
                   <span>
                   <small>@lang('index.get')</small>
                   <strong>{{$panel["recibir"]}}
                   {{$getCriptodefault->code}}</strong>
                   </span>
                   </label>
                </div>
             </div>
             @endforeach
          </div>
          <h6 class="title-divider mb-2"><span>@lang('index.otherQuantity')</span></h6>
          <div class="row" id="numbers-one">
             <div class="col-md-6">
                <div class="radio-amount-new pb-0">
                   <div class="areaCl d-flex">
                      <input type="radio" id="customBuy" name="amount" class="custom-control-input radioBtnClassCustom person" value="{{$default['pay']}}" >
                      <label class="custom-control-label" for="customBuy">
                      <span class="small text-muted">@lang('index.get'):</span>
                      </label>
                   </div>
                </div>
                <div class="input-group input-group-cantidad mb-3">
                  <input type="text" class="form-control" id="persoCrypto" value="{{$default['recibe']}}" onKeyPress="return soloNumeros(event)" aria-label="Amount (to the nearest dollar)">
                  <div class="input-group-append">
                    <span class="input-group-text">
                        <img class="mr-1" id="imgCryp" src="{{asset('img/1.png')}}" alt="">
                        {{$getCriptodefault->name}}
                    </span>
                  </div>
                </div>
             </div>
             <div class="col-md-6">
                <span class="small d-block mb-0 text-muted">@lang('index.pay'):</span>
                <div class="input-group input-group-cantidad mb-3">
                  <input type="text" class="form-control" id="persoCurrency" value="{{$default['pay']}}" onKeyPress="return soloNumeros(event)" onkeyup="document.getElementById('customBuy').value=this.value; newChecked(this);" aria-label="Amount (to the nearest dollar)">
                  <div class="input-group-append">
                    <span class="input-group-text">
                        <img class="mr-1"  id="imgDiv" src="{{asset('img/1.png')}}" alt="">
                        {{$getCurrencyUser->name}}
                    </span>
                  </div>
                </div>
             </div>
          </div>
         @if(isset($data))
            @php
                  if($data->form == 0)
                  {
                     // Generico
                     @endphp
                        @include('landing.metodos.paypal')
                     @php   
                  }
                  if($data->form == 1)
                  {
                     // paypal
                     @endphp
                        @include('landing.metodos.paypal')
                     @php   
                  }
                  elseif ($data->form == 2)
                  {
                     // Western Union
                     @endphp
                        @include('landing.metodos.westernUnion')
                     @php   
                  }elseif ($data->form == 3)
                  {
                     // Bizum
                     @endphp
                        @include('landing.metodos.bizum')
                     @php   
                  }
                  elseif ($data->form == 4)
                  {
                     // Skrill
                     @endphp
                        @include('landing.metodos.skrill')
                     @php   
                  } elseif ($data->form == 5)
                  {
                     // WeChat
                     @endphp
                        @include('landing.metodos.wechat')
                     @php   
                  }
                  elseif ($data->form == 6)
                  {
                     // AliPay
                     @endphp
                        @include('landing.metodos.alipay')
                     @php   
                  }
               @endphp
            
            @else
                  
            @endif


          <!--capturar aqui el metodo-->
          
       </div>
       
       <div class="row">
      {{-- 
         @include('partials.formPayU')
       --}} 
         @include('partials.form.flutterwave')

       </div>

       <div class="row p-25 pb-3">
         @include('partials.bootonModal')
         <p class="text-justify p-3"> <small>*PayPal has its own commission from 2.4% to 3.4%, on top of which we add our commission.  Its high commissions are the reason why most cryptocurrency sites don't support it as a payment method.  We support it but do not recommend it.  To avoid high commissions we recommend that you create a free account and make your payment by bank transfer.  We have accounts in more than 5 countries (Amercia, Asia, Europe, Australia) for your convenience and thus avoid unnecessary commissions</small></p>
      </div>
     <div class="row justify-content-lg-between mt-3">
        <div class="d-flex justify-content-center align-items-center flex-wrap mt-3" style="width: 100%;">
           <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.comiciones')</p>
           <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.inmediato')</p>
           <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.proceso')</p>
        </div>
        
        <center style="width: 100%;">
           <a href="/buy-btc-in-en-usd" class=" link " >@lang('index.verMetodos')</a>
        </center>
     </div>
     <!--bloque principal y no individual de cada metodo-->