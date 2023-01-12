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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register', [\App\Http\Controllers\Auth\LoginController::class, 'postFormRegister'])->name('post_register');
Route::get('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'formForgotPassword'])->name('form_forgot_password');
Route::post('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'postForgotPassword']);
Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'formResetForgot'])->name('reset_password');
Route::post('reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'postResetForgot']);
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('postLogin');
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'getLogout'])->name('logout');

// Chia các website thành 3 phần có các chức năng tưởng ứng với quyền
//role_id = 1 Quyền Admin
Route::group(['domain' => 'admin.ngo'], function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getFormLoginAdmin'])->name('login_admin');
});
//role_id = 2 Quyền nhà cung cấp
Route::group(['domain' => 'nha_cung_cap.ngo'], function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getFormLoginNCC'])->name('login_ncc');
    Route::get('/register', [\App\Http\Controllers\Auth\LoginController::class, 'getFormRegisterNCC'])->name('register_ncc');
});
//role_id = 3 Quyền vstore
Route::group(['domain' => 'vstore.ngo'], function () {
    Route::get('/register', [\App\Http\Controllers\Auth\LoginController::class, 'getFormRegisterVstore'])->name('register_vstore');
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getFormLoginVstore'])->name('login_vstore');
});


Route::middleware('auth')->group(function () {
    //Quyền admin
    Route::group(['domain' => 'admin.ngo', 'middleware' => 'admin'], function () {

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
        });

        Route::prefix('account')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AccountController::class, 'profile'])->name('screens.admin.account.profile');
            Route::post('/edit/{id}', [\App\Http\Controllers\Admin\AccountController::class, 'editProfile'])->name('screens.admin.account.editPro');
            Route::post('/upload/{id}', [\App\Http\Controllers\Admin\AccountController::class, 'uploadImage'])->name('screens.admin.account.upload');
            Route::get('/change-password', [\App\Http\Controllers\Admin\AccountController::class, 'changePassword'])->name('screens.admin.account.changePassword');
            Route::post('/change-password', [\App\Http\Controllers\Admin\AccountController::class, 'saveChangePassword'])->name('screens.admin.account.saveChangePassword');

        });
        Route::prefix('product')->group(function (){
           Route::get('index',[\App\Http\Controllers\Admin\ProductController::class,'index'])->name('screens.admin.product.index');
        });


    });
    //Quyền nhà cung cấp
    Route::group(['domain' => 'nha_cung_cap.ngo', 'middleware' => 'NCC'], function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [\App\Http\Controllers\Manufacture\DashboardController::class, 'index'])->name('screens.manufacture.dashboard.index');
        });
        Route::get('/add-product-warehouse',[\App\Http\Controllers\Manufacture\WarehouseController::class,'addProduct'])->name('screens.manufacture.warehouse.addProduct');
        Route::post('/add-product-warehouse',[\App\Http\Controllers\Manufacture\WarehouseController::class,'postAddProduct']);

//         Cập nhật thông tin tài khoản nhà cung cấp
        Route::prefix('account')->group(function () {
            Route::get('/', [\App\Http\Controllers\Manufacture\AccountController::class, 'profile'])->name('screens.manufacture.account.profile');
            Route::post('/edit/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'editProfile'])->name('screens.manufacture.account.editPro');
            Route::post('/upload/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'uploadImage'])->name('screens.manufacture.account.upload');
            Route::prefix('address')->group(function () {
                Route::get('/', [\App\Http\Controllers\Manufacture\AccountController::class, 'address'])->name('screens.manufacture.account.address');
                Route::post('/save-create', [\App\Http\Controllers\Manufacture\AccountController::class, 'saveAddress'])->name('screens.manufacture.account.saveCreate');
                Route::get('/edit', [\App\Http\Controllers\Manufacture\AccountController::class, 'editAddress'])->name('screens.manufacture.account.edit');
                Route::post('/edit/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'updateAddress'])->name('screens.manufacture.account.update');
                Route::get('/destroy', [\App\Http\Controllers\Manufacture\AccountController::class, 'getdestroyAddress'])->name('screens.manufacture.account.destroy');
                Route::post('/destroy/{id}', [\App\Http\Controllers\Manufacture\AccountController::class, 'destroyAddress'])->name('screens.manufacture.account.delete');

            });
            Route::get('/change-password', [\App\Http\Controllers\Manufacture\AccountController::class, 'changePassword'])->name('screens.manufacture.account.changePassword');
            Route::post('/change-password', [\App\Http\Controllers\Manufacture\AccountController::class, 'saveChangePassword'])->name('screens.manufacture.account.saveChangePassword');

        });
    });
    //Quyền vstore

    Route::group(['domain' => 'vstore.ngo', 'middleware' => 'vStore'], function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [\App\Http\Controllers\Vstore\DashboardController::class, 'index'])->name('screens.vstore.dashboard.index');
        });
        Route::prefix('account')->group(function () {
            Route::get('/', [\App\Http\Controllers\Vstore\AccountController::class, 'profile'])->name('screens.vstore.account.profile');
            Route::post('/edit/{id}', [\App\Http\Controllers\Vstore\AccountController::class, 'editProfile'])->name('screens.vstore.account.editPro');
            Route::post('/upload/{id}', [\App\Http\Controllers\Vstore\AccountController::class, 'uploadImage'])->name('screens.vstore.account.upload');
            Route::get('/change-password', [\App\Http\Controllers\Vstore\AccountController::class, 'changePassword'])->name('screens.vstore.account.changePassword');
            Route::post('/change-password', [\App\Http\Controllers\Vstore\AccountController::class, 'saveChangePassword'])->name('screens.vstore.account.saveChangePassword');

        });
    });
});


