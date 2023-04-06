<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
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
    Route::resource('banner', BannerController::class);
});

// Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
