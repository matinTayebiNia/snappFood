<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class StoreDiscountRequest extends FormRequest
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
    #[ArrayShape(["code" => "string[]", "title" => "string[]", "Discount_amount" => "string[]", "typeDiscount" => "array", "expired_at" => "string[]"])]
    public function rules(): array
    {
        return [
            "code" => ["required", "string","unique:discounts,code", "max:200"],
            "title" => ["required", "string", "max:200"],
            "Discount_amount" => ["required", "numeric"],
            "typeDiscount" => ["required", Rule::in(["money", "Percentage"])],
            "expired_at" => ["required", "string", "max:200"]
        ];
    }
}
