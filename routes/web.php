<?php

use App\Http\Controllers\MonotownController;
use App\Http\Controllers\ContactController;
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

Route::get("/", [MonotownController::class, "monotown"])->name("monotown");

Route::controller(ContactController::class)->prefix("contact")->group(function () {
    Route::get("/", "contact")->name("contact");
    Route::post("/send", "send")->name("contact.send");
});