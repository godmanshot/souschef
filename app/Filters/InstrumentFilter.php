<?php

namespace App\Filters;

class InstrumentFilter extends Filter {
    
    public function name($value)
    {
        return $this->query->where('name', 'LIKE', '%'.$value.'%');
    }
}