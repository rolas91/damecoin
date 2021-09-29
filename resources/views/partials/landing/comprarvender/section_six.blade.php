<div class="section-seven corte-4 ">
        <div class="container py-5">
            <div class="card banner-card">
                <div class="card-body py-5 text-center ">

                    <h2 class=" font-weight-bold ">@lang('index.netaccount')</h2>
                <a href="{{ url('signup') }}" class="btn text-decoration-none link-gradient-blue mx-auto py-2 px-3 mt-3"> <img class="mr-2" src="{{ asset('assets/img/navbar-landing-page/nave.png')}}" alt=""> @lang('index.btnnewacc')</a>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row justify-content-end">
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start">
                <h2>@lang('index.conoce')</h2>
                <p class="mb-0">

                </p>
                <a href="#" class="btn text-decoration-none link-gradient-blue  py-2 px-4 mt-3"> @lang('index.a') </a>
            </div>
            <div class="col-12 col-lg-7 mt-4 mt-lg-0">
                
                <div class="slider-metodo-pago">
                    <div id="slider-metodo-prev" class="slider-metodo-prev"> 
                        <span><i class="fas fa-arrow-left"></i></span> 
                    </div>
     
                    <div class="owl-carousel owl-theme " id="owl-metodo-pago">
                    
                            <div class="item">
                        
                                <div class="card card-metodo-pago">
                                    <div class="card-header d-flex justify-content-between align-items-start ">
                                    <span><img class="img-fluid" src="/{{$data->file}}" alt="">
                                    @if($data->state == 1)
                                    <span class="tipo bg-green">@lang('index.auto')</span>
                                    @else
                                    <span class="tipo bg-blue">@lang('index.manual')</span>
                                    @endif
                                    </div>
                                    {{-- <div class="card-body pt-0">
                                        <h5 class="card-title "><strong>{{ $data->name }}</strong></h5>
                                        <p class="card-text">
                                            {{ $data->description }}
                                        </p>
                                        <a href="#" class="btn-link">@lang('index.showmethod')<span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                    </div> --}}
                                </div>
                            </div>
                    
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

    <div class="conatiner py-4 text-center ">
    <img class="img-card" src="{{ asset('assets/img/comprar-vender/Free-holding-credit-card-mockup-free .png')}}" alt="">
            <h2 class="font-weight-bold mt-3">@lang('index.comprainstanta')</h2>
            <a href="#" class="btn text-decoration-none link-gradient-blue mx-auto py-2 px-4 mt-3">
               @lang('index.compraAhora')
            </a>

    </div>