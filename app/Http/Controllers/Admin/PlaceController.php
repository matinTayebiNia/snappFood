<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\places\updatePlaceRequest;
use App\Models\Place;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:show-places")->only("index");
        $this->middleware("can:show-place")->only("show");
        $this->middleware("can:edit-place")->only(["edit", "update"]);
        $this->middleware("can:destroy-place")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $places = Place::query();
        if ($word = request("search")) {
            $places->where('name', 'LIKE', "%{$word}%")
                ->orWhere("Number", "LIKE", "%{$word}%")
                ->orWhere("account_number", "LIKE", "%{$word}%")
                ->orWhereHas("owner", function ($query) use ($word) {
                    return $query->where("name", "LIKE", "%{$word}%");
                });
        }
        $places = $places->latest()->paginate(10);

        return view("admin.places.all", compact("places"));
    }

    /**
     * Display the specified resource.
     *
     * @param Place $place
     * @return Application|Factory|View
     */
    public function show(Place $place): View|Factory|Application
    {
        return view("admin.places.showPlace", compact("place"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place $place
     * @return Application|Factory|View
     */
    public function edit(Place $place): View|Factory|Application
    {
        return view("admin.places.edit", compact("place"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updatePlaceRequest $request
     * @param Place $place
     * @return Application|RedirectResponse|Redirector
     */
    public function update(updatePlaceRequest $request, Place $place): Redirector|RedirectResponse|Application
    {
        $place->update([
            "name" => $request->input("name"),
            "Number" => $request->input("Number"),
            "account_number" => $request->input("account_number"),
            "owner_id" => $request->input("owner_id")
        ]);

        //todo implement: set address for place


        return redirect(route("admin.places.index"))
            ->with("success", "place updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Place $place
     * @return Application|Redirector|RedirectResponse
     * @throws \Exception
     */
    public function destroy(Place $place): Redirector|RedirectResponse|Application
    {
        try {
            $place->delete();
            return redirect(route("admin.places.index"))
                ->with("success", "place updated");
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
