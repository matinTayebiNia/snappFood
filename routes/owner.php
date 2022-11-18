<?php

use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\placeController;
use App\Http\Controllers\Owner\ProductController;
use Illuminate\Support\Facades\Route;


Route::get("/index", [OwnerController::class, "index"])
    ->name("home");
Route::get("/profile/edit", [OwnerController::class, "edit"])
    ->name("profile.edit");
Route::patch("/profile/update", [OwnerController::class, "update"])
    ->name("profile.update");

Route::resource("placesOwner", placeController::class)
    ->except(["index", "destroy"]);

Route::resource("products", ProductController::class)->except(["show"]);
