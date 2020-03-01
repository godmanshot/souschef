<?php

namespace App\Http\Resources;

use App\Http\Resources\DishResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'dishes' => $this->whenPivotLoaded('week_categories', function () {
                return DishResource::collection($this->dishes()->where('week_id', $this->pivot->week_id)->get());
            }),
        ]);

        return $data;
    }
}
