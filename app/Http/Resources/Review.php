<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Review extends JsonResource
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
            'rating' => $this->rating,
            'review' => $this->review,
            'book' => $this->book->title,
            'book_id' => $this->book->id,
            'book_author' => $this->book->author->name,
            'review_author' => $this->user->name,
            'review_author_id' => $this->user->id,
            'review_date' => (string)$this->created_at->format('m/d/Y'),
        ];
    }
}
