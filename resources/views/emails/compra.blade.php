@extends('beautymail::templates.ark')
 
@section('content')

    @include('beautymail::templates.ark.contentStart')

    <p>Dear {{ $usuario }} {{ $lastname }}  ({{ $email }}),<br>thank you for using Damecoins.</p>
    
      {!! config('services.mail.title') !!}

    @include('beautymail::templates.ark.contentEnd')
 
    @include('beautymail::templates.ark.heading', [
        'heading' => 'Transaction details',
        'level' => 'h3'
    ])
 
    @include('beautymail::templates.ark.contentStart')
    
    <p>{{ $monto }}</p>
      
    {!! config('services.mail.body') !!}
     
    {!! config('services.mail.gretting') !!}
     
    {!! config('services.mail.contact') !!}
          
    @include('beautymail::templates.ark.contentEnd')
 
@stop