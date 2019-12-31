<?php
namespace App\QueryFilters;

use Closure;

class AuthorId extends Filter {
    
    public function applyFilter($builder){
        return $builder->where($this->filterName(), request($this->filterName()));
    }
}