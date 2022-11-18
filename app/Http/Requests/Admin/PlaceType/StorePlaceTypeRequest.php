<?php

namespace App\Http\Requests\Admin\PlaceType;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StorePlaceTypeRequest extends FormRequest
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
    #[ArrayShape(["name" => "string[]", "slug" => "string[]", "icon" => "string[]"])]
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:200"],
            "slug" => ["required", "string", "max:200", "unique:placetypes,slug"],
            "icon" => ["required", "image"]
        ];
    }
}
