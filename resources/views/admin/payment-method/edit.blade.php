@extends('layouts.admin_new')
@section('content')
    <!-- section -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                PaymentMethodState (Edit)
                <small></small>
            </h1>

        </section>
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/admin/limit"><i class="fa fa-dashboard"></i> Divisa</a></li>
                <li class="active">Actualizar</li>
            </ol>
        </section>
        <section class="content">


            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        {{ Form::model($method, ['route' => ['payment-method.update', $method->id], 'method' => 'PUT', 'files' => true]) }}
                        {!! Form::token() !!}
                        @include('admin.payment-method.partials.form',["file"=>$method->file])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

        </section>
    </div>


    <!--section end -->
@endsection
