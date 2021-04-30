<?php

namespace App\Repositories;

use App\Models\Meal;

class MealRepository extends Repository
{
    protected function getClass()
    {
        return Meal::class;
    }

}
