<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CryptoWallet;
use DB;

class AdminController extends Controller
{
    /*
    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    */
    public function index(){
       
        //$balances=Cryptowallet::where('status',1)->get();

        $pendiente = DB::table('crypto_wallets')
                     ->select(DB::raw('count(*) as pendiente'))
                     ->where('status', '=', 1)
                     ->first();
        $total = DB::table('crypto_wallets')
                    ->select(DB::raw('count(*) as total'))
                     //->where('status', '=', 1)
                     ->first();             
        //return $balances->pendiente;
        return view('admin.index',compact('pendiente','total'));
    }
}
