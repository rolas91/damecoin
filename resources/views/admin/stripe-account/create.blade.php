@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/stripe-account"><i class="fa fa-dashboard"></i> Recurly Support</a></li>
            <li class="active">Nueva</li>
          </ol>
        </section>

        <section class="content">
        <div class="container">
        @if(Session::has('error'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('error') }}
          </div>

        @endif
        <form action="{{ url('admin/stripe-account') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

             <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label">name</label>

                    <div class="">
                    <input id="name" type="text" class="form-control"  name="name" value="{{ old('name') }}">
               
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>   

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('stripe_id') ? ' has-error' : '' }}">
                    <label class="control-label">stripe_id</label>

                    <div class="">
                    <input id="stripe_id" type="text" class="form-control"  name="stripe_id" value="{{ old('stripe_id') }}">
               
                        @if ($errors->has('stripe_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stripe_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class=" col-md-8 form-group{{ $errors->has('secure_3d') ? ' has-error' : '' }}">
                    <label class="control-label">secure_3d</label>

                    <div class="">
                    {!!Form::select('secure_3d', [0 => 'No',1=>'Yes',], '', [
                                        'id' => 'secure_3d',
                                        'class' => 'form-control'
                                    ])!!}
                        @if ($errors->has('secure_3d'))
                            <span class="help-block">
                                <strong>{{ $errors->first('secure_3d') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('user_by') ? ' has-error' : '' }}">
                    <label class="control-label">user_by</label>

                    <div class="">
                    <input id="user_by" type="text" class="form-control"  name="user_by" value="{{ old('user_by') }}">
               
                        @if ($errors->has('user_by'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_by') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('email_owner') ? ' has-error' : '' }}">
                    <label class="control-label">email_owner</label>

                    <div class="">
                    <input id="email_owner" type="email" class="form-control"  name="email_owner" value="{{ old('email_owner') }}">
               
                        @if ($errors->has('email_owner'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email_owner') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('email_admin') ? ' has-error' : '' }}">
                    <label class="control-label">email_admin</label>

                    <div class="">
                    <input id="email_admin" type="email" class="form-control"  name="email_admin" value="{{ old('email_admin') }}">
               
                        @if ($errors->has('email_admin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email_admin') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>   
            
                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button> 
                        </div>
                </div>
        </form>
       </div>
    </section>

    </div>


<!--section end -->
@endsection