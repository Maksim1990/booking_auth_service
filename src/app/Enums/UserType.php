<?php

declare(strict_types=1);

namespace App\Enums;

enum UserType: string
{
    case USER = 'user';
    case DRIVER = 'driver';
}
