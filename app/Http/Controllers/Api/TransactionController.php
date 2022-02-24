<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\TransaksiDetail;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        //nama, email, password
        $validasi = Validator::make($request->all(), [
            'user_id' => 'required',
            'total_item' => 'required',
            'total_harga' => 'required',
            'name' => 'required',
            'jasa_pengiriman' => 'required',
            'ongkir' => 'required',
            'total_transfer' => 'required',
            'bank' => 'required',
            'phone' => 'required'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $kode_payment = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_trx = "INV/TRX/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_unik = rand(100, 999);
        $status = "Menunggu Pembayaran";
        $expired_at = now()->addDay();

        $dataTransaksi = array_merge($request->all(), [
            'kode_payment' => $kode_payment,
            'kode_trx' => $kode_trx,
            'kode_unik' => $kode_unik,
            'status' => $status,
            'expired_at' => $expired_at
        ]);

        // \DB::beginTransaction();
        DB::beginTransaction();
        $transaction = Transaction::create($dataTransaksi);
        foreach ($request->products as $product) {
            $detail = [
                'transaction_id' => $transaction->id,
                'product_id' => $product['id'],
                'total_item' => $product['total_item'],
                'catatan' => $product['catatan'],
                'total_harga' => $product['total_harga']
            ];
            $transaksiDetail = TransactionDetail::create($detail);
        }

        if (!empty($transaction) && !empty($transaksiDetail)) {
            // \DB::commit();
            DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksi' => collect($transaction)
            ]);
        } else {
            // \DB::rollback();
            DB::rollback();
            return $this->error('Transaksi gagal');
        }
    }

    public function history($id)
    {
        $transactions = Transaction::with(['users'])->whereHas('users', function ($query) use ($id) {
            $query->whereId($id);
        })->orderBy("id", "desc")->get();

        foreach ($transactions as $transaction) {
            $details = $transaction->details;
            foreach ($details as $detail) {
                $detail->product;
            }
        }

        if (!empty($transactions)) {
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transactions' => collect($transactions)
            ]);
        } else {
            $this->error('Transaksi gagal');
        }
    }

    public function cancel($id)
    {
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        if ($transaction) {
            // update data

            $transaction->update([
                'status' => "BATAL"
            ]);
            $this->pushNotif('Transaksi di batalkan', "Transasi Produk " . $transaction->details[0]->product->name . " berhsil dibatalkan", $transaction->users->fcm);

            return response()->json([
                'success' => 1,
                'message' => 'Berhasil',
                'transaction' => $transaction
            ]);
        } else {
            return $this->error('Gagal memuat transaksi');
        }
    }

    public function pushNotif($title, $message, $mFcm)
    {

        $mData = [
            'title' => $title,
            'body' => $message
        ];

        $fcm[] = $mFcm;

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAAcv1o4p8:APA91bGntzKph5P-OQXUvLqBnn3simMe7fW5B-vmki1HsFHOGAD2pu4ZQYKuaJzawAHqmSwWGeO_g3Abin_tWrYSOPShbByNlZ7-YwGk4JZC2oXXTIBWVbdwtNRTMKk6gA1IAXccoY8B"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }

    public function error($pasan)
    {
        return response()->json([
            'success' => 0,
            'message' => $pasan
        ]);
    }
}
