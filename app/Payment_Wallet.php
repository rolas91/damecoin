<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_Wallet extends Model
{
    protected $table="payment_wallet";
    protected $fillable = [
        'id', 'payment_id', 'wallet_id'
    ];
    public function payment()
    {
        return $this->belongsTo('App\Payment','payment_id');
    }
    public function wallet()
    {
        return $this->belongsTo('App\Wallet','wallet_id');
    }
}
