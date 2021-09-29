<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminConfig extends Model
{
    protected $table = 'config';

    protected $fillable = [
        'id','type', 'value', 
    ];
    //public $timestamp=false;
   public  $timestamps = false;
    public function scopePrivatek($query)
    {
    //return $query->select('id', 'name','code','symbol','secure')->first();
   return $query->select("id","value","type")->where('type', "privateKeyStripe")->first();
    }
    public function scopePublick($query)
    {
    //return $query->select('id', 'name','code','symbol','secure')->first();
   return $query->select("id","value","type")->where('type', "publicKeyStripe")->first();
    }
    public function scopeMaster($query)
    {
    //return $query->select('id', 'name','code','symbol','secure')->first();
   return $query->select("id","value","type")->where('type', "masterpassword")->first();
    }
    public function scopeFlutter($query,$key)
    {
    //return $query->select('id', 'name','code','symbol','secure')->first();
   return $query->select("id","value","type")->where('type', $key)->first();
    }

}
