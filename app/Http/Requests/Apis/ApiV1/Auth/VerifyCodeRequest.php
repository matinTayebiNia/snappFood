<?php

namespace App\Http\Requests\Apis\ApiV1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class VerifyCodeRequest extends FormRequest
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
    #[ArrayShape(["token" => "string[]", "phone" => "string[]"])]
    public function rules(): array
    {
        return [
            "token" => ["required", "numeric"],
            "phone"=>["required","numeric"]
        ];
    }
}
