<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->when(request()->q, function ($customers) {
            $customers = $customers->where('name', 'like', '%' . request()->q . '%');
        })->paginate(20);
        return view('admin.customer.index', compact('customers'));
    }

    /**

     * @return \Illuminate\Support\Collection

     */

    public function export_customer()

    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
