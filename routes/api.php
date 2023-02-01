<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('login',AuthController::class,'postLogin');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'postLogin']);
Route::prefix('product')->group(function () {
    Route::get('', [\App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('product-by-category/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByCategory']);
    Route::get('product-by-vstore/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByVstore']);
});
Route::prefix('category')->group(function () {
    Route::get('', [\App\Http\Controllers\Api\CategoryController::class, 'index']);

});
Route::prefix('vshop')->group(function () {
    Route::get('', [\App\Http\Controllers\Api\VShopController::class, 'getProductByIdPdone']);

});
Route::group(['domain' => 'nha_cung_cap.ngo', 'middleware' => 'NCC'], function () {
    Route::get('amount', [\App\Http\Controllers\Manufacture\WarehouseController::class, 'amount'])->name('amount');
});
