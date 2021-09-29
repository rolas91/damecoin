<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeAccountState extends Model
{
    protected $table="stripe_account_states";

    protected $fillable = [
        'status','id','stripe_account_id','descripcion'
    ];
    
    public function stripe_account()
    {
        return $this->belongsTo('App\StripeAccount','stripe_account_id');
    }
}

