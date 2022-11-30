<?php

namespace App\Http\Requests\Apis\Comment;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreCommentRequest extends FormRequest
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

    #[ArrayShape(["message" => "string[]", "score" => "string[]", "order_id" => "string[]", "parent_id" => "string[]", "forFood" => "string[]"])]
    public function rules(): array
    {
        return [
            "message" => ["required"],
            "score" => ["required", "numeric",'min:1','max:5'],
            "order_id" => ["required", "numeric", "min:0"],
            "parent_id" => ["nullable", "numeric", "min:0"],
            "forFood" => ["nullable", "boolean"]
        ];
    }
}
