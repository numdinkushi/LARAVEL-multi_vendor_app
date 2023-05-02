<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\IndexController;
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


//frontend
Route::get('/', [IndexController::class, 'home'])->name('home');
//product category
Route::get('/product-category/{slug}/', [IndexController::class, 'productCategory'])->name('product.category');

Route::get('/product-details/{slug}/', [IndexController::class, 'productDetails'])->name('product.details');

Route::get('/user/auth', [IndexController::class, 'userAuth'])->name('user.auth');

Route::post('/user/login', [IndexController::class, 'loginSubmit'])->name('login.submit');

Route::post('/user/register', [IndexController::class, 'registerSubmit'])->name('register.submit');



//end front end
Auth::routes(['register' => 'false']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
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

Route::prefix('seller')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

});