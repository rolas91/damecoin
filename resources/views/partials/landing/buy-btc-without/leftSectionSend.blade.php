<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div class="container " style="margin-top: 6%">
    <div class="row">
        <div class="col-12 col-lg-5">
            <img src="/img/emptylogo.png" id="imageBtcTop" width="50" height="50">
            <img class="icon-coin-small mx-3" src="{{ asset('img/metodo-pago/switch1.png') }}" alt="">
            <img  src="{{ asset($data->file)}}" width="50" height="50" alt="">
            
            <h2 class="text-white font-weight-bold">
            @lang('index.enviaizquierdo')
              <span class="text-success"> {{ $getCriptodefault->name }}</span> 
               @lang('index.parrafosgtIzq')
              <span class="text-success">{{ $metodo }}</span> 
            </h2>
            <p class="text-white mt-2">
                @lang('index.SubtituloDamecoins')
                @lang('index.SubTitulo2Damecoins')
            </p>
            
                        <a href="/signup" class="btn btn-info link-gradient-blue mx-1"> <img class="mr-2" src="{{ asset('img/landing/icons/rocket.png') }}" alt="">@lang('index.btnnewacc')</a>
    
                        <button type="button" class="btn btn-outline-light mx-1">@lang('index.conocerMas')</button>
            
            
            <ul class="list-punto-light mt-4">
               @lang('index.li2')
            </ul>

        </div>
        <div class="col-12 col-lg-7 mt-4">
            <div class="card card-compra-instantanea ">
                <div class="card-body">

                    <div class="row mr-0">
                        <div class="col-12 col-md-6 ">
                            <strong>@lang('index.depositarDivisa')</strong>

                            <div class="container-select-list mt-2">
                                <div class="icon"> 
                                    <span class="mr-2">{{$getCriptodefault->code}} </span>
                                    <span><i class="fas fa-angle-down"></i></span>
                                </div>
                                {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                                    'id' => 'getCryptosss',
                                    'class' => 'form-control'
                                    ])
                                !!}
                            </div>

                                    
                        </div>
                        <div class="col-12 col-md-6 ">
                            <strong >@lang('index.recibirWallets')</strong>

                            <div class="container-select-list mt-2">
                                <div class="icon"> 
                                    <span class="mr-2" id="pay" ></span> 
                                    <span><i class="fas fa-angle-down"></i></span>
                                </div>
                                
                                {!!Form::select('getMethods', $methods, '$getMethodDefault->name', [

                                    'id' => 'getMethods',
                                    'class' => 'form-control',
                                    'placeholder' => $getMethodDefault->name

                                ])!!}
                                
                            </div>

                        </div>
                    </div>
                    
                    @if(Auth::user())
                    <div class="container-select-list mt-2">
                        <div class="icon"> 
                            <span class="mr-2" id="pay" > </span>    
                        </div>               
                    </div>
                    <div class="container">
                    <form  method="POST" action="/cripto_wallet" id="sendMonto" role="form" class="p-25 m-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div class="row">
                            <div class='col-sm-6 mb-3'>
                                 <input
                                     type="text"
                                     value=""
                                     id="montoCrypto"
                                     name="montoCrypto"
                                     class="form-control  mb-3 mb-md-0 mb-lg-0"
                                     required="required"
                                    placeholder="@lang('index.digitaMonto')">
                            </div>

                            <div class='col-sm-6 '>
                                <input
                                type="text"
                                value=""
                                id="cuenta"
                                name="cuenta"
                                class="form-control  mb-3 mb-md-0 mb-lg-0"
                                required="required"
                                placeholder="@lang('index.digitaCuenta')">
                            </div>
                            <div class="container panelComision text-center text-bold" style="display: none;">
                                        <h6 class="alert alert-primary">Por el envío a {{$getMethodDefault->name}} usted debe pagar una comisión de {{$getMethodDefault->send_comission}}% 
                                        que se le cargará que se le descontará automáticamente al monto colocado arriba.</h6>   
                                        <h5>Se transferirá*</h5>
                                    <h3 class="actualform">  <h5> {{$getCriptodefault->code}}</h5></h3>
                                    <h5>Menos {{$getMethodDefault->send_comission}}% de comisión:</h5><h3 id="comi"></h3>
                                    <h3>Total {{$getCriptodefault->code}} a transferir: </h3> <h3 id="total"></h3>
                                    <p class="text-muted">Los valores de conversion a {{$getCurrencyUser->code}} tomarán de referencia según el día de la transacción</p>
                            </div>        
                            <div class='col-sm-6 formx'>
                                <input
                                type="hidden"
                                value="{{$cryptoUser[0]->total}}"
                                id="cryptoDisponible"
                                name="cryptoDisponible"
                                class="form-control  mb-3 mb-md-0 mb-lg-0">
                            </div>
                            <div class='col-sm-6 formx'>
                                <input
                                type="hidden"
                                value="{{$getMethodDefault->send_comission}}"
                                id="comission"
                                name="comission"
                                class="form-control  mb-3 mb-md-0 mb-lg-0">
                            </div>
                            <div class='col-sm-6 formx'>
                                <input
                                type="hidden"
                                value="{{$getMethodDefault->name}}"
                                id="platform"
                                name="platform"
                                class="form-control  mb-3 mb-md-0 mb-lg-0">
                            </div>
                            <div class='col-sm-6 formx'>
                                <input
                                type="hidden"
                                value="{{$getCriptodefault->code}}"
                                id="getCryptosss"
                                name="getCryptosss"
                                class="form-control  mb-3 mb-md-0 mb-lg-0">
                            </div>
                        </div>
                        
                        <center>
                        <input type="submit" name="" value="Go to send"  class="btn btn-outline-info w-100 p-1 btn-md h-25 mostrarForm"> 
                        </center>
                        <br>
                        <div class="container">
                            <p>@lang('index.variasDivisas')</p>
                            <div class="col-12 col-md-6 ">
                            <strong >@lang('index.recibirWallets')</strong>

                            <div class="container-select-list mt-2">
                                <div class="icon"> 
                                    <span class="mr-2"  ></span> 
                                    <span><i class="fas fa-angle-down"></i></span>
                                </div>
                                    {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                                    'id' => 'getCurrencies',
                                    'class' => 'form-control'])!!}
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (session('success')) 
                        <div class="alert alert-success"  id="transaccionExitosa"  role="alert">
                        {{ session('success') }}
                        </div>
                     @endif
                        <div class="alert alert-danger hidden"  id="errorMonto" role="alert" style="display:none" >
                            <button type="button" class="close"  id="cerrar" >X</span></button>
                            @lang('index.fondoInsuficiente')  <strong>{{$getCriptodefault->name}}</strong> @lang('index.fondoInsuficiente2')
                        </div>       
                         
                    </div>
            
                    
                    <div class="container-fluid" style="background:#F5F2F3;border-radius: 5px;">
                        @include("partials.form.payment-activo", ['dir'=>'index'])
                    </div>
                    
                    
                @else
               <center><strong class="text-center">Logueate para transferir tus criptos</strong></center> 
                    <a href="/login" class="btn text-decoration-none link-gradient-blue w-100 btn-sm py-2 px-3 mt-3"> <img class="mr-2" src="{{ asset('img/landing/icons/user.png') }}" alt=""> @lang('header.login')</a>
                    <div class="container-fluid" style="background:#F5F2F3;border-radius: 5px;">
                        @include("partials.form.payment-activo", ['dir'=>'index'])
                    </div>
                    
                    
                @endif
                    <div class="row justify-content-lg-between mt-3">
                        <div class="d-flex justify-content-center align-items-center flex-wrap mt-3" style="width: 100%;">
                            <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.comiciones')</p>
                            <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.inmediato')</p>
                            <p class="my-0 mx-2"> <span class="color-succes"><i class="fa fa-check"></i></span>  @lang('index.proceso')</p>
                        </div>
                        
                        <center style="width: 100%;">
                            <a href="{{ url(__('route.Payments', ['crypto' => $getCriptodefault->code, 'divisa' => $getCurrencyUser->code,'method' => $metodo  ])) }}" class=" link " >@lang('index.verMetodos')</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
