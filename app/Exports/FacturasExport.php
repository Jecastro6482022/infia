<?php

namespace App\Exports;

use App\Models\tbl_facturas;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacturasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tbl_facturas::all();
    }
}
