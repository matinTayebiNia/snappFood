<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Exception;

class OrderController extends Controller
{
    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $orders = auth()->user()->orders()->latest()->paginate(10);
            return OrderResource::collection($orders);
        } catch (Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    /**
     * @param Order $order
     * @return JsonResponse|OrderResource
     */
    public function show(Order $order): JsonResponse|OrderResource
    {
        try {
            if (auth()->user()->id == $order->user->id)
                return new OrderResource($order);
            throw new AuthorizationException("this is action is not authorized ");
        } catch (\Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }
}
