<?php
namespace App\QueryFilters;

use Closure;

class ReviewAuthorId extends Filter {

    public function applyFilter($builder){
        return $builder->where('user_id', request($this->filterName()));
    }
}
