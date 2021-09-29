<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    protected $fillable = [
        'name', 'orden','code', 'status','maker_fee','taker_fee','img'
    ];

    public function scopeFiltrado($query)
    {
    return $query->select('id', 'name','code','maker_fee','taker_fee')->orderBy('code', 'asc')->first();
    }

    public function getFirstNameAttribute($value)
    {
        //return ucfirst($value);
       // $this->attributes['first_name'] = strtolower($value);
    }
    
    public function scopeCryptos($query)
    {
    return $query
            ->select('id','name','code','img')
            ->orderBy('orden', 'asc')
            ->orderBy('code', 'asc')->get();
    }
    public function setStatus($value)
    {
        //$this->attributes['status'] = ($value)? 1 : "0";
    }
    public function cryptowallets()
    {
        return $this->hasMany('App\CryptoWallet');
    }
}
