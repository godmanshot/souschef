<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filter {

    private $request;
    private $query;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        $this->builder = $query;
        $params = array_filter($this->request->all());

        foreach($params as $key => $value) {

            if(method_exists($this, $key)) {
                $this->$key($value);
            }

        }

        return $this->builder;
    }

    public function id($value)
    {
        return $this->builder->where('id', $value);
    }
}