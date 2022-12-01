<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(["id" => "mixed", "food" => "mixed", "price" => "mixed", "quantity" => "mixed", "Restaurant" => "mixed"])]
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "food" => $this->name,
            "price" => $this->price,
            "quantity" => $this->pivot->quantity,
            "Restaurant" => $this->place->name,
        ];
    }
}
