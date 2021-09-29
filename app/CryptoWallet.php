<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoWallet extends Model
{

    protected $fillable = [
        'id', 'compra', 'venta','status', 'user_id','cripto_id','comments'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function crypto()
    {
        return $this->belongsTo('App\Crypto','cripto_id');
    }
    public function state()
    {
        return $this->belongsTo('App\State','status');
    }

    public function cryptowalletpayment()
    {
        return $this->hasOne('App\CryptoWalletPyment');
    }
    public function cryptowalletwallet()
    {
        return $this->hasOne('App\CryptoWalletWallet');
    }
    public function externals()
    {
        return $this->hasOne('App\ExternalWallet');
    }
}
