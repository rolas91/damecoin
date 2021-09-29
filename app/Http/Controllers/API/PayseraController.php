<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Country;
use App\PaymentWallTransaction;
use App\User;
use App\Log;
use Exception;
use App\Wallet;
use App\Crypto;
use General;
use App\Currency;
use App\Payment;
use App\CryptoWallet;
use App\CryptoWalletPyment;
use App\Payment_Wallet;
use DB;

class PayseraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = $request->total;
        $idDivisa = $request->idCurrency;
        $cryptoid = $request->idCrypto;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $pais = $request->country;
        $token = "co".str_random(30)."in";
        $currencyCode = strtoupper($request->currency);
        
        $countryID = Country::where('cod_iso2', $pais)->firstOrFail();
        try {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'role_id' => 2,
            'lastName' => $lastname,
            'country_id' => $countryID->id,
            'password' => bcrypt('12345678'),
        ]);
        }catch (Exception $e) {
            //exepcion usuario ya registrado
            if ($e->errorInfo[1] == 1062) {
                //echo "usuario registrado";
                $user = User::where('email', $email)
                    ->first();
            }
        }
         //return $user;
         $transaction = PaymentWallTransaction::create([
            'user_id' => $user->id,
            'direct' =>$request->direct,
            'currency_id' => $idDivisa,
            'crypto_id' => $cryptoid,
            'token' => $token,
            'amount' => $total,
            'status' => 'pending',
        ]);

        $log=  DB::table('logs')->insert(
            [
            'ipaddress' =>  $request->ip(),
            'useragent' => 2,
            'url' => "envio a megatutos",
            'description' => "envio a megatutos",
            'tipo' => "envio a megatutos",
            'user_id' => $user->id,
            ]
        );
        //return $post;


       $base_url = 'http://api.megatutos.com/api/paysera';
        $client = new Client(
            [
			'headers' => [
				'Content-Type' => 'application/json',
				'Accept' => 'application/json'
				]
        ]
    );

		$responsex = $client->request(
			'POST',
			$base_url,
			[
				'json' => [
				'user_id' => $user->id,
                'email' => $email,
                'token' => $token,
                'amount' => $total,
                'currency' => $currencyCode,
                'transaction_id' => $transaction->id,
                'isocode'=>$pais,
                'direct' => $request->direct,
				]
			]
        );
        
      
       $data = json_decode($responsex->getBody(), true);

       if($data["success"]==false){

            $response=["error"=>"true","code"=>"Declined"];

            return $response;

       }else{

            $response=["error"=>"false","token"=>$token,'user_id'=>$user->id];

            return $response;

            //return $data;

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentWallTransaction $transaction)
    {
        $idx=1;
        $log=  DB::table('logs')->insert(
            [
            'ipaddress' => $request->ip(),
            'useragent' => 2,
            'url' => "get a megatutos",
            'description' => "get a megatutos",
            'tipo' => "get a megatutos",
            'user_id' => $idx,
            ]
        );

                try{
                    $payment = DB::table('payment_wall_transactions')->where([
                        ['token', '=', $request->token],
                        ['status', '=', 'pending'],
                    ])->update(['status' => 'approved']);
                    
                    $info= DB::table('payment_wall_transactions')->where('token', $request->token)->first();
                    
                     $idDivisa=$info->currency_id;
                     $idCripto=$info->crypto_id;
                     $total=$info->amount;
                     $direct=$info->direct;
                     $user = User::find($info->user_id); 
                    $tipo="compra";
                    $metodo="paysera";
                    if(($direct=="index")|| ($direct=="buy")){
                        $process=$this->createProcess($idDivisa,$idCripto,$total,$user,$tipo,$metodo,$direct);
                        // return json_encode($process);
                        if($process["success"]=="true"){
                             return response()->json(['success' => 'true', 'message' => 'Pago confirmado exitosamente'], 200);
                         }
                    }
                    if(($direct=="deposit")){
                    
                      $process=$this->createProcessDeposit($idDivisa,$total,$user,$tipo,$metodo,$direct);
                      if($process["success"]=="true"){
                        return response()->json(['success' => 'true', 'message' => 'Pago confirmado exitosamente'], 200);
                       }
                     
                    }


                 }
                catch (Exception $ex) {
                    //throw $th;
                    if (!config('app.debug')) {
                        return response()->json('Ocurrió un error inesperado, intente nuevamente más tarde', 500);
                    }
                    return response()->json($ex->getMessage(), 500);
                }
            
    }

    public function createProcessDeposit($idDivisa,$total,$user,$tipo,$metodo,$direct){
        //return $idDivisa;
        $currency = Currency::find($idDivisa);

        $totalx=$total;

        if ($currency) {

              $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
              $total = $totalx - $comision;
              DB::beginTransaction();

              try {
                  $payment = new Payment;
                    $payment->user()->associate($user);
                    $payment->total = $totalx;
                    $payment->pasarela = $metodo;
                    $payment->descripcion = "deposito";
                    $payment->status = 1;
                    $payment->currency()->associate($currency);
                  $payment->save();

                  $wallet = new Wallet;
                    $wallet->abono = $total;
                    $wallet->status_user = "Aprobado";
                    $wallet->currency()->associate($currency);
                    $wallet->status = 1;
                    $wallet->user()->associate($user);
                  $wallet->save();

                  $paymentwallet = new Payment_Wallet;
                    $paymentwallet->payment()->associate($payment);
                    $paymentwallet->wallet()->associate($wallet);
                  $paymentwallet->save();

                  DB::commit();
                  General::email($wallet->abono, $currency->code, $user, "Deposit");
                
                  $response=["success"=>"true","tipo"=>"deposit"];
                  return $response; 
                 // return $wallet;
              } catch (Exception $e) {
                  DB::rollback();
                  $response=["success"=>"false"];
                  return $response;
              }

      }

    }
    public function createProcess($idDivisa,$idCrypto,$total,$user,$tipo,$metodo,$direct){
        $getCriptodefault=Crypto::where('id', $idCrypto)->filtrado();
        $getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
        $status="Success";//$paymentRecurly->status;
        $totalx=$total;//General::getMulti($getCurrencyUser->code);
        $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        $descuento=General::getDescuento($totalx,$getCriptodefault->maker_fee);
        $getTotalCrypto=number_format(($descuento/$getConvers), 7, '.', ''); 
        $comision=number_format((($totalx-$descuento)), 2, '.', ''); 

       // return $getTotalCrypto;

         DB::beginTransaction();

         try{

         $payment=new Payment;
             $payment->user()->associate($user);
             $payment->total=$totalx;
             $payment->pasarela=$metodo;
             $payment->descripcion="compra";
             $payment->status=1;
             $payment->currency_id= $getCurrencyUser->id;
         $payment->save();

         $criptowallet=new CryptoWallet;
             $criptowallet->compra=$getTotalCrypto;
             $criptowallet->taker=$comision;
             $criptowallet->cripto_id=$getCriptodefault->id;
             $criptowallet->status=1;
             $criptowallet->user()->associate($user);
         $criptowallet->save();
            
         $critowalletpaymet=new CryptoWalletPyment;
             $critowalletpaymet->payment()->associate($payment);
             $critowalletpaymet->cripto_wallet()->associate($criptowallet);
         $critowalletpaymet->save();

         DB::commit();
         if($direct=="index"){
             //envio el password
            $password=substr( md5(microtime()), 1, 8);
            $userx = User::find($user->id);
            $userx->password =bcrypt($password);
            $userx->save();
             General::emailindex($criptowallet->compra,$getCriptodefault->code,$user,"Purchase",$password);
             // Session::flash('success',__('index.success_buy'));
            $response=["success"=>"true","tipo"=>"index"];
            return $response;

         }
         if($direct=="buy"){
             //ya esta logueado el usuario
            General::email($criptowallet->compra, $getCriptodefault->code,$user, "Purchase");
            $response=["success"=>"true","tipo"=>"buy"];
            return $response;     
         }
        
         }catch (Exception $e) {

            DB::rollback();
            $response=["success"=>"false"];
            return $response;
           
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
