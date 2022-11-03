<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\placeType\storePlaceTypeRequest;
use App\Http\Requests\Admin\placeType\updatePlaceTypeRequest;
use App\Models\PlaceType;
use App\Traits\StoreImage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Redirector;

class PlaceTypeController extends Controller
{
    use StoreImage;

    public function __construct()
    {
        $this->middleware("can:show-placetypes")->only("index");
        $this->middleware("can:show-placetype")->only("show");
        $this->middleware("can:create-placetype")->only(["create", "store"]);
        $this->middleware("can:edit-placetype")->only(["edit", "update"]);
        $this->middleware("can:destroy-placetype")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $placeTypes = PlaceType::query();
        if ($word = request("search")) {
            $placeTypes->where('name', 'LIKE', "%{$word}%");
        }
        $placeTypes = $placeTypes->latest()->paginate(10);

        return view("admin.placeTypes.all", compact("placeTypes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("admin.placeTypes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storePlaceTypeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(storePlaceTypeRequest $request)
    {
        $icon = $request->file("icon");
        if ($icon) {
            $fullPath = $this->StoreImage($icon);
            PlaceType::create([
                "name" => $request->name,
                "slug" => $request->slug,
                "icon" => $fullPath,
            ]);
        }

        return redirect(route("admin.placeTypes.index"))
            ->with("success", "place type created");
    }

    /**
     * Display the specified resource.
     *
     * @param PlaceType $placeType
     * @return Application|Factory|View
     */
    public
    function show(PlaceType $placeType): View|Factory|Application
    {
        return view("admin.placeTypes.showPlaceType", compact("placeType"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PlaceType $placeType
     * @return Application|Factory|View
     */
    public
    function edit(PlaceType $placeType): View|Factory|Application
    {
        return view("admin.placeTypes.edit", compact("placeType"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updatePlaceTypeRequest $request
     * @param PlaceType $placeType
     * @return Application|Redirector|RedirectResponse
     */
    public
    function update(updatePlaceTypeRequest $request, PlaceType $placeType): Redirector|RedirectResponse|Application
    {
        $icon = $request->file("icon");
        if ($icon) {
            unlink(base_path("public/" . $placeType->icon));
            $fullPath = $this->StoreImage($icon);
            $placeType->update([
                "name" => $request->name,
                "slug" => $request->slug,
                "icon" => $fullPath,
            ]);
        }

        $placeType->update([
            "name" => $request->name,
            "slug" => $request->slug,
        ]);

        return redirect(route("admin.placeTypes.index"))
            ->with("success", "place type updated");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PlaceType $placeType
     * @return Application|Redirector|RedirectResponse
     * @throws \Exception
     */
    public
    function destroy(PlaceType $placeType): Redirector|RedirectResponse|Application
    {
        try {
            $placeType->delete();
            return redirect(route("admin.placeTypes.index"))
                ->with("success", "place type deleted");
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
