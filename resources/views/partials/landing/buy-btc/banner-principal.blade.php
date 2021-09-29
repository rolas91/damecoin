<div class=" banner-principal banner ">
  <div class="container" style="margin-top: 6%">
        <div class="row">
            <div class="col-12 col-lg-6">
                {{-- <img class="icon-coin" alt="" id="imageBtcTop"> --}}
                <img src="/img/emptylogo.png" id="imageBtcTop" width="50" height="50">
                <h2 class="text-white font-weight-bold">@lang('index.comprar') {{$getCriptodefault->code}} @lang('index.con') 
                </h2>
                <p class="text-white">
                    @lang('index.text-span')
                </p>
                <a href="#second-section" class="btn  link-gradient-blue">@lang('index.a')</a>

                <ul class="list-check pt-4">
                    <li> <span class="icon mr-2"></span> @lang('index.comprarfacilmente')</li>
                    <li> <span class="icon mr-2"></span> @lang('index.guardatus')
                    </li>
                    <li> <span class="icon mr-2"></span> @lang('index.grafic')</li>
                </ul>

            </div>
            <div class="col-12 col-lg-6 mt-4  text-center">
                <img class="img-principal" src="{{ asset('assets/img/metodo-pago/img-principal.png')}}" alt="">
            </div>
        </div>
  </div>

</div> 