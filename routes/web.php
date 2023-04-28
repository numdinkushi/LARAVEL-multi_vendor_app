<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    //banner section
    Route::resource('banner', BannerController::class);
    Route::post('/banner_status', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

    //category section
    Route::resource('category', CategoryController::class);
    Route::post('/category_status', [App\Http\Controllers\CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::post('/category/id/child', [App\Http\Controllers\CategoryController::class, 'getChildByParentId'])->name('get.child-category');

    //brand section
    Route::resource('brand', BrandController::class);
    Route::post('/brand_status', [App\Http\Controllers\BrandController::class, 'brandStatus'])->name('brand.status');

    //product section
    Route::resource('product', ProductController::class);
    Route::post('/product_status', [App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');

    //User section
    Route::resource('user', UserController::class);
    Route::post('/user_status', [App\Http\Controllers\UserController::class, 'userStatus'])->name('user.status');
});

