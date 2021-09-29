<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalWallet extends Model
{
     protected $table = 'external_wallets';

     public  $timestamps = true;

     protected $fillable = [
         'id','retiro', 'comision', 'wallet_externo','crypto_wallet_id','status'
     ];

     public function cryptowallet()
     {
         return $this->belongsTo('App\CryptoWallet','crypto_wallet_id');
     }
}
