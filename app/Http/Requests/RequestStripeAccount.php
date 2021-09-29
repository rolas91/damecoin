<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStripeAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stripe_id'=>'required',
            'name'=>'required',
            'secure_3d'=>'required',
            'user_by'=>'required',
            'email_owner'=>'required',
            'email_admin'=>'required',
        ];
    }
}
