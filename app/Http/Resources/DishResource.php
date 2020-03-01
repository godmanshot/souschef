<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = array_merge(parent::toArray($request), [
            'hashTags' => HashTagResource::collection($this->hashTags),
        ]);

        return $data;
    }
}