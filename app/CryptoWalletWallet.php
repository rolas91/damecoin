<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoWalletWallet extends Model
{
    protected $fillable = [
        'wallet_id', 'crypto_wallet_id'
    ];

    public function cripto_wallet()
    {
        return $this->belongsTo('App\CryptoWallet','crypto_wallet_id');
    }
    public function wallet()
    {
        return $this->belongsTo('App\Wallet','wallet_id');
    }


}
