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
// Route::apiResource('category', CategoryController::class);


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware(IfAuthenticated::class);
    Route::post('/refresh', 'refresh')->middleware(IfAuthenticated::class);
});






Route::group(['middleware' => IfAuthenticated::class], function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{id}', 'show');
        Route::put('/users/{id}', 'update');
        Route::delete('/users/{id}', 'destroy');
    });

    Route::resource('category', CategoryController::class);

    // Route::controller(CategoryController::class)->group(function () {
    //     Route::post('/category', 'create');
    //     Route::get('/category', 'index');
    //     Route::get('/category/{id}', 'show');
    //     Route::put('/category/{id}', 'update');
    //     Route::delete('/category/{id}', 'destroy');
    //     Route::get('/category/{category}/products', 'products');
    // });

    Route::controller(ProductController::class)->group(function () {
        Route::post('/products', 'create');
        Route::get('/products', 'index');
        Route::get('/products/{id}', 'show');
        Route::put('/products/{id}', 'update');
        Route::delete('/products/{id}', 'destroy');
    });
});

// Route::get('/category   ', [CategoryController::class, 'index'])->middleware(IfAuthenticated::class);


// Route::post('/register', [RegisterController::class, 'create']);
// Route::post('/login', [LoginController::class, 'create']);

// Route::get('users', [LoginController::class, 'index']);
// Route::get('users/{id}', [LoginController::class, 'show']);
// Route::put('users/{id}', [LoginController::class, 'update']);
// Route::delete('users/{id}', [LoginController::class, 'delete']);

// Route::post('products', [ProductController::class, 'create']);
// Route::get('products', [ProductController::class, 'index']);
// Route::get('products/{id}', [ProductController::class, 'show']);
// Route::put('products/{id}', [ProductController::class, 'update']);
// Route::delete('products/{id}', [ProductController::class, 'delete']);

// Route::post('categories', [CategoryController::class, 'create']);
// Route::get('categories',)
