<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class RequestPassword extends FormRequest
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
            'contraseña_actual' => 'required|current_password',
            //'contraseña_actual' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ];
    }
    public function sanitize()
    {
        return $this->only('nueva_contraseña');
    }
}
