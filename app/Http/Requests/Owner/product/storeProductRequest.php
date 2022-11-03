<?php

namespace App\Http\Requests\owner\product;

use Illuminate\Foundation\Http\FormRequest;

class storeProductRequest extends FormRequest
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
            "name"=>["required"],
            "Basic_cases"=>["required"],
            "price"=>["required","numeric"],
            "image"=>["required","image"],
            "category_id"=>["required"],

        ];
    }
}
