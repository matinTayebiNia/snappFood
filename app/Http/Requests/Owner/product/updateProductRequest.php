<?php

namespace App\Http\Requests\owner\product;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class updateProductRequest extends FormRequest
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
    #[ArrayShape(["name" => "string[]", "Basic_cases" => "string[]", "price" => "string[]", "image" => "string[]", "category_id" => "string[]"])]
    public function rules(): array
    {
        return [
            "name" => ["required"],
            "Basic_cases" => ["required"],
            "price" => ["required", "numeric"],
            "image" => ["image"],
            "category_id" => ["required"],
            "count" => ["required", "integer", "min:0"]
        ];
    }
}
