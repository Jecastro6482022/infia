<?php

namespace App\Exports;

use App\Models\tbl_empresas;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmpresasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tbl_empresas::all();
    }
}
