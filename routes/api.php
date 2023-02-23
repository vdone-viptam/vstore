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
Route::get('/', function () {
    return config('domain.api');
});
//Route::group(['domain' => config('domain.api')], function () {
Route::domain(config('domain.api'))->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\ProductController::class, 'index']);
        Route::get('/product-by-category/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByCategory']);
        Route::get('/product-by-vstore/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByVstore']);
        Route::get('/product-by-ncc/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByNcc']);
        Route::post('/vshop-pickup/{id}', [\App\Http\Controllers\Api\ProductController::class, 'vshopPickup']);
        Route::get('/ /{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByVshop']);
        Route::get('/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productById']);
    });
    Route::prefix('cart')->group(function () {
        Route::get('/{id}', [\App\Http\Controllers\Api\CartController::class, 'index']);
        Route::post('/add/{id}', [\App\Http\Controllers\Api\CartController::class, 'add']);
        Route::post('/remove/{id}', [\App\Http\Controllers\Api\CartController::class, 'remove']);
        Route::post('/quantity/$id', [\App\Http\Controllers\Api\CartController::class, 'quantity']);

    });
    Route::prefix('bill')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Api\BillController::class, 'add']);
        Route::get('/detail/{id}', [\App\Http\Controllers\Api\BillController::class, 'detail']);
        Route::get('/{id}', [\App\Http\Controllers\Api\BillController::class, 'index']);

    });
    Route::prefix('category')->group(function () {
        //list danh mục
        Route::get('', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'detail']);

    });
    Route::prefix('manufacture')->group(function () {
        //list nhà cung cấp
        Route::get('', [\App\Http\Controllers\Api\ManufactureController::class, 'index']);
        Route::get('/{id}',[\App\Http\Controllers\Api\ManufactureController::class,'detail']);

    });
    Route::prefix('vstore')->group(function () {
        //list nhà cung cấp
        Route::get('', [\App\Http\Controllers\Api\VstoreController::class, 'index']);
//    Route::get('/{id}',[\App\Http\Controllers\Api\ManufactureController::class,'detail']);
        Route::get('/category/{id}', [\App\Http\Controllers\Api\VstoreController::class, 'listByCategory']);

    });
});

Route::prefix('vshop')->group(function () {
    Route::get('', [\App\Http\Controllers\Api\VShopController::class, 'index']);
    Route::get('get-discount', [\App\Http\Controllers\Api\VShopController::class, 'getDiscountByTotalProduct']);

    Route::prefix('address')->group(function () {
        Route::post('/store', [\App\Http\Controllers\Api\VShopController::class, 'storeAddressReceive']);
        Route::get('/edit-address/{id}', [\App\Http\Controllers\Api\VShopController::class, 'editAddressReceive']);
        Route::put('/update-address/{id}', [\App\Http\Controllers\Api\VShopController::class, 'updateAddressReceive']);
    });

});
Route::prefix('discount')->group(function (){
    Route::get('get-discount',[\App\Http\Controllers\Api\DiscountController::class,'getDiscountByTotalProduct']);
    Route::get('available-discount/{id}',[\App\Http\Controllers\Api\DiscountController::class,'availableDiscount']);
});
Route::get('/test',[\App\Http\Controllers\TestController::class,'index']);
//Route::group(['domain' => 'nha_cung_cap.ngo', 'middleware' => 'NCC'], function () {
////    Route::get('amount',[\App\Http\Controllers\Manufacture\WarehouseController::class,'amount'])->name('amount');
//});
