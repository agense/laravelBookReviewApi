<?php
namespace App\QueryFilters;

use Closure;

class Rating extends Filter {
    
    public function applyFilter($builder){
        if(intval(request($this->filterName())) > 0 && intval(request($this->filterName())) <= 5){
            return $builder->where($this->filterName(), intval(request($this->filterName())));
        }
        return $builder;
    }
}