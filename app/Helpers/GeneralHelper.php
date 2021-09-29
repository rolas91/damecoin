<?php
//namespace app\Helpers;
//use IP2LocationLaravel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Wallet;
use App\AdminConfig;


class General {

	public static function getdata() {
		$records = IP2LocationLaravel::get('213.192.202.121'); //espa
		return $records['countryCode'];
	}

	public static function getMulti($currency) {
		$multi = 100;
		if (($currency == 'CLP') || ($currency == 'PYG') || ($currency == 'JPG') || ($currency == 'KMF') || ($currency == 'KRW') || ($currency == 'MGA') || ($currency == 'RWF') || ($currency == 'UGX') || ($currency == 'VND') || ($currency == 'VUV') || ($currency == 'KAF') || ($currency == 'XOF') || ($currency == 'KPF')) {
			$multi = 1;
		}
		return $multi;
	}
	public static function publicStripeKeys() {
		// $publicKey=AdminConfig::public();

		$publicKey = DB::table('config')
			->select("id", "value", "type")
			->where('type', "publicKeyStripe")
			->first();

		// select()->
		return $publicKey->value;
	}
	public static function getCompraVenta($compra, $venta) {
		if ($compra > 0) {
			return $compra;
		}
		if ($venta > 0) {
			return $venta;
		}
	}
	public static function getAbonoRetiro($abono, $retiro) {
		if ($abono > 0) {
			return $abono;
		}
		if ($retiro > 0) {
			return $retiro;
		}
	}
	public static function getLan($ipClient) {
		$records = IP2LocationLaravel::get($ipClient);
		//return $records;
		$divisa = DB::table('currencies')
			->select('code', 'id', 'idioma')
			->where('isoCountry', $records['countryCode'])
			->first();
		return $divisa;
	}

	public static function getTipoAbonoRetiro($abono, $retiro) {
		if ($abono > 0) {
			return "Deposito";
		}
		if ($retiro > 0) {
			return "Retiro";
		}
	}
	public static function getTipoCompraVenta($compra, $venta) {
		if ($compra > 0) {
			return "Buy";
		}
		if ($venta > 0) {
			return "Sell";
		}
	}

	public static function getConverCrypto($divisa, $symbol, $total) {

		if ($total == 0) {
			return "0.00";
		}

		$conver = self::getConvers($divisa, $symbol);

		return number_format(($total * $conver), 2, '.', '');

		//1 btc =2000cop
		// SELECT * FROM mc_customer_plan inner JOIN mc_plans on mc_customer_plan.idCustomer=2788442 and mc_plans.id=mc_customer_plan.idPlan and mc_customer_plan.status='Activo';

	}

	public static function getCryptoDefault($code) {
		$var = DB::table('cryptos')
			->select('id', 'code')
			->where('code', $code)
			->first();
		return $var->id;
		//return 7;
	}

	public static function getDivisaDefault() {
		//return 104;
		//$clientIP = '201.184.239.170';//colombia
		// $clientIP = ' 66.249.64.176';//usa
		$clientIP = $_SERVER['REMOTE_ADDR'];
		$getCurrency = General::getCurrency($clientIP);
		// echo $getCurrency;die();
		$default = $getCurrency["default"];
		return $default->id;
	}

	public static function getCryptoUser($crypto,$status) {
		//emplear status adicional para diferencial pedidos reales y pedidos pendientes.
		$id = Auth::user()->id;
		$cryptoId = $crypto;
		$valor = DB::table("crypto_wallets")
			->select(DB::raw("SUM(compra-venta) as total"))
			->orderBy("created_at")
			->where(['user_id' => $id, 'cripto_id' => $cryptoId,'status'=>$status])
			->first();
			$result=$valor->total;
		return number_format($result, 7, '.', '');
	}
	public static function getUserCrypto($crypto){
		if(!Auth::user()){
			return null;
		}
		$id = Auth::user()->id;

		$consulta = "select IF(sum(compra-venta) IS NULL, 0, sum(compra-venta)) total from crypto_wallets 
		where user_id = $id and cripto_id = $crypto";
		$res = DB::select($consulta);
		return $res;

	}

	public static function getCryptoUserNew($cryptoId,$id,$status) {
		$valor = DB::table("crypto_wallets")
			->select(DB::raw("SUM(compra-venta) as total"))
			->orderBy("created_at")
			->where(['user_id' => $id, 'cripto_id' => $cryptoId,'status'=>$status])
			->first();

		return number_format($valor->total, 7, '.', '');
	}

	public static function getCryptoWalettUser($currencyid) {
		$id = Auth::user()->id;
		$valor = DB::table("wallets")
			->select(DB::raw("SUM(abono-retiro) as total"))
			//->groupBy('abono')
			//->groupBy('retiro')
			->orderBy("created_at")
			->where(['user_id' => $id, 'currency_id' => $currencyid, 'status_user' => "Aprobado"])
			->first();
		//$number=floatval($valor->tota);
		return round($valor->total, 2);
		//return round($valor, 2);
		// number_format ( float $number [ int $decimals = 3 ] ) ;
		//
	}
	
	

	public static function getCurrency($ipClient) {
		$records = IP2LocationLaravel::get($ipClient); //espa
		//return $records['countryCode'];
		if ($records['countryCode'] == '-') {
			//$records['countryCode'] ='US';
			$isoCountry = 'USD';
			$divisa = DB::table('currencies')
				->select('code', 'id')
				->where('isoCountry', 'US')
				->first();
		} else {
			$divisa = DB::table('currencies')
				->select('code', 'id')
				->where('isoCountry', $records['countryCode'])
				->first();
			if ($divisa) {

				//$isoCountry =$divisa->code;
			} else {
				$divisa = DB::table('currencies')
					->select('code', 'id')
					->where('isoCountry', 'US')
					->first();
				//$isoCountry ='USD';
			}
		}

		//corregir para optimizar
		$response = array(
			//'currencies'=> $currencies,
			'default' => $divisa,
		);
		return $response;
	}

	public static function getCurrencyUser($idDivisa) {
		return DB::table('currencies')
			->select('id', 'name', 'code', 'isoCountry')
			->where('id', $idDivisa)
			->first();
	}

	public static function getCurrencies() {
		return DB::table('currencies')
			->select('id', 'name', 'code', 'isoCountry')
			->orderBy('name', 'asc')
			->get();
	}

	public static function getCrypto() {
		return DB::table('cryptos')
			->select('id', 'name', 'code')
			->orderBy('name', 'asc')
			->get();
	}

	public static function paymentState($plataforma) {
		$state = DB::table('payment_method_state')
			->select('*')
			->where('payment_method', $plataforma)
			->first();

		if ($state) {

			if($state->state){
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}

	public static function getCriptodefault($id) {
		if ($id == 'null') {
			$id = 7;
		}
		return DB::table('cryptos')
			->select('id', 'code', 'maker_fee','img','name', 'taker_fee')
			->where('id', $id)
			->first();
	}

	public static function getConvers($divisa, $symbol) {
		$endpoint = 'live';
		// $access_key = '48f6fcad288409d69517f40fb7f1b66f';
		$access_key = config("services.coinlayer.key");
		// Initialize CURL:
		$ch = curl_init('https://api.coinlayer.com/api/' . $endpoint . '?access_key=' . $access_key . '&target=' . $divisa . '&symbols=' . $symbol . '');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);
		// Decode JSON response:
		$exchangeRates = json_decode($json, true);
		if($exchangeRates["success"]){
			$data=$exchangeRates['rates'][$symbol];
			if($data){
				return $data;
			}else{
          	  return 0;
          	}
		}
		else{
			return 0;
		}
		// echo $btc;
	}
	public static function getDescuento($total, $desc) {
		$totalx = ($total - ($total * $desc / 100));
		return number_format($totalx, 2, '.', '');
	}
	public static function getDescuentoSinComision($total, $desc) {
		//descuento provicional sin comision
		$desc = 0;
		$totalx = ($total - ($total * $desc / 100));
		return number_format($totalx, 2, '.', '');
	}
	public static function aleatorio($valor) {

		$porcentaje = rand(-10, 10);

		$newvalor = $valor + ($valor * $porcentaje) / 100;

		return round($newvalor);
	}

	public static function aleatorio10($valor) {

		$porcentaje = rand(1, 10);

		$newvalor = $valor + ($valor * $porcentaje) / 100;

		return round($newvalor);
	}

	public static function getPanel($conver, $currency, $cripto, $currencyUser, $criptodefault) {
		//return $currencyUser->detailCurrency->max_deposito;
		$conver = number_format($conver, 2, '.', '');
		if ($conver == 0) {
			//$conver = 120000;
		}
		$panel1 = self::aleatorio($currencyUser->detailCurrency->min_deposito);
		//$min = self::getDescuento($panel1, $criptodefault->maker_fee);
		$min = self::getDescuentoSinComision($panel1, $criptodefault->maker_fee);
		$panel[] = array(
			"id" => 1,
			"pagar" => number_format($panel1, 2, '.', ''),
			"currency" => $currency,
			"cripto" => $cripto,
			"recibir" => number_format(($min / $conver), 7, '.', ''), //round(100/$conver,4),
			'default' => false,
		);

		$mid1 = $currencyUser->detailCurrency->max_deposito / 2;
		$panel2 = self::aleatorio($mid1);
		//$mid = self::getDescuento($panel2, $criptodefault->maker_fee);
		$mid = self::getDescuentoSinComision($panel2, $criptodefault->maker_fee);
		$panel[] = array(
			"id" => 2,
			"pagar" => number_format($panel2, 2, '.', ''),
			"currency" => $currency,
			"cripto" => $cripto,
			"recibir" => number_format(($mid / $conver), 7, '.', ''),
			'default' => true,
		);

		$max1 = $currencyUser->detailCurrency->max_deposito;
		$panel3 = self::aleatorio($max1);
		// $max = self::getDescuento($panel3, $criptodefault->maker_fee);
		$max = self::getDescuentoSinComision($panel3, $criptodefault->maker_fee);
		$panel[] = array(
			"id" => 3,
			"pagar" => number_format($panel3, 2, '.', ''),
			"currency" => $currency,
			"cripto" => $cripto,
			"recibir" => number_format(($max / $conver), 7, '.', ''),
			'default' => false,
		);

		return $panel;
	}

	public static function newGetPanel($conver, $currency, $cripto, $currencyUser, $criptodefault) {
		//return $currencyUser->detailCurrency->max_deposito;
		$conver = number_format($conver, 2, '.', '');
		if ($conver == 0) {
			//$conver = 120000;
		}
		$panel1 = self::aleatorio($currencyUser->detailCurrency->min_deposito);
		//$min = self::getDescuento($panel1, $criptodefault->maker_fee);
		$min = self::getDescuentoSinComision($panel1, $criptodefault->maker_fee);
		$panel[] = array(
			"id" => 1,
			"pagar" => number_format($panel1, 2, '.', ''),
			"currency" => $currency,
			"cripto" => $cripto,
			"recibir" => number_format(($min / $conver), 7, '.', ''), //round(100/$conver,4),
			'default' => false,
		);

		$mid1 = $currencyUser->detailCurrency->max_deposito / 2;
		$panel2 = self::aleatorio($mid1);
		//$mid = self::getDescuento($panel2, $criptodefault->maker_fee);
		$mid = self::getDescuentoSinComision($panel2, $criptodefault->maker_fee);
		$panel[] = array(
			"id" => 2,
			"pagar" => number_format($panel2, 2, '.', ''),
			"currency" => $currency,
			"cripto" => $cripto,
			"recibir" => number_format(($mid / $conver), 7, '.', ''),
			'default' => true,
		);

		$max1 = $currencyUser->detailCurrency->max_deposito;
		$panel3 = self::aleatorio($max1);
		// $max = self::getDescuento($panel3, $criptodefault->maker_fee);
		$max = self::getDescuentoSinComision($panel3, $criptodefault->maker_fee);
		$panel[] = array(
			"id" => 3,
			"pagar" => number_format($panel3, 2, '.', ''),
			"currency" => $currency,
			"cripto" => $cripto,
			"recibir" => number_format(($max / $conver), 7, '.', ''),
			'default' => false,
		);

		$max2 = ($currencyUser->detailCurrency->max_deposito) * 1.5;
		$panel4 = self::aleatorio($max2);
		// $max = self::getDescuento($panel3, $criptodefault->maker_fee);
		$max2 = self::getDescuentoSinComision($panel4, $criptodefault->maker_fee);
		$panel[] = array(
			"id" => 4,
			"pagar" => number_format($panel4, 2, '.', ''),
			"currency" => $currency,
			"cripto" => $cripto,
			"recibir" => number_format(($max2 / $conver), 7, '.', ''),
			'default' => false,
		);

		return $panel;
	}

	public static function countUser() {
		$user = DB::table("users")
			->select(DB::raw("count(*) as total"))
			->first();
		return $user->total;
	}
	public static function email($monto, $divisax, $user, $tipo) {

		$monto = $monto . " " . $divisax;
		session(['divisa' => $divisax]);
		session(['name' => $user->name]);
		session(['tipo' => $tipo]);
		session(['email' => $user->email]);
		//return $user;

		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
		$beautymail->send('emails.compra', ['monto' => $monto, "email" => $user->email, "usuario" => $user->name, "tipo" => $tipo, "lastname" => $user->lastName], function ($message) {
			$email = 'atencion@damecoins.com'; // Input::get('houltman@gmail.com');
			//$divisa=$user->name;
			$divisa = Session::get("divisa");
			$nombre = Session::get("name");
			$tipo = Session::get("tipo");
			$email = Session::get("email");
			$copia = "orders@damecoins.co.uk";
			$message
				->from('atencion@damecoins.com',"Damecoins.com")
				->to($email, "'.$nombre.'")
				->bcc($copia, "'.$nombre.'")
				->subject($tipo . '[' . $divisa . ']');
		});
	}

	public static function emailindex($monto, $divisax, $user, $tipo, $password) {
		$monto = $monto . " " . $divisax;
		session(['divisa' => $divisax]);
		session(['name' => $user->name]);
		session(['tipo' => $tipo]);
		session(['email' => $user->email]);

		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
		$beautymail->send('emails.compraindex', ['monto' => $monto, "email" => $user->email, "usuario" => $user->name, "tipo" => $tipo, "lastname" => $user->lastName, "password" => $password], function ($message) {
			$email = 'atencion@damecoins.com'; // Input::get('houltman@gmail.com');
			//$divisa=$user->name;
			$divisa = Session::get("divisa");
			$nombre = Session::get("name");
			$tipo = Session::get("tipo");
			$email = Session::get("email");
			//$copia="samihalawaster@gmail.com";
			$copia = "orders@damecoins.co.uk";
			$message
				->from('atencion@damecoins.com',"Damecoins.com")
				->to($email, "'.$nombre.'")
				->bcc($copia, "'.$nombre.'")
				->subject($tipo . '[' . $divisa . ']');
		});
	}

    public static function logsx($user,$info,$status,$msg){
		//return $info;

		$date =date('Y-m-d');
		$date = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
		$log=  DB::table('info')->insert(
            [
            'user_id' =>  $user,
            'info' => $info,
            'status' => $status,
            'msg' => $msg,
            'created_at' =>$date,
            ]
		);

		//return json_encode($log);

    }
	// Get All Cryptos for Header Slider
	public static function getSliderConvers($fiat) {
		$endpoint = 'live';
		// $access_key = '48f6fcad288409d69517f40fb7f1b66f';
		$access_key = config("services.coinlayer.key");
		// Initialize CURL:
		$ch = curl_init('https://api.coinlayer.com/api/' . $endpoint . '?access_key=' . $access_key . '&target=' . $fiat . '');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);
		// Decode JSON response:
		$exchangeRates = json_decode($json, true);
		// Access the exchange rate values, e.g. GBP:
		return $exchangeRates['rates'];
	}

	public static function getConversNew($fiat, $data) {

		
		
		$cache = "cryptoRatesG".$fiat;
		//cache::flush();
		if (Cache::has($cache)) {

			return Cache::get($cache);
		} else {
			$tiempo=60;
			if(env("ENV_APP")=="production"){
				$tiempo=60;
			}
			$expiresAt = Carbon::now()->addMinutes($tiempo);

			$pricesCryptosArray = $data->toArray();
			
			
			$pricesCryptosArray = array_pluck($pricesCryptosArray, 'code');

			
			$endpoint = 'live';
			// $access_key = '48f6fcad288409d69517f40fb7f1b66f';
			$access_key = config("services.coinlayer.key");
			$symbol = implode(",", $pricesCryptosArray);
			//$symbol='BTC,ETH,XRP';
			// $ch = curl_init('http://api.coinlayer.com/api/' . $endpoint . '?access_key=' . $access_key . '&target=' . $fiat . '&symbols=' . $symbol . '');

			//  $ch = curl_init('http://api.coinlayer.com/api/' . $endpoint . '?access_key=' . $access_key . '&target=' . $fiat . '&symbols=' . $symbol . '');
			//test http funciona solo en pruebas
			//$ch = curl_init('http://api.coinlayer.com/api/' . $endpoint . '?access_key=' . $access_key . '&target=' . $fiat . '');
			$ch = curl_init('https://api.coinlayer.com/api/' . $endpoint . '?access_key=' . $access_key . '&target=' . $fiat . '');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Store the data:
			$json = curl_exec($ch);
		
			curl_close($ch);
			// Decode JSON response:
			$exchangeRates = "";
			$exchangeRates = json_decode($json, true);
			//session api
			//session(['api' => $exchangeRates['rates']]);
			// Set cache of data
			//return 'hola';
			Cache::add($cache, $exchangeRates['rates'], $expiresAt);
			// dd( Cache::get('cryptoRates'));
			//return  Cache::get('cryptoRates');
			// Access the exchange rate values, e.g. GBP:
			// dd("sss");
			//echo "new";
			// dd($exchangeRates['rates']);
			
			return $exchangeRates['rates'];
		};
	}

	public static function getCryptos(){

		$cache = "cryptos";

		if (Cache::has($cache)) {

			return Cache::get($cache);
		} else {
			$tiempo=180;
			if(env("ENV_APP")=="production"){
				$tiempo=60;
			}
			$expiresAt = Carbon::now()->addMinutes($tiempo);

			$data=DB::table("cryptos")
			->select("code")
			->where('status',1)
			->get();
			Cache::add($cache, $data, $expiresAt);

			return $data;

		}
		
	}
	public static function getConverFromTo($from, $to, $amount) {

		if ($from==$to){

			return round($amount,2);

		}else{

			$fiatConvert = "convert-" . $from;

			if (Cache::has($fiatConvert)) {
				$get=Cache::get($fiatConvert);
				   return round($amount/$get,2);
			}else{
				$endpoint = 'convert';
				$access_key = config("services.fixer.key");
				$tiempo=1200;
				if(env("ENV_APP")=="production"){
					$tiempo=50;
				}
				$expiresAt = Carbon::now()->addMinutes($tiempo);
				$ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$json = curl_exec($ch);
				curl_close($ch);
				$conversionResult = json_decode($json, true);
	   			$convertedamount = round($conversionResult['result'],2);
	   			$cacheFiat=(1*$amount)/$convertedamount;
	   			Cache::add($fiatConvert, $cacheFiat, $expiresAt);
				
				return round($convertedamount,2);
				   
			}
		}
	}

	public static function getConverFromToNew($from, $to, $amount) {

		if ($from==$to){

			return round($amount,2);

		}else{	
			$endpoint = 'convert';
			$access_key = config("services.fixer.key");
			$tiempo=1200;
			if(env("ENV_APP")=="production"){
				$tiempo=50;
			}
			$expiresAt = Carbon::now()->addMinutes($tiempo);
			$ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($ch);
			curl_close($ch);
			$conversionResult = json_decode($json, true);
			$convertedamount = round($conversionResult['result'],2);
			
			return round($convertedamount,2);
		}
	}
	
	public static function getConverFromToAnalytics($from, $to, $amount) {
		$endpoint = 'convert';
		$fiatConvers = "fiat" . $from;
		$access_key = config("services.fixer.key");
        	if (Cache::has($fiatConvers)) {
			$get=Cache::get($fiatConvers);
			   return round($amount/$get,2);
	   	}
	   	else{
	   		$expiresAt = Carbon::now()->addMinutes(1200);
        		$ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		// get the JSON data:
        		$json = curl_exec($ch);
        		curl_close($ch);
        		$conversionResult = json_decode($json, true);
	   		$convertedamount = round($conversionResult['result'],2);
	   		$cacheFiat=(1*$amount)/$convertedamount;
	   		Cache::add($fiatConvers, $cacheFiat, $expiresAt);
	   		return $convertedamount;
       	}

	}

	public static function  logs($ip,$tipo,$url,$descr,$user,$useragent){
		$useragent=substr($useragent, 0, 200);
		$mysql_date =date('Y-m-d');
		$date = \Carbon\Carbon::createFromFormat('Y-m-d', $mysql_date);
        $log=  DB::table('logs')->insert(
            [
            'ipaddress' =>  $ip,
            'useragent' => $useragent,
            'url' => $url,
            'description' => $descr,
            'tipo' => $tipo,
			'user_id' => $user,
			'created_at'=>$date,
            ]
        );
        
	}

	public static function getLogUserError($user){
		//return $user;
		$maxUser=config("services.pay.max_error");
		$data = DB::table('logs')
			    ->where(["tipo"=>"error_buy","user_id"=>$user])
			    ->whereDate('created_at', DB::raw('CURDATE()'))
				->count();
		//return "true";
		$valid="true";		
		if($data>=$maxUser){
			$valid="false";
		}
		return $valid;

	}
	public static function getLogUserIp($ip){
		$maxIp=config("services.pay.max_error");
		$data = DB::table('logs')
			    ->where(["ipaddress"=>$ip,"tipo"=>"error_buy"])
			    ->whereDate('created_at', DB::raw('CURDATE()'))
				->count();
				//return $data;
		$valid="true";		
		if($data>=$maxIp){
			$valid="false";
		}
		return $valid;

	}
	public static function getLogMaxError(){
		$maxError=config("services.pay.max_error_diario");
		$data = DB::table('logs')
			    ->where(["tipo"=>"error"])
			    ->whereDate('created_at', DB::raw('CURDATE()'))
				->count();
				//return $data;
		$valid="true";		
		if($data>=$maxError){
			$valid="false";
		}
		return $valid;

	}

	public static function getLogMaxPayment(){
		$maxAproved=50;
		$data = DB::table('payments')
			    ->where(["pasarela"=>"PayU"])
			    ->whereDate('created_at', DB::raw('CURDATE()'))
				->count();
				//return $data;
		$valid="true";		
		if($data>=$maxAproved){
			$valid="false";
		}
		return $valid;

	}

	public static function validaBuyStripe($idUser,$ip){

		$error=self::getLogUserError($idUser);
		if($error){
			return $error;
		}
		$ip=self::getLogUserIp($ip);
		if($ip){
			//return $ip;
		}
		//return $var;
		//return $idUser;
	}
	public static function disabledCripto($cripto){
		try {
			$payment = DB::table('cryptos')->where([
			   ['id', '=', $cripto->id],
		    ])->update(['status' => 0]);
		} catch (Exception $e) {
		    General::logs("127.0.0.1","error","buy","crypto_not_found-exeption-delete",Auth::user()->id,"useragent");
		  
		}
	    
	 }
	 public static function enabledCripto($cripto){
		try {
			$payment = DB::table('cryptos')->where([
			   ['id', '=', $cripto->id],
		    ])->update(['status' => 1]);
		} catch (Exception $e) {
		    General::logs("127.0.0.1","error","buy","exeption-enabled",Auth::user()->id,"useragent");
		  
		}
	    
	 }

	 public static function analitycs($from,$amount){
		 if($from=="USD"){
			 return round($amount,2);
			//return number_format($amount,2,',','.');
		 }else{
             if ($amount>0) {
                 $new=self::getConverFromToAnalytics($from, "USD", $amount);
                 return round($new,2);
             }else{
			   return 0;
		   }
		 }
		
	 }

	 public static function conversTotalNew($amount, $currency, $to)
	 {
  
		$endpoint = 'convert';
		$access_key = config('services.fixer.key');
		$ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $currency . '&to=' . $to . '&amount=' . $amount . '');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);
		$conversionResult = json_decode($json, true);
		$convertedamount = $conversionResult['result'];
  
		return $convertedamount;
  
	 }

	 public static function getTypePayment($num){
		 if($num==1){
			 return "Aprobado";
		 }
		 if($num==2){
			return "ChargeBack";
		}
		if($num==3){
			return "Devolución";
		}
		if($num==4){
			return "Cancelado";
		}

	 }

	 public static function getCountryCode($ip) {
		$records = IP2LocationLaravel::get($ip); //espa
		return $records['countryCode'];
	}

	public static function flutterMensaje(){
		$fluttermensaje= AdminConfig::flutter('fluttermensaje');
		return $fluttermensaje->value;
	}

	public static function flutterConvertDefault(){
		$flutterDivisaDefault= AdminConfig::flutter('flutterDivisaDefault');
		$data=$flutterDivisaDefault->value?1:0;
		return $data;
	}

	
}