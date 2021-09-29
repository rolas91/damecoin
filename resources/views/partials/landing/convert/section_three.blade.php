{{-- <div class="first-section py-4">
    <div class="container">

        <div class="row justify-content-around align-items-center" >

            <div class="col-12 col-lg-4">
                <img class="img-comprar-vender d-none d-lg-block" src="{{ asset('assets/img/comprar-vender/Group17.png')}}" alt="">
                <h2 class="font-weight-bold">@lang('index.h2-text-landing')</h2>
            </div>
            <div class="col-12 col-lg-4">
                <p></p>
            </div>
        </div>
   
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-lg-10">
                    <div class="card  card-dark">
                        <div class="card-header">
        
                        <div class="row">
                            <div class="col-12 col-md-5  col-lg-3 " >
                                <div class="">
                                    <img class="img-coin mr-2" src="https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/btc.png" alt="" id="imagenCrypto" width="50">
                                    <span class="h4" >
                                        {{$getCriptodefault->code}}
                                    </span>
                                    
                                    <small class="d-block">
                                        @lang('index.valueprice')
                                    </small>

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
                                    <span class=" font-small">
                                        24h:
                                        <b class="color-succes" >
                                            <span id="7Item">...</span>
                                            <i class="fa fa-arrow-up" id="7ItemIcon"></i>
                                        </b>
                                    </span>

                                    <span class="mx-3">|</span>

                                    <span class=" font-small">
                                        7D:  
                                        <b class="color-succes">
                                            <span id="24Item">...</span>%
                                            <i class="fa fa-arrow-up" id="24ItemIcon"></i>
                                        </b>
                                    </span>

                                    <span class="mx-3">|</span>

                                    <span class=" font-small">
                                        30D:
                                        <b class="color-danger">
                                            <span id="30Item">...</span>
                                            <i class="fa fa-arrow-down"></i>
                                        </b>
                                    </span>
                                 </div>
                            
                            </div>
                        </div>
                        
                        </div>
                        <div class="card-body" style="height: 410px!important;width: 100%;">
        
                            <div class="container-chart" id="container-chart">
                                <canvas id="chart-results" ></canvas>
                            </div>
        
                        </div>
                    </div>
            </div>
        </div>

    </div>
  </div> --}}