<?php

namespace App\Http\Resources\Cart;

use App\classes\Cart\Cart;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(["id" => "mixed", "restaurant" => "array", "food" => "array", "HowManyOrdered" => "mixed", "PriceOfAll" => "float|int"])]
    public function toArray($request): array|JsonSerializable|Arrayable
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
            "PriceOfAll" => Cart::TheCostOfTheNumberOfMealsOfThisCart($this->resource["dataOfCart"]),
        ];
    }
}
