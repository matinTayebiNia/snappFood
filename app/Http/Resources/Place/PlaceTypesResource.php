<?php

namespace App\Http\Resources\Place;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceTypesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name
        ];
    }
}
