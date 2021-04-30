<?php

namespace App\Repositories;

use App\Models\Stay;

class StayRepository extends Repository
{
    protected function getClass()
    {
        return Stay::class;
    }

}
