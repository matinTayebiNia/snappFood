<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class OrderController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $orders = Order::with(["products"], function ($query) {
            return $query->whereHas("place", fn($query) => $query->where("owner_id", auth("owner")->user()->id));
        })->whereHas("products", function ($query) {
            return $query->whereHas("place", fn($query) => $query->where("owner_id", auth("owner")->user()->id));
        });

        if ($word = request("search")) {
            $orders->where('price', 'LIKE', "%{$word}%")
                ->orWhereHas("user", function ($query) use ($word) {
                    $query->where("name", "Like", "%{$word}%");
                });
        }

        $orders = $orders->latest()->paginate(10);

        return view("owner.orders.all", compact("orders"));

    }

    /**
     * @param Order $order
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Order $order): View|Factory|Application
    {
        if ($this->checkIsBelongOwner($order))
            return view("owner.orders.edit", compact("order"));
        throw new AuthorizationException("this is not authorized ");

    }

    /**
     * @param Order $order
     * @return bool
     */
    private function checkIsBelongOwner(Order $order): bool
    {
        return !! $order->products()->whereHas("place", function ($query) {
            return $query->where("owner_id", auth("owner")->user()->id);
        })->first();
    }

    /**
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateOrderRequest $request, Order $order): Application|RedirectResponse|Redirector
    {
        try {
            $order->update([
                "status" => $request->input("status"),
            ]);
            return redirect(route("owner.orders.index"));
        } catch (Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }
}
