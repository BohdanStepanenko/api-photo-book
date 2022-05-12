<?php

namespace App\Http\Resources\Mobile\Cover;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CoverCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return CoverResource::collection($this->collection);
    }
}
