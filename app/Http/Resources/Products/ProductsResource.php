<?php

namespace App\Http\Resources\Products;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    #[ArrayShape(["id" => "mixed", "title" => "mixed", "foods" => "mixed"])]
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            "id" => $this->id,
            "title" => $this->name,
            "foods" => $this->products
        ];
    }
}
