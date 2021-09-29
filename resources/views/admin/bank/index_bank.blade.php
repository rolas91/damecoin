@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/bank"><i class="fa fa-dashboard"></i> Cuenta Bancaria</a></li>
            <li class="active">List</li>
          </ol>
        </section>
        <section class="content">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                        <strong>!</strong> {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif

            <a href="{{ url('admin/bank/create') }}"> Nueva cuenta</a>
            <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Destinatario</th>
                            <th scope="col">País</th>
                            <th scope="col">Swift</th>
                            <th scope="col">Status</th>
                           
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>
                        <tbody>

                        @forelse ($banks as $bank)
                        <tr>
                        <th scope="row">1</th>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->destinatary }}</td>
                        <td>{{ $bank->country }}</td>
                        <td>{{ $bank->swift }}</td>
                        <td> {{  $bank->status === 0 ? 'Cancelado' : 'Activo'}}</td>


                      
                        
                        <td><a href="{{ url('admin/bank/'.$bank->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        @empty
                               
                        @endforelse
                          
                        </tbody>
                      </table>
           

           

        
       
        </section>
</div>   

   
<!--section end -->
@endsection