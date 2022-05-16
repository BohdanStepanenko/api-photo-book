<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Models\Book;
use App\Models\Address;
use App\Models\PaymentMethod;

class OrderCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $book_id = request()->input('book_id');
        $book = Book::where('id', '=', $book_id)->first();

        $address_id = request()->input('address_id');
        $address = Address::where('id', '=', $address_id)->first();

        $payment_method_id = request()->input('payment_method');
        $payment_method = PaymentMethod::where('id', '=', $payment_method_id)->first();

        return auth()->user()->id === $book->user_id && auth()->user()->id === $address->user_id && auth()->user()->id === $payment_method->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_id' => 'required|integer',
            'address_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:10',
            'note' => 'string|max:150|nullable'
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
            'book_id.required' => 'Book is required',
            'address_id.required' => 'Address is required',
            'quantity.required' => 'Quantity is required'
        ];
    }
}
