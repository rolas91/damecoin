<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crypto;
use General;
use DB;
class CarterasController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index($idDivisa){
        
        
        $cryptos=Crypto::orderBy('name','asc')->get();
        //$clientIP = '201.184.239.170';//colombia
        // $clientIP = ' 66.249.64.176';//usa
        // $getCurrency=General::getCurrency($clientIP);
        $default=General::getCurrencyUser($idDivisa);
        $getCurrencies = DB::table('currencies')->pluck('name', 'id');

         //$default=$getCurrency["default"];

        return view('home_usuario.carteras',compact('cryptos','getCurrencies','default'));

    }
}
