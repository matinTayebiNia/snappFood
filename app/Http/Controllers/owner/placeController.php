<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\place\storePlaceRequest;
use App\Http\Requests\Owner\place\updatePlaceRequest;
use App\Models\Place;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class placeController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("owner.place.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storePlaceRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(storePlaceRequest $request): Redirector|RedirectResponse|Application
    {
        $place = $request->user("owner")->place()->create([
            "name" => $request->input("name"),
            "Number" => $request->input("Number"),
            "account_number" => $request->input("account_number"),
        ]);
        $place->categories()->attach($request->input("categories"));
        $place->placeTypes()->attach($request->input("types"));
        $place->address()->create([
            "city" => $request->input("city"),
            "state" => $request->input("state"),
            "street" => $request->input("street"),
            "pluck" => $request->input("pluck"),
            "height"=>Str::random(6),
            "width"=>Str::random(6),
        ]);
        return redirect(route("owner.home"));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        return view("owner.place.showPlace");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View
     */
    public function edit(): View|Factory|Application
    {
        return view("owner.place.edit");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param updatePlaceRequest $request
     * @param Place $place
     * @return Application|RedirectResponse|Redirector
     */
    public function update(updatePlaceRequest $request, Place $placesOwner): Redirector|RedirectResponse|Application
    {
        $placesOwner->update([
            "name" => $request->input("name"),
            "Number" => $request->input("Number"),
            "account_number" => $request->input("account_number"),
        ]);

        $placesOwner->categories()->sync($request->input("categories"));
        $placesOwner->placeTypes()->sync($request->input("types"));

        $placesOwner->address()->update([
            "city" => $request->input("city"),
            "state" => $request->input("state"),
            "street" => $request->input("street"),
            "pluck" => $request->input("pluck"),
            "height"=>Str::random(6),
            "width"=>Str::random(6),
        ]);



        return redirect(route("owner.home"));
    }

}
