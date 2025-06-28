<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

// Landing Page
Route::get('/', [AuthenticatedSessionController::class, 'create'])
        ->name('/');

Route::group(['middleware' => ['auth', 'verified']], function () {

    // Home
    Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
        Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
    });

    Route::group(['middleware' => ['role:Administrator']], function () {
        Route::group(['prefix' => 'users',  'as' => 'users.'], function () {
            Route::resource('/', \App\Http\Controllers\UserController::class);
        });

        // Route::group(['prefix' => 'blogs',  'as' => 'blogs.'], function () {
        //     Route::resource('/', \App\Http\Controllers\BlogController::class);
        // });
        Route::resource('blogs', \App\Http\Controllers\BlogController::class);
        Route::resource('galleries',\App\Http\Controllers\GalleryController::class);
        Route::resource('services',\App\Http\Controllers\ServiceController::class);
    });
});

require __DIR__ . '/auth.php';
