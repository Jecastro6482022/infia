<?php

namespace App\Exports;

use App\Models\peliculas;
use Maatwebsite\Excel\Concerns\FromCollection;

class PeliculasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return peliculas::all();
    }
}
