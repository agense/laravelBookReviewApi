<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ImageValidation;

class BookRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:191',
                'regex:/^[a-zA-Z0-9,.?!\\s-]*$/',
                Rule::unique('books', 'title')->ignore($this->book)
            ],
            'description' =>'required|string|max:1000|regex:/^[a-zA-Z0-9,.?!\\s-]*$/',
            'publication_year' =>'required|integer|digits:4|min:1900|max:'.date('Y'),
            'genre_id' => 'required|integer|exists:genres,id',
            'author_id'=> 'required|integer|exists:authors,id',
            'image' => ['sometimes', 'nullable', new ImageValidation]
        ];
    }
}
