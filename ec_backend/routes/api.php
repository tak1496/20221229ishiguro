<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::group(
    [
        'middleware' => ['auth:api'],
        'prefix' => 'auth',
    ],
    function ($router) {
        Route::post('register', [
            AuthController::class,
            'register',
        ])->withoutMiddleware(['auth:api']);
        Route::post('login', [
            AuthController::class,
            'login',
        ])->withoutMiddleware(['auth:api']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('user', [AuthController::class, 'me']);
        Route::post('search', [AuthController::class, 'search']);
    }
);

Route::get('/product/product_count', [
    ProductController::class,
    'product_count',
]);

Route::post('/order/list', [OrderController::class, 'list']);

Route::apiResource('/product', ProductController::class);
Route::apiResource('/order', OrderController::class);
