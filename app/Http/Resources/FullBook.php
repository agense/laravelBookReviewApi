<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FullBook extends JsonResource
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
            'description' => $this->description,
            'genre' =>$this->genre->name,
            'genre_id' => $this->genre_id,
            'author' =>$this->author->name,
            'author_id' => $this->author_id,
            'publication_year' => $this->publication_year,
            'image' => ($this->image) ? asset('storage/images/'.$this->image) : null,
            'rating' => $this->rating,
            'review_count' => $this->reviews_count,
            'uploaded_by_user'=> $this->user_id,
        ];
    }
}
