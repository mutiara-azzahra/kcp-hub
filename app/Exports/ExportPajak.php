<?php

namespace App\Exports;
use App\Models\TransaksiInvoiceHeader;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPajak implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransaksiInvoiceHeader::all();
    }
}
