<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportRecurly extends Model
{
    protected $table = 'support_recurly';

    protected $fillable = [
        'id','default_conversion','note','currency_id','stripe_account_id','currency_default'
    ];
    
    public function currency()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }
    public function stripe_account()
    {
        return $this->belongsTo('App\StripeAccount','stripe_account_id');
    }
    public function currency2()
    {
        return $this->belongsTo('App\Currency','currency_default');
    }
/*
    public function gateway()
    {
        return $this->belongsTo('App\GatewayRecurly','conversion_id');
    }
    */
    



}
