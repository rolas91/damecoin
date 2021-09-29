@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Divisas
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/currency"><i class="fa fa-dashboard"></i> Divisa</a></li>
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
        <a href="{{ url('admin/currency/create') }}"> Nueva divisa</a>
                <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">code</th>
                            <th scope="col">symbol</th>
                            <th scope="col">iso country</th>
                            <th scope="col">idioma</th>
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>
                        <tbody>

                        @forelse ($currencies as $currency)
                        <tr>
                        <th scope="row">1</th>
                        <td>{{ $currency->name }}</td>
                        <td>{{ $currency->code }}</td>
                        <td>{{ $currency->symbol }}</td>
                        <td>{{ $currency->isoCountry }}</td>
                        <td>{{ $currency->idioma }}</td>
                        
                        <td><a href="{{ url('admin/currency/'.$currency->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        @empty
                                <p>No Ciptos</p>
                        @endforelse
                          
                        </tbody>
                      </table>
            {{ $currencies->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection