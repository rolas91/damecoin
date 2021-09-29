@extends('layouts.admin_new') 
@section('content')
<script src="{{ asset('js/jquery-2.2.4.min.js') }}" ></script> 
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/support-recurly"><i class="fa fa-dashboard"></i> Recurly Support</a></li>
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
        <form action="{{ url('admin/support-recurly') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('currency_id') ? ' has-error' : '' }}">
                    <label class="control-label">Divisa</label>

                    <div class="">
                    {!!Form::select('currency_id', $currencies, '', [
                    'id' => 'currency_id',
                    'class' => 'form-control'
                ])!!}
                        @if ($errors->has('currency_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('currency_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
               
            <div class="row">
                <div class=" col-md-8 form-group{{ $errors->has('default_conversion') ? ' has-error' : '' }}">
                    <label class="control-label">default_conversion</label>

                    <div class="">
                    {!!Form::select('default_conversion', [0 => 'No',1=>'Yes',], '', [
                                        'id' => 'default_conversion',
                                        'class' => 'form-control'
                                    ])!!}
                        @if ($errors->has('default_conversion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('default_conversion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>    

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('stripe_account_id') ? ' has-error' : '' }}">
                    <label class="control-label">Stripe Account</label>

                    <div class="">
                    {!!Form::select('stripe_account_id', $stripe, '', [
                    'id' => 'stripe_account_id',
                    'placeholder'=>"stripe id",
                    'class' => 'form-control'
                ])!!}
                        @if ($errors->has('stripe_account_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stripe_account_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('currency_default') ? ' has-error' : '' }}">
                    <label class="control-label">Currency conver</label>
                    <div class="">
                    {!!Form::select('currency_default', [], '', [
                    'id' => 'currency_default',
                    'class' => 'form-control'
                ])!!}
                        @if ($errors->has('currency_default'))
                            <span class="help-block">
                                <strong>{{ $errors->first('currency_default') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                    <label class="control-label">note</label>

                    <div class="">
                    <input id="note" type="text" class="form-control"  name="note" value="{{ old('note') }}">
               
                        @if ($errors->has('note'))
                            <span class="help-block">
                                <strong>{{ $errors->first('note') }}</strong>
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
    <script>
     $("#stripe_account_id").change(function () {
        var id = $(this).val();
        if(id){
           // alert(id);
            $.get('/admin/gateway-recurly/' + id, function(data){
            $('#currency_default').empty();
            $.each(data, function(index, subtypObj){
                $('#currency_default').append('<option value="'+subtypObj.id+'">'+subtypObj.code+'</option>');
            });
          });
        }
      //  var cat_id = e.target.value;
     });
    </script>

<!--section end -->
@endsection