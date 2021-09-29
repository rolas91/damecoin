<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'destinatary', 'title','name', 'country','addres','swift','numero_cuenta','status'
    ];
}


