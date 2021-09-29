<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAcount extends Model
{
    protected $fillable = [
        'benefics', 'name', 'country','addres','swit','iban','wallet_id','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function wallet()
    {
        return $this->belongsTo('App\Wallet','wallet_id');
    }
}
