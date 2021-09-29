<div class="container mt-4">
          <h2 class="title">@lang('home.buy_mobile_other_amount')</h2>
          
          <div class="d-flex justify-content-between">
              <div class="metodos-pago text-center">
                  <div class="d-flex justify-content-between">
                      <span class="metodo-icon"><img src="/dashboard/assets/img/comprar/icon1.png" alt=""></span> <span class=" m-0 color-succes">@lang('home.buy_mobile_no_inmidiatle')</span>
                  </div>
                  <p class="mt-3 text-left ">@lang('home.buy_mobile_transfer_or_deposit')</p>
                  <a href="#" data-toggle="modal" data-target="#modal-deposito"  class="btn mx-auto">@lang('home.buy_mobile_account_available')</a>
              </div>
              <div class="metodos-pago text-center">
                  <div class="d-flex justify-content-between">
                      <span class="metodo-icon"><img src="/dashboard/assets/img/comprar/icon2.png" alt=""></span>
                  </div> 
                  <p class="mt-3 text-left">@lang('home.buy_methods_alternative') </p>
                  <a href="#" data-toggle="modal" data-target="#modal-alternativas"  class="btn mx-auto">@lang('home.buy_methods_alternative_accounts')</a>
              </div>
          </div>

      </div>


      @include("dashboard.modals.buy.tarjetas")

      @include("dashboard.modals.buy.deposito")

    