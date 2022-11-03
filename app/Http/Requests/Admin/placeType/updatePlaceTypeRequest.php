<?php

namespace App\Http\Requests\Admin\placeType;

use Illuminate\Foundation\Http\FormRequest;

class updatePlaceTypeRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:200"],
            "slug" => ["required", "string", "max:200", "unique:placetypes,id," . $this->route("placeType")->id],
            "icon" => [ "image"]
        ];
    }
}
