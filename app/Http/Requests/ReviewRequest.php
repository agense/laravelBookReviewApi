<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rating' => 'required|integer|digits:1|min:1|max:5',
            'review' => 'required|string|max:500|regex:/^[a-zA-Z0-9,.?!\\s-]*$/',
            'book_id' => 'required|integer|exists:books,id',
        ];
    }
}
