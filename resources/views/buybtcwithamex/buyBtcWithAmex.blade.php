@extends('layouts.landing', [
  'title' => 'Landing'
])

@section('content')

@include('buybtcwithamex.buyBtcWithAmexhomeamex')
@include('buybtcwithamex.buyBtcWithAmexbuyneteller')
@include('buybtcwithamex.buyBtcWithAmexhowtobuywithneteller')
@include('buybtcwithamex.buyBtcWithAmexbenefits')
@include('buybtcwithamex.buyBtcWithAmexfreeacount')
@include('buybtcwithamex.buyBtcWithAmexpayment')


  @include('partials.landing.footerBuySellBtc')
@endsection


@section('scripts')
@endsection