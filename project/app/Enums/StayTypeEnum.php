<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static self PATIENT()
 * @method static self COMPANION()
 */
class StayTypeEnum extends Enum
{
    public const PATIENT = 'patient';
    public const COMPANION = 'companion';
}
