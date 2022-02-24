<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $transactionPending['listPending'] = Transaction::whereStatus("Menunggu Pembayaran")->get();

        $transactionFinish['listDone'] = Transaction::where("Status", "NOT LIKE", "%Menunggu Pembayaran%")->get();

        return view('admin.transaction.index')->with($transactionPending)->with($transactionFinish);
    }

    public function batal($id)
    {
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        $this->pushNotif('Transaction Diproses', "Transasi product " . $transaction->details[0]->product->name . " sedang diproses", $transaction->users->fcm);
        $transaction->update([
            'status' => "BATAL"
        ]);
        return redirect('admin/transaction');
    }
    public function details($id)
    {

        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        // dd($transaction);
        // die;
        return view('admin.transaction.details', compact('transaction'));
    }

    public function confirm($id)
    {
        $transaksi = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        $this->pushNotif('Transaksi Diproses', "Transasi product " . $transaksi->details[0]->product->name . " sedang diproses", $transaksi->users->fcm);
        $transaksi->update([
            'status' => "PROSES"
        ]);
        return redirect('admin/transaction');
    }

    public function kirim($id)
    {
        $transaksi = Transaction::with(['details.product', 'users'])->where('id', $id)->first();

        $this->pushNotif('Transaksi Dibatalkan', "Transasi product " . $transaksi->details[0]->product->name . " berhsil dibatalkan", $transaksi->users->fcm);
        $transaksi->update([
            'status' => "DIKIRIM"
        ]);

        foreach ($transaksi->details as $p) {

            $id = $p->product_id;
            //update data tanpa image
            $product = Product::findOrFail($id);
            $stock = $product->stock - $p->total_item;
            $product->update([
                'stock'       => $stock,
            ]);
        }

        return redirect('admin/transaction');
    }

    public function selesai($id)
    {
        $transaksi = Transaction::with(['details.product', 'users'])->where('id', $id)->first();

        $this->pushNotif('Transaksi Selesai', "Transasi product " . $transaksi->details[0]->product->name . " Sudah selesai", $transaksi->users->fcm);
        $transaksi->update([
            'status' => "SELESAI"
        ]);
        return redirect('admin/transaction');
    }

    public function cetak_faktur($id)
    {
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        // dd($transaction);
        // die;
        // return view('admin.transaction.faktur', compact('transaction'));
        $pdf = PDF::loadView('admin.transaction.faktur', compact('transaction'));

        return $pdf->download('Invoice.pdf');
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
}
