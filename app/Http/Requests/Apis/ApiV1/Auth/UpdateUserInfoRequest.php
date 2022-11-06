<?php

namespace App\Http\Requests\Apis\ApiV1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
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
            "name" => ["required"],
            "email" => ["required", "unique:users,id," . auth()->user()->id,"email"]
        ];
    }
}
