<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatewayRecurly extends Model
{
    protected $table = 'gateway_recurly';

    protected $fillable = [
        'id', 'gateway_code','currency_id','name','stripe_account_id'
    ];

    public function supports()
    {
        return $this->hasMany('App\SupportRecurly');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }
    

    public function stripe_account()
    {
        return $this->belongsTo('App\StripeAccount','stripe_account_id');
    }


}


