<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class PaymentMethods extends Model
{
    use SoftDeletes; 

    protected $table = 'payment_methods';

    protected $fillable = [
        'id','name','amount','send_comission','file','convert', 'form'
    ];
    public function scopeFiltrado($query)
    {
    return $query->select('id', 'name','amount','send_comission','convert','file','account','form')->first();
    }

}
