@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Circunstancias
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/circunstancia"><i class="fa fa-dashboard"></i> Circumstance</a></li>
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
        <a href="{{ url('admin/circunstancia/create') }}"> Nueva circunstancia</a>
                <table class="table table-striped">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">descripción</th>
                            <th scope="col">slug</th>
                            <th scope="col">idioma</th>
                          </tr>
                        </thead>
                        <tbody>

                        @forelse ($circunstancias as $circunstancia)
                            <tr>
                            <th scope="row">1</th>
                            <td>{{ $circunstancia->name }}</td>
                            <td>{{ $circunstancia->description }}</td>
                            <td>{{ $circunstancia->slug }}</td>
                            <td>{{ $circunstancia->idioma }}</td>
                            <td style="width: 40px; padding-right: 0"><a href="{{ url('admin/circunstancia/'.$circunstancia->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                            <td>
                            <form action="{{ url('admin/circunstancia/'.$circunstancia->id) }}" method="post">
                              {!! method_field('delete') !!}
                              {!! csrf_field() !!}
                              <button type="submit" class="btn btn-info">
                                <i class="fas fa-trash-alt"></i></a></td>
                              </button>
                            </form>
                              
                            </tr>
                        @empty
                                <p>No Circunstancias</p>
                        @endforelse
                          
                        </tbody>
                      </table>
            {{ $circunstancias->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection