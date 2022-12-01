<?php

use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\Permissions\RoleController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\PlaceTypeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [adminController::class, "index"])->name("home");
Route::post("/logout", [LoginController::class, "destroy"])->name("logout");

Route::resource("categories", CategoryController::class);
Route::resource("placeTypes", PlaceTypeController::class);
Route::resource("discounts", DiscountController::class);
Route::resource("places", PlaceController::class)->except(["create", "store"]);
Route::resource("roles", RoleController::class);
Route::resource("users", UserController::class);
Route::get("comments/unapproved", [CommentController::class, "unapproved"])->name("comments.unapproved");
Route::resource("comments", CommentController::class)
    ->only(["index", "update", "destroy"]);
