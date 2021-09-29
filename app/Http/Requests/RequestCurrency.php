<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCurrency extends FormRequest
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
            'name' => 'required',
            'code' => 'required',
            'symbol' => 'required',
            'idioma' => 'required',
            'isocode' => 'required',
            'min_deposito' => 'required|numeric',
            'max_deposito' => 'required|numeric',
            'comision_abono' => 'required|numeric',
            'comision_retiro' => 'required|numeric',
        ];
    }
}

