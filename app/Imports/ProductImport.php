<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow, WithUpserts
{


    public function uniqueBy()
    {
        return 'kodebrg';
    }


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
