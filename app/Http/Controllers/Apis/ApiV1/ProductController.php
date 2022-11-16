<?php

namespace App\Http\Controllers\Apis\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Exception;

class ProductController extends Controller
{
    /**
     * @param $place
     * @return JsonResponse
     */
    public function foods($place): JsonResponse
    {
        try {
            $foods = Category::where("type", "ForFood")
                ->with("products", function ($query) use ($place) {
                    return $query->where("place_id", $place);
                })
                ->whereHas('products', function ($query) use ($place) {
                    return $query->where("place_id", $place);
                })->get();

            return $this->successMessage(["categories" => $foods]);

        } catch (\Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        try {
            return $this->successMessage(["data" => $product->toJson()]);
        } catch (\Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

}
