<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nomor_rekening',
        'card_name',
        'image',
    ];

    public function getImageAttribute($image)
    {
        return asset('storage/bank/' . $image);
    }
}
