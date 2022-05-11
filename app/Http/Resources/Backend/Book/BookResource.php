<?php

namespace App\Http\Resources\Backend\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
                'pages'         => $this->pages,
                'cover_id'      => $this->cover_id,
                'created_at'    => $this->created_at
            ],
        ];
    }
}
