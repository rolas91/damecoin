
    @extends('layouts.admin_new') 

    @section('content')
    <!-- section -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <ol class="breadcrumb">
                <li><a href="/paswword"><i class="fa fa-dashboard"></i> perfil</a></li>
                <li class="active">Actualizar</li>
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
    
            <form action="/password" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                   
                    <div class="form-group{{ $errors->has('contraseña_actual') ? ' has-error' : '' }}">
                        <label for="contraseña_actual" class=" col-md-12 ">Clave Actual</label>
    
                        <div class="col-md-12">
                            <input id="contraseña_actual" type="password" class="form-control" name="contraseña_actual" autofocus placeholder="Contraseña Actual">
                            @if ($errors->has('contraseña_actual'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contraseña_actual') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12">Contraseña</label>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password"  maxlength="20" placeholder="Nueva contraseña">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirmation" class="col-md-12">Confirmar Contraseña</label>
                            <div class="col-md-12">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"  maxlength="20" placeholder="Confirmar contraseña">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
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
           
            </section>
    </div>   
    
       
    <!--section end -->
    @endsection