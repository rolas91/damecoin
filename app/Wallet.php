<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'abono','retiro','status','descripcion','user_id','currency_id','status_user','comments'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function cryptowalletwallet()
    {
        return $this->hasOne('App\CryptoWalletWallet');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }
    public function bankacounts()
    {
        return $this->hasOne('App\BankAcount');
    }
    public function paymenwallets()
    {
        return $this->hasOne('App\Payment_Wallet');
    }
    public function transferences()
    {
        return $this->hasOne('App\Transference');
    }
    public function state()
    {
        return $this->belongsTo('App\State','status');
    }

}


