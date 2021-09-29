@extends('layouts.admin_new')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Transferencias
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin/transfe"><i class="fa fa-dashboard"></i> Transferencias</a></li>
                <li class="active">list</li>
            </ol>
        </section>
        <section class="content">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> !</h4>
                    {{ Session::get('success') }}
                </div>

            @endif
            <table class="table table-striped">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Cuenta</th>
                        <th scope="col">EStatus</th>
                        <th scope="col">Fecha</th>
                        <th>Recipient</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($transfers as $transfe)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $transfe->user->email }}</td>
                            <td>{{ $transfe->account->title }}</td>
                            <td>{{ $transfe->status }}</td>
                            <td>{{ $transfe->created_at }}</td>
                            <td> <img class="img-thumbnail" src="{{ asset('uploads/comprobante/') }}/{{ $transfe->recipient }}">
                            </td>
                            <td><a href="{{ url('admin/transfe/' . $transfe->id . '/edit') }}" class="btn btn-info"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                    @empty
                        <p>No Transferencias</p>
                    @endforelse

                </tbody>
            </table>
            {{ $transfers->links() }}

        </section>
    </div>

    <!--section end -->
@endsection
