<?php

namespace App\Http\Controllers\Apis\V1;

use App\classes\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ApiV1\Cart\AddToCartRequest;
use App\Http\Resources\Cart\CartsResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartController extends Controller
{

    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            $carts = Cart::getAllCartsWithRelationsSubject(["place"]);

            return CartsResource::collection($carts);
        } catch (Exception $exception) {
            return throwErrorMessageException(
                [
                    "message" => $exception->getMessage(),
                    "code" => $exception->getCode(),
                ]
            );
        }
    }

    public function show($cart): JsonResponse
    {
        try {
            return successMessage(Cart::get($cart));
        } catch (Exception $exception) {
            return throwErrorMessageException(
                [
                    "message" => $exception->getMessage(),
                    "code" => $exception->getCode(),
                ]
            );
        }
    }

    public function store(AddToCartRequest $request): JsonResponse
    {
        try {

            $product = Product::find($request->input("food_id"));

            if (!Cart::has($product))
                Cart::put(
                    [
                        "count" => $request->input("count"),
                        "price" => $product->price,
                    ]
                    , $product);

            return successMessage("food added to cart successfully", 201);

        } catch (Exception $exception) {

            return throwErrorMessageException(
                [
                    "message" => $exception->getMessage(),
                    "code" => $exception->getCode(),
                ]
            );

        }
    }

    public function update(AddToCartRequest $request, $cart)
    {

    }

    public function destroy(Product $product)
    {

    }

    public function pay($cart)
    {

    }

}
