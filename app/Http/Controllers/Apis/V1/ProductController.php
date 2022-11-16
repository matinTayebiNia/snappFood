<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductsResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param $place
     * @return ProductsResource|JsonResponse
     */
    public function foods($place): JsonResponse|ProductsResource
    {
        try {
            $foods = Category::where("type", "ForFood")
                ->with("products", function ($query) use ($place) {
                    return $query->where("place_id", $place);
                })
                ->whereHas('products', function ($query) use ($place) {
                    return $query->where("place_id", $place);
                })->get();

            return new ProductsResource($foods);

        } catch (\Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

}
