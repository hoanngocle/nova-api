<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateHeroRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'          => 'required|min:6|max:18',
            'email'             => 'required|unique:users|max:255',
            'password'          => 'required|max:255',
            'confirm_password'  => 'required|same:password'
        ];
    }
}
