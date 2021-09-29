<div class="banner-confia py-5">
    <div class="container">
        <h2 class="font-weight-bold text-center">@lang('index.confia')</h2>
    
        <div class="row">
            <div class="col-12 col-md-3 text-center mt-4">
                <span class="icon"><i class="fas fa-check"></i></span>
                <strong>@lang('index.soculta')</strong>
            </div>
            <div class="col-12 col-md-3 text-center mt-4">
                <span class="icon"><i class="fas fa-check"></i></span>
                <strong>@lang('index.v5min')</strong>
            </div>
            <div class="col-12 col-md-3 text-center mt-4">
                <span class="icon"><i class="fas fa-check"></i></span>
                <strong>@lang('index.atencion365')</strong>
            </div>
            <div class="col-12 col-md-3 text-center mt-4">
                <span class="icon"><i class="fas fa-check"></i></span>
                <strong>@lang('index.paginsta')</strong>
            </div>
        </div>
    </div>
</div>

<div class=" py-4">
    <div class="container ">
        <div class="row">
            <div class="col-12 col-lg-5">
                <img src="{{ asset('assets/img/metodo-pago/Group17.png')}}" alt="">
                <h2 class="font-weight-bold">@lang('index.wallet')</h2>
                
                <p class="font-weight-bold h4" >@lang('index.credit')</p>
      
                <ul class="list-punto mt-4">
                    @lang('index.li')
                </ul>
      
            </div>
           
            <div class="col-12 col-lg-7 mt-4">
                @include("landing.partials.compra.compra-instantanea")
            </div>
          
        </div>
  </div>

</div>