<?php
namespace App\QueryFilters;

use Closure;

class OrderBy extends Filter {
    
    public function applyFilter($builder){
        $orderOptions = [];
        $reqUrl = explode('/', request()->url());
        
        if(end($reqUrl) == 'books'){
            $orderOptions = [
                'id',
                'author_id',
                'genre_id',
                'publication_year',
                'created_at'
            ];
        }elseif(end($reqUrl) == 'reviews'){
            $orderOptions = [
                'id',
                'book_id',
                'rating',
                'created_at'
            ];
        }
       
        $order = request()->has('order') && request('order') == 'ASC' ? 'ASC'  : 'DESC';

        if(! in_array(request($this->filterName()), $orderOptions)){
            //Deafult order
            return $builder->orderBy('created_at', 'DESC')->orderBy('id', 'DESC');
        }
        return $builder->orderBy(request($this->filterName()), $order);
    }
}