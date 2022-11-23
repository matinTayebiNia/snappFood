<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartsResource extends JsonResource
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
            "id" => $this->resource["id"],
            "restaurant" => [
                "title" => $this->resource["dataOfCart"]->place->name,
                "image" => $this->resource["dataOfCart"]->place->image,
            ],
            "food" => [
                "id" => $this->resource["dataOfCart"]->id,
                "title" => $this->resource["dataOfCart"]->name,
                "count" => $this->resource["dataOfCart"]->count,
                "price" => $this->resource["dataOfCart"]->price,
            ],
            "HowManyOrdered" => $this->resource["count"],
            "PriceOfAll" => $this->resource["price"],
        ];
    }
}
