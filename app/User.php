<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

   // use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','role_id','lastName','country_id','recurly_id','dni','postal','ciudad','phone','verified'
       // 'name', 'email', 'password','role_id','stripe_id','card_brand','card_last_four','trial_ends_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','role_id'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function hasVerifiedPhone()
    {
        return (bool)$this->verified;
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'verified' => true,
        ])->save();
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol','role_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment')->orderBy('created_at','desc');
    }
    public function cryptowallets()
    {
        return $this->hasMany('App\CryptoWallet')->orderBy('created_at',"desc");
    }
    public function wallets()
    {
        return $this->hasMany('App\Wallet');
    }
    
    public function bankacounts()
    {
        return $this->hasMany('App\BankAcount');
    }
    public function country()
    {
        return $this->belongsTo('App\Country','country_id');
    }
    public function accountrecurly()
    {
        return $this->hasOne('App\AccountRecurly');
    }
    public function account_stripes()
    {
        return $this->belongsToMany('App\StripeAccount');
    }
    public function preference()
    {
       // return $this->hasOne('App\PreferenceUsers');
        return $this->hasOne('App\PreferenceUsers', 'user_id', 'id');
    }

}
