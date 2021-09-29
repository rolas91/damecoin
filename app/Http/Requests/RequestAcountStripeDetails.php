<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAcountStripeDetails extends FormRequest
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
           'retencions'=>'required',
            'mounts' =>'nullable|regex:/^\d*(\.\d{2})?$/',
            'bank_id' =>'required',
            'fecha' =>'required',
            'stripe_account_id'
            
        ];
    }
}
