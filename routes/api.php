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


Route::group(['domain' => config('domain.api')], function () {
    Route::prefix('product')->group(function () {
        Route::get('/',[\App\Http\Controllers\Api\ProductController::class,'index']);
        Route::get('/product-by-category/{id}',[\App\Http\Controllers\Api\ProductController::class,'productByCategory']);
        Route::get('/product-by-vstore/{id}',[\App\Http\Controllers\Api\ProductController::class,'productByVstore']);
        Route::get('/product-by-ncc/{id}',[\App\Http\Controllers\Api\ProductController::class,'productByNcc']);
        Route::post('/vshop-pickup/{id}',[\App\Http\Controllers\Api\ProductController::class,'vshopPickup']);
        Route::get('/product-by-vshop/{id}',[\App\Http\Controllers\Api\ProductController::class,'productByVshop']);
        Route::get('/{id}',[\App\Http\Controllers\Api\ProductController::class,'productById']);
    });
    Route::prefix('cart')->group(function () {
        Route::get('/{id}',[\App\Http\Controllers\Api\CartController::class,'index']);
        Route::post('/add/{id}',[\App\Http\Controllers\Api\CartController::class,'add']);
        Route::post('/remove/{id}',[\App\Http\Controllers\Api\CartController::class,'remove']);
        Route::post('/quantity/$id',[\App\Http\Controllers\Api\CartController::class,'quantity']);

    });
    Route::prefix('bill')->group(function () {
        //list danh mục
        Route::get('/{id}',[\App\Http\Controllers\Api\CartController::class,'index']);
        Route::post('/add/{id}',[\App\Http\Controllers\Api\CartController::class,'add']);
        Route::post('/remove/{id}',[\App\Http\Controllers\Api\CartController::class,'remove']);
        Route::post('/quantity/$id',[\App\Http\Controllers\Api\CartController::class,'quantity']);

    });
    Route::prefix('category')->group(function () {
        //list danh mục
        Route::get('',[\App\Http\Controllers\Api\CategoryController::class,'index']);

    });
});
//Route::prefix('manufacture')->group(function () {
//    //list nhà cung cấp
//    Route::get('',[\App\Http\Controllers\Api\ManufactureController::class,'index']);
//    Route::get('/{id}',[\App\Http\Controllers\Api\ManufactureController::class,'detail']);
//
//});
//Route::prefix('vshop')->group(function () {
//    Route::get('', [\App\Http\Controllers\Api\VShopController::class, 'getProductByIdPdone']);
//
//});
//Route::group(['domain' => 'nha_cung_cap.ngo', 'middleware' => 'NCC'], function () {
////    Route::get('amount',[\App\Http\Controllers\Manufacture\WarehouseController::class,'amount'])->name('amount');
//});
