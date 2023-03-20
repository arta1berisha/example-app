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

// Route::group(['middleware' => IfAuthenticated::class], function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{id}', 'show');
        Route::put('/users/{id}', 'update');
        Route::delete('/users/{id}', 'destroy');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::post('/products', 'create');
        Route::get('/products', 'index');
        Route::get('/products/{id}', 'show');
        Route::put('/products/{id}', 'update');
        Route::delete('/products/{id}', 'destroy');
    });


    Route::controller(CategoryController::class)->group(function () {
        Route::post('/category', 'create')->middleware(IfAuthenticated::class);;
        Route::get('/category', 'index')->middleware(IfAuthenticated::class);;
        Route::get('/category/{id}', 'show')->middleware(IfAuthenticated::class);;
        Route::put('/category/{id}', 'update')->middleware(IfAuthenticated::class);;
        Route::delete('/category/{id}', 'destroy')->middleware(IfAuthenticated::class);;
        Route::get('.category/{id}/products', 'products')->middleware(IfAuthenticated::class);;
    });
