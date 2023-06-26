<?php

use App\Src\Frontend\Infrastructure\Controllers\AuthController;
use App\Src\Frontend\Infrastructure\Controllers\ChangePasswordController;
use App\Src\Frontend\Infrastructure\Controllers\LandingPageController;
use App\Src\Frontend\Infrastructure\Controllers\StudentController;
use App\Src\Frontend\Infrastructure\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::any('/', LandingPageController::class)->name('landing-page');

Route::group(['as' => 'auth.'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('signin', [AuthController::class, 'signin'])->name('signin');
});

Route::group(['as' => 'frontend.', 'middleware' => ['dotdev']], function () {
    Route::group(['prefix' => 'teachers', 'as' => 'teacher'/*, 'middleware' => ['dotdev:teacher']*/], function () {
        Route::get('/{id}', [TeacherController::class, 'show'])->name('.show');
        Route::get('/{id}/edit', [TeacherController::class, 'show'])->name('.edit');
        Route::put('/{id}', [TeacherController::class, 'update'])->name('.update');
        Route::post('/{id}', [TeacherController::class, 'store'])->name('.store');
        Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('.destroy');
    })->name('teachers');

    Route::group(['prefix' => 'students', 'as' => 'student'/*, 'middleware' => ['dotdev:student']*/], function () {
        Route::get('/{id}', [StudentController::class, 'show'])->name('.show');
        Route::get('/{id}/edit', [StudentController::class, 'show'])->name('.edit');
        Route::put('/{id}', [StudentController::class, 'update'])->name('.update');
        Route::post('/{id}', [StudentController::class, 'store'])->name('.store');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('.destroy');
    })->name('students');

    Route::put('/{type}/{id}/change-password', ChangePasswordController::class)
        //->middleware('dotdev')
        ->where('type', 'teachers|students')
        ->name('change-password');

    /*Route::any('{type}', function () {
        return redirect()->route('landing-page');
    })->where('type', 'teachers|students');*/

});

Route::group(['as' => 'backoffice.'], function() {
    //
});