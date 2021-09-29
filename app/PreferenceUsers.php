<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreferenceUsers extends Model
{

    protected $fillable = [
        'locate', 'fiat_wallet_default','user_id','crypto_wallet_default'
    ];

    public function user()
    {
        //return $this->belongsTo('App\User','user');
        return $this->belongsTo('App\User');
    }

    public function currency()
    {
        //return $this->belongsTo('App\User','user');
        return $this->belongsTo('App\Currency','fiat_wallet_default');
    }

    public function crypto()
    {
        //return $this->belongsTo('App\User','user');
        return $this->belongsTo('App\Crypto','crypto_wallet_default');
    }

    
 
}
