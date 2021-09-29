<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeAccount extends Model
{
    //stripe_accounts
    protected $table="stripe_accounts";

    protected $fillable = [
        'stripe_id','id','name','secure_3d','user_by','email_owner','email_admin','status'
    ];

    public function gateways()
    {
        return $this->hasMany('App\GatewayRecurly');
    }

    public function states()
    {
        return $this->hasMany('App\StripeAccountState');
    }

    public function details()
    {
        return $this->hasMany('App\StripeAccountDetails');
    }

    public function support_recurly()
    {
        return $this->hasMany('App\SupportRecurly');
    }

    public function users()
    {
        return $this->belongsToMany('App\Users');
    }

    
    

}
