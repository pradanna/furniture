<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductUpdate implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'kodebrg' => $row['kodebrg'],
            'barcode' => $row['barcode'],
            'kodeklmpk' => $row['kodeklmpk'],
            'kodedept' => $row['kodedept'],
            'name' => $row['name'],
            'slug' => Str::slug($row['name']),
            'price' => $row['price'],
            'stock' => $row['stock'],
            'hgros1' => $row['hgros1'],
            'hgros2' => $row['hgros2'],
            'quantity1' => $row['quantity1'],
            'quantity2' => $row['quantity2']
        ]);
    }
}
