<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Helpers;
use App\Http\Requests\RequestRegister;
use Auth;
use App\User;
use App\Rol;
use App\Crypto;
use App\Currency;
use General;
use DB;
use Mail;
use Session;
use Illuminate\Support\Facades\Input;
use App;
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
class IndexController1 extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }
    public function getStripeKey(){
        return config('services.stripe.secret');
    }
    public function paymentintent(Request $request){
       
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
        

    }
    public function indexx($idCrypto=null,$idDivisa=null,$pais=null)
    {
        $lang="es";
        session(['lang' => $lang]);
        \App::setLocale($lang);
        if($idCrypto==null){
            $idCrypto=General::getCryptoDefault('BTC');
        }else{
            $idCrypto=General::getCryptoDefault($idCrypto);
        }
        if($idDivisa==null){
            $idDivisa=General::getDivisaDefault();
        }else{
            $idDivisa=Currency::where('code', $idDivisa)->filtrado();
            $idDivisa=$idDivisa->id;
        }
       $getCriptodefault=Crypto::where('id', $idCrypto)->filtrado();
       //return $getCriptodefault;
       $getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
      // return $getCurrencyUser;
       $getCurrencies = DB::table('currencies')->where('status',1)->pluck('name', 'code');//Currency::lists('name', 'id');
       $getCryptos = DB::table('cryptos')->where('status',1)->pluck('name', 'code');
       $getCountry = DB::table('countries')->where("idioma",'es')->orderBy("name","asc")->pluck('name', 'cod_iso2','id');
       //return $getCurrencyUser->code;
       $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
       $getPanel=General::getPanel($getConvers,$getCurrencyUser->id,$getCriptodefault->id,$getCurrencyUser,$getCriptodefault);
       //return  $getPanel;
       $defaultValor=General::getDescuento($getCurrencyUser->detailCurrency->max_deposito,$getCriptodefault->maker_fee);
       //return $getConvers;
       $getConvers=number_format($getConvers, 2, '.', '');
       $default["cryptox"]=number_format(($defaultValor/$getConvers), 7, '.', '');//round(100/$conver,4),
       $xxvalor=$getCurrencyUser->detailCurrency->max_deposito*2;
       $xxvalor1=General::getDescuento($xxvalor,$getCriptodefault->maker_fee);
       $default["pay"]=number_format(($xxvalor), 2, '.', '');
       $default["recibe"]=number_format(($xxvalor1/$getConvers), 7, '.', '');
       $default["prueba"]=number_format(($xxvalor1*$getConvers), 7, '.', '');

       $meta['key']=__('index.key');
       $meta['title']=__('index.title',["cripto"=> $getCriptodefault->name ,"currency"=> $getCurrencyUser->name ]);
       $meta['descripcion']=__('index.description',["currency"=> $getCurrencyUser->name ]);
       return view('newIndex',compact('meta','getCriptodefault','getCurrencyUser','getCryptos','getCurrencies','getPanel','default','getCountry','pais'));
    

    }
    public function indexxenglish($idCrypto=null,$idDivisa=null,$pais=null)
    {
      $lang="en";
      session(['lang' => $lang]);
      \App::setLocale($lang);

        if($idCrypto==null){
            $idCrypto=General::getCryptoDefault('BTC');
        }else{
            $idCrypto=General::getCryptoDefault($idCrypto);
        }
        if($idDivisa==null){
            $idDivisa=General::getDivisaDefault();
        }else{
            $idDivisa=Currency::where('code', $idDivisa)->filtrado();
            $idDivisa=$idDivisa->id;
        }
       $getCriptodefault=Crypto::where('id', $idCrypto)->filtrado();
       //return $getCriptodefault;
       $getCurrencyUser=Currency::where('id', $idDivisa)->filtrado();
      // return $getCurrencyUser;

       $getCurrencies = DB::table('currencies')->where('status',1)->pluck('name', 'code');//Currency::lists('name', 'id');
       $getCryptos = DB::table('cryptos')->where('status',1)->pluck('name', 'code');
       $getCountry = DB::table('countries')->where("idioma",'en')->orderBy("name","asc")->pluck('name', 'cod_iso2','id');
       //return $getCurrencyUser->code;
       $getConvers=General::getConvers($getCurrencyUser->code, $getCriptodefault->code);
       //echo $getConvers;
       //echo "<br>";
       //$getConvers=number_format(($getConvers), 2, '.', '');
       $getConvers=round($getConvers);
       //return $getConvers;
       $getPanel=General::getPanel($getConvers,$getCurrencyUser->id,$getCriptodefault->id,$getCurrencyUser,$getCriptodefault);
       //return  $getPanel;
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
      return view('index',compact('meta','getCriptodefault','getCurrencyUser','getCryptos','getCurrencies','getPanel','default','getCountry','pais'));

    }
    public function mail(Request $request){


       // return "si";
      // return __('index.get');
      /*
      return  $request->server('HTTP_ACCEPT_LANGUAGE');
        $criptos= DB::table('cryptos')->where('status',1)->get();
        $currencies= DB::table('currencies')->where('status',1)->get();
       // return $xmls;
        return response()->view('xml', compact('criptos','currencies'))->header('Content-Type', 'text/xml');

*/
        //return view('xml', ['xmlContent' => $xml])->header('Content-Type', 'text/xml');

        
       // return $crypto;
       // return "s";
       /*
        $data = [
            'link' => 'https://damecoins.com'
          ];
          \Mail::send('emails.notificacion', $data, function($msg){
           //$msg->from('atencion@megacursos.com', 'Megacursos');
         $msg->to('houltman@gmail.com')->subject('Notificación');
          });
          */

          //return "si";
         // $data=
         
          
    $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
   // $divisa="BTC";
    session(['key' => 'btc']);
    $beautymail->send('emails.compra',['monto' => "0.1222 BTC","email"=>"dddd","usuario"=>"gabriel houltman","divisa"=>'btc'], function($message) 
    {
        $email ='houltman@gmail.com';// Input::get('houltman@gmail.com');
        //$divisa=Auth::user()->name;
        $divisa=Session::get("key");
      
        $message
            ->from('atencion@damecoins.com')
            ->to($email, 'gabriel!')
            ->subject('Compra'.'['.$divisa.']');
    });
    session()->flush();

    return "sss";
         //return Redirect::back();

          
         // Mail::to('email@doe.com')->send(new TestAmazonSes('It works!'));
    }
    public function getindex()
    {

        $getCurrency=General::getCurrency($clientIP);
        $getCriptodefault=General::getCriptodefault('null');
        //return response()->json($getCriptodefault, 200);//$getCriptodefault;
        $defaulCurrency=$getCurrency["default"];
        //return $getCurrency;
        $getCrypto=General::getCrypto();
        $defaulCrypto=$getCriptodefault->code;
        //$getConvers=General::getConvers($defaulCurrency, $defaulCrypto);
        $getConvers=9740.63583;
        $comision=10;

        //$getConvers=($getConvers*(10/100));
        $getConvers+=($getConvers*($comision/100));

        $getPanel=General::getPanel($getConvers,$getCurrency["default"]->id,$getCriptodefault->id);

        $data=array(
          'key'=>bcrypt('mega'),
          'currencies'  =>$getCurrency["currencies"],
          'defaultCurrency'  =>$getCurrency["default"]->code,
          'cryptos'  =>$getCrypto,
          'defaultCrypto'=>$getCriptodefault->code,
          'conver'=>$getConvers,
          'panel'=>$getPanel,
        );

        return response()->json($data, 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
        //return 'si';
    }
    public function login(Request $request)
    {
       $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
    ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            // The user is being remembered...

            if(Auth::user()->rol->name=="usuario"){
                return redirect('home');  
            }
            if(Auth::user()->rol->name=="administrator"){
                return redirect('admin');  
            }
        }
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'approve' => __('login.approve'),
        ]);
        //return "no";
        
    }
    public function  iniciar()
    {
       if (Auth::user()){
        if(Auth::user()->rol->name=="usuario"){
            return redirect('home');
         }
        }
        $meta['title']=__('login.title');
        $meta['key']=__('login.key');
        $meta['descripcion']=__('login.description');
        return view('auth.login',compact('meta')); 
    }

    public function  signup()
    {
        $getCountry = DB::table('countries')->where("idioma",App::getLocale())->orderBy("name","asc")->pluck('name', 'id');
        if (Auth::user()){
        if(Auth::user()->rol->name=="usuario"){
            return redirect('home');
         }
        }
        $meta['title']=__('signup.title');
        $meta['key']=__('signup.key');
        $meta['descripcion']=__('signup.description');
        return view('auth.register',compact('meta','getCountry')); 
    }

    public function register(RequestRegister $request)
    {
       // return $request['country'];
        try{
        User::create([
            'name' => $request['name'],
            'lastName'=>$request['lastname'],
            'email' => $request['email'],
            'role_id' => 2,
            'country_id' => $request['country'],
            'password' => bcrypt($request['password']), 
        ]);
            
            Session::flash('success', "registro Satisfactorio");
            
            return redirect('login');
        }catch(Exception $e){
         return redirect()->back()->withInput($request->only('email', 'name','country'));

        }
    }

}

