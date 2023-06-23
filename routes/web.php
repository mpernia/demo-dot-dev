<?php

use App\Src\Frontend\Infrastructure\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::any('/', LandingPageController::class)->name('landing-page');


/*
Route::get('/', function () {
    return view('welcome');
});
*/