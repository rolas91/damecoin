<div class="container-fluid section-slider-comprar pl-5" style="background: rgb(46,76,155);
background: linear-gradient(90deg, rgba(46,76,155,1) 0%, rgba(17,34,81,1) 76%);">
    <div class="row">    
        <div class="col-12 col-lg-4 pl-lg-5">
            @lang('index.interesar')
        </div>

        <div class="col-12 col-lg-8 mt-4 mt-lg-0">
            <div class="slider-compra">

                <div id="slider-compra-prev" class="slider-compra-prev"> 
                    <span><i class="fas fa-arrow-left"></i></span> 
                </div>

                <div class="owl-carousel owl-theme" id="owl-carousel-compra">
                    <div class="item" >
                    
                            {{$subtitles['envia']}}
                        
                        <a href="{{ url(__('route.enviar', ['crypto' => "btc", 'metodo' => 'alipay'])) }}" class="">Go -> <span><i class="fas fa-chevron-right"></i></span> </a>
                    </div>
                    <div class="item" >
                        {{$subtitles['convert']}}
                        <a href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => 'paypal'])) }}" class="">Go -> <span><i class="fas fa-chevron-right"></i></span> </a>
                    </div>
                    <div class="item" >
                        {{$subtitles['compra']}}
                        <a href="{{ url(__('route.Convert', ['crypto' => "btc", 'divisa' => 'usd'])) }}" class="">Go -> <span><i class="fas fa-chevron-right"></i></span> </a>
                    </div>
                    <div class="item" >
                        {{$subtitles['mercadopago']}}
                        <a href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'mercadopago'])) }}" class="">Go -><span><i class="fas fa-chevron-right"></i></span> </a>
                    </div>
                </div>

                <div id="slider-compra-dots" class="mt-3 slider-compra-dots">
                    <div class="owl-dot active"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                </div>

            </div>
        </div>
    </div>
</div>