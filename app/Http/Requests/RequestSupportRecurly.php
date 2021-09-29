<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSupportRecurly extends FormRequest
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
         'default_conversion' => 'required',
         //'conversion_id' => 'required',
        // 'gateway_code' => 'required|max:50',
         'note' => 'required|max:100',
         'currency_id' => 'required|numeric',
         'currency_default' => 'required|numeric',
        ];
    }
}
