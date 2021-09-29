
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


<nav  class="navbar navbar-expand-lg fixed-top navbar-landing" id="menu-landing">
	<div class="container">
		<a class="navbar-brand p-0" href="/">
			<img src="{{ asset('img/landing/logo.png') }}" class="img-fluid logo-base">
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="toggle-menu">
			<i class="fa fa-bars"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item">
		        <a class="nav-linkx nav-link" href="#how-it-works">@lang('index_process.new_h2')</a>
		      </li>
		      <li class="nav-item">
			  <!-- <a class="nav-link" href="#benefits">@lang('index_features.h2')</a>-->
			   <a class="nav-link" href="/use-dc-as-payment-gateway">@lang('payment-gateway.title')</a>
					
		      </li>
		      <li class="nav-item">
		        <a class="nav-linkx nav-link" href="#faqs">@lang('index_questions.title')</a>
		      </li>
		      <li class="nav-item d-flex align-items-center btn-auth">
		        <a class="btn btn-outline" href="/login">
		        	<img src="{{ asset('img/landing/icons/user.png') }}" class="left-icon">
		        	@lang('header.login')
		        </a>
		      </li>
		      <li class="nav-item d-flex align-items-center btn-new">
		        <a class="btn btn-light-blue-gradient" href="/signup">
		        	<img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
		        	@lang('header.signup')
		        </a>
		      </li>
		    </ul>
		</div>
	</div>
</nav>
