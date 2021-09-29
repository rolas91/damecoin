@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Países
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/currency"><i class="fa fa-dashboard"></i> Country</a></li>
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
        <a href="{{ url('admin/country/create') }}"> Nuevo país</a>
                <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">code</th>
                            <th scope="col">idioma</th>
                            <th scope="col">bandera</th>
                          </tr>
                        </thead>
                        <tbody>

                        @forelse ($countries as $country)
                            <tr>
                            <th scope="row">1</th>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->cod_iso2 }}</td>
                            <td>{{ $country->idioma }}</td>
                            <td>
                                <img width="40px" src="{{asset('banderas/'.$country->bandera)}}" alt="">
                            </td>
                            <td style="width: 40px; padding-right: 0"><a href="{{ url('admin/country/'.$country->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                            <td>
                            <form action="{{ url('admin/country/'.$country->id) }}" method="post">
                              {!! method_field('delete') !!}
                              {!! csrf_field() !!}
                              <button type="submit" class="btn btn-info">
                                <i class="fas fa-trash-alt"></i></a></td>
                              </button>
                            </form>
                              
                            </tr>
                        @empty
                                <p>No Países</p>
                        @endforelse
                          
                        </tbody>
                      </table>
            {{ $countries->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection