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
    <meta property="og:image" content="{{ asset('img/damecoins/facebooklinkpreview.jpg') }}" />
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
                @lang('home_retiro.header')
                <small></small>
            </h1>
        </section>
        <section class="content">
            @if (Session::has('success'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> {{ Session::get('success') }}</h4>

                        </div>

                    </div>
                </div>
            @endif

            @if (Session::has('msg'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-error alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> {{ Session::get('msg') }}</h4>

                        </div>

                    </div>
                </div>
            @endif

            <p> @lang('home_retiro.currency')</p>
            {!! Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->id, ['id' => 'getCurrencies', 'class' =>
            'form-control']) !!}

            @if ($totalCurrency >= 0)
                <p> @lang('home_retiro.quanty')</p>

                <form action="/processretiro" method="post" id="retiro">
                    {{ csrf_field() }}
                    <div class="row" style="padding:20px;background-color:#ccc;margin:10px">
                        <div class="col-sm-6">
                            <input type="hidden" name='idCurrency' value=" {{ $getCurrencyUser->id }}">
                            <div class="input-group">

                                <input class="form-control" id="totalCurrency" type="number" name='totalCurrency' value=""
                                    placeholder="{{ $totalCurrency }}" required>

                                <div class="input-group-prepend">
                                    <div class="input-group-text color-input">{{ $getCurrencyUser->code }}</div>
                                </div>
                            </div>
                            @if ($errors->has('totalCurrency'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('totalCurrency') }}</strong>
                                </span>
                            @endif
                            @if ($totalCurrency == 0)
                                <p class="text-info"> @lang('home_retiro.sinsaldo',["currency"=>$getCurrencyUser->code])</p>
                            @endif
                            <p class="badge" style="margin-top: 20px;background: #2196F3">@lang('home_retiro.saldo')
                                {{ $totalCurrency }} {{ $getCurrencyUser->code }} </p>
                        </div>


                    </div>
                    <section class="invoice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('home_retiro.destinatario')</label>
                                    <input type="text" class="form-control" name="beneficits">
                                    @if ($errors->has('beneficits'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('beneficits') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">@lang('home_retiro.banco')</label>
                                    <input type="text" class="form-control" name="bankname">
                                    @if ($errors->has('bankname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bankname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('home_retiro.country')</label>
                                    <input type="text" class="form-control" name="bankcountry">
                                    @if ($errors->has('bankcountry'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bankcountry') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('home_retiro.addres') </label>
                                    <input type="text" class="form-control" name="bankaddress">
                                    @if ($errors->has('bankaddress'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bankaddress') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('home_retiro.swift') </label>
                                    <input type="text" class="form-control" name="bankswit">
                                    @if ($errors->has('bankswit'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bankswit') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('home_retiro.account') </label>
                                    <input type="text" class="form-control" name="bankiban">
                                    @if ($errors->has('bankiban'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bankiban') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p> @lang('home_retiro.mesagge0')</p>
                                <p> @lang('home_retiro.mesagge1')</p>
                                <p> @lang('home_retiro.mesagge2')</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="final">@lang('home_retiro.totalt') <span id="total"> </span>
                                    {{ $getCurrencyUser->code }}</p>
                                {{-- <p class="final">@lang('home_retiro.comisiont')
                                    {{ $getCurrencyUser->detailCurrency->comision_retiro }} % :<span id="comision"></span>
                                    {{ $getCurrencyUser->code }} </p> --}}
                                <button type="submit" id="xxx"
                                    class="btn btn-warning mibutom pull-right">@lang('home_retiro.bottonretiro')
                                    {{ $getCurrencyUser->code }} </button>


                            </div>

                        </div>

                    </section>
                </form>

            @else
                <br>

                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> @lang('home_retiro.sinsaldo',["currency"=>$getCurrencyUser->code])
                    </h4>

                </div>

            @endif

        </section>
    </div>
    <script>
        $("#getCurrencies").change(function() {
            window.location = "/retirar/" + $(this).val();
        });

        $("#totalCurrency").keyup(function() {
            multi()
        });
        multi()

        function multi() {
            var currency = parseFloat($("#totalCurrency").val());
            var comision = parseFloat({
                {
                    $getCurrencyUser - > detailCurrency - > comision_retiro
                }
            });
            if (isNaN(currency)) {
                comision = mytoFixed(0, "comision");
                comision = mytoFixed(0, "total");
            } else {
                var comi = ((currency * comision) / 100);
                // var total=currency-comi;
                var total = currency;
                //console.log(comi);
                comision = mytoFixed(comi, "comision");
                comision = mytoFixed(total, "total");
            }
        }

        function mytoFixed(valor, variable) {
            valor = valor.toFixed(2);
            if (isNaN(valor)) {
                valor = 0;
                valor = valor.toFixed(2);
                $("#" + variable + "").text(valor);
            } else {
                $("#" + variable + "").text(valor);
                //$("#venta").text(valor);
            }

        }

    </script>
    <!--section end -->
@endsection
