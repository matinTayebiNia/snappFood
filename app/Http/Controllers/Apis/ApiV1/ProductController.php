<?php

namespace App\Http\Controllers\Apis\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Place $place
     * @return JsonResponse
     */
    public function index(Place $place): JsonResponse
    {
        try {

            $categories = $place->products()->with("category")->get();
            return $this->successMessage($categories);

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
