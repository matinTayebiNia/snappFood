<?php

namespace App\Http\Requests\Owner\auth;

use Illuminate\Foundation\Http\FormRequest;

class updateOwnerRequest extends FormRequest
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
            "name" => ["required"],
            "email" => ["required", "email",
                "unique:owners,email," . auth("owner")->user()->id],
            "phone" => ["required",
                "unique:owners,phone," . auth("owner")->user()->id],
            "password" => ["required"]
        ];
    }
}
