<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\NotPartner;
use App\Http\Middleware\ShouldPartner;

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
})->middleware(NotPartner::class);

Route::get("/rentals", function() {
    return view("pages.index");
})->middleware(NotPartner::class);

Route::get("/partner/register", function() {
    return view("partner.register");
});

Route::get("/test", function() {
    return view("pages.test");
});

Route::resource('/partner', App\Http\Controllers\PartnerController::class)->middleware(ShouldPartner::class);
Route::resource('/property', App\Http\Controllers\PropertiesController::class)->middleware(ShouldPartner::class);
Route::resource('/photos', App\Http\Controllers\PropertyPhotosController::class);

Auth::routes(["verify" => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
