<?php

namespace App\Exports;

use App\Models\tbl_usuarios;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return tbl_usuarios::leftJoin('tbl_roles as r', 'tbl_usuarios.cod_rol', '=', 'r.cod_rol')->select('tbl_usuarios.*', 'r.nom_rol')->orderBy('id_user', 'asc')->get();
    }
}
