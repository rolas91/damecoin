<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'id','code', 'name', 'symbol','isoCountry','status','idioma','secure'
    ];

    public function scopeFilter($query)
    {
    return $query->select('id', 'name','code','symbol')->orderBy('name', 'asc')->get();
    }
    public function scopeFiltrado($query)
    {
    return $query->select('id', 'name','code','symbol','secure')->first();
    }
    public function detailCurrency()
    {
        return $this->hasOne('App\DetailCurrency');
    }
    public function payment()
    {
        return $this->hasMany('App\Payment');
    }
    public function wallet()
    {
        return $this->hasMany('App\Payment');
    }
    public function transfers()
    {
        return $this->hasMany('App\Transference');
    }
    public function supportrecurly()
    {
        return $this->hasOne('App\SupportRecurly');
    }
    public function conversions()
    {
        return $this->hasMany('App\DefaultConversion');
    }

    public function preference()
    {
        return $this->hasMany('App\PreferenceUsers');
    }
    /*
    public function supportrecurly()
    {
        return $this->hasOne('App\SupportRecurly');
    }*/

}


