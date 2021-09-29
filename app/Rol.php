<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;
class Rol extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','id'
    ];
    public function users()
    {
        //return $this->belongsTo('App\Post');
        return $this->hasMany('App\User');
    }
}
