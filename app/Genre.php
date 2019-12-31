<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    protected $withCount = ['books'];

    /**
     * Relationship with Book Model
     */
    public function books(){
        return $this->hasMany(Book::class)->orderBy('id', 'DESC');
    }
}
