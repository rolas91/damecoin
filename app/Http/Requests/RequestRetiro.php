<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRetiro extends FormRequest
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
        				//'totalCurrency' => 'required',
                 'bankname' => 'required|max:50',
                 'beneficits' => 'required|max:50',
                 'bankcountry' => 'required|max:50',
                 'bankaddress' => 'required|max:50',
                 'bankswit' => 'required|max:50',
                 'bankiban' => 'required|max:50',
                 'totalCurrency' => 'required|numeric',
        ];
    }
}
