<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendPhoneCode extends Model
{
    protected $table = "send_phone_codes";

    protected $fillable = [
        'user_id', 'code',
    ];
}
