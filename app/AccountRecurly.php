<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRecurly extends Model
{
    protected $table = 'account_recurly';

    protected $fillable = [
        'id','user_id', 'account_number'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }


}
