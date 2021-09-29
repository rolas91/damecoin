@extends('layouts_dash.dash')
@section('content')



    <div class="principal-section pb-3 " id="principal-section">
        <div class="comprar-section">

            <div class="d-flex justify-content-center align-items-center flex-column mt-4 d-lg-none">
                @include("layouts_dash.balance")
            </div>

            <div class="container first-section ">
                @if (Session::has('error'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible " role="alert">
                                <strong>!</strong> {{ Session::get('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <h2></h2>
                        </div>
                    </div>
                @endif
                <div class="row ">
                    <div class="col-12 col-lg-6">
                        <div class="card card-blue ">
                            <div class="card-header">
                                <h6>@lang('dash_sell.sell_title'):</h6>
                            </div>
                            <div class="card-body">


                                <div class="container-select-bootstrap mt-2 mb-2">

                                    <div class="icon">
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>


                                    <select class="selectpicker" data-live-search="true" id="getCryptoBuy">
                                        @foreach ($getCryptos as $c)
                                            <option value="{{ $c->id }}"
                                                data-content="<img class='img-select' src='{{ asset('uploads/img/' . $c->img) }}'> {{ $c->name }}">

                                        @endforeach
                                    </select>

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                        <div class="card card-blue">
                            <div class="card-header">
                                <h6>@lang('dash_sell.sell_title_2'):</h6>
                            </div>
                            <div class="card-body">

                                <div class="container-select-list">
                                    <span><i class="fas fa-angle-down"></i></span>

                                    {!! Form::select('getCurrencies', $getCurrencies, $defaultCurrency->id, [
                                    'id' => 'getCurrencyBuy',
                                    'class' => 'form-control',
                                    'data-default' => $defaultCurrency->code,
                                    'data-symbol' => $defaultCurrency->symbol,
                                    ]) !!}

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container second-section mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <h5 class="card-title">@lang('dash_sell.sell_available_wallet')</h5>
                                <div class="card card-venta">
                                    <div class="card-body py-4">
                                        <span class="icon-card-venta"><img
                                                src="{{ asset('uploads/img/' . $getCriptodefault->img) }}" alt=""></span>
                                        <small>{{ $getCriptodefault->name }}</small>
                                        <h5 class="card-title mb-1">{{ $getCriptodefault->code }} {{ $totalCrypto }}</h5>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mt-4 mt-lg-0" style="display:none">
                                <h5 class="card-title">@lang('dash_sell.sell_amount_suggested')</h5>

                                <div class="d-none d-lg-inline">
                                    <div class="card-input-radio">
                                        <input type="radio" name="radiocustom" id="">
                                        <span class="checkmark"></span>
                                        <div class="card-info-input">
                                            <div>
                                                <small>@lang('dash_sell.sell_you_sell')</small><br>
                                                <strong> 0.0095954 BTC</strong>
                                            </div>
                                            <div>
                                                <small>@lang('dash_sell.sell_receive')</small><br>
                                                <strong> 100 USDC</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-input-radio mt-3">
                                        <input type="radio" name="radiocustom" id="">
                                        <span class="checkmark"></span>
                                        <div class="card-info-input">
                                            <div>
                                                <small>@lang('dash_sell.sell_you_sell')</small><br>
                                                <strong> 0.0095954 BTC</strong>
                                            </div>
                                            <div>
                                                <small>@lang('dash_sell.sell_receive')</small><br>
                                                <strong> 100 USDC</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-input-radio mt-3">
                                        <input type="radio" name="radiocustom" id="">
                                        <span class="checkmark"></span>
                                        <div class="card-info-input">
                                            <div>
                                                <small>@lang('dash_sell.sell_you_sell')</small><br>
                                                <strong> 0.0095954 BTC</strong>
                                            </div>
                                            <div>
                                                <small>@lang('dash_sell.sell_receive')</small><br>
                                                <strong> 100 USDC</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-lg-none">
                                    <div class="row">

                                        <div class="col-12 col-md-6">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>Pagas</small><br>
                                                        <strong>100 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('dash_sell.sell_receive')</small><br>
                                                        <strong>0.0095954 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt-4 mt-md-0">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>Pagas</small><br>
                                                        <strong>100 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('dash_sell.sell_receive')</small><br>
                                                        <strong>0.0095954 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt-4">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>Pagas</small><br>
                                                        <strong>100 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('dash_sell.sell_receive')</small><br>
                                                        <strong>0.0095954 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt-4">
                                            <div class="item-options">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <small>Pagas</small><br>
                                                        <strong>100 USD</strong>
                                                    </span>
                                                    <span><i class="fas fa-arrow-right"></i></span>
                                                    <span>
                                                        <small>@lang('dash_sell.sell_receive')</small><br>
                                                        <strong>0.0095954 BTC</strong>
                                                    </span>
                                                </div>

                                                <button class="btn mt-2">Seleccionar</button>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                                <form action="/dash/sell" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="idCripto" value="{{ $getCriptodefault->id }}">
                                    <input type="hidden" name="idCurrency" value="{{ $defaultCurrency->id }}">

                                    {{--
                                    <h5 class="card-title" style="display:none">Otro Monto</h5>
                                    --}}
                                    <small>@lang('dash_sell.sell_you_sell')</small>

                                    <div class="input-group input-group-monto mb-3">

                                        <input id="totalC" class='form-control' type="number" name='totalCripto'
                                            onKeyPress="return soloNumeros(event)" value="{{ $totalCrypto }}" step="any"
                                            min="0" max="{{ $totalCrypto }}">

                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <img src="{{ asset('uploads/img/' . $getCriptodefault->img) }}" alt="">

                                                <div class="d-flex flex-column align-items-start">
                                                    <strong class="m-0">{{ $getCriptodefault->code }}</strong>
                                                </div>

                                            </span>
                                        </div>
                                    </div>

                                    <small>@lang('dash_sell.sell_receive')</small>
                                    <div class="input-group input-group-monto mb-3">
                                        <input id="totalD" class='form-control' type="number" name='totaldivisa'
                                            onKeyPress="return soloNumeros(event)" value="{{ $conver }}" step="any" min="0"
                                            max="{{ $conver }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <img src="/dashboard/assets/img/comprar/2.png" alt="">

                                                <div class="d-flex flex-column align-items-start">
                                                    <strong class="m-0">{{ $defaultCurrency->code }}</strong>

                                                </div>

                                            </span>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-info btn-info-gradient  btn-block mt-3">@lang('dash_sell.botton_sell')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="container mt-4">
                <div class="card card-information">
                    <div class="card-body d-flex">
                        <span class="mr-3"><img src="/dashboard/assets/img/vender/information.png" alt=""></span>

                        <div class="ventas-info">
                          {{-- -@lang('dash_sell.sell_information_1')<br> --}}

                            - @lang('dash_sell.sell_information_2'). <br>

                            - @lang('dash_sell.sell_information_3',["cripto"=>$getCriptodefault->code,"currency"=> $defaultCurrency->code ]) <br>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>    
     $("#getCryptoBuy option[value='{{ $getCriptodefault->id }}']").prop('selected',true)
        //select currecy
        $("#getCurrencyBuy").change(function () {
           var str = $(this).val();
           var currency  = str.toLowerCase();
           var xcrypto=$("#getCryptoBuy").val();
           var crypto = xcrypto.toLowerCase();
           window.location='/dash/currency/'+currency;
        });
       //select crypto
        $("#getCryptoBuy").change(function () {
           var str = $(this).val();
           var crypto  = str.toLowerCase();
           var currencyx=$("#getCurrencyBuy").val();
           var currency = currencyx.toLowerCase();
           window.location='/dash/crypto/'+crypto;
        });
        function redireccion(crypto,currency){
           window.location='/dash/sell/'+crypto+'/'+currency;
        }
        $("#totalD").keyup(function(){
           var currency=parseFloat($(this).val());
           var defaultCurrency={{ $conver }};
           var crypto=parseFloat({{ $totalCrypto }});
           var totalCrypto=parseFloat((crypto*currency)/defaultCurrency);
           var totalCrypto=totalCrypto.toFixed(7);
           if(isNaN(totalCrypto)){
               totalCrypto=0;
               totalCrypto=totalCrypto.toFixed(7);
               $("#totalC").val(totalCrypto);
           }else{
               $("#totalC").val(totalCrypto);
           }
           var venta={{ $venta }}*totalCrypto/{{ $totalCrypto }};

       });
       $("#totalC").keyup(function(){
         var crypto=parseFloat($(this).val());
         var defaultCurrency={{ $totalCrypto }};
         var currency=parseFloat({{ $conver  }});
         var totalCrypto=parseFloat((crypto*currency)/defaultCurrency);
         var totalCrypto=totalCrypto.toFixed(2);
         if(isNaN(totalCrypto)){
             totalCrypto=0;
             totalCrypto=totalCrypto.toFixed(2);
             $("#totalD").val(totalCrypto);
         }else{
             $("#totalD").val(totalCrypto);
         }
         var venta={{ $venta }}*crypto/{{ $totalCrypto }};
         //venta=mytoFixed(venta,"venta");
         //var comision={{ $comision }}*crypto/{{ $totalCrypto }};
         //comision=mytoFixed(comision,"comision");
        // console.log(comision)
       });
       function mytoFixed(valor,variable){
         valor=valor.toFixed(7);
         if(isNaN(valor)){
           valor=0;
           valor=valor.toFixed(7);
           $("#"+variable+"").text(valor);
         }else{
           $("#"+variable+"").text(valor);
           //$("#venta").text(valor);
         
       }
       }

    </script>
@endsection
