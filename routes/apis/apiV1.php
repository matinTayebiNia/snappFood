<?php

use App\Http\Controllers\Apis\ApiV1\AddressController;
use App\Http\Controllers\Apis\ApiV1\Auth\AuthController;
use App\Http\Controllers\Apis\ApiV1\PlaceController;
use App\Http\Controllers\Apis\ApiV1\ProductController;
use App\Http\Controllers\Apis\ApiV1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("/v1/")->group(function () {
    //login
    Route::post("login", [AuthController::class, "login"]);
    Route::post("login/verifyCode", [AuthController::class, "verifyCode"]);
    Route::post("login/resendCode", [AuthController::class, "resendCode"]);

    //carts
    Route::prefix("carts")->group(function () {
        Route::get("/", []);
        Route::get("/{cart}", []);
        Route::post("/add", []);
        Route::patch("/add", []);
    });

    Route::middleware("auth:sanctum")->group(function () {
        //
        Route::patch("user/update", [UserController::class, "update"]);

        Route::prefix("addresses")->group(function () {
            Route::get("/", [AddressController::class, "index"]);
            Route::post("/", [AddressController::class, "store"]);
            Route::put("/{address}", [AddressController::class, "setCurrentAddress"]);
            Route::patch("/{address}/update", [AddressController::class, "update"]);
        });

        Route::post("carts/{cart}/pay", []);

        Route::prefix("comments")->group(function () {
            Route::get("/", []);
            Route::post("/", []);
        });

    });

    //Restaurants
    Route::prefix("Restaurants")->group(function () {
        Route::get("/{place}", [PlaceController::class, "show"]);
        Route::get("/", [PlaceController::class, "index"]);
    });

    //foods
    Route::get("/{place}/foods", [ProductController::class, "foods"]);

});
