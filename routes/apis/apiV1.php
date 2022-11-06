<?php

use Illuminate\Support\Facades\Route;

Route::prefix("/v.1/")->group(function () {
    Route::middleware("auth:sanctum")
        ->get("/addresses", [])->name("user.addresses");
});
