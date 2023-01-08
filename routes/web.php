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
//Route::get()
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'getLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('postLogin');


Route::get('/register', [\App\Http\Controllers\Auth\LoginController::class, 'getFormRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\LoginController::class, 'postFormRegister'])->name('post_register');
Route::get('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'formForgotPassword'])->name('form_forgot_password');
Route::post('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'postForgotPassword']);
Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'formResetForgot'])->name('reset_password');
Route::post('reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'postResetForgot']);

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
    Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('screens.admin.user.index');
    Route::get('/confirm/{id}', [\App\Http\Controllers\Admin\UserController::class, 'confirm'])->name('screens.admin.user.confirm');
});
Route::prefix('products')->group(function () {
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('screens.product.index');
    Route::get('/create/{type?}', [\App\Http\Controllers\ProductController::class, 'create'])->name('screens.product.create');
    Route::post('/create/{type?}', [\App\Http\Controllers\ProductController::class, 'store'])->name('screens.product.store');

});
