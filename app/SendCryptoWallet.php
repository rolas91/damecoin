<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendCryptoWallet extends Model
{
    protected $fillable = [
        'account','platform','currencies_id','crypto_wallets_id'
    ];
    public function cryptoWallet()
    {
        return $this->belongsTo('App\CryptoWallet','crypto_wallets_id');
    }
    public function currencies()
    {
        return $this->belongsTo('App\Currency','currencies_id');
    }
}
