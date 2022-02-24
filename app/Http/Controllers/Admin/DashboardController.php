<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {

        $products = Product::count();

        $transactionPending = Transaction::where('status', 'Menunggu Pembayaran')->count();

        $transactionProses = Transaction::where('status', 'PROSES')->count();

        $transactionSuccess = Transaction::where('status', 'SELESAI')->count();

        $omset = Transaction::where('status', 'SELESAI')->sum('total_harga');

        return view('admin.dashboard.index', compact('products', 'transactionPending', 'transactionProses', 'transactionSuccess', 'omset'));
    }
}
