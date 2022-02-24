<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'image',
        'min_order',
        'descriptions',
        'contact_centre',
        'expired'
    ];

    public function getImageAttribute($image)
    {
        return asset('img/voucher/' . $image);
    }
}
