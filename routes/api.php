<?php

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

Route::namespace('App\Core\Http\Controllers')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::get('/{id}', 'CustomerController@Get');
        Route::post('/', 'CustomerController@Create');
    });
});

Route::namespace('App\Core\Http\Controllers')->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@GetAll');
        Route::get('/{external_id}/supplier/{supplier_id}', 'ProductController@Get');
    });
});

Route::namespace('App\Core\Http\Controllers')->group(function () {
    Route::prefix('order')->group(function () {
        Route::post('/', 'OrderController@Create');
    });
});

