<?php

namespace App\Http\Resources\Mobile\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
                'user_id'       => $this->user_id,
                'name'          => $this->name,
                'full_address'  => $this->full_address,
                'apartment'     => $this->apartment,
                'postcode'      => $this->postcode
            ],
        ];
    }
}
