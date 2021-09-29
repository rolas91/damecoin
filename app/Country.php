<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'iso_code2', 'ico','id'
    ];
    public function usuario()
    {
        return $this->hasOne('App\User');
    }
}
