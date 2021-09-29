@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Usuarios
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/users"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active"> <a href="/admin/users/create">Nuevo usuario</a></li>
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
        @if(Session::has('error'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('error') }}
          </div>

        @endif

        <form action="{{ url('admin/users') }}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="destinatary" class=" control-label">Email</label>
    
                       
                            <input id="email" type="text" class="form-control" required name="email" value="{{ old('email') }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        
                </div>
                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Buscar
                            </button> 
                        </div>
                </div>
        </form>
        <!--
        <a href="{{ url('admin/currency/create') }}"> Nueva divisa</a>
        -->
                <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">email</th>
                            <th scope="col">name</th>
                            <th scope="col">lastname</th>
                            <th scope="col">rol</th>
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $index=1;
                        ?>
                        @forelse ($users as $user)
                        <tr>
                        <th scope="row">{{ $index++ }}</th>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->lastName }}</td>
                        <td>{{ $user->rol->name }}</td>
           
   
                        <td>
                        <a data-toggle="tooltip" title="Agregar fiat" href="{{ url('admin/users/'.$user->id.'') }}" class="btn btn-warning"><i class="fa fa-dollar"></i></a>
                        <a data-toggle="tooltip" title="Ver historial crypto" href="{{ url('admin/users-history/'.$user->id.'') }}" class="btn btn-success"><i class="fa fa fa-bitcoin"></i></a>
                        <a data-toggle="tooltip" title="Ver historial de pagos" href="{{ url('admin/users-history-payment/'.$user->id.'') }}" class="btn btn-warning"><i class="fa fa fa-eur"></i></a>
                       
                        <a data-toggle="tooltip" title="Ver crypto" href="{{ url('admin/users-wallet/'.$user->id.'') }}" class="btn btn-success"><i class="fa fa-google-wallet"></i></a>
                        <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        @empty
                                <p>No user email registrado</p>
                        @endforelse
                          
                        </tbody>
                      </table>
            {{ $users->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection