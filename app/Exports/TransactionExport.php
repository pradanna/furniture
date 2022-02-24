<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionExport implements FromCollection, WithHeadingRow
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::all();
    }
}
