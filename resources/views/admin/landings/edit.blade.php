@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="card" style="width: 100%">
                <div class="card-header text-center">
                    Edit Landing
                </div>

                <div class="card-body">

                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> !</h4>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    {{ Form::model($landing, ['route' => ['landing.update', $landing->id], 'method' => 'PUT']) }}  
                        {!! Form::token() !!}
                        @include('admin.landings.partials.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!--section end -->
@endsection