<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Landing extends Model
{
    use SoftDeletes; 

    protected $table = 'landing';

    protected $fillable = [
        'id','name','url','comentarios','link_asana','state','agent'
    ];
}
