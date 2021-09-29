@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Criptodivisa
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/cripto"><i class="fa fa-dashboard"></i> Criptodivisa</a></li>
        <li class="active">list</li>
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
        <a href="{{ url('admin/cripto/create') }}"> Nueva Criptodivisa</a>
                <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">orden</th>
                            <th scope="col">code</th>
                            <th scope="col">taker free</th>
                            <th scope="col">maker free</th>
                            <th scope="col">Status</th>
                            <th>img</th>
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>
                        <tbody>

                        @forelse ($criptos as $cripto)
                        <tr>
                        <th scope="row">1</th>
                        <td>{{ $cripto->name }}</td>
                        <td>{{ $cripto->orden }}</td>
                        <td>{{ $cripto->code }}</td>
                        <td>{{ $cripto->taker_fee }}%</td>
                        <td>{{ $cripto->maker_fee }}%</td>
                        <td>{{$cripto->status === 0 ? 'Inactiva' : 'Soportada'}}</td>
                        <td><img src="{{ asset('uploads/img') }}/{{ $cripto->img }}" alt=""></td>
                        <td><a href="{{ url('admin/cripto/'.$cripto->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        @empty
                                <p>No Ciptos</p>
                        @endforelse
                          
                        </tbody>
                      </table>
            {{ $criptos->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection