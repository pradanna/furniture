<?php

namespace App\Http\Controllers\Api;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function index()
    {
        $bank = Bank::latest()->limit(20)->get();
        return response()->json([

            'success' => 1,
            'message' => 'Get Voucher Berhasil',
            'bank' => $bank
        ]);
    }
}
