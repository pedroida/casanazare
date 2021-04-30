<?php

namespace App\Repositories;

use App\Models\Source;

class SourceRepository extends Repository
{
    protected function getClass()
    {
        return Source::class;
    }

}
