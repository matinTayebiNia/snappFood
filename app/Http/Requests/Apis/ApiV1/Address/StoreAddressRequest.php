<?php

namespace App\Http\Requests\Apis\ApiV1\Address;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreAddressRequest extends FormRequest
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
    #[ArrayShape(["width" => "string[]", "height" => "string[]", "state" => "string[]", "city" => "string[]", "street" => "string[]", "pluck" => "string[]"])]
    public function rules(): array
    {
        return [
            "width" => ["required"],
            "height" => ["required"],
            "state" => ["required", "string"],
            "city" => ["required"],
            "street" => ["required"],
            "pluck" => ["required"],
        ];
    }
}
