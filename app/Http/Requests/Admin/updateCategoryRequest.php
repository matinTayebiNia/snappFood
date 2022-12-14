<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class updateCategoryRequest extends FormRequest
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
    #[ArrayShape(
        ["name" => "string[]",
        "slug" => "string[]",
        "icon" => "string[]",
        "parent_id" => "string[]",
        "type" => "array",
        "placetype_id" => "string[]"]
    )]
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:200"],
            "slug" => ["required", "unique:categories,id," . $this->route('category')->id, "max:200"],
            "icon" => ["image"],
            "parent_id" => ["integer", "required"],
            "type" => ["required", Rule::in(["ForRestaurant", "ForFood"])],
            "placetype_id" => ["required","array"]
        ];
    }
}
