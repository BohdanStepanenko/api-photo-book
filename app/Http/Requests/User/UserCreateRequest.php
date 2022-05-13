<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|between:2,50',
            'surname' => 'required|string|between:2,50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|between:6,12'
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
            'name.required' => 'Name is required',
            'surname.required' => 'Surname is required',
            'email.required' => 'Email is required',
            'email.email' => 'Incorrect Email field',
            'password.required' => 'Password is required'
        ];
    }
}
