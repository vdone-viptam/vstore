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
        Route::post('/vshop-ready-stock/{id}', [\App\Http\Controllers\Api\ProductController::class, 'vshopReadyStock']);
        Route::get('/vshop/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByVshop']);
        Route::get('/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productById']);
    });
    Route::prefix('cart')->group(function () {
        Route::get('/{pdone_id}', [\App\Http\Controllers\Api\CartController::class, 'index']);
        Route::post('/add/{id}', [\App\Http\Controllers\Api\CartController::class, 'add']);
        Route::delete('/remove/{cart_id}', [\App\Http\Controllers\Api\CartController::class, 'remove']);
        Route::post('/add-quantity/{cart_id}/{type}', [\App\Http\Controllers\Api\CartController::class, 'quantity']);

    });
    Route::prefix('banners')->group(function () {
        Route::get('/get-banner', [\App\Http\Controllers\Api\BannerController::class, 'getBannerHomePage']);
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
        Route::get('/{id}', [\App\Http\Controllers\Api\ManufactureController::class, 'detail']);

    });
    Route::prefix('vstore')->group(function () {
        //list nhà cung cấp
        Route::get('', [\App\Http\Controllers\Api\VstoreController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\Api\ManufactureController::class, 'detail']);
        Route::get('/category/{id}', [\App\Http\Controllers\Api\VstoreController::class, 'listByCategory']);

    });
    Route::prefix('vshop')->group(function () {
        Route::get('', [\App\Http\Controllers\Api\VShopController::class, 'index']);
        Route::get('get-discount', [\App\Http\Controllers\Api\VShopController::class, 'getDiscountByTotalProduct']);
        Route::post('/create-discount', [\App\Http\Controllers\Api\VShopController::class, 'createDiscount']);
        Route::prefix('address')->group(function () {
            Route::post('/store', [\App\Http\Controllers\Api\VShopController::class, 'storeAddressReceive']);
            Route::get('/edit-address/{id}', [\App\Http\Controllers\Api\VShopController::class, 'editAddressReceive']);
            Route::put('/update-address/{id}', [\App\Http\Controllers\Api\VShopController::class, 'updateAddressReceive']);
        });

    });
    Route::prefix('discount')->group(function () {
        Route::get('get-discount', [\App\Http\Controllers\Api\DiscountController::class, 'getDiscountByTotalProduct']);
        Route::get('available-discount/{id}', [\App\Http\Controllers\Api\DiscountController::class, 'availableDiscount']);
    });
    Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
});

Route::get('/get-city', [\App\Http\Controllers\Auth\LoginController::class, 'getCity'])->name('get_city');


//Route::group(['domain' => 'nha_cung_cap.ngo', 'middleware' => 'NCC'], function () {
////    Route::get('amount',[\App\Http\Controllers\Manufacture\WarehouseController::class,'amount'])->name('amount');
//});
