@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          PaymentMethodState
        <small></small>
      </h1>

      <div class="text-right">
        <a href="{{ url('admin/payment-method-state/create') }}" class="btn btn-primary">Crear</a>
      </div>

    </section>
    <section class="content">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('success') }}
          </div>

        @endif
        <table class="table table-striped mt-4">
            <thead class="">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">State</th>
                    <td scope="col">Actions</td>
                </tr>
            </thead>
            <tbody>

                @php
                    $i = 1;
                @endphp
                @forelse ($payments as $payment)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $payment->payment_method }} </td>
                    <td>{{ $payment->state === 0 ? 'Caido' : 'Activo'}} </td>
                    <td>
                        {!! Form::open(['route' => ['payment-method-state.destroy', $payment->id], 'method' => 'DELETE']) !!}
                            <a href="{{ url('admin/payment-method-state/'.$payment->id.'/edit') }}" class="btn btn-info btn-sm">Edit</a>
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm square']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>

                @php
                    $i++
                @endphp
                    @empty <p>No Ciptos</p>
                @endforelse

            </tbody>
        </table>
    </section>
</div>
    
<!--section end -->
@endsection