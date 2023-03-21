<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IfAuthenticated;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware(IfAuthenticated::class);
    Route::post('/refresh', 'refresh')->middleware(IfAuthenticated::class);
});

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{user}', 'show');
        Route::put('/users/{user}', 'update');
        Route::delete('/users/{user}', 'destroy');
    });

    Route::prefix('admin')->middleware('auth.jwt')->group(function () {

        Route::controller(ProductController::class)->group(function () {
            Route::post('/products', 'store');
            Route::get('/products', 'index');
            Route::get('/products/{product}', 'show');
            Route::put('/products/{product}', 'update');
            Route::delete('/products/{product}', 'destroy');
        });
    
        Route::controller(CategoryController::class)->group(function () {
            Route::post('/categories', 'store');
            Route::get('/categories', 'index');
            Route::get('/categories/{category}', 'show');
            Route::put('/categories/{category}', 'update');
            Route::delete('/categories/{category}', 'destroy');
            Route::get('/categories/{category}/products', 'products');
        });
    });
});
