@extends('layouts.admin_new')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/admin/transfe"><i class="fa fa-dashboard"></i> Transferencia</a></li>
                <li class="active">Actualizar</li>
            </ol>
        </section>
        <section class="content">
            <form action="{{ url('admin/transfe/' . $transfe->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12 ">Usuario: {{ $transfe->user->name }} {{ $transfe->user->lastName }}</label>
                    <label for="name" class="col-md-12 ">Cuenta: {{ $transfe->account->title }} {{ $transfe->account->destinatary }}</label>
                    <div class="col-md-12">
                        {!!Form::select('status', ['Aprobado' => 'Aprobado','Pendiente'=>'Pendiente','Rechazado'=>'Rechazado'], $transfe->status, [
                            'id' => 'status',
                            'class' => 'form-control'
                        ])!!}

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

            <img class="img-fluid" src="{{ asset('uploads/comprobante/') }}/{{ $transfe->recipient }}">

        </section>
    </div>


    <!--section end -->
@endsection
