<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\SoftDeletes; 

class PaymentMethoState extends Model
{
     // use SoftDeletes; 

     protected $table="payment_method_state";

     protected $fillable = [
          'id','state','payment_method'
      ];

}
