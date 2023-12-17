<?php

use Illuminate\Support\Facades\Route;

// Admin Panel Controllers
// Admin Auth
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Backend\Dashboard\HomeController;
use App\Http\Controllers\Backend\Url\UrlController;

// Frontend Controllers
//User Auth
use App\Http\Controllers\Auth\User\UserAuthController;
use App\Http\Controllers\Frontend\Home\HomeController as FrontHomeController;
use App\Http\Controllers\Frontend\Url\UrlController as FrontUrlController;


// Cache Clear
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
});

Route::get('/', function () {
    return view('welcome');
});


// Admin Routes
Route::group(['prefix' => 'admin', 'as'=>'admin.'], function () {
    //Route::get('/', [HomeController::class, 'index']);

    // Admin Authentication
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('login', 'loginForm')->name('login');
        Route::post('login', 'login')->name('login.confirm');
        //Route::post('register', 'register')->name('register');
        Route::get('password/forget', 'forgotPasswordForm')->name('password.forget.form');
        Route::post('password/forget', 'forgotPassword')->name('password.forget');
        Route::get('password/reset/{token}', 'resetPasswordForm')->name('password.reset.form');
        Route::post('password/reset', 'resetPassword')->name('password.reset');
        Route::post('logout', 'logout')->name('logout');
        Route::get('verification/notice', 'verificationNotice')->name('verification.notice');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', function(){
            return redirect(route('admin.home'));
        });
        // Admin Dashboard Routes
        Route::controller(HomeController::class)->group(function () {
            Route::get('/url-panel', 'dashboard')->name('home');
        });

        // Url Routes
        Route::controller(UrlController::class)->group(function () {
            Route::get('url-list', 'index')->name('url.index');
            Route::post('/url', 'save')->name('url.save');
            Route::get('/url/{slug}/{status}', 'statusUpdate')->name('url.status');
            Route::get('/url-edit/{slug}', 'edit')->name('url.edit');
            Route::get('/url-delete/{slug}', 'destroy')->name('url.destroy');
        });
    });

});





// Website Routes
// Home Page Routes
Route::controller(FrontHomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});


// User Authentication Routes
Route::controller(UserAuthController::class)->group(function () {
    Route::get('login', 'loginForm')->name('login');
    Route::post('login', 'login')->name('login.confirm');
    Route::get('register', 'registerForm')->name('register');
    Route::post('register', 'register')->name('register.confirm');
    Route::get('verification/notice', 'verificationNotice')->name('verification.notice');
    Route::post('verification/resend', 'verificationResend')->name('verification.resend');
    Route::get('account/verify/{token}', 'verifyAccount')->name('account.verify');

    Route::get('password/forget', 'forgotPasswordForm')->name('password.forget.form');
    Route::post('password/forget', 'forgotPassword')->name('password.forget');
    Route::get('password/reset/{token}', 'resetPasswordForm')->name('password.reset.form');
    Route::post('password/reset', 'resetPassword')->name('password.reset');
    Route::post('logout', 'logout')->name('logout');
});


// User Panel Routes
Route::group(['prefix' => 'url-panel', 'as'=>'user.'], function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::controller(FrontHomeController::class)->group(function () {
            Route::get('/', 'dashboard')->name('profile');
        });

        // Url Routes
        Route::controller(FrontUrlController::class)->group(function () {
            Route::get('url-list', 'index')->name('url.index');
            Route::post('/url', 'save')->name('url.save');
            Route::get('/url/{slug}/{status}', 'statusUpdate')->name('url.status');
            Route::get('/url-edit/{slug}', 'edit')->name('url.edit');
            Route::get('/url-delete/{slug}', 'destroy')->name('url.destroy');
        });
    });
});



Route::controller(FrontHomeController::class)->group(function () {
    Route::get('/{generated_url}', 'redirectToUrlOrigin')->name('redirectToUrlOrigin');
});