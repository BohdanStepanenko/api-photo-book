<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Models\Book;

class PhotoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $book_id = request()->get('book_id');
        $book = Book::where('id', '=', $book_id)->first();

        return auth()->user()->id === $book->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'string|between:2,50',
            'book_id' => 'required|integer'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'photo.required' => 'Photo is required',
            'photo.image' => 'Photo should be jpeg,png,jpg,gif,svg format',
            'photo.max' => 'Photo max size is 2MB',
            'book_id.required' => 'Book to upload is required'
        ];
    }
}
