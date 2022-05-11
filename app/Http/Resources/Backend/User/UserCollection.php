<?php

namespace App\Http\Resources\Backend\User;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Backend\User\UserResource;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return UserResource::collection($this->collection);
    }
}
