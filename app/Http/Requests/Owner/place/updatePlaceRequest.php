<?php

namespace App\Http\Requests\Owner\place;

use Illuminate\Foundation\Http\FormRequest;

class updatePlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            "Number" => ["required", "numeric", ],
            "account_number" => ["required", "numeric",],
            "types" => ["required", "array"],
            "categories" => ["required", "array"],
            "city" => ["required", "string"],
            "state" => ["required", "string"],
            "street" => ["required", "string"],
            "pluck" => ["required", "string"],
        ];
    }
}
