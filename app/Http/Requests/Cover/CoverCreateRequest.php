<?php

namespace App\Http\Requests\Cover;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CoverCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cover' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|between:2,50'
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
            'cover.required' => 'Cover is required',
            'cover.image' => 'Cover image should be jpeg,png,jpg,gif,svg format',
            'cover.max' => 'Cover max size is 2MB',
            'title.required' => 'Cover title is required'
        ];
    }
}
