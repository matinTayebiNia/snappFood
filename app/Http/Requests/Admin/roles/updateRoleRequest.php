<?php

namespace App\Http\Requests\Admin\roles;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class updateRoleRequest extends FormRequest
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
    #[ArrayShape(["name" => "string[]"])]
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:200", "unique:roles,id," . $this->route("role")->id]
        ];
    }
}
