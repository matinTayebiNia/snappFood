<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\owner\product\storeProductRequest;
use App\Http\Requests\owner\product\updateProductRequest;
use App\Models\Product;
use App\Traits\StoreImage;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ProductController extends Controller
{
    use StoreImage;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $products = Product::query();
        if ($word = request("search")) {
            $products->where('name', 'LIKE', "%{$word}%");
        }
        $products = $products->latest()->paginate(10);

        return view("owner.products.all", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("owner.products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storeProductRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(storeProductRequest $request): Redirector|RedirectResponse|Application
    {

        $image = $request->file("image");
        if ($image) {
            $fullPath = $this->StoreImage($image);
            $request->user("owner")->place->products()->create([
                "name" => $request->input("name"),
                "Basic_cases" => $request->input("Basic_cases"),
                "price" => $request->input("price"),
                "image" => $fullPath,
                "count" => $request->input("count"),
                "category_id" => $request->input("category_id"),
            ]);
        }

        return redirect(route("owner.products.index"))
            ->with("success", "product created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product): View|Factory|Application
    {
        return view("owner.products.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updateProductRequest $request
     * @param Product $product
     * @return Application|Redirector|RedirectResponse
     */
    public function update(updateProductRequest $request, Product $product): Redirector|RedirectResponse|Application
    {
        $image = $request->file("image");
        $fullPath = $product->image;
        if ($image) {
            unlink(base_path("public/" . $product->image));
            $fullPath = $this->StoreImage($image);
        }

        $request->user("owner")->place->products()->update([
            "name" => $request->input("name"),
            "Basic_cases" => $request->input("Basic_cases"),
            "price" => $request->input("price"),
            "image" => $fullPath,
            "count" => $request->input("count"),
            "category_id" => $request->input("category_id"),
        ]);

        return redirect(route("owner.products.index"))
            ->with("success", "product updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Application|Redirector|RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product): Redirector|RedirectResponse|Application
    {
        try {
            $product->delete();
            return redirect(route("owner.products.index"))
                ->with("success", "product deleted");

        } catch (Exception $exception) {
            throw new $exception;
        }
    }
}
