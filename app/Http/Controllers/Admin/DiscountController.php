<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\StoreDiscountRequest;
use App\Http\Requests\Admin\Discount\UpdateDiscountRequest;
use App\Models\Discount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use PHPUnit\Exception;

class DiscountController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:show-discounts")->only("index");
        $this->middleware("can:show-discount")->only("show");
        $this->middleware("can:create-discount")->only(["create", "store"]);
        $this->middleware("can:edit-discount")->only(["edit", "update"]);
        $this->middleware("can:destroy-discount")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $discounts = Discount::query();
        if ($word = request("search")) {
            $discounts->where('code', 'LIKE', "%{$word}%")
                ->orWhere("title", "LIKE", "%{$word}%")
                ->orWhere("typeDiscount", "LIKE", "%{$word}%");
        }
        $discounts = $discounts->latest()->paginate(10);

        return view("admin.discount.all", compact("discounts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("admin.discount.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDiscountRequest $request
     * @return RedirectResponse|Redirector|Application
     */
    public function store(StoreDiscountRequest $request): Application|RedirectResponse|Redirector
    {
        Discount::create([
            "code" => $request->input("code"),
            "title" => $request->input("title"),
            "Discount_amount" => $request->input("Discount_amount"),
            "typeDiscount" => $request->input("typeDiscount"),
            "expired_at" => $request->input("expired_at")
        ]);
        return redirect(route("admin.discounts.index"))
            ->with("success", "discount created");
    }

    /**
     * Display the specified resource.
     *
     * @param Discount $discount
     * @return Application|Factory|View
     */
    public function show(Discount $discount): View|Factory|Application
    {
        return view("admin.discount.showOnlyDiscount", compact("discount"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Discount $discount
     * @return Application|Factory|View
     */
    public function edit(Discount $discount): View|Factory|Application
    {
        return view("admin.discount.edit", compact("discount"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDiscountRequest $request
     * @param Discount $discount
     * @return RedirectResponse|Redirector|Application
     */
    public function update(UpdateDiscountRequest $request, Discount $discount): Application|RedirectResponse|Redirector
    {
        $discount->update([
            "code" => $request->input("code"),
            "title" => $request->input("title"),
            "Discount_amount" => $request->input("Discount_amount"),
            "typeDiscount" => $request->input("typeDiscount"),
            "expired_at" => $request->input("expired_at")
        ]);

        return redirect(route("admin.discounts.index"))
            ->with("success", "discount updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Discount $discount
     * @return Application|Redirector|RedirectResponse
     * @throws \Exception
     */
    public function destroy(Discount $discount): Redirector|RedirectResponse|Application
    {
        try {
            $discount->delete();
            return redirect(route("admin.discounts.index"))
                ->with("success", "discount deleted");
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
