@extends('layouts.admin_new')

@section('content')
    <!-- section -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                PaymentMethods
                <small></small>
            </h1>

            <div class="text-right">
                <a href="{{ url('admin/payment-method/create') }}" class="btn btn-primary">Crear</a>
            </div>

        </section>
        <section class="content">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> !</h4>
                    {{ Session::get('success') }}
                </div>

            @endif
            <table class="table table-striped mt-4 table-bordered">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Amount</th>
                        {{-- <th scope="col">Convert</th> --}}
                        <th scope="col">Img</th>
                        <th scope="col">Form</th>
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
                            <td>{{ $payment->name }} </td>
                            <td>
                                @if ($payment->amount == 'null')
                                    {{ number_format(0, 2, ',', '.') }}
                                @else
                                    {{ number_format($payment->amount, 2, ',', '.') }}
                                @endif
                            </td>
                            {{-- <td>{{ $payment->convert }} EUR </td> --}}
                            <td><img width="52" height="52" src="   {{ asset($payment->file) }}" alt=""> </td>
                            <td>
                                @php
                                    if ($payment->form == 0) {
                                        echo 'Default';
                                    } elseif ($payment->form == 1) {
                                        echo 'Paypal';
                                    } elseif ($payment->form == 2) {
                                        echo 'Western Union';
                                    } elseif ($payment->form == 3) {
                                        echo 'Bizum';
                                    } elseif ($payment->form == 4) {
                                        echo 'Skrill';
                                    } elseif ($payment->form == 5) {
                                        echo 'wechat';
                                    } else {
                                        echo '';
                                    }
                                @endphp
                            </td>

                            <td>
                                {!! Form::open(['route' => ['payment-method.destroy', $payment->id], 'method' => 'DELETE']) !!}
                                <a href="{{ url('admin/payment-method/' . $payment->id . '/edit') }}"
                                    class="btn btn-info btn-sm">Edit</a>
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm square']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>

                        @php
                            $i++;
                        @endphp
                    @empty <p>No Ciptos</p>
                    @endforelse

                </tbody>
            </table>
        </section>
    </div>

    <!--section end -->
@endsection
