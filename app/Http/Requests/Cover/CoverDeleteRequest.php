<?php

namespace App\Http\Requests\Cover;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cover;

class CoverDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $cover_id = $this->route('cover')->id;
        $cover = Cover::where('id', '=', $cover_id)->first();

        return auth()->user()->id === $cover->user_id;
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
