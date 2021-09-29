<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transference extends Model
{
    protected $fillable = [
        'id','total','pasarela','descripcion','status','currency_id','user_id','img'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function wallet()
    {
        return $this->belongsTo('App\Wallet','wallet_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }
}
