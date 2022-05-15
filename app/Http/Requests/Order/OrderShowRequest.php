<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Order;

class OrderShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route()->parameter('id');
        $order = Order::findOrFail($id);

        return auth()->user()->id === $order->user_id;
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
