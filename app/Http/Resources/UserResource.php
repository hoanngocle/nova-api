<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'token'     => $this->createToken(config('constant.BASE_TEXT_TOKEN'))->plainTextToken,
            'username'  => $this->username,
            'profile'   => $this->profile,
        ];
    }
}
