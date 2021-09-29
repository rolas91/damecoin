<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAdminUsers extends FormRequest
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
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'country_id' => 'required',
                'role_id' => 'required',
                'lastName' => 'required',
                'password' => 'required|min:6|confirmed',
            ];
      
    }
}
