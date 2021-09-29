<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name','id'
    ];
    public function cryptowallets()
    {
        return $this->hasMany('App\CryptoWallet');
    }
    public function wallets()
    {
        return $this->hasMany('App\Wallet');
    }

}
