<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'registration_date' => $this->created_at->format('m/d/Y'),
            'book_count' => $this->books_count ?? 'N/A',
            'review_count' => $this->reviews_count ?? 'N/A',
            'author_count' => $this->authors_count ?? 'N/A',
        ];
    }
}
