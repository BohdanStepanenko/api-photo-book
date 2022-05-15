<?php

namespace App\Http\Requests\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PaymentMethod;

class PaymentMethodShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $payment_method_id = $this->route('payment_method')->id;
        $payment_method = PaymentMethod::where('id', '=', $payment_method_id)->first();

        return auth()->user()->id === $payment_method->user_id;
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
