@extends('layouts.admin_user')
@section('meta_title')
    <title>{{ $meta['title'] }}</title>
@overwrite
@section('meta_tags')
    <!-- Seo Tags -->
    <meta name="description" content="  {{ $meta['descripcion'] }}">
    <meta name="keywords" content="{{ $meta['key'] }}">
    <meta name="robots" content="index, follow"> 
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('img/damecoins/facebooklinkpreview.jpg')}}" />
    <meta property="og:url" content="https://damecoins.com/" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:description" content="{{ $meta['descripcion'] }}" />
    <!-- /Seo Tags -->
@overwrite

 @section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Sell
        <small></small>
      </h1>
      
    </section>
    <section class="content "> 

       <div class="alert alert-danger" role="alert">
                For payments by credit or debit card, please make the payment on the home page of Damecoins.com.  Make sure to enter the same email address as your current Damecoins account so that the purchase is instantly linked to your account.  We are working hard to implement the new form directly here for your convenience as soon as possible.  Sorry for the inconvenience.
                </div>
                <a style="
                    background: #2196F3;
                    color: white;
                    padding: 10px;
                    display: block;
                    width: 30%;
                    border-radius: 30px;
                    text-align: center;
                    margin-bottom: 18px;
                    border: 1px solid #1b82d4;
                    box-shadow: 0 2px 3px rgb(0 0 0 / 11%);
                " href="/buy/{{$getCriptodefault->id  }}/{{ $getCurrencyUser->id }}">PAY WITH CREDIT/DEBIT CARD</a>

    <div class="row">
        <div class='col-sm-6'>
            <p class="subt">@lang('home_sell.selldivisa')</p>

            {!! Form::select('getCryptos', $getCryptos, $getCriptodefault->id,['id' => 'getCryptos','class' => 'form-control'] ) !!}
        </div>
        <div class='col-sm-6'>
            <p class="subt">@lang('home_sell.receivedivisa')</p>

            {!! Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->id,['id' => 'getCurrencies','class' => 'form-control']) !!}
        </div>
    
    </div>
    <br>
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong> </strong> {{Session::get('error')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                            
                        @endif
                        <br>
    
   @if($totalCrypto>0)
    <form action="/processventa" method="post" id="vender" >
          {{ csrf_field() }}
          <input type="hidden"  name='crypto' value=" {{$getCriptodefault->id}}">
          <p>@lang('home_sell.quantydivisa')</p>

          <div class="row" style="padding:15px;background-color:#ccc;margin:10px" >
            <div class='col-sm-6'>
                <div class="input-group">
                    
                    <input id="totalC" style="padding:10px" class='form-control' type="number" name='totalCrypto' value="{{$totalCrypto}}"  step="any" min="0" max="{{ $totalCrypto }}">
                    <span class="input-group-addon" style="background-color:#367fa9;color:#fff;font-weight:bold"><i class="glyphicon">{{$getCriptodefault->code}} </i></span>
                  </div>
          </div>
          <div class='col-sm-6'>
                <div class="input-group"> 
                    <input id="totalD" class='form-control' type="number" name='totaldivisa' value="{{$conver}}" step="any" min="0" max="{{ $conver }}">
                    <span class="input-group-addon" style="background-color:#367fa9;color:#fff;font-weight:bold"><i class="glyphicon">{{$getCurrencyUser->code}} </i></span>
              </div>
          </div>
          <div class='col-sm-12'>
              <p>@lang('home_sell.have') {{ $totalCrypto}} {{$getCriptodefault->code}} </p> 
          </div>  
          </div>

          <div class="row">
              <div class='col-md-5'>
                <p style="text-align:justify">-@lang('home_sell.mesagge1',["currency"=> $getCurrencyUser->code ]) 
                
                </p>
              </div>  
              <div class='col-md-7'  style="float:right">
                  <input type="hidden"  name='currency' value=" {{$getCurrencyUser->id}}">
                  <p class="final">@lang('home_sell.total'): <span id="venta">{{ $totalCrypto }} </span>{{$getCriptodefault->code}}</p>
                   {{-- Original function   --}}
                  {{--  <p class="final">@lang('home_sell.total'): <span id="venta">{{ $venta }} </span>{{$getCriptodefault->code}}</p>   --}}
                  {{--  <p class="final">@lang('home_sell.comision') {{$taker_fee}}: <span id="comision">{{$comision}}</span> {{$getCriptodefault->code}}</p>   --}}
                  {{--  End original function  --}}
              <button type="submit"  id="xxx" class='btn btn-warning  pull-right' >@lang('home_sell.btn_sell') {{$getCriptodefault->code}}</button>
              </div>  
          </div>
    </form>
    @else

    <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible " role="alert">
                            <strong>!</strong>@lang('home_sell.sindivisa',["cripto"=>$getCriptodefault->code,"currency"=>$getCurrencyUser->code]) 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                 
            </div>
    </div> 

    
    @endif

    
</section>
</div>

<script>
$("#getCurrencies").change(function(){
    //console.log($(this).val());
    //console.log($("#getCryptos").val());
    window.location="/sell/"+$("#getCryptos").val()+"/"+$(this).val();
   // alert("vendor/"+$("#getCryptos").val()+"/"+$(this).val());
        });
      $("#getCryptos").change(function(){
        window.location="/sell/"+$(this).val()+"/"+$("#getCurrencies").val();
    //alert("vendor/"+$(this).val()+"/"+$("#getCurrencies").val());
      });
       // $('.xx').submit(); 
       /*
       $("#totalC").keyup(function(){
         currency=$(this).val();
         defaultCurrency={{ $conver }};
         }); 
         */
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
          venta=mytoFixed(venta,"venta");
          var comision={{ $comision }}*totalCrypto/{{ $totalCrypto }};
          comision=mytoFixed(comision,"comision");
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
          venta=mytoFixed(venta,"venta");
          var comision={{ $comision }}*crypto/{{ $totalCrypto }};
          comision=mytoFixed(comision,"comision");
         
         // console.log(comision);

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
<!--section end -->
@endsection