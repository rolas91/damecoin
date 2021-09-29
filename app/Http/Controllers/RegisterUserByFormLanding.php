<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Payment;
use App\CryptoWallet;
use App\CryptoWalletPyment;
use DB;
use App\Country;
use App\Crypto;
use App\Currency;
use Exception;
use General;
use Session;
use Response;
use App\PaymentLimit;
use App\Http\Requests\RequestTransfe;
use App\Wallet;

class RegisterUserByFormLanding extends Controller
{
    public function RegisterUserByFrom(Request $request)
    {
        //siempre crear los controladores paralelamente no instanciar un controlador
        // que no conoces
        // y no sabemos si se va a emplear
        //oeditar nuevamente
        try {
            $idDivisa       =       $request->idCurrency;
            $idCrypto       =       $request->idCrypto;
            $pais           =       $request->country;
            $currency       =       $request->currency;
            $ip             =       $_SERVER['REMOTE_ADDR'];
            $url            =       url()->current();
            $country        =       Country::where('cod_iso2',$pais)->first();
            $totalCompra    =       $request->amount;
            $email          =       $request->email;
            
            $description    =       $request->method;
            
            try{
                $user= User::create([
                   'name' => $request->name,
                   'lastName'=> $request->surname,
                   'country_id'=> $country->id ,
                   'role_id' => 2,
                   'email' => $email,
                   'password' => bcrypt('123'),
                ]);

            } catch(Exception $e){
                if ($e->errorInfo[1] == 1062 ){
                    //echo "usuario registrado";
                    $user = User::where('email',$email)
                            ->first();
                 }
            }

            if($request->hasFile('File')){
                $file = $request->file('img');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $file->move('uploads/comprobante/', $filename);
            }


           $getCriptodefault=Crypto::where('id', $idCrypto)->filtrado();
           $getCurrencyUser = Currency::where('id', $idDivisa)->filtrado();
           $totalDeposit=$this->deposit_fee($totalCompra, $idDivisa);
           $newTotal=$this->maker_fee($totalDeposit,$getCriptodefault->maker_fee);
           $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
           $getTotalCrypto=number_format(($newTotal/$getConvers), 7, '.', ''); 
           //return $getTotalCrypto;
           $comision=number_format((($totalCompra-$newTotal)), 2, '.', ''); 

          
            //return $comision;
           try {
               DB::beginTransaction();

               $payment=new Payment;
                    $payment->user()->associate($user);
                    $payment->total=$request->amount;
                    $payment->pasarela= $description;
                    $payment->descripcion="compra";
                    $payment->status=0;//status pendiente
                    $payment->currency_id= $getCurrencyUser->id;
               $payment->save();

               $wallet = new Wallet;
                    $wallet->abono = $newTotal;
                    $wallet->status_user = "Pendiente";
                    $wallet->currency()->associate($getCurrencyUser->id);
                    $wallet->status = 1;
                    $wallet->user()->associate($user);
               $wallet->save();

               $criptowallet = new CryptoWallet;
                    $criptowallet->compra       =     $getTotalCrypto;
                    $criptowallet->taker        =     $comision;
                    $criptowallet->cripto_id    =     $getCriptodefault->id;
                    $criptowallet->status       =     2; //status pendiente
                    $criptowallet->comments     =     $description;
                    $criptowallet->user()->associate($user);
               $criptowallet->save();

               $critowalletpaymet=new CryptoWalletPyment;
                    $critowalletpaymet->payment()->associate($payment);
                    $critowalletpaymet->cripto_wallet()->associate($criptowallet);
               $critowalletpaymet->save();
               
               DB::commit();
            //    $password="12345678";
               //cambiar y validar si el usuario ya esta registrado
               $password=substr(md5(microtime()), 1, 8);
               $userx = User::find($user->id);
               $userx->password =bcrypt($password);
               $userx->save();
               //probar el email y crear uno con el monto y el estado pendiente guiarse por el 
               //email actual
               General::emailindex($criptowallet->compra,  $getCriptodefault->code,  $userx, "Purchase", $password);
               Session::flash('success', __('index.success_buy'));
               //el mensaje debe ser difetente compra realizada en estatus pendiente
               //General::logs($ip, "process", $url, "process", $user->id, $useragent);
               return Response::json(['status' => 1]);
           }
           catch (Exception $e) {
            DB::rollback();
            return $e;
            $response=["error"=>"true","code"=>"error"];
            return $response;
        }
    
        } catch (Exception $e) {
            return $e;
            //throw $th;
        }
    }

    //Verifica si el usuario existe en mi base de datos
    public function verifyUser($email)
    {
        $user = User::where('email', $email)->get();
        return ($user->isNotEmpty()) ? true : false;
    }
    public function deposit_fee($total,$idDivisa){
        $getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
        return ($total-($total*($getCurrencyUser->detailCurrency->comision_abono/100)));
    }

    public function conversTotal($amount,$currency){
        //return $total;
        $endpoint = 'convert';
        $access_key = config('services.fixer.key');
        $to = 'PEN';
        $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $currency . '&to=' . $to . '&amount=' . $amount . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);

        $convertedamount = $conversionResult['result'];

        return $convertedamount;
        
    }

    function maker_fee($total, $desc) {
		$totalx = ($total - ($total * $desc / 100));
		return number_format($totalx, 2, '.', '');
    }
    

    public function ProcessTransfeFormLanding(Request $request)
    {

        $currency = Currency::find($request->idCurrency);

        $paymentLimit = PaymentLimit::find(1);

        $endpoint = 'convert';
        $access_key = '27692546960c2e421da5a5513b76491d';
        $to = 'USD';
        // initialize CURL:
        $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $to . '&to=' . $currency . '&amount=' . $paymentLimit['bank_deposit_minimum'] . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);
        $convertedamountMinimo = $conversionResult['result'];

        if($request->montot < 1) {
            Session::flash('msg', __('home_deposit.minimum_deposit', ['amount' => $paymentLimit['bank_deposit_minimum']]) . ' (' . number_format($convertedamountMinimo, 2, '.', '') . ' ' . $currency->code . ')');

            return back();
        }
        
        return ;
        $ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $currency->code . '&to=' . $to . '&amount=' . $request->montot . '');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);
        $convertedamountVerify = $conversionResult['result'];

        if ($convertedamountVerify < $paymentLimit['bank_deposit_minimum']) {
            # code...
            Session::flash('msg', __('home_deposit.minimum_deposit', ['amount' => $paymentLimit['bank_deposit_minimum']]) . ' (' . number_format($convertedamountMinimo, 2, '.', '') . ' ' . $currency->code . ')');

            return back();
        }
        

        if ($currency) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/comprobante/', $filename);
            $totalx = $request->montot;
            $comision = ($totalx * $currency->detailCurrency->comision_abono) / 100;
            $total = $totalx - $comision;
            DB::beginTransaction();
            try {
                $wallet = new Wallet;
                $wallet->abono = $total;
                $wallet->status_user = "Pendiente";
                $wallet->currency()->associate($currency);
                $wallet->status = 1;
                $wallet->user()->associate(Auth::user());
                $wallet->save();

                $transfe = new Transference;
                $transfe->user()->associate(Auth::user());
                $transfe->total = $totalx;
                $transfe->pasarela = 'Wester Union';
                $transfe->descripcion = "Transferencia";
                $transfe->img = $filename;
                $transfe->status = 1;
                $transfe->wallet()->associate($wallet);
                $transfe->currency()->associate($currency);
                $transfe->save();

                DB::commit();
                General::email($wallet->abono, $currency->code, Auth::user(), "Transfer");

                Session::flash('success', __('home_deposit.success_transfe'));
                return redirect("/home/" . $currency->id);
            } catch (Exception $e) {
                // return $e;
                DB::rollback();
                return Redirect::back()->with('msg', __('home_deposit.error_transfe'));
            }
        } else {
            return Redirect::back()->with('msg', __('home_deposit.error_transfe'));
        }
    }

    public function ConsultUser($email)
    {
        $data = User::where('email',$email)->get();

        if(count($data))
        {
            return $data;
        }
        return $data;
    }
}
