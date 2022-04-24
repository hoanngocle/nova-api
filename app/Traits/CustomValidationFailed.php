<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

trait CustomValidationFailed
{
    /**
     * Custom Validation Failed Request
     *
     * @param Validator $validator
     * @return mixed
     */
    public function failedValidation(Validator $validator): mixed
    {
        throw new HttpResponseException(response()->json([
            "code"    => Response::HTTP_UNPROCESSABLE_ENTITY,
            "message" => $validator->errors(),
            "success" => false
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
