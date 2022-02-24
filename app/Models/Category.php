<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodeklmpk',
        'kodedept',
        'namaklmpk',
        'image',
    ];



    public function getImageAttribute($image)
    {
        return asset('storage/category/' . $image);
    }
}
