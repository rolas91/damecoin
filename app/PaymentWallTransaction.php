<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentWallTransaction extends Model
{
    protected $fillable = [
        'id', 'user_id', 'token', 'currency_id', 'amount', 'crypto_id', 'status','direct'
    ];
}
