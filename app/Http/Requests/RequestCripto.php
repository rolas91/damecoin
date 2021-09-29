<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCripto extends FormRequest
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

                // 'nombre' => 'required|alpha|min:2|max:60',
                // 'apellido' => 'required|alpha|min:2|max:60',
                 'name' => 'required|max:20',
                 'code' => 'required|unique:cryptos|max:4',
                 'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                 //'genero' => 'required|in:femenino,masculino',
                 //'fecha_nacimiento' => 'required|date|max:20',
                 'maker_fee' => 'required',
                 'taker_fee' => 'required'
             ];
    
    }
}
