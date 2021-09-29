@extends('layouts.landing', [
  'title' => 'Landing'
])

@section('content')

@include('buySellBtc.buySellBtccontentheader')
@include('buySellBtc.buySellBtccontentcontainer')
@include('buySellBtc.buySellBtccontentbehavior')
@include('buySellBtc.buySellBtccontenthowtobuy')
@include('buySellBtc.buySellBtccontentbenefits')
@include('buySellBtc.buySellBtccontentfreeacount')
@include('buySellBtc.buySellBtccontentbuynow')



@include('partials.landing.footerBuySellBtc')
@endsection


@section('scripts')
@endsection