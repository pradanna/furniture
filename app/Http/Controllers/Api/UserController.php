<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    // Endpoint login
    public function login(Request $request)
    {
        // Ambil data dari table Users
        $user = Customer::where('email', $request->email)->first();
        // Checking User ada atau tidak
        if ($user) {
            //Check Password
            if (password_verify($request->password, $user->password)) {
                return response()->json([
                    'success' => 1,
                    'message' => 'Selamat Datang ' . $user->name,
                    //response data
                    'user' => $user
                ]);
            }
            // Error jika password salah
            return $this->error_message('Password salah!');
        }
        // Error jika email tidak ada
        return $this->error_message('Email belum terdaftar!');
    }

    //Endpoint Api Register
    public function register(Request $request)
    {
        // Validasi request
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6'
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
        $user = Customer::create(array_merge($request->all(), [
            // Password di Encrypt
            'password' => bcrypt($request->password)
        ]));

        // Jika User berhasil di simpan kedalam database
        if ($user) {
            $users = Customer::where('id', $user->id)->first();
            return response()->json([
                'success' => 1,
                'message' => 'Register berhasil!',
                //response data
                'user' => $users
            ]);
        }
        // jika Registrasi gagal
        return $this->error_message('Registrasi Gagal');
    }

    // Fungsi tambahan untuk notif error 
    public function error_message($message)
    {
        return response()->json([
            'success' => 0,
            'message' => $message
        ]);
    }

    public function check_email(Request $request)
    {
        // Validasi request
        $validation = Validator::make($request->all(), [
            'email' => 'required'
        ]);

        // Pengkondisian
        if ($validation->fails()) {
            // Pesan Error
            $message = $validation->errors()->all();
            // Di kembalikan dalam bentuk array[0, Pertama]
            return $this->error_message($message[0]);
        }

        // Ambil data dari table Users
        $user = Customer::where('email', $request->email)->first();

        if ($user) {
            //Check Password
            return response()->json([
                'success' => 1,
                'message' => 'Email di Temukan',
                //response data
                'user' => $user
            ]);
        }
        // Error jika email tidak ada
        return $this->error_message('Email belum terdaftar!');
    }

    public function reset_password(Request $request)
    {
        // Validasi request
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        // Pengkondisian
        if ($validation->fails()) {
            // Pesan Error
            $message = $validation->errors()->all();
            // Di kembalikan dalam bentuk array[0, Pertama]
            return $this->error_message($message[0]);
        }


        $customer = DB::update('update customers set password = ? where email = ?', [bcrypt($request->password), $request->email]);
        // //update data tanpa image
        // $customer = Customer::findOrFail($request->email);
        // $customer->update([
        //     'password' => bcrypt($request->password)
        // ]);

        if ($customer) {
            $users = Customer::where('email', $request->email)->first();
            return response()->json([
                'success' => 1,
                'message' => 'Password berhasil di rubah!',
                //response data
                'user' => $users
            ]);
        }
        // Error jika email tidak ada
        return $this->error_message('Password gagal di rubah!');
    }
}
