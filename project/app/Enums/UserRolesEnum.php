<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static self ADMIN()
 * @method static self CLIENT()
 * @method static self VOLUNTARY()
 */
class UserRolesEnum extends Enum
{
    public const ADMIN = 'admin';
    public const VOLUNTARY = 'voluntary';
    public const CLIENT = 'client';
}
