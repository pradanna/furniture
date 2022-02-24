<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodebrg',
        'barcode',
        'kodeklmpk',
        'kodedept',
        'name',
        'slug',
        'price',
        'weight',
        'stock',
        'description',
        'category',
        'image',
        'hgros1',
        'hgros2',
        'quantity1',
        'quantity2',

        // Tambahan
        'is_promo',
        'discount',
        'potongan_harga',
        'd_price',
        'd_hgros1',
        'd_hgros2',
        'expired'
    ];



    public function getImageAttribute($image)
    {
        return asset('storage/product/' . $image);
    }

    // public function favorite()
    // {
    //     return $this->belongsTo(Favorite::class, "product_id", "id");
    // }
}
