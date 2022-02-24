<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Kategori Berhasil',
            'category' => $category
        ]);
    }

    // Fungsi tambahan untuk notif error 
    public function error_message($message)
    {
        return response()->json([
            'success' => 0,
            'message' => $message
        ]);
    }

    public function show($kodeklmpk)
    {

        $products = Product::latest()
            ->where('kodeklmpk', $kodeklmpk)
            ->where('is_promo', 'tidak')
            ->limit(10)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'product' => $products
        ]);
        // $products = Product::latest()->where('kodeklmpk', $kodeklmpk)->limit(10)->get();
        // return response()->json([

        //     'success' => 1,
        //     'message' => 'Get Produk Berhasil',
        //     'product' => $products
        // ]);
    }
}
