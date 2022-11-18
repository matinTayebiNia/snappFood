<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
    public function rules()
    {
        return [
            "name" => ["required", "string", "max:200"],
            "slug" => ["required", "unique:categories,slug", "max:200"],
            "icon" => ["required", "image"],
            "parent_id" => ["integer", "required"],
            "type" => ["required", Rule::in(["ForRestaurant", "ForFood"])],
            "placetype_id" => ["required"]
        ];
    }
}
