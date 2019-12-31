<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class Review extends Model
{
    protected $fillable = ['rating', 'review', 'book_id', 'user_id'];

    protected $with = ['user:id,name','book:id,title,author_id', 'book.author:id,name'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    /**
     * Relationship with User Model
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Book Model
     */
    public function book(){
        return $this->belongsTo(Book::class);
    }

    /**
     * Returns filtered reviews
     */
    public static function filteredReviews(){
        return $query = app(Pipeline::class)
        ->send(Review::query())
        ->through([
            \App\QueryFilters\BookId::class,
            \App\QueryFilters\Rating::class,
            \App\QueryFilters\ReviewAuthorId::class,
            \App\QueryFilters\OrderBy::class,
        ])
        ->thenReturn();
    }    
}
