<?php

namespace App\Filters;

class DishFilter extends Filter {
    
    public function name($value)
    {
        return $this->query->where('name', 'LIKE', '%'.$value.'%');
    }
}