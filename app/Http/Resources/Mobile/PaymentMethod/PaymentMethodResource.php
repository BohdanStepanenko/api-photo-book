<?php

namespace App\Http\Resources\Mobile\PaymentMethod;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
                'user_id'           => $this->user_id,
                'last_four'         => $this->last_four,
                'card_token'        => $this->card_token,
                'created_at'        => $this->created_at
            ],
        ];
    }
}
