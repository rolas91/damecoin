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
            @lang('home.header')
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i>  @lang('home.header')</a></li>
            <li class="active">list</li>
        </ol>
    </section>
    <section class="content">
        @if(Session::has('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible " role="alert">
                        <strong>Excelente!</strong> {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <h2></h2>
                </div>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-error alert-dismissible " role="alert">
                        <strong></strong> {{Session::get('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <h2></h2>
                </div>
            </div>
        @endif
        <div class="row">
            <div class='col-sm-6'>
                {!!Form::select('getCurrencies', $getCurrencies, $default->id, ['id' => 'getCurrencies','class' => 'form-control'])!!}
            </div>
        </div>
        <!-- wallet principal -->
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                          <div class="row">
                                <div class="col-sm-3">
                                    <div class="circulo">
                                        <h2>{{ $default->symbol }} </h2>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <h3 class="box-title" style="vertical-align:middle!important">
                                        {{$default->code}} Wallet
                                    </h3>
                                </div>
                          </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h3 style="margin:0;color:#367fa9;font-weight:bold">
                                    {{$default->code}}  {{ General::getCryptoWalettUser($default->id) }}
                                </h3>
                            </div>
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a class="btn btn-block btn-primary" href="/deposit/{{$default->id}}"> @lang('home.deposit')  </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a class="btn btn-block btn-primary" href="/retirar/{{$default->id}}"> @lang('home.retiro')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--cripto Wallet-->
        <div class="row">
            @forelse($unionCryptos as $crypto)
                <div class="col-sm-12 col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><img style="width:50px;height:50px" src="{{ asset('uploads/img') }}/{{ $crypto['crypto']->img }}" alt=""> {{$crypto['crypto']->code}}</h3>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                        <div class="row" style="margin:0;padding:0;">
                       
                            <div class="col-sm-12 col-md-4">
                             
                                <?php //$z = General::getCryptoUser($crypto->id);?>
                                <h4 style="margin:0;color:#367fa9;font-weight:bold">  {{ $crypto['amount'] }} {{$crypto['crypto']->code}}
                                </h4>

                                <p style="display:none; font-size: 1.5rem;color: #03A9F4;font-weight: bold;">{{  $default->code}} {{ $crypto['conver'] }}</p>

                                <p style="font-size:15px;color:#4dcbea">{{$crypto['crypto']->name }}</p>
                                
                            </div>
                            <div class="col-sm-12 col-md-8" >
                            
                                <div class="row" style="margin:0;padding:0;">
                                    <div class="col-sm-6 col-md-6" style="padding:2px">
                                        <a class="btn btn-block btn-primary" href="/buy/{{$crypto['crypto']->id}}/{{$default->id}}"> @lang('home.buy') {{$crypto['crypto']->code}} </a>
                                    </div>

                                    <div class="col-sm-6 col-md-6" style="padding:2px;">
                                        <a class="btn btn-block btn-primary"   href="/sell/{{$crypto['crypto']->id}}/{{$default->id}}"> @lang('home.sell') {{ $crypto['crypto']->code }}</a>

                                        @if($user->created_at->gt(\Carbon\Carbon::create(2020, 4, 20)) || $paymentAcount == 0)
                                            <button type="button" class="btn btn-block btn-primary open-AddBookDialog" data-toggle="modal" data-target="#wallet"  data-code="{{ $crypto['crypto']->code }}" data-id="{{ $crypto['crypto']->id }}" data-default="{{ $default->id }}">
                                            @lang('home.retiro') {{ $crypto['crypto']->code }}
                                            </button>
                                        @endif
                                    </div>
                                    
                                </div>
                                
                                
                                
                            </div>
                            

                        </div>
                        
                     </div>
                      <!-- /.box-body -->
            </div>
                    <!-- /.box -->
        </div>
            @empty
                <p></p>
            @endforelse
        </div>

        <div class="modal fade" id="wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title"  style="font-weight: bold" id="exampleModalLabel">@lang('home.retiro') <span class="title-crypto"></span></h5>
                    </div>
                    <div class="modal-body" style="padding: 20px 10px 30px">
                        <div class="alert alert-danger" role="alert">
                            <h4 style="line-height:28px"> You do not have enough <span class="title-crypto"></span> to send to another <span class="title-crypto"></span> wallet outside Damecoins! Please purchase more <span class="title-crypto"></span> and try again!</h4>
                        </div>
                        <div style="display: flex; justify-content: center">
                            <a class="btn btn-primary sell-wallet"  href="/buy/1/{{$default->id}}"> @lang('home.buy') <span class="title-crypto"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
</div>

<script>
    $("#getCurrencies").change(function () {
        window.location = "/home/" + $(this).val();
        // alert("vendor/"+$("#getCryptos").val()+"/"+$(this).val());
    });

    $(document).on("click", ".open-AddBookDialog", function () {
        var code = $(this).data('code');
        var id = $(this).data('id');
        var defaultId = $(this).data('default');

        $('.title-crypto').text(code);

        $('.sell-wallet').attr("href", "/buy/"+id+"/"+defaultId)
    });
</script>
<!--section end -->
@endsection