@extends('layouts.landing', [
  'title' => 'Landing'
])

@section('content')
	@include('buyBtcByCountry.overview')
	@include('buyBtcByCountry.howToBuy')
	@include('buyBtcByCountry.popularPaymentMethods')
	@include('buyBtcByCountry.createFreeAccount')

	@include('partials.landing.footerBuySellBtc')
@endsection


@section('scripts')
@endsection