<style>
@-webkit-keyframes scroll {
  0% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  100% {
    -webkit-transform: translateX(calc(-250px * 7));
            transform: translateX(calc(-250px * 7));
  }
}

@keyframes scroll {
  0% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  100% {
    -webkit-transform: translateX(calc(-250px * 7));
            transform: translateX(calc(-250px * 7));
  }
}
.slider {
  background: white;
  box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.125);
  margin: auto;
  overflow: hidden;
  position: relative;
  z-index: 100;
}
.slider::before, .slider::after {
  background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 100%);
  content: "";
  height: 50px;
  position: absolute;
  width: 250px;
  z-index: 2;
}
@media (max-width: 600px) {
    .slider::before, .slider::after {
  background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 30%);
  content: "";
  height: 50px;
  position: absolute;
  width: 250px;
  z-index: 2;
}
}
.slider::after {
  right: 0;
  top: 0;
-webkit-transform: rotateZ(180deg);
          transform: rotateZ(180deg);
}
.slider::before {
  /*left: 0;
  top: 0;
  */
}
.slider .slide-track {
  -webkit-animation: scroll 40s linear infinite;
          animation: scroll 40s linear infinite;
  display: flex;
  width: calc(180px * <?php echo isset($pricesCryptos) ? count($pricesCryptos) : ''; ?>);
}
.slider .slide {
  height: 50px;
margin:auto;
	display: flex;
	flex-direction: row;
	align-content: center;
	align-items: center;	
}
.slide img {
	object-fit: contain;
	width: 25px;
	height: 25px;	
	margin-right: .4rem;	
}
</style>
	
<div class="slider">
	<div class="slide-track">
		@if(isset($pricesCryptos))
			@foreach($pricesCryptos as $obj)
				<div class="slide">
					<img src="{{ asset('uploads/img/' . $obj['img']) }}" alt="">
					1 {{ $obj['code'] }} = {{ $obj['price'] }} {{$symbol}}
				</div>
			@endforeach
		@endif
	</div>
</div>
<header class="header-section clearfix" style="background: #f3f7f9">	
		<div  class="row" style="margin-top:30;padding:0">
			<div class="container-fluid ">
				@if (isset($getCriptodefault))
				<div style="float:right;padding:10px;">
				{!!Form::select('idioma', config('idioma.'.App::getLocale()),App::getLocale(),  [
					'id' => 'idioma',
					'class' => 'form-control'
				])!!}
			  </div>
					@else
					<div style="float:right;padding:10px">
						{!!Form::select('idioma2',config('idioma.'.App::getLocale()) ,App::getLocale(),  [
							'id' => 'idioma2',
							'class' => 'form-control'
						])!!}
					  </div>
				@endif
				</p>
		    </div>
		</div>
		
		<div class="row">
		<div class="container-fluid">
			<a href="/" class="site-logo">
				<img src="{{asset('img/logo.png')}}" alt="">
			</a>
			<div class="responsive-bar"><i class="fa fa-bars"></i></div>
			<a href="" class="user"><i class="fa fa-user"></i></a>
			<a href="/signup" class="site-btn sb-gradients">@lang('header.signup')</a>
			<nav class="main-menu">
				<ul class="menu-list">
					<li><a href="/">@lang('header.home')</a></li>
					<li><a href="{{ route('payment-gateway') }}">@lang('payment-gateway.title')</a></li>
					<li><a href="/login">@lang('header.login')</a></li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<script type="text/javascript">
	var idioma = navigator.language || navigator.userLanguage;
	//alert ("The language is: " + idioma);
	//var lgNav = window.navigator.language||navigator.browserLanguage;
// Extrae las dos primeros datos
//var lg = lgNav.substring(0, 2);
//alert(lg);
	</script>

<script type="text/javascript">
	window.Trengo = window.Trengo || {};
	window.Trengo.key = 'GKdX1ztIR4cVgtE9z1SC';
	(function(d, script, t) {
	    script = d.createElement('script');
	    script.type = 'text/javascript';
	    script.async = true;
	    script.src = 'https://static.widget.trengo.eu/embed.js';
	    d.getElementsByTagName('head')[0].appendChild(script);
	}(document));
	</script>
<!-- Header section end -->