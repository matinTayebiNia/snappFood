<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\owner\Auth\LoginController as loginControllerOwner;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware("guest")->group(function () {
    Route::get("/login", function () {
        return "login page";
    })->name("login");
    Route::get("/admin/login", [LoginController::class, "index"]);
    Route::post("/admin/login", [LoginController::class, "store"])->name("admin.login");
    Route::post("/admin/logout", [LoginController::class, "destroy"])->name("admin.logout");
    Route::get("/owner/login",[loginControllerOwner::class, "index"]);
    Route::post("/owner/login",[loginControllerOwner::class, "store"])->name("owner.login");
    Route::post("/owner/logout",[loginControllerOwner::class, "destroy"])->name("owner.logout");
});


