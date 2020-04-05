<?php

namespace App\Repositories;

use App\Models\Source;

class StayRepository extends Repository
{
    protected function getClass()
    {
        return Source::class;
    }

}
