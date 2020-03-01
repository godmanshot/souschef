<?php

namespace App\Filters;

use App\Filters\Filter;

trait CanFilterTrait {

    public function scopeFilter($query, Filter $filter)
    {
        return $filter->apply($query);
    }

}