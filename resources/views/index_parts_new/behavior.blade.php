<section id="behavior">
   {{-- <div class="container">
      <div class="row justify-content-center mt-4">
         <div class="col-12 col-lg-10">
            <h2 class="text-primary text-center mb-4">@lang('index.behavior')</h2>

            <div class="card mb-4 col-12 col-md-7 m-auto">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 mb-3 mb-md-0 mb-lg-0 m-auto">
                    <div class="form-group mb-0">
                      <div class="select-wrapper">
                      {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                      'id' => 'getCryptos',
                      'class' => 'form-control nameCripto',
                      'value' => $getCriptodefault->code
                      ])!!}
                      </div>
                    </div>
                  </div>
                 

                  <div class="col-md-4 mb-3 mb-md-0 mb-lg-0 d-none">
                    <div class="form-group mb-0">
                      <input type="date" class="form-control" placeholder="Desde" name="start_date" id="since" value="10/05/2020">
                    </div>
                  </div> 
                  <div class="col-md-4 mb-3 mb-md-0 mb-lg-0 d-none">
                    <div class="form-group mb-0">
                      <input type="date" class="form-control" placeholder="Hasta" name="end_date" id="until">
                    </div>
                  </div>
                  <div class="col-md-12 d-none">
                    <div class="form-group mb-0 mt-2">
                      <div id="error" class="text-danger text-center"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card  card-dark mt-5">
               <div class="card-header">
                  <div class="row">
                     <div class="col-12 col-md-5  col-lg-3 " >
                        <div class="">
                           <img class="img-coin mr-2" src="https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/btc.png" alt="" id="imagenCrypto" width="50">
                           <span class="h4" >{{$getCriptodefault->code}}</span>
                           <small class="d-block">@lang('index.valueprice')</small>
                           <h5 class="mb-0 h4" id="">
                              {{$getCurrencyUser->code}} 
                              <b id="currencyActuality"></b>
                           </h5>
                           <small class="color-succes">
                           <span id="priceCrypto"></span> 
                           {{$getCurrencyUser->code}} 
                           (<b id="percetanjeshow">0</b>%)
                           </small>
                        </div>
                     </div>
                     <div class="col-12 col-md-7  col-lg-9  d-flex justify-content-md-end flex-column" >
                        <div class="d-flex  align-items-center justify-content-start justify-content-md-end flex-wrap " >
                           <button class="btn btn-primary-custom-gradient active m-1 itemCtr1">1 Sem</button>
                           <button class="btn btn-primary-custom-gradient m-1 itemCtr2" >1 Mes</button>
                           <button class="btn btn-primary-custom-gradient m-1 itemCtr3">3 Mes</button>
                           <button class="btn btn-primary-custom-gradient m-1 itemCtr4">6 Mes</button>
                        </div>
                        <div class="mt-2 d-flex justify-content-between align-items-center justify-content-md-end flex-wrap ">
                           <span class=" font-small">24h: <b class="color-succes" ><span id="24Item">...</span><i class="fa fa-arrow-up" id="24ItemIcon"></i></b></span>
                           <span class="mx-3">|</span>
                           <span class=" font-small">7D:  
                           <b class="color-succes"><span id="7Item">...</span>%
                           <i class="fa fa-arrow-up" id="7ItemIcon"></i></b>
                           </span>
                           <span class="mx-3">|</span>
                           <span class=" font-small">30D: <b class="color-danger"><span id="30Item">...</span><i class="fa fa-arrow-down"></i></b></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="container-chart" id="container-chart">
                     <canvas id="chart-results" ></canvas>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> --}}
   <div class="container-fluid four-section py-4">

            <div class="owl-carousel owl-theme Slider-Cotiza " id="Slider-Cotiza">


                @foreach($getCryptos as $key => $item)

                  @if($key == 'ATOM'  || $key == 'SILVER' || $key == 'USDC')

                  @else
                    <div class="item itemCrypto" data-crypto="{{strtolower($key)}}">

                        <div class="d-flex justify-content-start  ">
                            <span class="mr-2"><img src="https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/{{strtolower($key)}}.png" alt=""></span>
                            <h5>{{$item}} <br> <small class="d-none">Ethereum</small></h5>
                            <small class="ml-auto d-none">7D: <b class="color-succes">17% <i class="fa fa-arrow-up"></i></b> </small>
                        </div>
                        <div class="">
                            <small>@lang('index.valueprice')</small>
                            <h6 class="mb-0 h4">{{$getCurrencyUser->code}}  <b class="price_widget">...</b></h6>
                            <small class="color-succes d-none">216.10 USD (2.17%)</small>
                        </div>

                    </div>

                    @endif


                @endforeach

                

            </div>

        </div>
</section>