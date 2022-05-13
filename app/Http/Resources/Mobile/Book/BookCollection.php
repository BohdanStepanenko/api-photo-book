<?php

namespace App\Http\Resources\Mobile\Book;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Mobile\Book\BookResource;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return BookResource::collection($this->collection);
    }
}
