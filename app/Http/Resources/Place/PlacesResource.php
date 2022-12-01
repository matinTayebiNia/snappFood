<?php

namespace App\Http\Resources\Place;

use App\Models\Schedule;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class PlacesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */

    #[ArrayShape(["id" => "string", "isOpen" => "\App\Models\Schedule|\Illuminate\Database\Eloquent\Builder", "title" => "mixed", "score" => "mixed", "type" => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection", "address" => "mixed", "image" => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            "id" => (string)$this->id,
            "isOpen" => Schedule::CheckSchedule(),
            "title" => $this->name,
            "score" => $this->score,
            "type" => PlaceTypesResource::collection($this->placetypes),
            "address" => $this->address,
            "image" => $this->image
        ];
    }
}
