<!-- Footer section -->
	<footer class="footer-section" style='background-color: #e8f2f7;'>
		<div class="container">
			<div class="row spad">
				<div class="col-md-6 col-lg-3 footer-widget">
					<img src="{{ asset('img/logo.png') }}" class="mb-4" alt="">
					<p>@lang('footer.p')</p>
				</div>
				<div style="display:none;"  class="col-md-6 col-lg-2 offset-lg-1 footer-widget">
					<h5 class="widget-title">Resources</h5>
					<ul>
						<li><a href="#">How to Buy Coin</a></li>
						<li><a href="#">Coin Overview</a></li>
						<li><a href="#">Blog News</a></li>
						<li><a href="#">How to Sell Coin</a></li>
						<li><a href="#">Purchase Theme</a></li>
					</ul>
				</div>
				<div class="col-md-6 col-lg-2 offset-lg-1 footer-widget">
					<h5 class="widget-title">@lang('footer.link')</h5>
					<ul>
						<li><a href="/">@lang('footer.home')</a></li>
						<li><a href="{{ route('payment-gateway') }}">@lang('payment-gateway.title')</a></li>
						<li><a href="/signup">@lang('footer.signup')</a></li>
						<li><a href="/login">@lang('footer.login')</a></li>
					
					</ul>
				</div>

				<div style="display:none;"  class="col-md-6 col-lg-3 footer-widget pl-lg-5 pl-3">
					<h5 class="widget-title">@lang('footer.following')</h5>
					<div class="social">
						<a style="display:none;"  href="" class="facebook"><i class="fa fa-facebook"></i></a>
						<a style="display:none;"  href="" class="google"><i class="fa fa-google-plus"></i></a>
						<a  style="display:none;"   href="https://instagram.com/damecoins" class="instagram"><i class="fa fa-instagram"></i></a>
						<a style="display:none;"  href="" class="twitter"><i class="fa fa-twitter"></i></a>
					</div>
				</div>
			</div>
			<div class="footer-bottom" style="padding-bottom: 100px;">
				<div class="row">
					<div  class="col-lg-4 store-links text-center text-lg-left pb-3 pb-lg-0">
						<a style="display:none;"  href=""><img src="{{ asset('img/appstore.png')}}" alt="" class="mr-2"></a>
						<a style="display:none;" href=""><img src="{{ asset('img/playstore.png')}}" alt=""></a>
					</div>
					<div class="col-lg-8 text-center text-lg-right">
						<ul class="footer-nav">
							<li><a href="">Damecoins Financial Group (UK) Ltd. ©️ 2020 All Rights Reserved. <a class="link" href="support@damecoins.co.uk">support@damecoins.co.uk</a> Contact Terms and Conditions AML Policy Refund Policy</a></li>
							<li><a style="display:none;"  href="">@lang('footer.terminos')</a></li>
							<li><a style="display:none;"  href="">@lang('footer.politica')</a></li>
							<li><a href="">info@damecoins.com</a></li>
							<li><a href="/contact">Contact</a></li>
							<li><a href="/terms-conditions">Terms and Conditions</a></li>
							<li><a href="/aml-policy">AML Policy</a></li>
							<li><a href="/refund-policy">Refund Policy</a></li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>