<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransfAdmin extends Model
{
    protected $table="transf_user_admin";

    protected $fillable = [
        'recipient','id','user_id','currency_id','status','account_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Bank','account_id');
    }
}
