<?php

namespace App\Http\Requests\Admin\Places;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaceRequest extends FormRequest
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
            "name"=>["required","string","max:200"],
            "Number"=>["required","integer","max:200"],
            "account_number"=>["required","integer","max:200"],
            "owner_id"=>["required","integer","max:200"],
        ];
    }
}
