<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kode_payment',
        'kode_trx', 'total_item', 'total_harga', 'kode_unik',
        'status', 'resi', 'kurir', 'name', 'phone', 'detail_lokasi', 'metode',
        'deskripsi', 'expired_at', 'jasa_pengiriman', 'ongkir', 'total_transfer', 'bank'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, "transaction_id", "id");
    }

    public function users()
    {
        return $this->belongsTo(Customer::class, "user_id", "id");
    }
}
