<nav class="navbar navbar-expand-lg">
	<div class="container">
		<a class="navbar-brand p-0" href="{{ route('new-index') }}">
			<img src="{{ asset('img/landing/logo.png') }}" class="img-fluid">
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa fa-bars"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="#buy">Comprar</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#send">Enviar</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#convert">Conversor</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#paymentMethods">Métodos de pago</a>
		      </li>
		      <li class="nav-item">
		        <a class="btn btn-light-blue-gradient" href="{{ route('new-register') }}">
		        	<img src="{{ asset('img/landing/icons/rocket.png') }}" class="left-icon">
		        	Crear cuenta gratis
		        </a>
		      </li>
		    </ul>
		</div>
	</div>
</nav>