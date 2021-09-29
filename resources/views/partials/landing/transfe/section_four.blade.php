<div class="container-fluid pt-5 mb-4 corte-completo">
    <div class="row justify-content-end">
        <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start">
            <h2>@lang('index.conoce')</h2>
            <p class="mb-0">is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <a href="#" class="btn text-decoration-none link-gradient-blue  py-2 px-4 mt-3"> Ver todos </a>
        </div>
        <div class="col-12 col-lg-7 mt-4 mt-lg-0">
            
            <div class="slider-metodo-pago">
                <div id="slider-metodo-prev" class="slider-metodo-prev"> 
                    <span><i class="fas fa-arrow-left"></i></span> 
                </div>
 
                <div class="owl-carousel owl-theme " id="owl-metodo-pago">
                
                    @foreach ($data as $item)
                    <div class="item">
                
                        <div class="card card-metodo-pago">
                            <div class="card-header d-flex justify-content-between align-items-start ">
                            <span><img class="img-fluid" src="/{{$item->file}}" alt="">
                            @if($item->state == 1)
                            <span class="tipo bg-green">@lang('index.auto')</span>
                            @else
                            <span class="tipo bg-blue">@lang('index.manual')</span>
                            @endif
                            </div>
                            <div class="card-body pt-0">
                                <h5 class="card-title "><strong>{{ $item->payment_method }}</strong></h5>
                                   <p class="card-text">
                                       {{ $item->description }}
                                   </p>
                                   <a href="#" class="btn-link">@lang('index.showmethod')<span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                            </div>
                        </div>

                    
                    </div>
                @endforeach
                
                </div>

                <div id="slider-metodo-dots" class="mt-3 slider-metodo-dots">
                    <div class="owl-dot active"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                </div>

            </div>

        </div>
    </div>

</div>
