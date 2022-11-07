<?php

use App\Http\Controllers\Apis\ApiV1\AddressController;
use App\Http\Controllers\Apis\ApiV1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("/v.1/")->group(function () {
    Route::middleware("auth:sanctum")->group(function () {
            //
        Route::patch("/user/update",[UserController::class,"update"]);

        Route::prefix("/addresses")->group(function () {
            Route::get("/", [AddressController::class, "index"]);
            Route::post("/", [AddressController::class, "store"]);
            Route::put("/{address}", [AddressController::class, "setCurrentAddress"]);
            Route::patch("/{address}/update", [AddressController::class, "update"]);
        });

    });
});
