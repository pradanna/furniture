<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::latest()->when(request()->q, function ($transactions) {
            $transactions = $transactions->where('name', 'like', '%' . request()->q . '%');
        })->paginate(20);
        return view('admin.laporan.index', compact('transactions'));
    }

    /**

     * @return \Illuminate\Support\Collection

     */

    public function export_transaksi()

    {
        return Excel::download(new TransactionExport, 'transaksi.xlsx');
    }
}
