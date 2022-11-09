<?php

namespace App\Exports;

use App\Models\tbl_registros;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegistrosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tbl_registros::all();
    }
}
