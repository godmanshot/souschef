<?php

namespace App\Filters;

class WeekFilter extends Filter {
    
    public function name($value)
    {
        return $this->query->where('name', 'LIKE', '%'.$value.'%');
    }
}