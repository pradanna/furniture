<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'diskon',
        'pot_harga',
        'price',
        'hgros1',
        'hgros2',
        'batas_promo',
        'is_active',
    ];
}
