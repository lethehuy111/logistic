<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Profile\UserController;
use App\Http\Controllers\ProvinceStock\ProvinceStockController;
use App\Http\Controllers\Rate\RateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
//        Route::post('register', 'register');
        Route::post('logout', 'logout')->middleware('auth:api');
        Route::post('refresh', 'refresh');
    });
    Route::middleware('auth:api')->group(function () {

        Route::controller(UserController::class)->group(function () {
            Route::get('user', 'index')->middleware('auth:api');
        });

        Route::prefix('order')->group(function () {
            Route::controller(OrderController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('store', 'store');
                Route::get('get-price-weight', 'getPriceWeight');
                Route::post('confirm', 'confirm');
                Route::post('/process/update', 'update');
            });
        });

        Route::prefix('province-stock')->group(function () {
            Route::controller(ProvinceStockController::class)->group(function () {
                Route::get('/', 'index');
            });
        });

        Route::prefix('rate')->group(function () {
            Route::controller(RateController::class)->group(function () {
                Route::post('store', 'store');
            });
        });
    });
});
