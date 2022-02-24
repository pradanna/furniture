<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        $slide = Slide::latest()->get();
        return response()->json([
            'success' => 1,
            'message' => 'Get Slide Berhasil',
            'slide' => $slide
        ]);
    }
}
