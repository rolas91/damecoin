@extends('beautymail::templates.ark')
 
@section('content')

    @include('beautymail::templates.ark.contentStart')
       <p>Dear {{ $usuario }} {{ $lastname }}  ({{ $email }}),<br>. This is your first order here. Welcome and thanks for choosing Damecoins!.</p>
       
       {!! config('services.mail.title') !!}
    @include('beautymail::templates.ark.contentEnd')
 
    @include('beautymail::templates.ark.heading', [
        'heading' => 'Transaction details',
        'level' => 'h2'
    ])
 
    @include('beautymail::templates.ark.contentStart')
    <br><p>{{ $monto }}</p>
    <p>You can login with your password: {{ $password }}</p>


    {!! config('services.mail.body') !!}
     
    {!! config('services.mail.gretting') !!}
     
    {!! config('services.mail.contact') !!} 

    @include('beautymail::templates.ark.contentEnd')
 
@stop