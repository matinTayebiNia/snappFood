<?php

namespace App\Http\Requests\Apis\ApiV1\Cart;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['food_id' => "string[]", "count" => "string[]"])]
    public function rules(): array
    {
        return [
            'food_id' => ["required", "integer", "min:0"],
            "count" => ["required", "integer", "min:0"]
        ];
    }
}
