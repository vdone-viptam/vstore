<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::post('/register', [\App\Http\Controllers\Auth\LoginController::class, 'postFormRegister'])->name('post_register');
Route::get('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'formForgotPassword'])->name('form_forgot_password');
Route::post('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'postForgotPassword']);
Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'formResetForgot'])->name('reset_password');
Route::post('reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'postResetForgot']);
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('postLogin');
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'getLogout'])->name('logout');
Route::get('/otp/{token1}', [\App\Http\Controllers\Auth\LoginController::class, 'OTP'])->name('otp');
Route::post('/otp/{token1}', [\App\Http\Controllers\Auth\LoginController::class, 'post_OTP'])->name('post_otp');
Route::get('reOtp', [\App\Http\Controllers\Auth\LoginController::class, 'reOtp'])->name('re_otp');

// Chia các website thành 3 phần có các chức năng tưởng ứng với quyền
//role_id = 1 Quyền Admin
Route::group(['domain' => config('domain.admin')], function () {
    Route::get('/', function () {
        return redirect()->route('login_admin');
    });
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getFormLoginAdmin'])->name('login_admin');
});
//role_id = 2 Quyền nhà cung cấp
Route::group(['domain' => config('domain.ncc')], function () {
    Route::get('/', [\App\Http\Controllers\LandingpageController::class, 'ladingpageNCC'])->name('landingpagencc');
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getFormLoginNCC'])->name('login_ncc');
    Route::get('/register', [\App\Http\Controllers\Auth\LoginController::class, 'getFormRegisterNCC'])->name('register_ncc');
    Route::get('/p/{slug}', [\App\Http\Controllers\LandingpageController::class, 'index'])->name('intro');
//    Route::get('/', function () {
//        return redirect()->route('login_ncc');
//    });
    Route::get('/mail', [\App\Http\Controllers\Api\ProductController::class, 'mail']);
});
//role_id = 3 Quyền vstore
Route::group(['domain' => config('domain.vstore')], function () {
    Route::get('/', [\App\Http\Controllers\LandingpageController::class, 'ladingpage'])->name('landingpagevstore');
    Route::get('/register', [\App\Http\Controllers\Auth\LoginController::class, 'getFormRegisterVstore'])->name('register_vstore');
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getFormLoginVstore'])->name('login_vstore');
    Route::get('/p/{slug}', [\App\Http\Controllers\LandingpageController::class, 'vstore'])->name('intro_vstore');

});

//role_id = 4 Quyền kho
//Route::group(['domain' => config('domain.storage')], function () {
//    Route::get('/', [\App\Http\Controllers\LandingpageController::class, 'ladingpageStorage'])->name('screens.storage.index');
//    Route::get('/register', [\App\Http\Controllers\Auth\LoginController::class, 'getFormRegisterVstorage'])->name('register_storage');
//    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getFormLoginVstorage'])->name('login_storage');
//});

//Route::group(['domain' => config('domain.storage'), 'middleware' => 'storage'], function () {
//    Route::prefix('dashboard')->group(function () {
//        Route::get('/', [\App\Http\Controllers\Storage\DashboardController::class, 'index'])->name('screens.storage.dashboard.index');
//    });
//    Route::prefix('products')->group(function () {
//        Route::get('/', [\App\Http\Controllers\Storage\ProductController::class, 'index'])->name('screens.storage.product.index');
//        Route::get('/request', [\App\Http\Controllers\Storage\ProductController::class, 'request'])->name('screens.storage.product.request');
//        Route::get('/requestOut', [\App\Http\Controllers\Storage\ProductController::class, 'requestOut'])->name('screens.storage.product.requestOut');
//    });
//    Route::prefix('account')->group(function () {
//        Route::get('/', [\App\Http\Controllers\Storage\AccountController::class, 'profile'])->name('screens.storage.account.profile');
//        Route::post('/edit/{id}', [\App\Http\Controllers\Storage\AccountController::class, 'editProfile'])->name('screens.storage.account.editPro');
//        Route::post('/upload/{id}', [\App\Http\Controllers\Storage\AccountController::class, 'uploadImage'])->name('screens.storage.account.upload');
//        Route::get('/change-password', [\App\Http\Controllers\Storage\AccountController::class, 'changePassword'])->name('screens.storage.account.changePassword');
//        Route::post('/change-password', [\App\Http\Controllers\Storage\AccountController::class, 'saveChangePassword'])->name('screens.storage.account.saveChangePassword');
//
//    });
//    Route::prefix('finances')->group(function () {
//        Route::get('/', [\App\Http\Controllers\Storage\FinanceController::class, 'index'])->name('screens.storage.finance.index');
//        Route::get('/history', [\App\Http\Controllers\Storage\FinanceController::class, 'history'])->name('screens.storage.finance.history');
//
//    });
//    Route::prefix('partners')->group(function () {
//        Route::get('/', [\App\Http\Controllers\Storage\PartnerController::class, 'index'])->name('screens.storage.partner.index');
////        Route::get('/vshop', [\App\Http\Controllers\Vstore\PartnerController::class, 'vshop'])->name('screens.vstore.partner.vshop');
////        Route::get('/ship', [\App\Http\Controllers\Vstore\PartnerController::class, 'ship'])->name('screens.vstore.partner.ship');
//
//        //        Route::get('/report', [\App\Http\Controllers\Manufacture\PartnerController::class, 'report'])->name('screens.manufacture.partner.report');
//
//    });
//});
//Quyền admin
Route::group(['domain' => config('domain.admin'), 'middleware' => 'admin'], function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('screens.admin.dashboard.index');
    });
    Route::prefix('categories')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('screens.admin.category.index');
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('screens.admin.category.create');
        Route::post('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('screens.admin.category.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('screens.admin.category.edit');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('screens.admin.category.update');
        Route::get('/delete/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('screens.admin.category.destroy');
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'getListUser'])->name('screens.admin.user.list_user');
        Route::get('/register-account', [\App\Http\Controllers\Admin\UserController::class, 'getListRegisterAccount'])->name('screens.admin.user.index');
        Route::get('/confirm/{id}', [\App\Http\Controllers\Admin\UserController::class, 'confirm'])->name('screens.admin.user.confirm');
        Route::get('/chi-tiet', [\App\Http\Controllers\Admin\UserController::class, 'detail'])->name('screens.admin.user.detail');

    });

    Route::prefix('account')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AccountController::class, 'profile'])->name('screens.admin.account.profile');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\AccountController::class, 'editProfile'])->name('screens.admin.account.editPro');
        Route::post('/upload/{id}', [\App\Http\Controllers\Admin\AccountController::class, 'uploadImage'])->name('screens.admin.account.upload');
        Route::get('/change-password', [\App\Http\Controllers\Admin\AccountController::class, 'changePassword'])->name('screens.admin.account.changePassword');
        Route::post('/change-password', [\App\Http\Controllers\Admin\AccountController::class, 'saveChangePassword'])->name('screens.admin.account.saveChangePassword');

    });
    Route::prefix('product')->group(function () {
        Route::get('index', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('screens.admin.product.index');
        Route::get('/detail', [\App\Http\Controllers\Admin\ProductController::class, 'detail'])->name('screens.admin.product.detail');
        Route::post('/confirm/{id}}', [\App\Http\Controllers\Admin\ProductController::class, 'confirm'])->name('screens.admin.product.confirm');
        Route::get('gen-code/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'genderCodeProduct'])->name('screens.admin.product.code');

    });
    Route::get('/notifications', function () {
        return view('layouts.admin.all_noti', []);
    })->name('admin_all_noti');

});
//Quyền nhà cung cấp

Route::group(['domain' => config('domain.ncc'), 'middleware' => 'NCC'], function () {

    Route::get('amount', [\App\Http\Controllers\Manufacture\WarehouseController::class, 'amount'])->name('amount');
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manufacture\DashboardController::class, 'index'])->name('screens.manufacture.dashboard.index');
    });
    Route::prefix('warehouses')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manufacture\WarehouseController::class, 'index'])->name('screens.manufacture.warehouse.index');
        Route::get('/swap', [\App\Http\Controllers\Manufacture\WarehouseController::class, 'swap'])->name('screens.manufacture.warehouse.swap');
        Route::get('/detail', [\App\Http\Controllers\Manufacture\WarehouseController::class, 'detail'])->name('screens.manufacture.warehouse.detail');

        Route::get('/add-product-warehouse', [\App\Http\Controllers\Manufacture\WarehouseController::class, 'addProduct'])->name('screens.manufacture.warehouse.addProduct');
        Route::post('/add-product-warehouse', [\App\Http\Controllers\Manufacture\WarehouseController::class, 'postAddProduct']);

// Quản lý kho hàng
        Route::get('/list', [\App\Http\Controllers\Manufacture\AccountController::class, 'address'])->name('screens.manufacture.account.address');
        Route::post('/save-create', [\App\Http\Controllers\Manufacture\AccountController::class, 'saveAddress'])->name('screens.manufacture.account.saveCreate');
        Route::get('/edit', [\App\Http\Controllers\Manufacture\AccountController::class, 'editAddress'])->name('screens.manufacture.account.edit');
        Route::post('/edit/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'updateAddress'])->name('screens.manufacture.account.update');
//        Route::get('/destroy', [\App\Http\Controllers\Manufacture\AccountController::class, 'getdestroyAddress'])->name('screens.manufacture.account.destroy');
//        Route::post('/destroy/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'destroyAddress'])->name('screens.manufacture.account.delete');

    });
    Route::prefix('partners')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manufacture\PartnerController::class, 'index'])->name('screens.manufacture.partner.index');
        Route::get('/report', [\App\Http\Controllers\Manufacture\PartnerController::class, 'report'])->name('screens.manufacture.partner.report');

    });
    Route::prefix('finances')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manufacture\FinanceController::class, 'index'])->name('screens.manufacture.finance.index');
        Route::get('/history', [\App\Http\Controllers\Manufacture\FinanceController::class, 'history'])->name('screens.manufacture.finance.history');

    });
    Route::prefix('orders')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manufacture\OrderController::class, 'index'])->name('screens.manufacture.order.index');
        Route::get('/destroy', [\App\Http\Controllers\Manufacture\OrderController::class, 'destroy'])->name('screens.manufacture.order.destroy');
        Route::get('/pending', [\App\Http\Controllers\Manufacture\OrderController::class, 'pending'])->name('screens.manufacture.order.pending');

    });
//         Cập nhật thông tin tài khoản nhà cung cấp
    Route::prefix('account')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manufacture\AccountController::class, 'profile'])->name('screens.manufacture.account.profile');
        Route::post('/edit/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'editProfile'])->name('screens.manufacture.account.editPro');
        Route::post('/upload/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'uploadImage'])->name('screens.manufacture.account.upload');

        Route::get('/change-password', [\App\Http\Controllers\Manufacture\AccountController::class, 'changePassword'])->name('screens.manufacture.account.changePassword');
        Route::post('/change-password', [\App\Http\Controllers\Manufacture\AccountController::class, 'saveChangePassword'])->name('screens.manufacture.account.saveChangePassword');

    });
    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manufacture\ProductController::class, 'index'])->name('screens.manufacture.product.index');
        Route::get('/create', [\App\Http\Controllers\Manufacture\ProductController::class, 'create'])->name('screens.manufacture.product.create');
        Route::post('/create', [\App\Http\Controllers\Manufacture\ProductController::class, 'store'])->name('screens.manufacture.product.store');
        Route::get('/create-request', [\App\Http\Controllers\Manufacture\ProductController::class, 'createRequest'])->name('screens.manufacture.product.createRequest');
        Route::post('/store-request', [\App\Http\Controllers\Manufacture\ProductController::class, 'storeRequest'])->name('screens.manufacture.product.storeRequest');
        Route::get('/lay-du-lieu', [\App\Http\Controllers\Manufacture\ProductController::class, 'getDataProduct'])->name('screens.manufacture.product.getDataProduct');

        Route::get('/request', [\App\Http\Controllers\Manufacture\ProductController::class, 'requestProduct'])->name('screens.manufacture.product.request');
        Route::get('/detail', [\App\Http\Controllers\Manufacture\ProductController::class, 'detail'])->name('screens.manufacture.product.detail');
        Route::get('/createp', [\App\Http\Controllers\Manufacture\ProductController::class, 'createp'])->name('screens.manufacture.product.createp');
    });
    Route::get('/notifications', function () {
        return view('layouts.manufacture.all_noti', []);
    })->name('ncc_all_noti');
});
//Quyền vstore

Route::group(['domain' => config('domain.vstore'), 'middleware' => 'vStore'], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\Vstore\DashboardController::class, 'index'])->name('screens.vstore.dashboard.index');
    });
    Route::prefix('finance')->group(function () {
        Route::get('', [\App\Http\Controllers\Vstore\FinanceController::class, 'index'])->name('screens.vstore.finance.index');
        Route::get('revenue', [\App\Http\Controllers\Vstore\FinanceController::class, 'revenue'])->name('screens.vstore.finance.revenue');
        Route::get('history', [\App\Http\Controllers\Vstore\FinanceController::class, 'history'])->name('screens.vstore.finance.history');

    });
    Route::prefix('order')->group(function () {
        Route::get('', [\App\Http\Controllers\Vstore\OrderController::class, 'index'])->name('screens.vstore.order.index');
        Route::get('new', [\App\Http\Controllers\Vstore\OrderController::class, 'new'])->name('screens.vstore.order.new');
    });
    Route::prefix('account')->group(function () {
        Route::get('/', [\App\Http\Controllers\Vstore\AccountController::class, 'profile'])->name('screens.vstore.account.profile');
        Route::post('/edit/{id}', [\App\Http\Controllers\Vstore\AccountController::class, 'editProfile'])->name('screens.vstore.account.editPro');
        Route::post('/upload/{id}', [\App\Http\Controllers\Vstore\AccountController::class, 'uploadImage'])->name('screens.vstore.account.upload');
        Route::get('/change-password', [\App\Http\Controllers\Vstore\AccountController::class, 'changePassword'])->name('screens.vstore.account.changePassword');
        Route::post('/change-password', [\App\Http\Controllers\Vstore\AccountController::class, 'saveChangePassword'])->name('screens.vstore.account.saveChangePassword');

    });
    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\Vstore\ProductController::class, 'index'])->name('screens.vstore.product.index');
        Route::get('/request', [\App\Http\Controllers\Vstore\ProductController::class, 'request'])->name('screens.vstore.product.request');
        Route::get('/detail', [\App\Http\Controllers\Vstore\ProductController::class, 'detail'])->name('screens.vstore.product.detail');
        Route::post('/confirm/{id}}', [\App\Http\Controllers\Vstore\ProductController::class, 'confirm'])->name('screens.vstore.product.confirm');
        Route::get('/discount', [\App\Http\Controllers\Vstore\ProductController::class, 'discount'])->name('screens.vstore.product.discount');
        Route::get('/create-discount', [\App\Http\Controllers\Vstore\ProductController::class, 'createDis'])->name('screens.vstore.product.createDis');
    });
    Route::prefix('partners')->group(function () {
        Route::get('/', [\App\Http\Controllers\Vstore\PartnerController::class, 'index'])->name('screens.vstore.partner.index');
        Route::get('/vshop', [\App\Http\Controllers\Vstore\PartnerController::class, 'vshop'])->name('screens.vstore.partner.vshop');
        Route::get('/ship', [\App\Http\Controllers\Vstore\PartnerController::class, 'ship'])->name('screens.vstore.partner.ship');

//        Route::get('/report', [\App\Http\Controllers\Manufacture\PartnerController::class, 'report'])->name('screens.manufacture.partner.report');

    });
    Route::get('/notifications', function () {
        return view('layouts.vstore.all_noti', []);
    })->name('vstore_all_noti');
});




