<style>
  .panel {
  background-color: #fff;
  border-radius: 10px;
  /*padding: 15px 25px;*/
  position: relative;
  width: 100%;
  z-index: 10;
}

.pricing-table {
  box-shadow: 0px 10px 13px -6px rgba(0, 0, 0, 0.08), 0px 20px 31px 3px rgba(0, 0, 0, 0.09), 0px 8px 20px 7px rgba(0, 0, 0, 0.02);
  display: flex;
  flex-direction: column;
}

@media (min-width: 768px) {
  .pricing-table {
    flex-direction: row;
  }


}

@media screen and (min-width : 320px) {
  .pricing-features {
    color: #016FF9;
    font-weight: 600;
    letter-spacing: 1px;
    /*margin: 0px !important;*/
    list-style: none;
  }

/*  .pricing-plan {
    border-bottom: none;
    border-right: 1px solid #e1f1ff;
    flex-basis: 100%;
    padding: 0px !important;
  }*/
}


@media only screen and (min-width: 992px) {
  .pricing-plan {
    border-bottom: none;
    border-right: 1px solid #e1f1ff;
    flex-basis: 100%;
    padding: 0px;
  }

}

@@media screen and (max-width: 992px) {
    .pricing-header {
      color: #888;
      font-weight: 600;
      letter-spacing: 1px;
      margin-top:20px;
      font-size: 12px;
    }
      
  .pricing-plan {
    border-bottom: none;
    border-right: 1px solid #e1f1ff;
    flex-basis: 100%;
    padding: 5px;
  }
}

.pricing-table * {
  text-align: center;
  text-transform: uppercase;
}

.pricing-plan {
  /*border-bottom: 1px solid #e1f1ff;
  /*padding: 25px;*/
}

.pricing-plan:last-child {
  border-bottom: none;
}

@media  only screen and (min-width: 1200px) {
  .pricing-plan {
    border-bottom: none;
    border-right: 1px solid #e1f1ff;
    flex-basis: 100%;
    padding: 25px 20px;
    /*padding: 0px;*/
  }

  .pricing-plan:last-child {
    border-right: none;
  }
}

.pricing-img {
  margin-bottom: 25px;
  max-width: 100%;
}

.pricing-header {
  color: #888;
  font-weight: 600;
  letter-spacing: 1px;
  margin-top:20px;
}

.pricing-features {
  color: #016FF9;
  font-weight: 600;
  letter-spacing: 1px;
  /*margin: 50px 0 25px;*/
  list-style: none;
}

.pricing-features-item {
  border-top: 1px solid #e1f1ff;
  font-size: 14px;
  line-height: 1.5;
  padding: 24px 0;
}

.pricing-features-item-2 {
  border-top: 1px solid #e1f1ff;
  font-size: 10px;
  line-height: 1.5;
  padding: 10px 0;
  width: 117px;
  height: 70px;
}

.pricing-features-item:last-child {
  border-bottom: 1px solid #e1f1ff;
}

.pricing-price {
  color: #016FF9;
  display: block;
  font-size: 20px;
  font-weight: 700;
  text-decoration: none
}

.pricing-button {
  border: 1px solid #9dd1ff;
  border-radius: 10px;
  color: #348EFE;
  display: inline-block;
  margin: 25px 0;
  padding: 15px 35px;
  text-decoration: none;
  transition: all 150ms ease-in-out;
}

.pricing-button:hover,
.pricing-button:focus {
  background-color: #e1f1ff;
}

.pricing-button.is-featured {
  background-color: #48aaff;
  color: #fff;
}

.pricing-button.is-featured:hover,
.pricing-button.is-featured:active {
  background-color: #269aff;
}
</style>

<section class="contact-area mt-30 section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="contact-content mb-100">
                    
                    <div class="row">   
                      <div class="col-12">
                          <div class="elements-title my-5">
                              <h2>@lang('index_fees.title')</h2>


                            <p class="my-3">@lang('index_fees.subtitle')*</p>
                          </div>
                      </div>
                    </div>  

                  <div class="panel pricing-table">
                    
                    <div class="pricing-plan d-sm-none d-none d-md-block" style="background-color: #f9f9f9;">
                    <p class="pricing-header" style="color: #f9f9f9 !important;">/</p>
                      <ul class="pricing-features">
                        <li class="pricing-features-item-2">
                          <span style="font-size:10px;">@lang('index_fees.m1')</span>
            
                        </li>
                        <li class="pricing-features-item-2">@lang('index_fees.m2')</li>
                        <li class="pricing-features-item-2">@lang('index_fees.m3')</li>
                        <li class="pricing-features-item-2">@lang('index_fees.m4')</li>
                      </ul>                
                    </div>
                    
                    <div class="pricing-plan">
                      <p class="pricing-header">Coinbase</p>
                      <ul class="pricing-features">
                        <li class="pricing-features-item">
                         <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 3.99%
                        </li>
                        <li class="pricing-features-item">
                         <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m2')</span>
                           <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m3')</span>
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m4')</span>
                            <img src="{{ asset('img/ok.png') }}" alt="#" width="25px">
                        </li>
                      </ul>
                    </div>
                    
                    <div class="pricing-plan">
                      <p class="pricing-header">Coinmama</p>
                      <ul class="pricing-features">
                        <li class="pricing-features-item"> 
                         <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 10.5%
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m2')</span>
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m3')</span>
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m4')</span> 
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                      </ul>
                      
                    </div>              

                    <div class="pricing-plan" style="background-color: #61b1fd">
                      <p class="pricing-header" style="color: white !important; font-weight: bold;    margin-top: -15px;margin-bottom: -1px;padding-bottom: -11px;padding-top: 18px;">Damecoins</p>
                      <span class="badge badge-success"> BEST CHOICE*</span>
                      <ul class="pricing-features" style="margin-top: 10px;">
                        <li class="pricing-features-item" style="color: white; font-weight: bold;">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 1.99%
                        </li>
                        <li class="pricing-features-item" style="color: white; font-weight: bold;">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m2')</span>
                            <img src="{{ asset('img/ok.png') }}" alt="#" width="25px">
                        </li>
                        <li class="pricing-features-item" style="color: white; font-weight: bold;">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m3')</span>
                            <img src="{{ asset('img/ok.png') }}" alt="#" width="25px">
                        </li>
                        <li class="pricing-features-item" style="color: white; font-weight: bold;">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m4')</span>
                            <img src="{{ asset('img/ok.png') }}" alt="#" width="25px">
                        </li>
                      </ul>
                    </div>                    

                    <div class="pricing-plan">
                      <p class="pricing-header">Binance</p>
                      <ul class="pricing-features">
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 3.50%
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m2')</span>
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m3')</span>
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m4')</span> 
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                      </ul>
                    </div>  

                    <div class="pricing-plan">
                      <p class="pricing-header">BTCDirect</p>
                      <ul class="pricing-features">
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 
                          5%
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 
                           <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 
                           <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">  <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px"></li>
                      </ul>
                    </div>     

                    <div class="pricing-plan">
                      <p class="pricing-header">Bitstamp</p>
                      <ul class="pricing-features">
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 
                          5%
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 
                           <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 
                            <img src="{{ asset('img/cerrar.png') }}" alt="#" width="20px">
                        </li>
                        <li class="pricing-features-item">
                          <span class="d-block d-sm-block d-md-none" style="font-size:8px">@lang('index_fees.m1')</span> 
                            <img src="{{ asset('img/ok.png') }}" alt="#" width="25px">
                        </li>
                      </ul>
                    </div>

                  </div>
                   <span style="float: right;color:#61b1fd !important;">*2020 Crypto-World Studio #4535</span>

                </div>
            </div>
        </div>
    </div>
</section>
               
