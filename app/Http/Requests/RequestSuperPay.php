<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSuperPay extends FormRequest
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
            'email' => 'required|email',
            'cv' => 'required|min:3',
            'total'=>'required',
            'mm'=>'required|min:2|date_format:m',
            'yy'=>'required|min:2|date_format:y',
            'cc'=>'required|max:19',
            'dni'=>'required',
            'name'=>'required',
            'ciudad'=>'required',
            'postal'=>'required',
            "phone"=>'required',
            'currency'=>'required',
            'direccion'=>'required',

            
            
        ];
    }
}
