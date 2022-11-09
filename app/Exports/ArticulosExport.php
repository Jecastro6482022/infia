<?php

namespace App\Exports;

use App\Models\tbl_articulos;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticulosExport implements FromCollection
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return tbl_articulos::all();
    }
}
