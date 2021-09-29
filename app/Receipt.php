<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'receipt', 'payment_id',
    ];

    public function payment()
    {
        return $this->belongsTo('App\Payment','payment_id');
    }

}
