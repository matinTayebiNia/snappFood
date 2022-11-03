<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\storeCategoryRequest;
use App\Http\Requests\Admin\updateCategoryRequest;
use App\Models\Category;
use App\Traits\StoreImage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class CategoryController extends Controller
{

    use StoreImage;

    public function __construct()
    {
        $this->middleware("can:show-categories")->only("index");
        $this->middleware("can:show-category")->only("show");
        $this->middleware("can:create-category")->only(["create", "store"]);
        $this->middleware("can:edit-category")->only(["edit", "update"]);
        $this->middleware("can:destroy-category")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = Category::query();
        if ($word = request("search")) {
            $categories->where('name', 'LIKE', "%{$word}%")
                ->orWhere("slug", "LIKE", "%{$word}%");
        }
        $categories = $categories->latest()->paginate(10);

        return view("admin.categories.all", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storeCategoryRequest $request
     * @return RedirectResponse|Redirector|Application
     */
    public function store(storeCategoryRequest $request): Application|RedirectResponse|Redirector
    {

        $icon = $request->file("icon");
        if ($icon) {
            $fullPath = $this->StoreImage($icon);
            $category = Category::create([
                "name" => $request->name,
                "slug" => $request->slug,
                "icon" => $fullPath,
                "parent_id" => $request->parent_id == "0" ? 0 : $request->parent_id,
                "type" => $request->type,
            ]);

            $category->placeTypes()->sync($request->placetype_id);

        }

        return redirect(route("admin.categories.index"))
            ->with("success", "category created");

    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(Category $category): View|Factory|Application
    {
        return view("admin.categories.category", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updateCategoryRequest $request
     * @param Category $category
     * @return Application|Redirector|RedirectResponse
     */
    public function update(updateCategoryRequest $request, Category $category): Application|RedirectResponse|Redirector
    {

        $icon = $request->file("icon");
        $fullPath = $category->icon;
        if ($icon) {
            unlink(base_path("public/" . $category->icon));
            $fullPath = $this->StoreImage($icon);
        }

        $category->update([
            "name" => $request->name,
            "slug" => $request->slug,
            "icon" => $fullPath,
            "parent_id" => $request->parent_id == "none" ? 0 : $request->parent_id,
            "type" => $request->type,
        ]);

        $category->placeTypes()->sync($request->placetype_id);

        return redirect(route("admin.categories.index"))
            ->with("success", "category updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Application|Redirector|RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category): Redirector|RedirectResponse|Application
    {
        try {
            $category->delete();
            return redirect(route("admin.categories.index"))->with("success", "category deleted");
        } catch (Exception $exception) {
            throw new $exception;
        }
    }


}
