<?php

use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SlideController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoucherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('login', 'Api\UserController@login');
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('check_email', [UserController::class, 'check_email']);
Route::post('reset_password', [UserController::class, 'reset_password']);

Route::post('favorite', [FavoriteController::class, 'favorite']);
Route::get('favorite/user/{id}', [FavoriteController::class, 'list_favorite']);
Route::post('checkfavorite', [FavoriteController::class, 'checkfavorite']);
Route::get('hapusfavorite', [FavoriteController::class, 'hapusfavorite']);

Route::get('slide', [SlideController::class, 'index']);

Route::get('category', [CategoryController::class, 'index']);
Route::get('category/{kodeklmpk}', [CategoryController::class, 'show']);

Route::get('service', [ServiceController::class, 'index']);
Route::get('laporan', [LaporanController::class, 'index']);
Route::get('bank', [BankController::class, 'index']);
Route::get('product', [ProductController::class, 'index']);
Route::get('voucher', [VoucherController::class, 'index']);
Route::get('product/{kodeklmpk}', [ProductController::class, 'show']);
Route::get('promo/{check}', [ProductController::class, 'promo']);
Route::get('nonpromo/{check}', [ProductController::class, 'nonpromo']);
//Route Search Produk
Route::get('product/search/{query}', [ProductController::class, 'search']);


Route::get('detail/{id}', [ProductController::class, 'detail']);


Route::post('chekout', [TransactionController::class, 'store']);
Route::get('chekout/user/{id}', [TransactionController::class, 'history']);
Route::post('chekout/cancel/{id}', [TransactionController::class, 'cancel']);

Route::post('push', [TransactionController::class, 'pushNotif']);
