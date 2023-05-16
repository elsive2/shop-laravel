<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    // Auth
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');

        Route::middleware('auth:api')->group(function () {
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
        });
    });

    // Product
    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('/', 'index');
        Route::get('/{product}', 'view');

        Route::middleware('auth:api')->group(function () {
            Route::post('/', 'create');
            Route::delete('/{product}', 'delete');
        });
    });

    // Category
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'index');
        Route::get('/{category}', 'view');

        Route::middleware('auth:api')->group(function () {
            Route::post('/', 'create');
            Route::delete('/{category}', 'delete');
            Route::get('/{category}/products', 'getByCategory');
        });
    });

    // Cart
    Route::controller(CartController::class)
        ->middleware('auth:api')
        ->prefix('cart')
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/{product}', 'create');
            Route::delete('/{product}', 'delete');
        });
});

