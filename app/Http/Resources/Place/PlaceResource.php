<?php

namespace App\Http\Resources\Place;

use App\Models\Schedule;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(["id" => "string", "isOpen" => "\App\Models\Schedule|\Illuminate\Database\Eloquent\Builder", "title" => "mixed", "image" => "mixed", "type" => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection", "schedules" => "mixed", "address" => "mixed"])]
    public function toArray($request)
    {
        return [
            "id" => (string)$this->id,
            "isOpen" => Schedule::CheckSchedule(),
            "title" => $this->name,
            "image" => $this->image,
            "type" => PlaceTypesResource::collection($this->placetypes),
            "schedules" => $this->schedules,
            "address"=>$this->address,
        ];
    }
}
