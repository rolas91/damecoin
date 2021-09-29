<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLimit extends Model
{
    protected $table="payment_limit";

    protected $fillable = [
        'card_minimum', 'card_maximum', 'wechat_minimun', 'bank_minimum', 'bank_deposit_minimun','paypal_minimun'
    ];
}
