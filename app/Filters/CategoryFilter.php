<?php

namespace App\Filters;

class CategoryFilter extends Filter {
    
    public function name($value)
    {
        return $this->query->where('name', 'LIKE', '%'.$value.'%');
    }
}