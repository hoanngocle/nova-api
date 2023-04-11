<?php

namespace App\Http\Resources\User;

use App\Enums\UserStatus;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'username'      => $this->username,
            'email'         => $this->email,
            'bio'           => $this->bio,
            'avatar'        => $this->avatar,
            'dob'           => Carbon::parse($this->dob)->format('Y-m-d'),
            'address'       => $this->address,
            'role'          => $this->role,
            'role_name'     => UserType::from($this->role)->text(),
            'status'        => UserStatus::from($this->status)->text(),
            'created_at'    => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'deleted_at'    => $this->deleted_at,
        ];
    }
}
