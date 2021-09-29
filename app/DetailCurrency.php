<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailCurrency extends Model
{
    protected $fillable = [
        'min_deposito', 'max_deposito', 'comision_retiro','comision_abono'
    ];
    public function currency()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }
}
