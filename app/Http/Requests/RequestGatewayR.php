<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestGatewayR extends FormRequest
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
                'gateway_code'=>'required|max:50',
                'currency_id'=>'required',
                'stripe_account_id'=>'required',
                //'currency_default'=>'required',
        ];
    }
}
