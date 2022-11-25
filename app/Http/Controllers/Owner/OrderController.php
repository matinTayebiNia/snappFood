<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

    public function edit()
    {

    }

    public function update()
    {

    }
}
