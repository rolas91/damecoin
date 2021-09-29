<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoWalletPyment extends Model
{
    protected $fillable = [
        'id', 'payment_id', 'cripto_wallet_id'
    ];
    public function payment()
    {
        return $this->belongsTo('App\Payment','payment_id');
    }
    public function cripto_wallet()
    {
        return $this->belongsTo('App\CryptoWallet','crypto_wallet_id');
    }
}
