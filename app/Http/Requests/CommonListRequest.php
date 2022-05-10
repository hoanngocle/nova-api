<?php

namespace App\Http\Requests;

use App\Traits\CustomValidationFailed;
use Illuminate\Foundation\Http\FormRequest;

class CommonListRequest extends FormRequest
{
    use CustomValidationFailed;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword'       => 'nullable|max:255',
            'sort_by'       => 'nullable|max:255',
            'sort_order'    => 'nullable|in:' . implode(',', ['asc', 'desc']),
            'per_page'      => 'nullable|in:' . implode(',', [20, 30, 50, 100])
        ];
    }
}
