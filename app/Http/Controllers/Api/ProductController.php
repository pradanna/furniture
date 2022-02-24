<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->limit(100)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'product' => $products
        ]);
        // return response()->json($products);
    }
    public function show($kodeklmpk)
    {
        $products = Product::latest()
            ->where('kodeklmpk', $kodeklmpk)
            ->where('is_promo', 'tidak')
            ->paginate(20);
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'product' => $products
        ]);
    }

    public function nonpromo($check)
    {
        $products = Product::latest()->where('is_promo', $check)->limit(80)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'product' => $products
        ]);
    }

    public function promo($check)
    {
        $products = Product::latest()->where('is_promo', $check)->limit(10)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'product' => $products
        ]);
    }
    public function detail($id)
    {
        $products = Product::where('id', $id)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Detail Produk Berhasil',
            'product' => $products
        ]);
    }
    public function search($query)
    {
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
        if ($products) {
            return response()->json([
                'success' => 1,
                'message' => 'Get Detail Produk Berhasil',
                'product' => $products
            ]);
        }
        return response()->json([
            'success' => 0,
            'message' => 'Produk tidak tersedia'
        ]);
    }
}
