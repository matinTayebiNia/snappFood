<?php

namespace App\Http\Controllers\Apis\V1;

use App\classes\Cart\Cart;
use App\Events\NewOrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ApiV1\Cart\AddToCartRequest;
use App\Http\Resources\Cart\CartsResource;
use App\Listeners\NewOrderListener;
use App\Models\Product;
use App\Notifications\Cart\SendOrderStatusNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{

    /**
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            return CartsResource::collection(Cart::all());
        } catch (Exception $exception) {
            return throwErrorMessageException(
                [
                    "message" => $exception->getMessage(),
                    "code" => $exception->getCode(),
                ]
            );
        }
    }

    /**
     * @param Product $product
     * @return JsonResponse|CartsResource
     */
    public function show(Product $product): JsonResponse|CartsResource
    {
        try {
            return new CartsResource(Cart::get($product));
        } catch (Exception $exception) {
            return throwErrorMessageException(
                [
                    "message" => $exception->getMessage(),
                    "code" => $exception->getCode(),
                ]
            );
        }
    }

    /**
     * @param AddToCartRequest $request
     * @return JsonResponse
     */
    public function store(AddToCartRequest $request): JsonResponse
    {
        try {

            $product = Product::find($request->input("food_id"));
            if (!Cart::has($product)) {
                Cart::put(
                    [
                        "count" => intval($request->input("count")),
                    ]
                    , $product);
            }

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

    public function update(AddToCartRequest $request)
    {
        try {
            $product = Product::find($request->input("food_id"));
            if (Cart::has($product)) {
                if ((Cart::count($product) + intval($request->input("count")))
                    <= $product->count) {
                    Cart::update($product, [
                        "count" => intval($request->input("count")),
                    ]);
                    return successMessage("your cart updated");
                } else
                    throw  ValidationException::withMessages([
                        "count" => ["The number of food entered exceeds the number of food in stock "]
                    ]);
            }
        } catch (\Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    public function destroy(Product $product): JsonResponse|Collection
    {
        try {
            if (Cart::has($product)) {
                Cart::forget($product);
                return successMessage("food removed from your cart!");
            }
            return successMessage("Food is not in your cart ");
        } catch (Exception$exception) {
            return throwErrorMessageException(
                [
                    "message" => $exception->getMessage(),
                    "code" => $exception->getLine()
                ]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function flush(): JsonResponse
    {
        try {
            Cart::flush();
            return successMessage("your cart is empty now!");
        } catch (\Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    public function pay(): JsonResponse
    {
        try {
            $cartItems = Cart::all();
            if ($cartItems->count()) {
                $price = Cart::totalPrice();

                $orderItems = $cartItems->mapWithKeys(function ($item) {
                    return [$item["dataOfCart"]->id => ['quantity' => $item["count"]]];
                });

                $order = auth()->user()->orders()->create([
                    "status" => "unpaid",
                    "price" => $price,
                ]);

                $order->products()->attach($orderItems->toArray());
                event(new NewOrderEvent($order));
                auth()->user()->notify(new SendOrderStatusNotification($order));
                Cart::flush();
                return successMessage("your order has been registered");
            }
            return successMessage("your cart is empty");
        } catch (\Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

}
