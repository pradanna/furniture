<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\CustomerController;  
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\LaporanController;

Route::get('/', function () {
    return view('auth.login');
});

/**
 * route for admin
 */

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function () {

        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        //route resource categories
        Route::resource('/transaction', TransactionController::class, ['as' => 'admin']);

        // Route::resource('/transaction', TransactionController::class, 'index');
        Route::get('/transaction/batal/{id}', [TransactionController::class, 'batal'])->name('transactionBatal');
        Route::get('/transaction/details/{id}', [TransactionController::class, 'details'])->name('transactionDetail');
        Route::get('/transaction/faktur/{id}', [TransactionController::class, 'cetak_faktur'])->name('cetak_faktur');
        Route::get('/transaction/confim/{id}',  [TransactionController::class, 'confirm'])->name('transactionConfirm');
        Route::get('/transaction/kirim/{id}',  [TransactionController::class, 'kirim'])->name('transactionKirim');
        Route::get('/transaction/selesai/{id}',  [TransactionController::class, 'selesai'])->name('transactionSelesai');


        Route::get('/product/download_template',  [ProductController::class, 'downloadTemplate'])->name('download_template');
        Route::get('/product/import',  [ProductController::class, 'import'])->name('import');
        Route::post('/product/import_file',  [ProductController::class, 'import_file'])->name('import_file');

        Route::get('/product/import_update',  [ProductController::class, 'import_update'])->name('import_update');
        Route::post('/product/imported',  [ProductController::class, 'imported'])->name('imported');

        Route::resource('/product', ProductController::class, ['as' => 'admin']);
        Route::resource('/voucher', VoucherController::class, ['as' => 'admin']);
        Route::resource('/bank', BankController::class, ['as' => 'admin']);
        Route::resource('/service', ServiceController::class, ['as' => 'admin']);

        Route::get('/laporan/export_transaksi',  [LaporanController::class, 'export_transaksi'])->name('export_transaksi');
        //pokoknya jika ada route grouping (resource) dan buat custom route haru di letakan di atasnya karena di group routing laravel otomatis buatin index, show, store, create, edit, destroy,
        Route::resource('/laporan', LaporanController::class, ['as' => 'admin']);


        Route::get('/category/import_category',  [CategoryController::class, 'import_category'])->name('import_category');
        Route::post('/category/import_file_category',  [CategoryController::class, 'import_file_category'])->name('import_file_category');

        Route::resource('/category', CategoryController::class, ['as' => 'admin']);

        Route::get('/customer/export_customer',  [CustomerController::class, 'export_customer'])->name('export_customer');
        Route::resource('/customer', CustomerController::class, ['as' => 'admin']);

        Route::resource('/promo', PromoController::class, ['as' => 'admin']);

        Route::resource('/slide', SlideController::class, ['as' => 'admin']);
    });
});
