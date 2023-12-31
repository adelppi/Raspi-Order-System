<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
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

Route::get('/menus', [MenuController::class, 'index']);
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/{tableNumber}/done-serving', 'App\Http\Controllers\OrderController@doneServing');
Route::post('/update-stock', 'App\Http\Controllers\MenuController@updateStock');
Route::get('/clear-all-orders', 'App\Http\Controllers\OrderController@clearAllOrders');
Route::post('/create-order', 'App\Http\Controllers\OrderController@createOrder');
Route::get('/order-status-sorted', 'App\Http\Controllers\OrderController@orderStatusSorted');
Route::get('/order-status', 'App\Http\Controllers\OrderController@orderStatus');