<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeAccountDetails extends Model
{
    protected $table="stripe_account_details";

    protected $fillable = [
        'retencions','id','mounts','bank_id','fecha','stripe_account_id'
    ];

    public function stripe_account()
    {
        return $this->belongsTo('App\StripeAccount','stripe_account_id');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank','bank_id');
    }



}
