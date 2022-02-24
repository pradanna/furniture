<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    public function users()
    {
        return $this->belongsTo(Customer::class, "user_id", "id");
    }
}
