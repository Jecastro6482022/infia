<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tbl_inventarios;
use App\Models\tbl_registros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class inventario extends Controller
{

    public function index()
    {

        $inventario = tbl_inventarios::leftJoin('tbl_articulos as a','tbl_inventarios.cod_articulo','=','a.cod_articulo')
        ->select('tbl_inventarios.*','a.tipo_articulo','a.descripcion_articulo')
        ->get();    
        return view('inventarios.inventarios', compact('inventario'));
    }

   }
