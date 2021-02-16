<?php

namespace App\Repositories;

use App\Models\Unit;

class UnitRepository extends Repository
{
    protected function getClass()
    {
        return Unit::class;
    }

}
