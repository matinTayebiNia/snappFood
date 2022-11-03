<?php

use App\Models\Admin;
use App\Models\Owner;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('admin', function () {
    Admin::create([
        "name" => "matinTayebi",
        "adminType" => "superuser",
        "email" => "matintayebinia@gmail.com",
        "phone" => "09024466648",
        "address" => "this is test",
        "password" => Hash::make("123456789")
    ]);
})->purpose('Display an inspiring quote');


Artisan::command('owner', function () {
    Owner::create([
        "name" => "matinTayebi",
        "email" => "matin@gmail.com",
        "phone" => "09024466647",
        "password" => Hash::make("123456789")
    ]);
})->purpose('Display an inspiring quote');
