<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Api Url Controllers
use App\Http\Controllers\Api\Url\UrlController;
use App\Http\Controllers\Api\Auth\RegisterController;


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    Route::controller(UrlController::class)->group(function () {
        Route::post('url/save', 'save')->name('save');
    });
});


// Url Routes
