<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Book;

class BookDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $book_id = $this->route('book')->id;
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
        return [];
    }
}
