<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' =>$this->author->name,
            'author_id' => $this->author_id,
            'publication_year' => $this->publication_year,
            'genre' =>$this->genre->name,
            'genre_id' => $this->genre_id,
            'rating' => $this->rating,
            'review_count' => $this->reviews_count,
            'image' => ($this->image) ? asset('storage/images/'.$this->image) : null,
        ];
    }
}
