<?php

namespace App\Repositories\Criterias\Common;

use App\Repositories\Criterias\Criteria;
use App\Repositories\Repository;

class WhereBetween extends Criteria
{
    private $field;
    private $from;
    private $to;

    public function __construct($field, $from, $to)
    {
        $this->field = $field;
        $this->from = $from;
        $this->to = $to;
    }

    public function apply($queryBuilder, Repository $repository)
    {
        return $queryBuilder->where(function ($query) {
            return $query->whereBetween($this->field, [$this->from, $this->to]);
        });
    }
}
