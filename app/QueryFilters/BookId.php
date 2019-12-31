<?php
namespace App\QueryFilters;

use Closure;

class BookId extends Filter {
    
    public function applyFilter($builder){
        return $builder->where($this->filterName(), request($this->filterName()));
    }
}