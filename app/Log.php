<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    
    protected $fillable = [
        'id', 'ipaddress','useragent','url','description','tipo','user_id'
    ];
}

