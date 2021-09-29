<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MethodCountryCripto extends Model
{
    protected $table = 'method_country_cripto';
    protected $fillable = [
        'country_id', 'crypto_id', 'description', 'id'
    ];
    
}
