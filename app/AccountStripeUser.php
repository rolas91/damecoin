<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountStripeUser extends Model
{
    
    protected $table ='account_stripe_users';
/*
    public function user()
    {
        return $this->belongsToMany('App\Role');
    }
    public function acount_stripe()
    {
        return $this->belongsToMany('App\Role');
    }
    */
}
