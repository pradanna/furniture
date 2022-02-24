<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::latest()->limit(20)->get();
        return response()->json([

            'success' => 1,
            'message' => 'Get Voucher Berhasil',
            'service' => $service
        ]);
    }
}
