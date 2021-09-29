<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id','total','pasarela','descripcion','status','currency_id','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function cryptowalletpayment()
    {
        return $this->hasOne('App\CryptoWalletPyment');
    }

    public function paymentwallet(){

        return $this->hasOne('App\Payment_Wallet');

    }

    public function receipt(){

        return $this->hasOne('App\Receipt');

    }

    public function currency()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }




}



          
           