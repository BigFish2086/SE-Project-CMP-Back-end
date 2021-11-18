<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON
     */
    public function toArray($request)
    {
        return [
            "tags" => TagResource::collection($this->collection)
        ];
    }
}