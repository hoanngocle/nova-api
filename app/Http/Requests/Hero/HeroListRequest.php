<?php

namespace App\Http\Requests\Hero;

use Illuminate\Foundation\Http\FormRequest;

class HeroListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|max:255',
            'password'  => 'required|max:255'
        ];
    }
}
