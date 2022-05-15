<?php

namespace App\Http\Resources\Backend\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'order_number'      => (string)$this->id,
            'order_date'        => $this->created_at,
            'quantity'          => $this->quantity,
            'status'            => $this->status,
            'book_id'           => $this->book_id,
            'pages_quantity'    => $this->books->pages,
            'delivery_address'  => $this->addresses->full_address,
            'user_email'        => $this->users->email,
            'user_phone_number' => $this->users->phone,
            'note'              => $this->note
        ];
    }
}
