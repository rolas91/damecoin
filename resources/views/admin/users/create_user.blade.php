@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Registro Nuevo Usuario
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/users"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">Nuevo</li>
      </ol>
    </section>

    <section class="content">
          @if(Session::has('success'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> !</h4>
              {{ Session::get('success') }}
            </div>
          @endif

          <div class="container">
               @foreach ($errors->all() as $error)
                   <div class="alert alert-warning">{{ $error }}</div>
               @endforeach
           <div class="row">
                   <div class="col-md-6 hero-text">
                       <div class=" justify-content-center ">
                           <div class="card">
                               
                               <div class="card-body">
                                   <div class="panel panel-default">
                                       <div class="panel-body">
                                           <form class="form-horizontal" method="POST" action="/admin/users-create-users">
                                               {{ csrf_field() }}
                                           
                                               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                  
                                                   <div class="col-md-12">

                                                       <label for="name">@lang('signup.name')</label>
                                               
                                                       <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                                   
                                                       @if ($errors->has('name'))
                                                           <span class="help-block">
                                                               <strong>{{ $errors->first('name') }}</strong>
                                                           </span>
                                                       @endif
                                                   </div>
                                               </div>
                                           
                                               <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                                      
                                                       <div class="col-md-12">
                                                            <label for="lastname">@lang('signup.lastName')</label>
                                               
                                                           <input id="lastname" type="text" class="form-control" name="lastName" value="{{ old('name') }}" required autofocus>
                                                       
                                                           @if ($errors->has('lastname'))
                                                               <span class="help-block">
                                                                   <strong>{{ $errors->first('lastname') }}</strong>
                                                               </span>
                                                           @endif
                                                       </div>
                                                   </div>
                                               
                                               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                  
                                                   <div class="col-md-12">
                                                       <label for="email">@lang('signup.email')</label>
                                                       <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                                   
                                                       @if ($errors->has('email'))
                                                           <span class="help-block">
                                                               <strong>{{ $errors->first('email') }}</strong>
                                                           </span>
                                                       @endif
                                                   </div>
                                               </div>
                                               <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                                  
                                                   <div class="col-md-12">
                                                       <label for="email">@lang('signup.country')</label>
                                                           {!!Form::select('country_id', $getCountry, '56', [
                                                               'id' => 'getCountry',
                                                               'class' => 'form-control',
                                                               'placeholder' => __('signup.country'),
                                                               'required'=>'required'
                                                           ])!!}
                                                   
                                                       @if ($errors->has('country'))
                                                           <span class="help-block">
                                                               <strong>{{ $errors->first('country') }}</strong>
                                                           </span>
                                                       @endif
                                                   </div>
                                               </div>

                                               <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
                                                  
                                                  <div class="col-md-12">
                                                      Rol
                                                          {!!Form::select('role_id', $rols, ' ', [
                                                              'id' => 'rol',
                                                              'class' => 'form-control',
                                                              'placeholder' => 'Rol',
                                                              'required'=>'required'
                                                          ])!!}
                                                  
                                                      @if ($errors->has('rol'))
                                                          <span class="help-block">
                                                              <strong>{{ $errors->first('rol') }}</strong>
                                                          </span>
                                                      @endif
                                                  </div>
                                              </div>
                                               <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                   <div class="col-md-12">
                                                       <label for="password">@lang('signup.password')</label>
                                                       <input id="text" value="{{ $password }}" type="text" class="form-control" name="password" required>
                                                   </div>
                                               </div>
                                           
                                               <div class="form-group">
                                                   
                                                   <div class="col-md-12">
                                                       <label for="password-confirm">@lang('signup.confirm')</label>
                                               
                                                       <input id="password-confirm" value="{{ $password }}" type="text" class="form-control" name="password_confirmation" required>
                                                       @if ($errors->has('password-confirm'))
                                                       <span class="help-block">
                                                           <strong>{{ $errors->first('password-confirm') }}</strong>
                                                       </span>
                                                   @endif
                                                   </div>
                                               </div>
                                           
                                               <div class="form-group">
                                                   <div class="col-md-12 col-md-offset-4">
                                                       <button type="submit" class="btn btn-primary">
                                                           @lang('signup.buttom')
                                                       </button>
                                                   </div>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       </div>
                       <div class="col-md-6">
                                    
                       </div>
   
   
               
           </div>
       </div>
         
          
          

       

      </section>


  
</div>
    
<!--section end -->
@endsection