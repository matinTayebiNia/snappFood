<?php

namespace App\Http\Requests\Apis\Comment;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ShowCommentRequest extends FormRequest
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
    #[ArrayShape(["food_id" => "string[]", "restaurant_id" => "string[]"])]
    public function rules(): array
    {
        return [
            "food_id" => ["required_unless:restaurant_id,null"],
            "restaurant_id" => ["required_unless:food_id,null"],
        ];
    }
}
