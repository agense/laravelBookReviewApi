<?php
namespace App\QueryFilters;

use Closure;
use Str;

abstract class Filter {
    
    public function handle($request, Closure $next){
        if(! request()->has($this->filterName())){
            return $next($request);
        }
        $builder = $next($request);
        return $this->applyFilter($builder);
    }
    
    protected function filterName(){
        return Str::snake(class_basename($this));
    }

    protected abstract function applyFilter($builder);
}