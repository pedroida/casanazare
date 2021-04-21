<?php

namespace App\Repositories\Criterias\Common;

use App\Repositories\Criterias\Criteria;
use App\Repositories\Repository;

class GroupBy extends Criteria
{
    private $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function apply($queryBuilder, Repository $repository)
    {
        return $queryBuilder->groupBy(...$this->column);
    }
}
