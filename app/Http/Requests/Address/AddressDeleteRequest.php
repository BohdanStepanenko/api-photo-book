<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;

class AddressDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $address_id = $this->route('address')->id;
        $address = Address::where('id', '=', $address_id)->first();

        return auth()->user()->id === $address->user_id;
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
