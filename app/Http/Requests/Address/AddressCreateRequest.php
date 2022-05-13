<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AddressCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:24',
            'full_address' => 'required|string|min:2',
            'apartment' => 'required|string|min:2|max:24',
            'postcode' => 'required|string|min:2|max:24',
            'contact_person_name' => 'required|string|min:2|max:24',
            'contact_person_phone' => 'required|regex:/(\+27)[0-9]{9}/'
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
            'name.required' => 'Address name is required',
            'full_address.required' => 'Full address is required',
            'apartment.required' => 'Apartment is required',
            'postcode.required' => 'Postcode is required',
            'contact_person_name.required' => 'Contact person name is required',
            'contact_person_phone.required' => 'Contact person phone is required'
        ];
    }
}
