<?php

namespace App\Filters;

class HashTagFilter extends Filter {
    
    public function name($value)
    {
        return $this->query->where('name', 'LIKE', '%'.$value.'%');
    }
}