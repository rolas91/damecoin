
<div  class="row" style="margin:0;padding:0;">
	<div  class="container-fluid">
		@if (isset($getCriptodefault))
		<div id="lgnAbs">
		{!!Form::select('idioma', config('idioma.'.App::getLocale()),App::getLocale(),  [
			'id' => 'idioma',
			'class' => 'form-control'
		])!!}
		</div>
			@else
			<div id="lgnAbs">
				{!!Form::select('idioma2',config('idioma.'.App::getLocale()) ,App::getLocale(),  [
					'id' => 'idioma2',
					'class' => 'form-control'
				])!!}
			</div>
		@endif
		</p>
	</div>
</div>


<nav style="padding-top: 6.5rem!important; z-index: 100"  class="navbar navbar-expand-lg fixed-top navbar-landing" id="menu-landing">
	<div class="">
		

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="toggle-menu">
			<i class="fa fa-bars"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto">
			<li class="nav-item d-flex align-items-center">
			<a class="navbar-brand p-0" href="/">
			<img src="{{ asset('img/landing/logo.png') }}" class="img-fluid logo-base">
		</a>
		      </li>
		      <li class="nav-item d-flex align-items-center">
		        <a class="nav-linkx nav-link" href="#how-it-works">@lang('index_process.new_h2')</a>
		      </li>
		      <li class="nav-item d-flex align-items-center">
			  <!-- <a class="nav-link" href="#benefits">@lang('index_features.h2')</a>-->
			   <a class="nav-link" href="/use-dc-as-payment-gateway">@lang('payment-gateway.title')</a>
					
		      </li>
			  <li class="nav-item d-flex align-items-center">
			   	<a class="nav-link" href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'mercadopago'])) }}">Mercadopago @lang('index.payEasyMp') Rapipago ARG</a>	
		      </li>
		      <li class="nav-item d-flex align-items-center">
		        <a class="nav-linkx nav-link" href="#faqs">@lang('index_questions.title')</a>
			  </li>
			  <li class="nav-item d-flex align-items-center">
		        <a class="nav-linkx nav-link" href="blog">Blog</a>
			  </li>
			  <li class="nav-item d-flex align-items-center dropdown"> <!-- select metodos de pago-->
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100px;">
				  {{-- @lang('header.metodos') --}}
				  @lang('index.metodosPago')
				  <span class="fa fa-angle-down"></span>
				</a>
				<div class="dropdown-menu text-capitalize" aria-labelledby="navbarDropdown" style="margin:-0.875rem 0 0!important; overflow: scroll; height: 350px">
					<a class="dropdown-item" href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => 'paypal'])) }}">Paypal</a>
			
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => 'skrill'])) }}">Skrill</a>
				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => 'westerUnion'])) }}">Western Union</a>
				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => 'bizum'])) }}">Bizum</a>
				
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => 'WeChat'])) }}">WeChat</a>

				<div class="dropdown-divider"></div>
				
				<a class="dropdown-item" href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => 'AliPay'])) }}">AliPay</a>
				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'mercadopago'])) }}" >Mercadopago</a>
				<div class="dropdown-divider"></div>
				
				<a class="dropdown-item" href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'rapipago'])) }}" >Rapipago</a>
				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => 'pagofacil'])) }}" >Pago Fácil</a>

				</div>
			  </li> 
			  <li class="nav-item d-flex align-items-center dropdown"> <!-- select caracteristicas -->
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100px;">
				  {{-- @lang('header.metodos') --}}
				  @lang('index.caracteristicas')
				  <span class="fa fa-angle-down"></span>
				</a>
				<div class="dropdown-menu text-capitalize" aria-labelledby="navbarDropdown" style="margin:-0.875rem 0 0!important; overflow: scroll; height: 250px">

				<a class="dropdown-item" href="{{ url(__('route.enviar', ['crypto' => "btc", 'metodo' => 'alipay'])) }}" >Send Crypto to Wallet</a>
				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.Convert', ['crypto' => "btc", 'divisa' => 'usd'])) }}" >@lang("index.conversor")</a>
				<div class="dropdown-divider"></div>
				<?php 
					$sin_comisiones = \App\Circumstance::where('ref', 1)
					->where('idioma', \App::getLocale())
					->first();
					$sin_kyc = \App\Circumstance::where('ref', 2)
					->where('idioma', \App::getLocale())
					->first();
					$barato = \App\Circumstance::where('ref', 3)
					->where('idioma', \App::getLocale())
					->first();
					$menor = \App\Circumstance::where('ref', 4)
					->where('idioma', \App::getLocale())
					->first();
				?>	
				<a class="dropdown-item" href="{{ url(__('route.Circunstancias', ['crypto' => "btc", 'circunstance' => $sin_comisiones->slug])) }}" >@lang('index.buy') {{$sin_comisiones->name}}</a>

				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.Circunstancias', ['crypto' => "btc", 'circunstance' => $sin_kyc->slug])) }}" >{{$sin_kyc->name}}</a>

				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.Circunstancias', ['crypto' => "btc", 'circunstance' => $barato->slug])) }}" >@lang("index.buy") {{$barato->name}}</a>

				<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.Circunstancias', ['crypto' => "btc", 'circunstance' => $menor->slug])) }}" > @lang("index.buy") {{strtolower($menor->name)}}</a>

				

				<!--<div class="dropdown-divider"></div>

				<a class="dropdown-item" href="{{ url(__('route.Pais', ['crypto' => "btc", 'country' => 'colombia'])) }}">País</a>-->

<!--
				<a class="dropdown-item" href="{{ url(__('route.Convert', ['crypto' => "btc", 'divisa' => 'usd'])) }}">@lang('header.conversor')</a>
				
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{ url(__('route.Circunstancias', ['crypto' => "btc", 'circunstancia' => 'usd'])) }}">@lang('header.circunstancias')</a>
				-->
				<!--
				  <div class="dropdown-divider"></div>
				
				  <a class="dropdown-item" href="{{ url(__('route.Payments', ['crypto' => "btc", 'divisa' => 'usd','method'=>'paypal'])) }}">@lang('header.metodos')</a>
					
				  <div class="dropdown-divider"></div>
				
				<a class="dropdown-item" href="{{ url(__('route.Pais', ['crypto' => "btc", 'country' => 'spain'])) }}">País</a>-->
		
				</div>
			  </li>
		      <li class="nav-item d-flex align-items-center btn-auth">
		        <a class="btn btn-outline" href="/login" style="font-size: 12px">
		        	<img src="{{ asset('img/landing/icons/user.png') }}" class="left-icon">
		        	@lang('header.login')
		        </a>
		      </li>
		      <li class="nav-item d-flex align-items-center btn-new">
		        <a class="btn btn-light-blue-gradient" href="/signup" style="font-size: 12px">
		        	<img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
		        	@lang('header.signup')
		        </a>
		      </li>
		    </ul>
		</div>
	</div>
</nav>
