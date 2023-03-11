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


Route::prefix('cart')->group(function () {
    Route::get('/user/{user_id}', [\App\Http\Controllers\Api\CartController::class, 'index']);
    Route::post('/add/{id}', [\App\Http\Controllers\Api\CartController::class, 'add']);
    Route::delete('/remove/{cart_id}', [\App\Http\Controllers\Api\CartController::class, 'remove']);
    Route::post('/{id}/product/quantity', [\App\Http\Controllers\Api\CartController::class, 'updateQuantityInCart']);
});

// THANH TOÁN APP
//Route::group(['domain' => config('domain.payment')], function () {
    Route::post('/payment', [\App\Http\Controllers\PaymentMethod9PayController::class, 'payment']); // API APP CALL ĐỂ NHẬN LINK WEBVIEW
    Route::get('/payment/check', [\App\Http\Controllers\PaymentMethod9PayController::class, 'paymentCheck']); // API CHECK PAYMENT
//});
// END THANH TOÁN APP


//Route::post('callback-viettel-post', function (Request $req) {
//
//    return $req->all();


//    \Illuminate\Support\Facades\Log::info('CALLBACK_VIETTEL_POST', compact('all'));
//    return response()->json([
//        "status" => true,
//        "req" => $req
//    ]);
//});
//
//Route::any('callback-viettel-post', function (Request $req) {
//    $all = $req->all();
//
//    \Illuminate\Support\Facades\Log::info('CALLBACK_VIETTEL_POST', compact('all'));
//    return response()->json([
//        "status" => true,
//        "req" => $req
//    ]);
//});

Route::prefix('bill')->group(function () {
    Route::post('/add', [\App\Http\Controllers\Api\BillController::class, 'add']);
    Route::get('/detail/{id}', [\App\Http\Controllers\Api\BillController::class, 'detail']);
    Route::post('/checkout', [\App\Http\Controllers\Api\BillController::class, 'checkout']);
    Route::get('/{id}', [\App\Http\Controllers\Api\BillController::class, 'index']);
});

Route::post('callback-viettel-post', [\App\Http\Controllers\ViettelpostController::class, 'index']);


//Route::get('/', function () {
//    return config('domain.api');
//});
//Route::group(['domain' => config('domain.api')], function () {
Route::group(['domain' => config('domain.api'), 'middleware' => 'checkToken'], function () {


    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\ProductController::class, 'index']);

        Route::get('search/{key_word}', [\App\Http\Controllers\Api\ProductController::class, 'searchProductByKeyWord']);
        Route::get('/product-by-category/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByCategory']);
        Route::get('/product-by-vstore/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByVstore']);
        Route::get('/product-by-ncc/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByNcc']);
        Route::post('/vshop-pickup/{id}', [\App\Http\Controllers\Api\ProductController::class, 'vshopPickup']);
        Route::post('/vshop-ready-stock/{id}', [\App\Http\Controllers\Api\ProductController::class, 'vshopReadyStock']);
        Route::get('/product-by-vshop/{id_pdone}', [\App\Http\Controllers\Api\ProductController::class, 'productByVshop']);
        Route::get('/product-available-by-vshop/{id_pdone}', [\App\Http\Controllers\Api\ProductController::class, 'getProductAvailableByVshop']);
        Route::get('/create-bill/{id_pdone}', [\App\Http\Controllers\Api\ProductController::class, 'createBill']);
        Route::post('/save-bill/{id_pdone}', [\App\Http\Controllers\Api\ProductController::class, 'saveBill']);

        Route::get('/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productById']);
        Route::delete('destroy-affiliate/{id_pdone}/{product_id}', [\App\Http\Controllers\Api\ProductController::class, 'destroyAffProduct']);
    });
    // CARD
    Route::prefix('big-sales')->group(function () {
        Route::get('/get-list', [\App\Http\Controllers\Api\BigSaleController::class, 'getListProductSale']);
    });
    Route::prefix('banners')->group(function () {
        Route::get('/get-banner', [\App\Http\Controllers\Api\BannerController::class, 'getBannerHomePage']);
    });
    Route::prefix('bill')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Api\BillController::class, 'add']);
        Route::get('/detail/{id}', [\App\Http\Controllers\Api\BillController::class, 'detail']);
        Route::post('/checkout', [\App\Http\Controllers\Api\BillController::class, 'checkout']);
        Route::get('/{id}', [\App\Http\Controllers\Api\BillController::class, 'index']);


    });
    Route::prefix('categories')->group(function () {
        //list danh mục
        Route::get('', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
        Route::get('get-category-by-vstore/{vstore_id}', [\App\Http\Controllers\Api\CategoryController::class, 'getCategoryByVstore']);
        Route::get('get-product-vstore-by-category/{category_id}', [\App\Http\Controllers\Api\CategoryController::class, 'getProductAndVstoreByCategory']);
        Route::get('get-product-by-category/{category_id}', [\App\Http\Controllers\Api\CategoryController::class, 'getProductByCategory']);

        Route::get('get-all-vstore-by-category/{category_id}', [\App\Http\Controllers\Api\CategoryController::class, 'getAllVstoreByCategory']);
    });
    Route::prefix('manufactures')->group(function () {
        //list nhà cung cấp
        Route::get('/get-list', [\App\Http\Controllers\Api\ManufactureController::class, 'index']);
        Route::get('/profile/{ncc_id}', [\App\Http\Controllers\Api\ManufactureController::class, 'profileNCC']);

    });
    Route::prefix('vstore')->group(function () {
        //list nhà cung cấp
        Route::get('', [\App\Http\Controllers\Api\VstoreController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\Api\VstoreController::class, 'detail']);
        Route::get('/category/{id}', [\App\Http\Controllers\Api\VstoreController::class, 'listByCategory']);

    });
    Route::prefix('vshop')->group(function () {
        Route::get('', [\App\Http\Controllers\Api\VShopController::class, 'index']);
        Route::post('create',[\App\Http\Controllers\Api\VShopController::class,'create']);
        Route::get('get-discount', [\App\Http\Controllers\Api\VShopController::class, 'getDiscountByTotalProduct']);
        Route::post('/create-discount', [\App\Http\Controllers\Api\VShopController::class, 'createDiscount']);
        Route::get('/profile/{id}', [\App\Http\Controllers\Api\VShopController::class, 'getProfile']);
        Route::put('/profile/{id}', [\App\Http\Controllers\Api\VShopController::class, 'postProfile']);
        Route::get('/get-buy-more-discount/{id}',[\App\Http\Controllers\Api\VShopController::class,'getBuyMoreDiscount']);
//        dd(1);
        Route::post('/store-discount', [\App\Http\Controllers\Api\VShopController::class, 'storeDiscount']);
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
    Route::post('login', [\App\Http\Controllers\Api\storage\AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('storage')->group(function () {
            Route::prefix('dashboard')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\DashboardController::class, 'index']);
            });
            Route::prefix('products')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\ProductController::class, 'index']);
                Route::get('/request', [\App\Http\Controllers\Api\storage\ProductController::class, 'request']);
                Route::put('/request/update/{status}', [\App\Http\Controllers\Api\storage\ProductController::class, 'updateRequest']);

                Route::get('/requestOut', [\App\Http\Controllers\Api\storage\ProductController::class, 'requestOut']);
                Route::put('/requestOut/update/{status}', [\App\Http\Controllers\Api\storage\ProductController::class, 'updateRequestOut']);
                Route::get('/detail', [\App\Http\Controllers\Api\storage\ProductController::class, 'detail']);
            });
            Route::prefix('account')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\AccountController::class, 'profile']);
                Route::post('/edit/{id}', [\App\Http\Controllers\Api\storage\AccountController::class, 'editProfile']);
                Route::post('/upload/{id}', [\App\Http\Controllers\Api\storage\AccountController::class, 'uploadImage']);
                Route::get('/change-password', [\App\Http\Controllers\Api\storage\AccountController::class, 'changePassword']);
                Route::put('/change-password', [\App\Http\Controllers\Api\storage\AccountController::class, 'saveChangePassword']);
                Route::get('/edit-tax-code', [\App\Http\Controllers\Api\storage\AccountController::class, 'editTaxCode']);
                Route::put('/save-tax-code', [\App\Http\Controllers\Api\storage\AccountController::class, 'saveChangeTaxCode']);
            });
            Route::prefix('finances')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\FinanceController::class, 'index']);
                Route::post('/store-wallet', [\App\Http\Controllers\Api\storage\FinanceController::class, 'storeWall']);
                Route::put('/update-wallet/{id}', [\App\Http\Controllers\Api\storage\FinanceController::class, 'updateWall']);
                Route::post('/create-deposit', [\App\Http\Controllers\Api\storage\FinanceController::class, 'deposit']);

                Route::get('/history', [\App\Http\Controllers\Api\storage\FinanceController::class, 'history']);

            });
            Route::prefix('partners')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\PartnerController::class, 'index']);
            });
        });

//        Route::get('/notifications', function () {
//            return view('layouts.storage.all_noti', []);
//        })->name('storage_all_noti');
//        return $request->user();
    });

    Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
});

Route::get('/get-city', [\App\Http\Controllers\Auth\LoginController::class, 'getCity'])->name('get_city');


//Route::group(['domain' => 'nha_cung_cap.ngo', 'middleware' => 'NCC'], function () {
////    Route::get('amount',[\App\Http\Controllers\Manufacture\WarehouseController::class,'amount'])->name('amount');
//});
