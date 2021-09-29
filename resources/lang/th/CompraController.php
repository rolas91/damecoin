<?php

namespace App\Http\Controllers;
use General;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Currency;
use App\Crypto;
//use App\Currency;
use App\Wallet;
use App\Payment;
use App\Country;
use App\CryptoWallet;
use App\CryptoWalletWallet;
use App\CryptoWalletPyment;
use App\AdminConfig;
use Session;
use Mail;
use Redirect;
//use Laravel\Cashier\Cashier;
//use Laravel\Cashier\Billable;
use Exception;
use InvalidArgumentException;
use Stripe\Stripe ;//as Stripe;
use Stripe\Card as StripeCard;
use Stripe\Token as StripeToken;
use Illuminate\Support\Collection;
use Stripe\Charge as StripeCharge;
use Stripe\Refund as StripeRefund;
use Stripe\Invoice as StripeInvoice;
use Stripe\Customer as StripeCustomer;
use Stripe\BankAccount as StripeBankAccount;
use Stripe\InvoiceItem as StripeInvoiceItem;
use Stripe\PaymentIntent as PaymentIntent ;
//use Stripe\Source;
use Stripe\Error\InvalidRequest as StripeErrorInvalidRequest;

class CompraController extends Controller
{
    public function __construct()
    {
      
       $this->middleware('auth',['except' => 'compraindex','getStripeKey','paymentintent']);
    }

    public function getStripeKey(){
        $privateKey=AdminConfig::privatek();
        return $privateKey->value;//config('services.stripe.secret');
    }
    public function paymentintent(Request $request){
    	 try{
            Stripe::setApiKey($this->getStripeKey());
            $currency=$request->currency;
            $newamount=$request->total;
            $email=Auth::user()->email;
            $name=Auth::user()->name." ".Auth::user()->lastName;
            $stripeToken=$request->stripeToken;
            $multi=100;
            if(($currency=="CLP")||($currency=="PYG")){
                $multi=1;
            }
            try{
            $options=array(
                "description" => "New sale",
                 "email" => $email,
                 "source" => $stripeToken,
                 "name" => $name,
                );
                $customer = StripeCustomer::create(
                 $options, $this->getStripeKey()
                );
                //return $customer;
                $newamount=$newamount*$multi;
                $result = PaymentIntent::create([
                'amount' => (int)($newamount),
                'currency' => $currency,//$currencynew,
                'customer'=>  $customer->id,                 
                'payment_method_types' => ['card']
                ]);
                $data=array(
                     "client_secret"=>$result->client_secret,
                    );
                    return json_encode($data);
                 }
                 catch(Stripe\Error\Card $e){
                    $body = $e->getJsonBody();
                    $error=array(
                     "error"=>"true",
                     "type"=>$body['error']["message"],
                    );
                 return json_encode($error);
                }      
        }
        catch(Exception $e){
            $body = $e->getJsonBody();
            $error=array(
                "error"=>"true",
                "type"=>$body['error']["message"],
            );
            return json_encode($error);
        }
       /*
       try{
            Stripe::setApiKey($this->getStripeKey());
            $currency=$request->currency;
            $newamount=$request->total;
            $multi=100;
            if(($currency=="CLP")||($currency=="PYG")){
                $multi=1;
            }
            $newamount=$newamount*$multi;
            $result = PaymentIntent::create([
                'amount' => (int)($newamount),
                'currency' => $currency,//$currencynew,
               // 'customer'=>  $newPaymentMethodToken,                  
                'payment_method_types' => ['card']
            ]);
            $data=array(
                "client_secret"=>$result->client_secret,
            );
            return json_encode($data);
        }
        catch(Exception $e){
           // return $e;
            $error=array(
                "error"=>"true",
            );
            return json_encode($error);
        }
        */
        

    }
    
    public function compraindex(Request $request){
        $total=$request['total'];
        $idDivisa=$request['currency'];
        $idCrypto=$request['crypto'];
        $name=$request['name'];
        $lastname=$request['lastname'];
        $email=$request['email'];
        $pais=$request['country'];
        $country=Country::where('cod_iso2',$pais)->first();
        //registro de usuario
            try{
               $user= User::create([
                'name' => $name,
                'lastName'=>$lastname,
                'country_id'=>$country->id,
                'role_id' => 2,
                'email' => $email,
                'password' => bcrypt('123'),
            ]);
            }
            catch(Exception $e){
            //exepcion usuario ya registrado
              if ($e->errorInfo[1]==1062){
                  //echo "usuario registrado";
                  $user = User::where('email',$email)
                          ->first();
              }
            }
            //return $user;
            $getCriptodefault=Crypto::where('id', $idCrypto)->filtrado();
            //return $getCriptodefault;
            $getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
        if (isset($request["secure"])){
        //	echo "mantenimiento";die();
            $secret=$request["secret"];
            $result=$request["result"];
            Stripe::setApiKey($this->getStripeKey());
            $intent=PaymentIntent::retrieve($result);
               if($intent->status=="succeeded"){
                   // $amount=$intent->amount/$divi;
                    $status=$intent->status;
                    $totalx=$intent->amount/General::getMulti($getCurrencyUser->code);
                    $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    $descuento=General::getDescuento($totalx,$getCriptodefault->maker_fee);
                    $getTotalCrypto=number_format(($descuento/$getConvers), 7, '.', ''); 
                    $comision=number_format((($totalx-$descuento)), 2, '.', ''); 
                    DB::beginTransaction();

                    try{

                    $payment=new Payment;
                        $payment->user()->associate($user);
                        $payment->total=$totalx;
                        $payment->pasarela='Stripe';
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
                    //return "si";
                    
                    DB::commit();
                    $password=substr( md5(microtime()), 1, 8);
                    $userx = User::find($user->id);
                        $userx->password =bcrypt($password);
                    $userx->save();
                    //return $userx;
                 General::emailindex($criptowallet->compra,$getCriptodefault->code,$userx,"Purchase",$password);
                  
                    Session::flash('success',__('index.success_buy'));
                    return redirect("/login");
                    }
                    catch (Exception $e) {
                       // return $e;
                       
                       DB::rollback();
                       return Redirect::back()->with('error', __('index.error_buy'));
                      // return $e;
                       // something went wrong
                   }


               }else{
                return Redirect::back()->with('error', __('index.error_buy'));
                   
               }

        }
        else{
	//echo "mantenimiento2";die();
            $options=array(
                "description" => "New sale",
                 "email" => $user->email,
                 "source" => $request['stripeToken'],
                  "name" => $user->name." ".$user->lastName,
                );
                try{
                $customer = StripeCustomer::create(
                 $options, $this->getStripeKey()
                );
                    try{
                         $options=array(
                        "amount" => $total*General::getMulti($getCurrencyUser->code),
                        "currency" =>$getCurrencyUser->code,
                        "customer" =>  $customer->id,
                        );
                         $charges=StripeCharge::create($options, ['api_key' => $this->getStripeKey()]);
                         $status=$charges->status;
                         $totalx=$charges->amount/General::getMulti($getCurrencyUser->code);
                         $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                         //return $totalx;
                         $descuento=General::getDescuento($totalx,$getCriptodefault->maker_fee);
                          $getTotalCrypto=number_format(($descuento/$getConvers), 7, '.', ''); 
                         // $getTotalCrypto=number_format($getTotalCrypto, 6, '.', ','); 
                          $comision=number_format((($totalx-$descuento)), 2, '.', ''); 
                          //return $getTotalCrypto;
                          DB::beginTransaction();

                          try{
 
                          $payment=new Payment;
                              $payment->user()->associate($user);
                              $payment->total=$totalx;
                              $payment->pasarela='Stripe';
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
                          //return "si";
                          DB::commit();
                          $password=substr( md5(microtime()), 1, 8);
                          $userx = User::find($user->id);
                           $userx->password =bcrypt($password);
                          $userx->save();
                          General::emailindex($criptowallet->compra,$getCriptodefault->code,$userx,"Purchase",$password);
                          Session::flash('success',__('index.success_buy'));
                          return redirect("/login");
                          }
                          catch (Exception $e) {
                              //return $e;
                             DB::rollback();
                             return Redirect::back()->with('error', __('index.error_buy'));
                             //return $e;
                             // something went wrong
                         }
                    }
                    catch(Exception $e){
                        //return $e;
                        return Redirect::back()->with('error', __('index.error_buy'));
                     }
            }catch(Exception $e){
                //return $e;
                return Redirect::back()->with('error', __('index.error_buy'));
            }
        }    
    }

    public function compraInterna($idCrypto=null,$idDivisa=null){
       $getCriptodefault=Crypto::where('id', $idCrypto)->first();
       $getCurrencyUser=Currency::where('id', $idDivisa)->first();
       //$getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
       // return json_encode($getCurrencyUser->detailCurrency->min_deposito);
        $getCurrencies = DB::table('currencies')->pluck('name', 'id');//Currency::lists('name', 'id');
        $getCryptos = DB::table('cryptos')->pluck('name', 'id');
        $getTotalDivisa=General::getCryptoWalettUser($idDivisa);
        $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        $getPanel=General::getPanel($getConvers,$getCurrencyUser->id,$getCriptodefault->id,$getCurrencyUser,$getCriptodefault);
        //return $getPanel;
        $defaultValor=General::getDescuento($getCurrencyUser->detailCurrency->max_deposito,$getCriptodefault->maker_fee);
        $default["cryptox"]=number_format(($defaultValor/$getConvers), 7, '.', '');//round(100/$conver,4),
        $xxvalor=$getCurrencyUser->detailCurrency->max_deposito*2;
       $xxvalor1=General::getDescuento($xxvalor,$getCriptodefault->maker_fee);
       $default["pay"]=number_format(($xxvalor), 2, '.', '');
       $default["recibe"]=number_format(($xxvalor1/$getConvers), 7, '.', '');
       $default["prueba"]=number_format(($xxvalor1*$getConvers), 7, '.', '');

       $meta['key']=__('index.key');
       $meta['title']=__('index.title',["cripto"=> $getCriptodefault->name ,"currency"=> $getCurrencyUser->name ]);
       $meta['descripcion']=__('index.description',["currency"=> $getCurrencyUser->name ]);
     

        return view('home_usuario.comprar',compact('getCriptodefault','getCurrencyUser','getCryptos','getCurrencies','totalCrypto','getTotalDivisa','getPanel','default','meta'));
    }
    public function processcomprax(Request $request){
        return $request;  
            $getTotal=$request['total'];
            //return $getTotal;
            $idDivisa=$request['currency'];
            $idCrypto=$request['crypto'];
            //return $getTotal;
        if ($request['wallet']=='true'){
            //verifico que tiene el monto en el wallet
            $getTotal=$request['total'];
            //return $getTotal;
            $idDivisa=$request['currency'];
            $idCrypto=$request['crypto'];
            //return $idDivisa;
            $getCriptodefault=General::getCriptodefault($idCrypto);
            $getCurrencyUser=General::getCurrencyUser($idDivisa);
            $getTotalDivisa=General::getCryptoWalettUser($idDivisa);
           // return $getTotalDivisa;
            if($getTotalDivisa>$getTotal){//saldo valido
                //capturo cuanta cripto puede comprar con el monto enviado
                $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                //return $getConvers;
                $getTotalCrypto=round(($getTotal/$getConvers),8);
                $getTotalCrypto=number_format($getTotalCrypto, 6, '.', ''); 
                //$comision=
                //$getTotalCrypto=round(($totalx/$getConvers),8);
                //$getTotalCrypto=number_format($getTotalCrypto, 6, '.', ','); 
                $comision=$getCriptodefault->maker_fee * $getTotalCrypto / 100;
                $comision=number_format($comision, 6, '.', ''); 
                $maker_fee=$getTotalCrypto-$comision;

                //descontar del walett
                DB::beginTransaction();
                try{
                    $user=Auth::user();
                    $wallet=new Wallet;
                        $wallet->retiro=$getTotal;
                        $wallet->currency_id=$getCurrencyUser->id;
                        $wallet->status=1;
                        $wallet->comments="";
                        $wallet->user()->associate($user);
                    $wallet->save();
                    $criptowallet=new CryptoWallet;
                        $criptowallet->compra=$getTotalCrypto;
                        $criptowallet->taker=$maker_fee;
                        $criptowallet->cripto_id=$getCriptodefault->id;
                        $criptowallet->status=1;
                        $criptowallet->user()->associate($user);
                    $criptowallet->save();
                    $critowallwallet=new CryptoWalletWallet;
                        $critowallwallet->wallet()->associate($wallet);
                        $critowallwallet->cripto_wallet()->associate($criptowallet);
                    $critowallwallet->save();
                    DB::commit();
                    General::email($criptowallet->compra,$getCriptodefault->code,Auth::user(),"Purchase");
                   // General::emailCompra($criptowallet->compra,$getCriptodefault->code);
                    Session::flash('success', __('index.success_buy'));
                    return redirect("/home/".$idDivisa);  
                }
                catch (Exception $e) {
                    //return $e;
                    DB::rollback();
                    return Redirect::back()->with('error', __('index.error_buy'));
                    // something went wrong
                }
            }else{
                Session::flash('error', __('index.quanty_not_found'));
                return redirect("/buy/".$request['crypto']."/".$request['currency']);
                //return "sin saldo";
            }
        }else{
            $getCriptodefault=General::getCriptodefault($idCrypto);
            $getCurrencyUser=General::getCurrencyUser($idDivisa);
            $user=Auth::user();
            if (isset($request["secure"])){
                $secret=$request["secret"];
                $result=$request["result"];
                Stripe::setApiKey($this->getStripeKey());
                $intent=PaymentIntent::retrieve($result);
                   if($intent->status=="succeeded"){
                    $status=$intent->status;
                    $totalx=$intent->amount/General::getMulti($getCurrencyUser->code);
                    $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                    $descuento=General::getDescuento($totalx,$getCriptodefault->maker_fee);
                    $getTotalCrypto=number_format(($descuento/$getConvers), 7, '.', ''); 
                    $comision=number_format((($totalx-$descuento)), 2, '.', ''); 
                    DB::beginTransaction();
                    try{
                    $payment=new Payment;
                        $payment->user()->associate($user);
                        $payment->total=$totalx;
                        $payment->pasarela='Stripe';
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
                    General::email($criptowallet->compra,$getCriptodefault->code,Auth::user(),"Purchase");
                    Session::flash('success', __('index.success_buy'));
                    return redirect("/home/".$idDivisa);
                    }
                    catch (Exception $e) {
                       //return $e;
                       DB::rollback();
                       //return $e;
                       return Redirect::back()->with('error', __('index.error_buy'));
                       // something went wrong
                   }
                 }
                }else{
            $total=$request['total'];
           // return $total;
          
            $options=array(
                "description" => "New sale",
                 "email" => $user->email,
                 "source" => $request['stripeToken'],
                  "name" => $user->name." ".$user->lastName,
                 
                );
                try{
                $customer = StripeCustomer::create(
                 $options, $this->getStripeKey()
                );
                    try{
                         $options=array(
                        "amount" => $total*General::getMulti($getCurrencyUser->code),
                        "currency" => $getCurrencyUser->code,
                        "customer" =>  $customer->id,
                        );
                         $charges=StripeCharge::create($options, ['api_key' => $this->getStripeKey()]);
                       $status=$charges->status;
                       $totalx=$charges->amount/General::getMulti($getCurrencyUser->code);
                       $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
                       //return $totalx;
                       $descuento=General::getDescuento($totalx,$getCriptodefault->maker_fee);
                       //return $descuento;

                        //$getTotalCrypto=number_format(($descuento/$getConvers),8);

                        $getTotalCrypto=number_format(($descuento/$getConvers), 7, '.', ''); 
                       // $getTotalCrypto=number_format($getTotalCrypto, 6, '.', ','); 
                        $comision=number_format((($totalx-$descuento)), 2, '.', ''); 
                       // return $getTotalCrypto;

                        DB::beginTransaction();

                         try{

                         $payment=new Payment;
                             $payment->user()->associate($user);
                             $payment->total=$totalx;
                             $payment->pasarela='Stripe';
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
                         //return "si";
                         DB::commit();
                         General::email($criptowallet->compra,$getCriptodefault->code,Auth::user(),"Purchase");
                        // return Auth::user();
                        
                         Session::flash('success', __('index.success_buy'));
                         //return redirect("/home");
                         return redirect("/home/".$idDivisa);
                         }
                         catch (Exception $e) {
                            //return $e;
                            DB::rollback();
                            //return $e;
                            return Redirect::back()->with('error', __('index.error_buy'));
                            // something went wrong
                        }
                        }
                        catch(Exception $e){
                           // return $e;
                            return Redirect::back()->with('error', __('index.error_buy'));
                         }
                }catch(Exception $e){
                   // return $e;
                    return Redirect::back()->with('error', __('index.error_buy'));
                }

        }
     }
    }

    public function wechatCharge(Request $request){
         
        $source =  $request->source['source']; 
        $idCrypto =  $request->crypto; 
        $idDivisa =  $request->currency_form; 
        $amount =  $request->amount; 
        $user = Auth::user();


        $getCriptodefault = General::getCriptodefault($idCrypto);
        $getCurrencyUser = General::getCurrencyUser($idDivisa);


        $options=array(
          "description" => "New sale",
          "email" => $user->email,
          "name" => $user->name." ".$user->lastName,
        );  
      
        $customer = StripeCustomer::create(
         $options, $this->getStripeKey()
         // $options, 'sk_test_tjeBXUhmznGLVKr0jGwvTWsp00O7tLswHd'
        );

        \Stripe\Stripe::setApiKey($this->getStripeKey());
        // \Stripe\Stripe::setApiKey('sk_test_tjeBXUhmznGLVKr0jGwvTWsp00O7tLswHd');
        $charge = \Stripe\Charge::create([
          'amount' => $source['amount'],
          'currency' => $source['currency'],
          'source' => $source['id'],
          'customer' => $customer->id,
        ]);

        try{
                      
          $totalx = $amount/General::getMulti($getCurrencyUser->code);
          $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
          $descuento=General::getDescuento($totalx,$getCriptodefault->maker_fee);
          $getTotalCrypto=number_format(($descuento/$getConvers), 7, '.', ''); 
          $comision=number_format((($totalx-$descuento)), 2, '.', ''); 

          DB::beginTransaction();

            try{
                 $payment=new Payment;
                     $payment->user()->associate($user);
                     $payment->total=$totalx;
                     $payment->pasarela='WeChat';
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
                 General::email($criptowallet->compra,$getCriptodefault->code,Auth::user(),"Purchase");                 

                return 'ok';
             }

            catch (Exception $e) {
                DB::rollback();
                // return Redirect::back()->with('error', __('index.error_buy'));
                 return $e;
            }
        }
        catch(Exception $e){
            // return Redirect::back()->with('error', __('index.error_buy'));
            return $e;
        }

    }

    public function changeDivisaHKD(Request $request)
    {


      $endpoint = 'convert';
      $access_key = '27692546960c2e421da5a5513b76491d';
      $to = 'HKD';

      $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$request->currency.'&to='.$to.'&amount='.$request->amount.''); 
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // get the JSON data:
      $json = curl_exec($ch);
      curl_close($ch);
      $conversionResult = json_decode($json, true);

      $convertedamount = $conversionResult['result']; 

      return $convertedamount;
    }

    public function compraInternaTest($idCrypto=null,$idDivisa=null){
       $getCriptodefault=Crypto::where('id', $idCrypto)->first();
       $getCurrencyUser=Currency::where('id', $idDivisa)->first();
       //$getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
       // return json_encode($getCurrencyUser->detailCurrency->min_deposito);
        $getCurrencies = DB::table('currencies')->pluck('name', 'id');//Currency::lists('name', 'id');
        $getCryptos = DB::table('cryptos')->pluck('name', 'id');
        $getTotalDivisa=General::getCryptoWalettUser($idDivisa);
        $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
        $getPanel=General::getPanel($getConvers,$getCurrencyUser->id,$getCriptodefault->id,$getCurrencyUser,$getCriptodefault);
        //return $getPanel;
        $defaultValor=General::getDescuento($getCurrencyUser->detailCurrency->max_deposito,$getCriptodefault->maker_fee);
        $default["cryptox"]=number_format(($defaultValor/$getConvers), 7, '.', '');//round(100/$conver,4),
        $xxvalor=$getCurrencyUser->detailCurrency->max_deposito*2;
       $xxvalor1=General::getDescuento($xxvalor,$getCriptodefault->maker_fee);
       $default["pay"]=number_format(($xxvalor), 2, '.', '');
       $default["recibe"]=number_format(($xxvalor1/$getConvers), 7, '.', '');
       $default["prueba"]=number_format(($xxvalor1*$getConvers), 7, '.', '');

       $meta['key']=__('index.key');
       $meta['title']=__('index.title',["cripto"=> $getCriptodefault->name ,"currency"=> $getCurrencyUser->name ]);
       $meta['descripcion']=__('index.description',["currency"=> $getCurrencyUser->name ]);
     

        return view('home_usuario.comprarTest',compact('getCriptodefault','getCurrencyUser','getCryptos','getCurrencies','totalCrypto','getTotalDivisa','getPanel','default','meta'));
    }
}

