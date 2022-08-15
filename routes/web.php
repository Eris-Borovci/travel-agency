<?php

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
    return view('pages.index');
});

Route::get("/rentals", function() {
    return view("pages.index");
});

Route::get("/partner", [App\Http\Controllers\PartnerController::class, "index"]);
Route::get("/partner/register", [App\Http\Controllers\PartnerController::class, "register"]);
Route::get("/partner/login", [App\Http\Controllers\PartnerController::class, "login"]);

Auth::routes(["verify" => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
