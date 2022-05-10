<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Photo;
use App\Models\Book;

class ShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $photo_id = $this->route('photo')->id;
        $book_id = Photo::where('id', '=', $photo_id)->pluck('book_id');
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
