<div class="banner-principal-four ">
    <div class="container " style="margin-top: 6%">
          <div class="row">
              <div class="col-12 col-lg-5">
                  
                <div class="d-flex justify-content-start align-items-center ">
                    <img class="icon-coin"  id="imageBtcTop" src="" alt="">
                <img class="icon-coin-small mx-3" src="{{ asset('assets/img/detalle-metodo-pago/switch1.png')}}"alt="">
                    {{-- <img class="icon-coin" src="assets/img/conversor/icon2.png" alt=""> --}}
                    <img src="/img/emptylogo.png" id="imgDiv" width="50" height="50">
                </div>
                
                  <h2 class="text-white font-weight-bold mt-3">@lang('index.convert') {{$getCriptodefault->code}} @lang('index.convert2')</h2>

                  <p class="text-white mt-2">
                    @lang('index.comprabtcwithtdc')
                  </p>
                  
                  <ul class="list-punto-light mt-4">
                     @lang('index.li')
                  </ul>

              </div>
              <div class="col-12 col-lg-7 mt-4">
                    <div class="card card-compra-instantanea ">
                 
                      <div class="card-header ">
                           <h3  class="font-weight-bold mt-3">@lang('index.convertir')</h3>
                          
                            <div class="row">
                                <div class="col-12 col-md-6 position-relative">
                                <img class="icon-1 d-none d-md-block" src="{{ asset('assets/img/conversor/switch2.png')}}" alt="">
                                    <div class="container-select-list-blue mt-2">
                                        <div class="icon"> 
                                            <span class="mr-2">{{$getCriptodefault->code}} </span>
                                            <span><i class="fas fa-angle-down"></i></span>
                                        </div>
      
                                        {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                                          'id' => 'getCryptos',
                                          'class' => 'selectpicker'
                                          ])
                                      !!}
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 ">
                                    <div class="container-select-list-blue mt-2">
                                        <div class="icon"> 
                                            <span class="mr-2">{{$getCurrencyUser->code}}  </span>
                                            <span><i class="fas fa-angle-down"></i></span>
                                        </div>
                                            {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                                                'id' => 'getCurrencies',
                                                'class' => 'selectpicker'
                                            ])!!}
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 mt-3 position-relative">
                                <img class="icon-2 d-none d-md-block" src="{{asset('assets/img/conversor/=.png')}}" alt="">
                                  <small>@lang('index.amountconvert')</small>
                                    <div class="input-group input-group-light">
                                      <input type="text" class="form-control" id='amount' onKeyPress="return soloNumeros(event)" aria-label="Amount (to the nearest dollar)">
                                      <div class="input-group-append">
                                        <span class="input-group-text">{{$getCriptodefault->code}}</span>
                                      </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 mt-3 text-right">
                                  <small class="text-muted  "> <img src="{{ asset('assets/img/conversor/rotate-ccw.png')}}" alt=""> @lang('index.taza5s')</small>
                                  <div class="input-group input-group-light">
                                  <span class="form-control" id='convert'></span>
                                   
                                    <div class="input-group-append">
                                      <span class="input-group-text">{{$getCurrencyUser->code}}</span>
                                    </div>
                                  </div>
                               </div>
                              
                            </div>

                           

                      </div>
                      <div class="container-fluid" style="background:#F5F2F3;border-radius: 5px;">
                        @include("partials.form.payment-activo", ['dir'=>'index'])
                        
                    </div>

                      <div class="card-body">    
                                        
                         

                        <div class="row p-25 pb-3" style="padding: 13px!important">
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
                               <a href="{{ url(__('route.Payments', ['crypto' => $getCriptodefault->code, 'divisa' => $getCurrencyUser->code,'method' => 'alipay'  ])) }}" class=" link " >@lang('index.verMetodos')</a>
                            </center>
                         </div>
                      </div>
                  </div>

              </div>
          </div>
    </div>
  </div>