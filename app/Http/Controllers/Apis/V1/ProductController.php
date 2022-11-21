<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductsResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @param $place
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function foods($place): JsonResponse|AnonymousResourceCollection
    {
        try {
            $foods = Category::where("type", "ForFood")
                ->with("products", function ($query) use ($place) {
                    return $query->where("place_id", $place);
                })
                ->whereHas('products', function ($query) use ($place) {
                    return $query->where("place_id", $place);
                })->get();

            return  ProductsResource::collection($foods);

        } catch (Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

}
