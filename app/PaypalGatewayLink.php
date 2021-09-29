<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalGatewayLink extends Model
{
    protected $fillable = [
        'id', 'status', 'url', 'target'
    ];
}
