<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
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
});

