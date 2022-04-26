<?php

namespace App\Enums;

enum UserStatus: int
{
    case WAITING    = 0;
    case ACTIVE     = 1;
    case DISABLE    = 2;
}
