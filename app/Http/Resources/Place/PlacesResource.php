<?php

namespace App\Http\Resources\Place;

use App\Models\Schedule;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PlacesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {


        return [
            "id" => (string) $this->id,
            "isOpen" => Schedule::CheckSchedule($this->schedules),
            "title" => $this->name,
            "type" => PlaceTypesResource::collection($this->placetypes),
            "address" => $this->address,
            "image" => $this->image
        ];
    }
}
