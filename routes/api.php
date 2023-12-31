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

Route::get('/els', [\App\Http\Controllers\Api\ElasticsearchController::class, 'index']);

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
Route::post('/tuyet-test-ngu', [\App\Http\Controllers\TestController::class, 'tuyet']);

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

    Route::get('get-province', [\App\Http\Controllers\Api\AddressController::class, 'getProvince']);
    Route::get('get-district/{id}', [\App\Http\Controllers\Api\AddressController::class, 'getDistrict']);
    Route::get('get-wards/{id}', [\App\Http\Controllers\Api\AddressController::class, 'getWards']);
    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\ProductController::class, 'index']);

        Route::get('search', [\App\Http\Controllers\Api\ProductController::class, 'searchProductByKeyWord']);
        Route::get('/product-by-category/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByCategory']);
        Route::get('/product-by-vstore/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByVstore']);
        Route::get('/product-by-ncc/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productByNcc']);
        Route::post('/vshop-pickup/{id}', [\App\Http\Controllers\Api\ProductController::class, 'vshopPickup']);
        Route::post('/vshop-ready-stock/{id}', [\App\Http\Controllers\Api\ProductController::class, 'vshopReadyStock']);
        Route::get('/product-by-vshop/{pdone_id}', [\App\Http\Controllers\Api\ProductController::class, 'productByVshop']);
        Route::get('/product-available-by-vshop/{pdone_id}', [\App\Http\Controllers\Api\ProductController::class, 'getProductAvailableByVshop']);
        Route::get('/create-bill/{pdone_id}', [\App\Http\Controllers\Api\ProductController::class, 'createBill']);
        Route::post('/save-bill/{pdone_id}', [\App\Http\Controllers\Api\ProductController::class, 'saveBill']);

        Route::get('/{id}', [\App\Http\Controllers\Api\ProductController::class, 'productById']);
        Route::delete('destroy-affiliate/{pdone_id}/{product_id}', [\App\Http\Controllers\Api\ProductController::class, 'destroyAffProduct']);

    });
    Route::prefix('review-product')->group(function () {

        Route::post('/accept-review', [\App\Http\Controllers\Api\ReviewProductApiController::class, 'acceptReviewProduct']);
        Route::get('/review-detail-product/{point_id}', [\App\Http\Controllers\Api\ReviewProductApiController::class, 'reviewDetailProduct']);
        Route::get('/list-review-product/{product_id}', [\App\Http\Controllers\Api\ReviewProductApiController::class, 'showListReviewProduct']);
        Route::get('/list-review-vdone/{done_id}', [\App\Http\Controllers\Api\ReviewProductApiController::class, 'showListReviewVDone']);
        Route::post('/rep-review-product', [\App\Http\Controllers\Api\ReviewProductApiController::class, 'repReviewProduct']);
    });
    // CART
    Route::prefix('cart')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\CartController::class, 'index']);
        Route::post('/product/{id}', [\App\Http\Controllers\Api\CartController::class, 'add']);
        Route::post('/{id}/product/{productId}/quantity', [\App\Http\Controllers\Api\CartController::class, 'updateQuantityInCart']);
    });

    Route::prefix('order')->group(function () {
        Route::post('/checkout', [\App\Http\Controllers\Api\OrderController::class, 'index']);
//        Route::post('/{orderId}', [\App\Http\Controllers\Api\OrderController::class, 'update']);
        // THANH TOÁN APP
        Route::post('/{id}/payment', [\App\Http\Controllers\PaymentMethod9PayController::class, 'payment']); // API APP CALL ĐỂ NHẬN LINK WEBVIEW
        // END THANH TOÁN APP

        Route::get('/user/get-list/{id}', [\App\Http\Controllers\Api\OrderController::class, 'getOrdersByUser']);
        Route::get('/user/detail/{order_id}', [\App\Http\Controllers\Api\OrderController::class, 'getDetailOrderByUser']);
        Route::get('/vshop/get-list/{pdone_id}', [\App\Http\Controllers\Api\OrderController::class, 'orderOfUserByVshop']);
        Route::get('/refuse-order', [\App\Http\Controllers\Api\OrderController::class, 'refuseOrderByCustomer']);


        Route::get('/detail-order-cancel', [\App\Http\Controllers\Api\OrderController::class, 'detailOrderCancel']);
        Route::put('/update-amount-warehouse', [\App\Http\Controllers\Api\OrderController::class, 'updateAmountWarehouse']);

    });

//    Route::('big-sales')->group(function () {
    Route::get('/product-sales', [\App\Http\Controllers\Api\BigSaleController::class, 'getListProductSale']);
//    });
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
    Route::prefix('finances')->group(function () {
        Route::get('get-list-bank', [\App\Http\Controllers\Api\FinanceController::class, 'getListBank']);
        Route::get('get-bank-id/{bank_id}', [\App\Http\Controllers\Api\FinanceController::class, 'getBankId']);
        Route::get('/wallet/{pdone_id}', [\App\Http\Controllers\Api\FinanceController::class, 'getWallet']);
        Route::get('/wallet/edit/{wallet_id}', [\App\Http\Controllers\Api\FinanceController::class, 'editWallet']);
        Route::put('/wallet/update/{wallet_id}', [\App\Http\Controllers\Api\FinanceController::class, 'updateWallet']);
        Route::post('/wallet/store', [\App\Http\Controllers\Api\FinanceController::class, 'storeWallet']);
        Route::post('/wallet/store-deposit/{wallet_id}', [\App\Http\Controllers\Api\FinanceController::class, 'storeDeposit']);
        Route::get('/get-surplus/{pdone_id}', [\App\Http\Controllers\Api\FinanceController::class, 'getSurplusByVshop']);

    });
    Route::prefix('vstore')->group(function () {
        //list nhà phân phối
        Route::get('', [\App\Http\Controllers\Api\VstoreController::class, 'index']);
        Route::get('search', [\App\Http\Controllers\Api\VstoreController::class, 'searchVstoreByKeyword']);

        Route::get('/{id}', [\App\Http\Controllers\Api\VstoreController::class, 'detail']);
        Route::get('/category/{id}', [\App\Http\Controllers\Api\VstoreController::class, 'listByCategory']);

    });
    Route::prefix('vshop')->group(function () {
        Route::get('/products/{pdone_id}', [\App\Http\Controllers\Api\VShopController::class, 'adminGetProductByvShop']);


        Route::get('', [\App\Http\Controllers\Api\VShopController::class, 'index']);
        Route::match(['put', 'post'], 'create', [\App\Http\Controllers\Api\VShopController::class, 'create']);
        Route::get('get-discount', [\App\Http\Controllers\Api\VShopController::class, 'getDiscountByTotalProduct']);
        Route::get('/get-discount/{pdone_id}/{product_id}', [\App\Http\Controllers\Api\VShopController::class, 'getDiscount']);
        Route::put('/edit-discount/{pdone_id}/{product_id}', [\App\Http\Controllers\Api\VShopController::class, 'editDiscount']);
        Route::post('/create-discount', [\App\Http\Controllers\Api\VShopController::class, 'createDiscount']);
        Route::get('/profile/{pdone_id}', [\App\Http\Controllers\Api\VShopController::class, 'getProfile']);
        Route::put('/profile/{pdone_id}', [\App\Http\Controllers\Api\VShopController::class, 'postProfile']);
        Route::get('/get-buy-more-discount/{id}', [\App\Http\Controllers\Api\VShopController::class, 'getBuyMoreDiscount']);

        Route::get('/get_money_history', [\App\Http\Controllers\Api\VShopController::class, 'get_mony_history']);

        Route::post('/store-discount', [\App\Http\Controllers\Api\VShopController::class, 'storeDiscount']);
        Route::prefix('address')->group(function () {
            Route::post('/store/{pdone_id}', [\App\Http\Controllers\Api\VShopController::class, 'storeAddressReceive']);
            Route::get('/edit-address/{id}', [\App\Http\Controllers\Api\VShopController::class, 'editAddressReceive']);
            Route::put('/update-address/{id}', [\App\Http\Controllers\Api\VShopController::class, 'updateAddressReceive']);
        });
        // Nhập hàng sẵn
        Route::post('/pre-order/product/{productId}', [\App\Http\Controllers\Api\VShopController::class, 'preOrder']);
        Route::post('/pre-order/{orderId}/confirm', [\App\Http\Controllers\Api\VShopController::class, 'preOrderConfirm']);
        Route::post('/pre-order/{orderId}/payment', [\App\Http\Controllers\Api\VShopController::class, 'preOrderPayment']);
        // lịch sử
        Route::get('/user/{userId}/pre-order', [\App\Http\Controllers\Api\VShopController::class, 'getPreOrder']);
        Route::post('/pre-order/{orderId}', [\App\Http\Controllers\Api\VShopController::class, 'updateStatusDonePreOrder']);
        // END Nhập hàng sẵn

    });
    Route::prefix('wallet')->group(function () {
        Route::get('/{pdone_id}', [\App\Http\Controllers\Api\WalletVshopController::class, 'surplus']);

    });
    Route::prefix('discount')->group(function () {
        Route::get('get-discount', [\App\Http\Controllers\Api\DiscountController::class, 'getDiscountByTotalProduct']);
        Route::get('available-discount/{id}', [\App\Http\Controllers\Api\DiscountController::class, 'availableDiscount']);
    });
    Route::post('login', [\App\Http\Controllers\Api\storage\AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('storage')->group(function () {
            Route::get('/notification', [\App\Http\Controllers\Api\storage\DashboardController::class, 'notifi']);
            Route::prefix('dashboard')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\DashboardController::class, 'index']);
            });
            Route::prefix('products')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\ProductController::class, 'index']);
                Route::get('/detail', [\App\Http\Controllers\Api\storage\ProductController::class, 'detailProduct']);
                Route::get('/request', [\App\Http\Controllers\Api\storage\ProductController::class, 'request']);

                Route::put('/request/update/{status}', [\App\Http\Controllers\Api\storage\ProductController::class, 'updateRequest']);

                Route::get('/requestOut', [\App\Http\Controllers\Api\storage\ProductController::class, 'requestOut']);
                Route::get('/detail-request', [\App\Http\Controllers\Api\storage\ProductController::class, 'detailRequest']);
                Route::get('/detail-request-out', [\App\Http\Controllers\Api\storage\ProductController::class, 'detailRequestOut']);

                Route::put('/requestOut/update/{status}', [\App\Http\Controllers\Api\storage\ProductController::class, 'updateRequestOut']);
                Route::get('info/{sku}', [\App\Http\Controllers\Api\storage\ProductController::class, 'getProductAndOrderBySKU']);
                Route::get('bill/{order_id}', [\App\Http\Controllers\Api\storage\ProductController::class, 'sendBill']);
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
            Route::prefix('warehouses')->group(function () {
                Route::get('/import', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'importProduct']);
                Route::get('/export', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'exportProduct']);
                Route::put('/confirm-export', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'confirmExportProduct']);
                Route::get('/destroy-export', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'exportDestroyProduct']);
                Route::get('/create/destroy-export', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'createRequestDestroy']);
                Route::post('/store/destroy-export', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'storeRequestDestroy']);
                Route::post('/store/import-destroy-order', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'storeImportProduct']);

                Route::get('/destroy', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'destroyOrder']);
                Route::get('/detail', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'detailImportProduct']);
                Route::get('/detail-destroy', [\App\Http\Controllers\Api\storage\WarehouseController::class, 'detailDestroyOrder']);

            });
            Route::prefix('finances')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\FinanceController::class, 'index']);
                Route::post('/store-wallet', [\App\Http\Controllers\Api\storage\FinanceController::class, 'storeWall']);
                Route::put('/update-wallet/{id}', [\App\Http\Controllers\Api\storage\FinanceController::class, 'updateWall']);
                Route::post('/create-deposit', [\App\Http\Controllers\Api\storage\FinanceController::class, 'deposit']);

                Route::get('/history', [\App\Http\Controllers\Api\storage\FinanceController::class, 'history']);
                Route::delete('/destroy-wa/{id}', [\App\Http\Controllers\Api\storage\FinanceController::class, 'destoryWa']);

            });
            Route::prefix('partners')->group(function () {
                Route::get('/', [\App\Http\Controllers\Api\storage\PartnerController::class, 'index']);
                Route::get('/detail-ncc', [\App\Http\Controllers\Api\storage\PartnerController::class, 'detailNcc']);
                Route::get('/delivery-partner', [\App\Http\Controllers\Api\storage\PartnerController::class, 'deliveryPartner']);
                Route::get('/detail-delivery-partner', [\App\Http\Controllers\Api\storage\PartnerController::class, 'detailDeliveryPartner']);
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
