<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Routes New
Route::get('signup', 'NewIndexController@signup')->name('new-register');

Route::get('new-buy-sell-btc', function () {
	return view('buySellBtc.buySellBtc');
})->name('newBuySellBtc');

Route::get('new-buy-btc-with-amex', function () {
	return view('buybtcwithamex.buyBtcWithAmex');
})->name('buyBtcWithAmex');

Route::get('new-buy-btc-by-country', function () {
	return view('buyBtcByCountry.index');
})->name('buyBtcByCountry');



Route::get('/new-index', function () {
	$clientIP = $_SERVER['REMOTE_ADDR'];
	$getCurrency = General::getCurrency($clientIP);
	$divisa = strtolower($getCurrency['default']->code);
	$getLan = General::getLan($clientIP);
	if (session('lang')) {
		$lang = session('lang');
		// session(['lang' => $lang]);
	} else {
		if ($getLan) {
			$lang = $getLan->idioma;
		} else {
			$langx = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			if ($langx != 'es' && $langx != 'en' && $langx != 'fr' && $langx != 'it') {
				$lang = 'en';
			} else {
				$lang = $langx;
			}
		}
	}
	session(['lang' => $lang]);
	\App::setLocale($lang);

	$crypto = 'btc';

	return redirect(__('route.newIndex', ['cripto' => $crypto, 'currency' => $divisa]));
})->name('new-index');

Route::get('aml-policy', 'NewIndexController@amlPolicy');
Route::get('terms-conditions', 'NewIndexController@termsCondintions');
Route::get('refund-policy', 'NewIndexController@refundPolicy');
Route::get('contact', 'NewIndexController@contact');

Route::Auth();
Route::get('sistemap', 'IndexController@sistemaspxml');
Route::get('criptodinamic', 'IndexController@autoCripto');
Route::get('api/gateway', 'ApiGatewayController@code');

Route::get('api/code', 'ApiGatewayController@index');
//new design damecoins

Route::get('wallets/{id?}', 'User\WalletController@index');
Route::get('prices/{divisa?}', 'User\PrecioController@index');

Route::get('buynew', 'User\BuyController@index');
Route::get('buy-express', 'User\BuyController@buyExpress');

Route::get('sellnew', 'User\SellController@index');
Route::get('change', 'User\ChangeController@index');
Route::get('depositnew', 'User\DepositController@index');
Route::get('history', 'User\HistoryController@index');
Route::get('pending','User\PendingController@index')->name('pending');

Route::get('home/{divisa?}', 'HomeUserController@home');
Route::get('login', 'NewIndexController@iniciar')->name('new-login');

Route::get('use-dc-as-payment-gateway', 'IndexController@paymentGateway')->name('payment-gateway');

Route::get('perfil', 'PerfilController@perfil');
Route::post('perfil', 'PerfilController@update');

Route::get('password', 'PerfilController@password');
Route::post('password', 'PerfilController@updatepassword')->name('password.request');
Route::get('/password/reset', 'NewIndexController@reset');
/*Route::get('password/reset/{token}', 'NewIndexController@showResetForm')->name('password.reset');*/


Route::group(['prefix' => 'dash','middleware' => 'auth'], function () {
	
	Route::get('/', 'DashBoard\PortafolioController@index');
	Route::get('/portfolio', 'DashBoard\PortafolioController@get')->name('dashPortfolio');;
	Route::get('/wallets/{id?}', 'DashBoard\WalletController@index')->name('dashWallets');
	Route::get('/prices/{id?}', 'DashBoard\PrecioController@index')->name('dashPrices');
	Route::get('/buy/{crypto?}/{divisa?}', 'DashBoard\BuyController@index');
	Route::post('/buy', 'DashBoard\BuyController@buy');
	Route::post('/buy-user-wallet', 'DashBoard\BuyController@buyUserWallet');
	Route::post('/validphone', 'DashBoard\BuyController@validPhone');
	Route::post('/getcode', 'DashBoard\BuyController@getCode');
	Route::get('/sell/{crypto?}/{divisa?}', 'DashBoard\SellController@index')->name('dashSell');
	Route::post('/sell', 'DashBoard\SellController@sell');
	Route::get('/change/{crypto?}/{divisa?}', 'DashBoard\ChangeController@index')->name('dashChange');
	Route::post('buy-express-convert', 'DashBoard\BuyController@getConvert');

	Route::post('/transfe', 'DashBoard\DepositController@transfe')->name('dashTransfe');

	Route::get('/deposit/{divisa?}', 'DashBoard\DepositController@index')->name('dashDeposit');
	Route::get('/movements', 'DashBoard\HistoryController@index')->name('dashMov');
	Route::resource('profile', 'DashBoard\PerfilController');
	Route::patch('setting/{id}', 'DashBoard\PerfilController@setting');

	Route::get('currency/{currency}', function ($currency ) {
		$current=DB::table("currencies")->where("id",$currency)->first();

		if($current){
			session(['currencyDefault' => $current->id]);
			return redirect()->back();
		}
		return redirect()->back();

	});

	Route::get('crypto/{crypto}', function ($crypto ) {

		$crypto=DB::table("cryptos")->where("id",$crypto)->first();

		if($crypto){
			session(['cryptoDefault' => $crypto->id]);
			return redirect()->back();
		}
		return redirect()->back();

	});
	Route::get('buycrypto/{crypto}', function ($crypto ) {

		$crypto=DB::table("cryptos")->where("id",$crypto)->first();

		if($crypto){
			session(['cryptoDefault' => $crypto->id]);
			return redirect("/dash/buy");
		}
		return redirect()->back();

	});
	Route::get('sellcrypto/{crypto}', function ($crypto ) {

		$crypto=DB::table("cryptos")->where("id",$crypto)->first();

		if($crypto){
			session(['cryptoDefault' => $crypto->id]);
			return redirect("/dash/sell");
		}
		return redirect()->back();

	});

	//horrible estas rutas de mercado que incluyo mayron aqui dentro del dashboard
	Route::get('{metodo}/{crypto?}/{divisa?}', 'MercadoPagoController@index');
	Route::get('buy/{metodo}/{crypto?}/{divisa?}', 'MercadoPagoController@indexBuy');

	
});

Route::post('/cripto_wallet', 'Admin\BalanceController@sendCryptoToWallet');
Route::group(['middleware' => ['auth', 'admin']], function () {
	Route::get('admin', 'AdminController@index');
	Route::resource('admin/cripto', 'Admin\CriptoController');
	Route::resource('admin/balance', 'Admin\BalanceController');
	Route::resource('admin/currency', 'Admin\CurrencyController');
	Route::resource('admin/country', 'Admin\CountryController');
	Route::resource('admin/transfe', 'Admin\TransfeController');
	Route::resource('admin/circunstancia', 'Admin\CircunstanciaController');
	Route::resource('admin/analitycs', 'Admin\AnalitycsController');
	Route::resource('admin/stripe', 'Admin\StripeController');
	Route::resource('admin/masterpassword', 'Admin\MasterPasswordController');
	Route::resource('admin/wallets', 'Admin\WalletController');
	Route::get('admin/criptoWallet','Admin\BalanceController@showSendTransfer');
	Route::get('admin/criptoWallet/{id}/edit','Admin\BalanceController@editSend');
	Route::patch('admin/criptoWallet/{id}/edit','Admin\BalanceController@editSendToWallet');

	Route::resource('admin/users', 'Admin\UserController');
	Route::get('admin/users-history/{id}', 'Admin\UserController@history');
	Route::get('admin/users-history-payment/{id}', 'Admin\UserController@historyPayment');
	Route::get('admin/users-history-payment-edit/{id}/{payment}', 'Admin\UserController@historyPaymentEdit');
	Route::patch('admin/users-history-payment-edit/{id}', 'Admin\UserController@historyPaymentUpdate');

	Route::get('admin/users-wallet/{id}', 'Admin\UserController@wallet');
	Route::get('admin/users-retirar/{idUser}/{idCripto}', 'Admin\UserController@retirar');
	Route::post('admin/users-retirar-wallets', 'Admin\UserController@processRetirar');
	Route::post('admin/users-create-users', 'Admin\UserController@createUser');
	Route::resource('admin/payment-limit', 'Admin\PaymentLimitController');
	Route::resource('admin/payment-method-state', 'Admin\PaymentMethodStateController');
	Route::resource('admin/support-recurly', 'Admin\SupportRecurlyController');
	Route::resource('admin/gateway-recurly', 'Admin\GatewayRController');
	Route::resource('admin/stripe-account', 'Admin\StripeAccountController');
	Route::resource('admin/flutterwave', 'Admin\FlutterwaveController');
	Route::resource('admin/stripe-account-details', 'Admin\StripeAccountDetailsController');
	Route::resource('admin/stripe-account-states', 'Admin\StripeAccountStatesController');
	Route::resource('admin/bank', 'Admin\BankController');
	Route::resource('admin/paypal-gateway-links', 'Admin\PaypalGatewayLinkController');

	Route::resource('admin/payment-method','Admin\PaymentMethod');

	Route::post('admin/payment-method-file','Admin\PaymentMethod@idioma');

	Route::post('admin/payment-method-file-s','Admin\PaymentMethod@idiomaSave');

	
	Route::resource('admin/payment-states','Admin\PaymentStates');
	//Route::resource('admin/payment-method','Admin\PaymentMethod@updateAccount');

	Route::get('admin/landings','Admin\LandingController@index');
	Route::get('admin/landings/create','Admin\LandingController@create');
	Route::post('admin/landings/create','Admin\LandingController@store')->name('landing.create');
	Route::get('admin/landings/{id}/edit','Admin\LandingController@edit')->name('landing.edit');
	Route::put('admin/landings/update/{id}','Admin\LandingController@update')->name('landing.update');

	//Route::get('admin/bank', 'Admin\BankController@index');
	//Route::post('admin/bank', 'Admin\BankController@update');
});

/*
Route::get('vender/{crypto?}/{divisa?}', function ($crypto=null,$divisa=null) {
return 'User '.$crypto;
});
 */

Route::post('actualizar-imagenqr-alipay/{id}', 'CompraController@updateImagenAlipayQr');
Route::post('actualizar-imagenqr-wechat/{id}', 'CompraController@updateImagenWechatQr');

Route::get('sell/{crypto?}/{divisa?}', 'VenderController@vender');


Route::get('deposit/{divisa}', 'DepositController@index');

Route::post('processdeposit', 'DepositController@processdeposit');

Route::post('payment-pay', 'SuperPayController@processIndex')->name('payment-pay');

Route::post('payment-pay-buy', 'SuperPayController@processHome')->name('payment-pay-buy');

Route::post('payment-pay-revo', 'Payment\RevoController@process')->name('payment-pay-revo');
Route::post('paymentsharebuy', 'Payment\RevoController@paymentsharebuy')->name('paymentsharebuy');
Route::post('payment-pay-unitpay', 'Payment\UniPayController@buy')->name('payment-pay-unitpay');

Route::post('payment-pay-revo-index', 'Payment\RevoController@processIndex')->name('payment-pay-revo-index');

Route::post('payment-pay-deposit', 'SuperPayController@processDepositPayU')->name('payment-pay-deposit');

Route::post('processdepositrecurly', 'RecurlyController@processDepositRecurly');

Route::post('payment-intent/recurly', 'RecurlyController@paymentIntentRecurly');

Route::post('/process-secure/recurly', 'RecurlyController@processRecurlySecure');

Route::post('processtransfe', 'DepositController@processtransfe');

Route::get('retirar/{divisa?}', 'RetirarController@retirar');

Route::post('processventa', 'VenderController@processventa');

Route::post('processretiro', 'RetirarController@processretiro');

Route::get('buy/{crypto?}/{divisa?}', 'CompraController@compraInterna');

Route::get('buytest/{crypto?}/{divisa?}', 'CompraController@compraInternaTest');

Route::post('wechat-charge', 'CompraController@wechatCharge');

Route::post('wechat-charge-index', 'CompraController@wechatChargeIndex');

Route::post('wechat-charge-deposit', 'DepositController@wechatChargeDeposit');

Route::post('wechat-change-divisa', 'CompraController@changeDivisaHKD');

Route::post('cambiar-divisa', 'CompraController@cambiarDivisa');

Route::post('calculate-minimun-flutter', 'Conversor\ConversorController@flutter');

Route::post('calculate-minimun-mercadopago', 'Conversor\ConversorController@mercadopago');

Route::post('calculate-minimun', 'Conversor\ConversorController@store'); //nueva ruta

Route::post('paymentintenthome', 'CompraController@paymentintent');

//carteras
Route::get('carteras/{divisa?}', 'CarterasController@index');

Route::post('process', 'CompraController@compraindex');

Route::post('paymentresulthome', 'CompraController@faster');

Route::post('processrecurly', 'RecurlyController@compraRecurly');

Route::post('processrecurlyhome', 'RecurlyController@compraRecurlyHome');

Route::post('processcomprax', 'CompraController@processcomprax');

Route::get('getindex', ['as' => 'getindex', 'uses' => 'IndexController@getindex']);

Route::post('transaccion', ['as' => 'transaccion', 'uses' => 'CompraController@compra']);

Route::post('paymentintent', ['as' => 'paymentintent', 'uses' => 'IndexController@paymentintent']);

Route::group(['middleware' => 'throttle:60,1'], function () {	
	Route::post('login', ['as' => 'login', 'uses' => 'NewIndexController@login']);
	Route::post('register', 'IndexController@register');
});

Route::get('logout', ['as' => 'logout', 'uses' => 'NewIndexController@logout']);
Route::get('/', function () {
	
	$clientIP = $_SERVER['REMOTE_ADDR'];


	//$clientIP="193.252.45.218";//francia
	//$clientIP="45.56.153.196";//singapore
	//session()->flush();
	$getCurrency = General::getCurrency($clientIP);
	$divisa = strtolower($getCurrency['default']->code);
	$getLan = General::getLan($clientIP);
	if (session('lang')) {
		$lang = session('lang');
		// session(['lang' => $lang]);
	} else {
		if ($getLan) {
			$lang = $getLan->idioma;
		} else {
			$langx = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			if ($langx != 'es' && $langx != 'en' && $langx != 'fr' && $langx != 'it') {
				$lang = 'en';
			} else {
				$lang = $langx;
			}
		}
	}
	session(['lang' => $lang]);
	\App::setLocale($lang);

	$crypto = 'btc';

	if($divisa == "ars"){
		return redirect('comprar-btc-con-mercadopago');
	}
	return redirect(__('route.index', ['cripto' => $crypto, 'currency' => $divisa]));
});



Route::group(['middleware' => ['web']], function () {


	Route::get('/comprar-{crypto}-con-{metodo}', 'MercadoPagoController@indexMainEs');
	Route::get('/buy-{crypto}-with-{metodo}', 'MercadoPagoController@indexMainEn');
	Route::get('/acheter-{crypto}-avec-{metodo}', 'MercadoPagoController@indexMainfr');
	Route::get('/????????????-{crypto}-??-{metodo}', 'MercadoPagoController@indexMainru');
	Route::get('/???-{crypto}-???-{metodo}', 'MercadoPagoController@indexMainch');
	Route::get('/acquistare-{crypto}-con-{metodo}', 'MercadoPagoController@indexMainitalian');
	Route::get('/??????-{crypto}-???-{metodo}', 'MercadoPagoController@indexMainjapan');
	Route::get('/????????????-{crypto}-?????????-{metodo}', 'MercadoPagoController@indexMaintailandian');
	Route::get('/koupit-{crypto}-s-{metodo}}', 'MercadoPagoController@indexMaincheco');
	Route::get('/comprar-{crypto}-com-{metodo}', 'MercadoPagoController@indexMainportuguez');
	Route::get('/??????-{crypto}-??????-{metodo}', 'MercadoPagoController@indexMaincoreano');
	Route::get('/kaufen-{crypto}-mit-{metodo}', 'MercadoPagoController@indexMainaleman');
	Route::get('/??????????-{crypto}-????-{metodo}', 'MercadoPagoController@indexMainarabe');
	Route::get('/???????????? ???????????? ?????????-{crypto}-????????? ?????????-{metodo}', 'MercadoPagoController@indexMainhindi');
	Route::get('/k??pa-{crypto}-med-{metodo}', 'MercadoPagoController@indexMainsuecia');
	//route::get('mercado/{preference}', 'MercadoPagoController@mercadoPago');
	route::post('process_payment_mp', 'MercadoPagoController@processPayment');
	route::post('process_payment_mp_buy', 'MercadoPagoController@processPaymentBuy');
	route::post('payment_pay_mp_index', 'MercadoPagoController@processPaymentIndex');

		//NUEVALANDING DE PAIS	
		
		
	Route::get('/comprar-{crypto}-en-{country}', 'Landing\CountryController@indexEs'); 
	Route::get('/buy-{crypto}-in-{country}', 'Landing\CountryController@indexEn');
	Route::get('/acheter-{crypto}-dans-{country}', 'Landing\CountryController@indexFr'); 
	Route::get('/????????????-{crypto}-????-{country}', 'Landing\CountryController@indexAe'); 
	Route::get('/???-{crypto}-???-{country}', 'Landing\CountryController@indexCh'); 
	Route::get('/koupit-{crypto}-v-{country}', 'Landing\CountryController@indexCz'); 
	Route::get('/kaufen-{crypto}-im-{country}', 'Landing\CountryController@indexDe'); 
	Route::get('/??????????????????-{crypto}-?????????-{country}', 'Landing\CountryController@indexHi'); 
	Route::get('/comprare-{crypto}-nel-{country}', 'Landing\CountryController@indexIt'); 
	Route::get('/??????-{crypto}-???-{country}', 'Landing\CountryController@indexJp'); 
	Route::get('/??????-{crypto}-???-{country}', 'Landing\CountryController@indexKr'); 
	Route::get('/comprar-{crypto}-no-{country}', 'Landing\CountryController@indexPt'); 
	Route::get('/????????????????-{crypto}-??-{country}', 'Landing\CountryController@indexRu'); 
	Route::get('/k??pa-{crypto}-i-{country}', 'Landing\CountryController@indexSe'); 
	Route::get('/????????????-{crypto}-??????-{country}','Landing\CountryController@indexTh'); 


		//$index="new-index";
		#esta era mi unica ruta de prueba ';)
		//Route::get('/new-index/test-{crypto}/con-tarjeta-en-{divisa?}', 'IndexController@indexxTest');
		
		/*Route::get('/new-index/comprar-{crypto}/con-tarjeta-en-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/buy-{crypto}/with-credit-card-in-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/acheter-{crypto}/avec-card-in-{divisa?}', ' 	@redirectIndex');
		Route::get('/new-index/????????????-{crypto}/??-??????????-??-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/???-{crypto}/???-???-???-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/acquistare-{crypto}/con-card-in-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/??????-{crypto}/con-???????????????-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/????????????-{crypto}/???????????????????????????-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/koupit-{crypto}/s-kartou-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/comprar-{crypto}/com-cart??o-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/??????-{crypto}/??????-???-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/kauf-{crypto}/with-card-in-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/??????????-{crypto}/with-credit-card-in-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/???????????? ???????????? ?????????-{crypto}/???????????????-???????????????-??????-{divisa?}', 'NewIndexController@redirectIndex');
		Route::get('/new-index/k??pa-{crypto}/with-credit-card-in-{divisa?}', 'NewIndexController@redirectIndex');*/
});



Route::group(['middleware' => ['web']], function () {
	Route::get('/test-{crypto}/con-tarjeta-en-{divisa?}', 'NewIndexController@indexxTest');
	Route::get('/comprar-{crypto}/con-tarjeta-en-{divisa?}', 'NewIndexController@indexx');
	Route::get('/buy-{crypto}/with-credit-card-in-{divisa?}', 'NewIndexController@indexxenglish');
	Route::get('/acheter-{crypto}/avec-card-in-{divisa?}', 'NewIndexController@indexxfr');
	Route::get('/????????????-{crypto}/??-??????????-??-{divisa?}', 'NewIndexController@indexxru');
	Route::get('/???-{crypto}/???-???-???-{divisa?}', 'NewIndexController@indexxch');
	Route::get('/acquistare-{crypto}/con-card-in-{divisa?}', 'NewIndexController@indexxitalian');
	Route::get('/??????-{crypto}/con-???????????????-{divisa?}', 'NewIndexController@indexxjapan');
	Route::get('/????????????-{crypto}/???????????????????????????-{divisa?}', 'NewIndexController@indexxtailandian');
	Route::get('/koupit-{crypto}/s-kartou-{divisa?}', 'NewIndexController@indexxcheco');
	Route::get('/comprar-{crypto}/com-cart??o-{divisa?}', 'NewIndexController@indexxportuguez');
	Route::get('/??????-{crypto}/??????-???-{divisa?}', 'NewIndexController@indexxcoreano');
	Route::get('/kauf-{crypto}/with-card-in-{divisa?}', 'NewIndexController@indexxaleman');
	Route::get('/??????????-{crypto}/with-credit-card-in-{divisa?}', 'NewIndexController@indexxarabe');
	Route::get('/???????????? ???????????? ?????????-{crypto}/???????????????-???????????????-??????-{divisa?}', 'NewIndexController@indexxhindi');
	Route::get('/k??pa-{crypto}/with-credit-card-in-{divisa?}', 'NewIndexController@indexxsuecia');

	// Metodos de pago
	Route::get('/????????????-{crypto}-????-ae-{divisa?}/{method?}','LandingPaymentController@indexAe'); // AE
	Route::get('/???-{crypto}-???-ch-{divisa?}/{method?}','LandingPaymentController@indexch'); //CH
	Route::get('/koupit-{crypto}-v-cz-{divisa?}/{method?}','LandingPaymentController@indexCz'); // CZ
	Route::get('/kaufen-{crypto}-im-de-{divisa?}/{method?}','LandingPaymentController@indexDe'); // DE
	Route::get('/buy-{crypto}-in-en-{divisa?}/{method?}','LandingPaymentController@indexEn'); //EN
	Route::get('/comprar-{crypto}-en-es-{divisa?}/{method?}','LandingPaymentController@indexEs'); // ES
	Route::get('/acheter-{crypto}-dans-fr-{divisa?}/{method?}','LandingPaymentController@indexFr'); // FR
	Route::get('/??????????????????-{crypto}-?????????-hi-{divisa?}/{method?}','LandingPaymentController@indexHi'); // HI	
	Route::get('/comprare-{crypto}-nel-it-{divisa?}/{method?}','LandingPaymentController@indexIt'); // IT
	Route::get('/??????-{crypto}-???-jp-{divisa?}/{method?}','LandingPaymentController@indexJp'); // JP
	Route::get('/??????-{crypto}-???-kr-{divisa?}/{method?}','LandingPaymentController@indexKr'); // KR
	Route::get('/comprar-{crypto}-no-pt-{divisa?}/{method?}','LandingPaymentController@indexPt'); // PT
	Route::get('/????????????????-{crypto}-??-ru-{divisa?}/{method?}','LandingPaymentController@indexRu'); // RU
	Route::get('/att_k??pa-{crypto}-i-se-{divisa?}/{method?}','LandingPaymentController@indexSe'); // SE
	Route::get('/????????????-{crypto}-??????-th-{divisa?}/{method?}','LandingPaymentController@indexTh'); //TH

	// Circunstancias
	
	Route::get('/??????????-{crypto}-{circumstance}','LandingCircunstanciaController@indexAe'); // AE
	Route::get('/??????-{crypto}-{circumstance}','LandingCircunstanciaController@indexCh'); // CH
	Route::get('/Koupit-{crypto}-{circumstance}','LandingCircunstanciaController@indexCz'); // CZ
	Route::get('/Kaufen-{crypto}-{circumstance}','LandingCircunstanciaController@indexDe'); // DE
	Route::get('/buy-{crypto}-{circumstance}','LandingCircunstanciaController@indexEn'); // EN
	Route::get('/comprar-{crypto}-{circumstance}','LandingCircunstanciaController@indexEs'); // ES
	Route::get('/acheter-{crypto}-{circumstance}','LandingCircunstanciaController@indexFr'); // FR
	Route::get('/????????????-{crypto}-{circumstance}','LandingCircunstanciaController@indexHi'); // HI
	Route::get('/acquistare-{crypto}-{circumstance}','LandingCircunstanciaController@indexIt'); // IT
	Route::get('/??????-{crypto}-{circumstance}','LandingCircunstanciaController@indexJp'); // JP
	Route::get('/??????-{crypto}-{circumstance}','LandingCircunstanciaController@indexKr'); // KR
	Route::get('/comprare-{crypto}-{circumstance}','LandingCircunstanciaController@indexPt'); // PT
	Route::get('/????????????-{crypto}-{circumstance}','LandingCircunstanciaController@indexRu'); // RU
	Route::get('/k??pa-{crypto}-{circumstance}','LandingCircunstanciaController@indexSe'); // SE
	Route::get('/????????????-{crypto}-{circumstance}','LandingCircunstanciaController@indexTh'); // TH

	/*Route::get('/??????????-{crypto}-???????? ??????????/{divisa?}','LandingCircunstanciaController@indexAe'); // AE
	Route::get('/??????-{crypto}-????????????/{divisa?}','LandingCircunstanciaController@indexCh'); // CH
	Route::get('/Koupit-{crypto}-bez_komise/{divisa?}','LandingCircunstanciaController@indexCz'); // CZ
	Route::get('/Kaufen-{crypto}-ohne_Auftrag/{divisa?}','LandingCircunstanciaController@indexDe'); // DE
	Route::get('/buy-{crypto}-without_commision/{divisa?}','LandingCircunstanciaController@indexEn'); // EN
	Route::get('/comprar-{crypto}-sin_comision/{divisa?}','LandingCircunstanciaController@indexEs'); // ES
	Route::get('/acheter-{crypto}-sans_commission/{divisa?}','LandingCircunstanciaController@indexFr'); // FR
	Route::get('/????????????-{crypto}-without_commission/{divisa?}','LandingCircunstanciaController@indexHi'); // HI
	Route::get('/acquistare-{crypto}-senza_commissione/{divisa?}','LandingCircunstanciaController@indexIt'); // IT
	Route::get('/??????-{crypto}-without_commission/{divisa?}','LandingCircunstanciaController@indexJp'); // JP
	Route::get('/??????-{crypto}-without_commision/{divisa?}','LandingCircunstanciaController@indexKr'); // KR
	Route::get('/comprare-{crypto}-without_commission/{divisa?}','LandingCircunstanciaController@indexPt'); // PT
	Route::get('/????????????-{crypto}-??????_????????????????/{divisa?}','LandingCircunstanciaController@indexRu'); // RU
	Route::get('/k??pa-{crypto}-utan_kommission/{divisa?}','LandingCircunstanciaController@indexSe'); // SE
	Route::get('/????????????-{crypto}-without_commision/{divisa?}','LandingCircunstanciaController@indexTh'); // TH*/

	// Convert
	Route::get('/??????????-{btc}-to-{divisa?}','Landing\ConverterController@indexAe'); // AE	
	Route::get('/??????-{btc}-to-{divisa?}','Landing\ConverterController@indexCh'); // CH	
	Route::get('/konvertovat-{btc}-to-{divisa?}','Landing\ConverterController@indexCz'); // CZ	
	Route::get('/konvertieren-{btc}-to-{divisa?}','Landing\ConverterController@indexDe'); // DE	
	Route::get('/convert-{btc}-to-{divisa?}','Landing\ConverterController@indexEn'); // EN	
	Route::get('/convertir-{btc}-a-{divisa?}','Landing\ConverterController@indexEs'); // ES	
	Route::get('/convertir-{btc}-to-{divisa?}','Landing\ConverterController@indexFr'); // FR	
	Route::get('/??????????????????????????????-{btc}-to-{divisa?}','Landing\ConverterController@indexHi'); // HI	
	Route::get('/convertire-{btc}-to-{divisa?}','Landing\ConverterController@indexIt'); // IT	
	Route::get('/????????????-{btc}-to-{divisa?}','Landing\ConverterController@indexJp'); // JP	
	Route::get('/???????????????-{btc}-to-{divisa?}','Landing\ConverterController@indexKr'); // KR	
	Route::get('/converter-{btc}-to-{divisa?}','Landing\ConverterController@indexPt'); // PT	
	Route::get('/????????????????????????????-{btc}-to-{divisa?}','Landing\ConverterController@indexRu'); // RU	
	Route::get('/konvertera-{btc}-to-{divisa?}','Landing\ConverterController@indexSe'); // SE	
	Route::get('/????????????-{btc}-to-{divisa?}','Landing\ConverterController@indexTh'); // TH	

	//Enviar
	Route::get('/??????????-{crypto}-??????-{metodo}','Landing\LandingEnviarController@indexAe'); // AE	
	Route::get('/??????-{crypto}-???-{metodo}','Landing\LandingEnviarController@indexCh'); // CH	
	Route::get('/poslat-{crypto}-na-{metodo}','Landing\LandingEnviarController@indexCz'); // CZ	 
	Route::get('/senden-{crypto}-su-{metodo}','Landing\LandingEnviarController@indexDe'); // DE	
	Route::get('/send-{crypto}-to-{metodo}','Landing\LandingEnviarController@indexEn'); // EN	
	Route::get('/enviar-{crypto}-a-{metodo}','Landing\LandingEnviarController@indexEs'); // ES	
	Route::get('/envoyer-{crypto}-??-{metodo}','Landing\LandingEnviarController@indexFr'); // FR	
	Route::get('/???????????????-{crypto}-????????????????????????-{metodo}','Landing\LandingEnviarController@indexHi'); // HI	
	Route::get('/invia-{crypto}-ad-{metodo}','Landing\LandingEnviarController@indexIt'); // IT	
	Route::get('/??????-{crypto}-???-{metodo}','Landing\LandingEnviarController@indexJp'); // JP	
	Route::get('/?????????-{crypto}-...???-{metodo}','Landing\LandingEnviarController@indexKr'); // KR	
	Route::get('/envie-{crypto}-para-{metodo}','Landing\LandingEnviarController@indexPt'); // PT	
	Route::get('/??????????????????-{crypto}-????-{metodo}','Landing\LandingEnviarController@indexRu'); // RU	
	Route::get('/skicka-{crypto}-till-{metodo}','Landing\LandingEnviarController@indexSe'); // SE	
	Route::get('/?????????????????????????????????-{crypto}-???-{metodo}','Landing\LandingEnviarController@indexTh'); // TH	
	
	

		
	
	
	//nueva structura para landings
	Route::get('/??????????-{crypto?}/{divisa?}/????/{method?}', 'Landing\MetodoController@indexAe'); // AE	
	Route::get('/??????-{crypto?}/{divisa?}/???/{method?}', 'Landing\MetodoController@indexCh'); // CH	
	Route::get('/Koupit-{crypto?}/{divisa?}/s/{method?}', 'Landing\MetodoController@indexCz'); // CZ	
	Route::get('/Kaufen-{crypto?}/{divisa?}/mit/{method?}', 'Landing\MetodoController@indexDe'); // DE	
	Route::get('/buy-{crypto?}/{divisa?}/with/{method?}', 'Landing\MetodoController@indexEn'); // EN	
	Route::get('/comprar-{crypto?}/{divisa?}/con/{method?}', 'Landing\MetodoController@indexEs'); // ES	
	Route::get('/acheter-{crypto?}/{divisa?}/avec/{method?}', 'Landing\MetodoController@indexFr'); // FR	
	Route::get('/????????????-{crypto?}/{divisa?}/??????????????????/{method?}', 'Landing\MetodoController@indexHi'); // HI	
	Route::get('/acquistare-{crypto?}/{divisa?}/con/{method?}', 'Landing\MetodoController@indexIt'); // IT	
	Route::get('/??????-{crypto?}/{divisa?}/???/{method?}', 'Landing\MetodoController@indexJp'); // JP	
	Route::get('/??????-{crypto?}/{divisa?}/???/{method?}', 'Landing\MetodoController@indexKr'); // KR	
	Route::get('/comprar-{crypto?}/{divisa?}/com/{method?}', 'Landing\MetodoController@indexPt'); // PT	
	Route::get('/????????????-{crypto?}/{divisa?}/??????????????????/{method?}', 'Landing\MetodoController@indexRu'); // RU	
	Route::get('/k??pa-{crypto?}/{divisa?}/med/{method?}', 'Landing\MetodoController@indexSe'); // SE	
	Route::get('/????????????-{crypto?}/{divisa?}/????????????/{method?}', 'Landing\MetodoController@indexTh'); // TH	

	//
	Route::get('/??????????-????????-{crypto?}-{divisa?}-????-{method?}','LandingComprarVenderController@indexAe'); // AE
	Route::get('/??????-???-{crypto?}-{divisa?}-???-{method?}','LandingComprarVenderController@indexCh'); // CH
	Route::get('/Koupit-prodat-{crypto?}-{divisa?}-s-{method?}','LandingComprarVenderController@indexCz'); // CZ
	Route::get('/Kaufen-verkaufen-{crypto?}-{divisa?}-mit-{method?}','LandingComprarVenderController@indexDe'); // DE
	Route::get('/buy-sell-{crypto?}-{divisa?}-with-{method?}','LandingComprarVenderController@indexEn'); // EN
	Route::get('/comprar-vender-{crypto?}-{divisa?}-con-{method?}','LandingComprarVenderController@indexEs'); // ES
	Route::get('/acheter-vendre-{crypto?}-{divisa?}-avec-{method?}','LandingComprarVenderController@indexFr'); // FR
	Route::get('/????????????-???????????????-{crypto?}-{divisa?}-??????????????????-{method?}','LandingComprarVenderController@indexIr'); // HI
	Route::get('/acquistare-vendere-{crypto?}-{divisa?}-con-{method?}','LandingComprarVenderController@indexIt'); // IT
	Route::get('/??????-??????-{crypto?}-{divisa?}-???-{method?}','LandingComprarVenderController@indexJp'); // JP
	Route::get('/??????-??????-{crypto?}-{divisa?}-?????????-{method?}','LandingComprarVenderController@indexKr'); // KR
	Route::get('/comprar-vender-{crypto?}-{divisa?}-com-{method?}','LandingComprarVenderController@indexPt'); // PT
	Route::get('/????????????-??????????????????-{crypto?}-{divisa?}-??????????????????-{method?}','LandingComprarVenderController@indexRu'); // RU
	Route::get('/k??pa-s??lja-{crypto?}-{divisa?}-med-{method?}','LandingComprarVenderController@indexSe'); // SE
	Route::get('/????????????-?????????-{crypto?}-{divisa?}-????????????-{method?}','LandingComprarVenderController@indexTh'); // TH

	//
	Route::get('transferenciaBancarias','NewIndexController@TransferBanks');

	//
	Route::get('/buy-{crypto}-{country?}/{divisa?}/{lang?}','LandingPaymentController@LandingCountry'); // ES
});

Route::get('mercadopago/lang/{lang}/{cripto}/{metodo}', function ($lang, $cripto, $metodo) {
	session(['lang' => $lang]);
	\App::setLocale($lang);
	$cripto = strtolower($cripto);
	return redirect(__('route.mercadopago', ['crypto' => $cripto, 'metodo' => $metodo]));
	//return \Redirect::back();
})->name('change_lang');

Route::get('lang/{lang}/{cripto?}/{currency?}', function ($lang, $cripto = null, $currency = null) {
	if ($currency) {
		session(['lang' => $lang]);
		\App::setLocale($lang);
		$cripto = strtolower($cripto);
		$currency = strtolower($currency);
		
		return redirect(__('route.index', ['cripto' => $cripto, 'currency' => $currency]));
	} else {
		session(['lang' => $lang]);
		\App::setLocale($lang);

		return redirect()->back();
	}
	//return \Redirect::back();
})->name('change_lang');

Route::get('circunstancia/lang/{lang}/{cripto?}/{ref?}', function ($lang, $cripto = null, $ref = null) {
	if ($ref) {
		session(['lang' => $lang]);
		\App::setLocale($lang);
		$cripto = strtolower($cripto);
		$circunstancia = \App\Circumstance::where('ref', $ref)
		->where('idioma', $lang)
		->first();
		
		return redirect(__('route.Circunstancias', ['crypto' => $cripto, 'circunstance' => $circunstancia->slug]));
	} else {
		session(['lang' => $lang]);
		\App::setLocale($lang);

		return redirect()->back();
	}
	//return \Redirect::back();
})->name('change_lang');



Route::get('new-index/lang/{lang}/{cripto?}/{currency?}', function ($lang, $cripto = null, $currency = null) {
	if ($currency) {
		session(['lang' => $lang]);
		\App::setLocale($lang);
		$cripto = strtolower($cripto);
		$currency = strtolower($currency);

		return redirect(__('route.newIndex', ['cripto' => $cripto, 'currency' => $currency]));
	} else {
		session(['lang' => $lang]);
		\App::setLocale($lang);

		return redirect()->back();
	}
	//return \Redirect::back();
})->name('change_lang');

Route::get('pais/lang/{lang}/{cripto?}/{cod_iso2}', function ($lang, $crypto = null, $cod_iso2) {	
	if ($cod_iso2) {
		$paisAux =DB::table('landing_countries')->where('cod_iso2', $cod_iso2)->where('idioma', $lang)->pluck('name')->first();
		
		session(['lang' => $lang]);
		\App::setLocale($lang);
		$crypto = strtolower($crypto);
		
		return redirect(__('route.Pais', ['crypto' => $crypto, 'country' => lcfirst($paisAux)]));
	} else {
		session(['lang' => $lang]);
		\App::setLocale($lang);

		return redirect()->back();
	}
	//return \Redirect::back();
});


//Change Lenguaje
Route::get('change/lang/{lang}/{crypto?}/{divisa?}/{method?}/{prefix?}', function ($lang, $crypto = null, $divisa = null,$method = null, $prefix = null) {

	
	if ($divisa) {
		session(['lang' => $lang]);
		\App::setLocale($lang);
		$crypto = strtolower($crypto);
		$divisa = strtolower($divisa);
		
		$url = 'route.'.$prefix;
		
		return redirect(__($url, ['crypto' => $crypto, 'divisa' => $divisa, 'method' => $method,'lang' => $lang]));
	} else {
		session(['lang' => $lang]);
		\App::setLocale($lang);

		return redirect()->back();
	}

});


Route::get('/convert/{crypto?}/{divisa?}/{defaultCrypto}/{defaultCurrency}','LandingConverteController@convert');

Route::get('/conversorTemporal/{crypto?}/{divia?}/{lang?}','ConversorTemporalController@index');
Route::get('/conversorTemp/{crypto?}/{fecha?}','ConversorTemporalController@test');
Route::post('registerForm','RegisterUserByFormLanding@RegisterUserByFrom');

Route::get('/testpayu', 'SuperPayController@testpayu')->name('testpayu');

Route::post('/paymentGatewayEmail','IndexController@paymentGatewayEmail')->name('paymentGatewayEmail');

Route::get('/getBankData','NewIndexController@getBankData');