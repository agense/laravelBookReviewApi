<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Book extends Model
{
    protected $fillable = ['title', 'description', 'publication_year', 'image', 'genre_id', 'author_id', 'user_id'];

    protected $with = ['author:id,name', 'genre:id,name'];
    protected $withCount = ['reviews'];

    //Append rating to each book

    protected $appends = ['rating'];

    public function getRatingAttribute()
    {
        return round($this->hasMany(Review::class)->avg('rating'));
    }

    /**
     * Relationship with Genre Model
     */
    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    /**
     * Relationship with Author Model
     */
    public function author(){
        return $this->belongsTo(Author::class);
    }

    /**
     * Relationship with User Model
     */
    public function user(){
        return $this->belongsTo(User::class);
    }


    /**
     * Relationship with Review Model
     */
    public function reviews(){
        return $this->hasMany(Review::class)->orderBy('created_at', 'DESC')->orderBy('id', 'DESC');
    }

    /**
     * Returns filtered books
     */
    public static function filteredBooks(){
        return $query = app(Pipeline::class)
        ->send(Book::query())
        ->through([
            \App\QueryFilters\AuthorId::class,
            \App\QueryFilters\GenreId::class,
            \App\QueryFilters\OrderBy::class,
        ])
        ->thenReturn();
    }   
}
