<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestPerfil;
use App\Http\Requests\RequestPassword;
use App\User;
use App\Crypto;
use App\Currency;
use Auth;
use Session;
use DB;
//use Validator;

class PerfilController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    public function index(){
        $user=User::find(Auth::user()->id);

        $paymentAcount = $user->payments->count();

        $bandera=false;

        $idDivisa = 1;

        if($idDivisa==null){

            $currencies=Currency::select('id')->where('status',1)->get();
            $current=[];
            $bandera=false;
            foreach ($currencies as $currency) {
                $saldo=General::getCryptoWalettUser($currency->id); 
                
                $current[]=[
                    'saldo'=>$saldo,
                    'id'=>$currency->id,
                ];
                $idDivisa=$currency->id;
    
                if ($saldo>0){
                    $bandera=true;
                    break;
                }
            }

            if ($bandera==true)  {

                $default=Currency::find($idDivisa);
    
            }else{
                    $idDivisa=General::getDivisaDefault();
                    $default=Currency::find($idDivisa);
                
            } 

        }else{
            $default=Currency::find($idDivisa);
        }

        $getCountry = DB::table('countries')->pluck('name','id');
        $getCurrencies = DB::table('currencies')->pluck('name', 'id');
       // return ;
        if(Auth::user()->rol->name == "usuario"){
         $page = 'profile';

         return view('perfil.index',compact('user','getCountry', 'page', 'default', 'getCurrencies'));
        }

        if(Auth::user()->rol->name == "v2"){
         $page = 'profile';

         return view('dash_users.profile',compact('user','getCountry', 'page', 'default', 'getCurrencies'));
        }



        if(Auth::user()->rol->name == "administrator"){
            return view('perfil.index_perfil_admin',compact('user','getCountry'));
        }
    }
    public function perfil(){
        $user=User::find(Auth::user()->id);
        $getCountry = DB::table('countries')->pluck('name','id');
       // return ;
        if(Auth::user()->rol->name == "usuario"){
         return view('perfil.index_perfil',compact('user','getCountry'));
        }
        if(Auth::user()->rol->name == "administrator"){
            return view('perfil.index_perfil_admin',compact('user','getCountry'));
           }
    }

    public function update(RequestPerfil $request)
    {
       //return $request->pais;
        $user = User::find(Auth::user()->id);
            $user->name =ucfirst($request->name);
            $user->lastName =ucfirst($request->lastname);
            $user->country_id =ucfirst($request->pais);
            //$user->symbol=strtoupper($request->symbol);
            //$user->isoCountry=strtoupper($request->isocode);
        $user->save();
        Session::flash('success', 'Datos actualizados');
        return redirect('/perfil');
        
    }
    public function password(){
        if(Auth::user()->rol->name == "usuario"){
            return view('perfil.index_password_user');
           }
           if(Auth::user()->rol->name == "administrator"){
               return view('perfil.index_password_admin');
        }
    }
    public function updatepassword(RequestPassword $request)
    {
       
        $user = User::find(Auth::user()->id);
            $user->password =bcrypt($request->password);
            //$user->lastName =ucfirst($request->lastname);
            //$user->country_id =ucfirst($request->pais);
            //$user->symbol=strtoupper($request->symbol);
            //$user->isoCountry=strtoupper($request->isocode);
        $user->save();
        Session::flash('success', 'Contraseña actualizada con exito');
        if(Auth::user()->rol->name == "usuario"){
            return redirect('/home');
           }
           if(Auth::user()->rol->name == "administrator"){
            return redirect('/admin');
        }

       
        
        
    }
}
