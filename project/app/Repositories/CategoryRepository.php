<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    protected function getClass()
    {
        return Category::class;
    }

}
