<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Echo_;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {

        // Validasi request
        $validation = Validator::make($request->all(), [
            'product_id' => 'required',
            'user_id' => 'required'
        ]);

        // Pengkondisian
        if ($validation->fails()) {
            // Pesan Error
            $message = $validation->errors()->all();
            // Di kembalikan dalam bentuk array[0, Pertama]
            return $this->error_message($message[0]);
        }

        // Proses simpan di Database
        // $user adalah variabel dari model User
        // yang kemudian di jadikan array untuk ambil password untuk di encrypt
        $favorite = Favorite::create(array_merge($request->all()));

        // Jika User berhasil di simpan kedalam database
        if ($favorite) {
            //$favorites = Favorite::where('id', $user->id)->first();
            return response()->json([
                'success' => 1,
                'message' => 'Get Produk Berhasil',
                'favorited' => $favorite
            ]);
        }
        // jika Registrasi gagal
        return $this->error_message('Adding Failed');
    }

    // Fungsi tambahan untuk notif error 
    public function error_message($message)
    {
        return response()->json([
            'success' => 0,
            'message' => $message
        ]);
    }



    public function list_favorite($id)
    {
        $favorites = Favorite::with(['users', 'product'])->whereHas('users', function ($query) use ($id) {
            $query->whereId($id);
        })->orderBy("id", "desc")->get();

        // foreach ($favorites as $favorite) {
        //     $products = $favorite->product;
        //     // foreach ($products as $detail) {
        //     //     $detail->product;
        //     // }
        // }

        if (!empty($favorites)) {
            return response()->json([
                'success' => 1,
                'message' => 'Ambil data Berhasil',
                'favorite' => collect($favorites)
            ]);
        } else {
            $this->error('gagal');
        }
    }

    public function checkfavorite(Request $request)
    {
        // Validasi request
        $validation = Validator::make($request->all(), [
            'product_id' => 'required',
            'user_id' => 'required'
        ]);

        // Pengkondisian
        if ($validation->fails()) {
            // Pesan Error
            $message = $validation->errors()->all();
            // Di kembalikan dalam bentuk array[0, Pertama]
            return $this->error_message($message[0]);
        }

        // Proses simpan di Database
        // $user adalah variabel dari model User
        // yang kemudian di jadikan array untuk ambil password untuk di encrypt
        $favorite = DB::table('favorites')
            ->where('product_id', '=', $request->post('product_id'))
            ->where('user_id', '=', $request->post('user_id'))
            ->first();

        // Jika User berhasil di simpan kedalam database
        if ($favorite) {
            //$favorites = Favorite::where('id', $user->id)->first();
            return response()->json([
                'success' => 1,
                'message' => 'Get Produk Berhasil',
                'favorited' => $favorite
            ]);
        }
        // jika Registrasi gagal
        return $this->error_message('Adding Failed');
    }

    public function hapusfavorite(Request $request)
    {

        // Validasi request
        $validation = Validator::make($request->all(), [
            'product_id' => 'required',
            'user_id' => 'required'
        ]);

        // Pengkondisian
        if ($validation->fails()) {
            // Pesan Error
            $message = $validation->errors()->all();
            // Di kembalikan dalam bentuk array[0, Pertama]
            return $this->error_message($message[0]);
        }

        // Proses simpan di Database
        // $user adalah variabel dari model User
        // yang kemudian di jadikan array untuk ambil password untuk di encrypt
        $favorite = DB::table('favorites')
            ->where('product_id', '=', $request->post('product_id'))
            ->where('user_id', '=', $request->post('user_id'))
            ->get();

        foreach ($favorite as $f) {
            $id = $f->id;
        }

        $favorites = Favorite::findOrfail($id);

        if ($favorites) {

            $favorites->delete();

            return response()->json([
                'success' => 1,
                'message' => 'Favorite Deleted',
            ], 200);
        }

        //data post not found
        return response()->json([
            'success' => 0,
            'message' => 'Post Not Found',
        ], 404);
    }
}
