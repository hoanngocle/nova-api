<?php

namespace App\Http\Controllers\API;

use App\Services\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
}
