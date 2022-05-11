<?php

namespace App\Http\Resources\Mobile\Cover;

use Illuminate\Http\Resources\Json\JsonResource;

class CoverResource extends JsonResource
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
                'title'         => $this->title,
                'path'          => $this->path,
                'created_at'    => $this->created_at
            ],
        ];
    }
}
