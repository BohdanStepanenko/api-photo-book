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
            'id'            => (string)$this->id,
            'attributes'    =>
            [
                'book_id'       => $this->book_id,
                'address_id'    => $this->address_id,
                'quantity'      => $this->quantity,
                'note'          => $this->note,
                'status'        => $this->status
            ],
        ];
    }
}
