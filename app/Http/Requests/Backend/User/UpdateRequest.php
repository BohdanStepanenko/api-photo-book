<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|between:2,50',
            'surname' => 'string|between:2,50',
            'email' => 'string|email|max:100|unique:users',
            'phone' => 'regex:/(27)[0-9]{9}/'
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
}
