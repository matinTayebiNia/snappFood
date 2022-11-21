<?php

namespace App\Http\Resources\Place;

use App\Models\Place;
use App\Models\Schedule;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
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
            "id" => (string)$this->id,
            "isOpen" => Place::PlaceIsOpen(),
            "title" => $this->name,
            "image" => $this->image,
            "type" => PlaceTypesResource::collection($this->placetypes),
            "schedules" => $this->schedules,
            "address"=>$this->address,


        ];
    }
}
