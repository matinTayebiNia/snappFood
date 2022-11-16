<?php

namespace App\Http\Resources\Address;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class AddressesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => (string)$this->id,
            "state" => $this->state,
            "city" => $this->city,
            "street" => $this->street,
            "pluck" => $this->pluck,
            "latitude" => $this->width,
            "longitude" => $this->height,
            "CurrentAddresses" => User::getCurrentAddress($this->id),
        ];
    }
}
