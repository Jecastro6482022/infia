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

        $cantidadEntradas = $this->inventario();

        return view('inventarios.inventarios', compact('cantidadEntradas'));
    }

    private function inventario()
    {
        $entradas = DB::table('tbl_registros')
            ->selectRaw('cod_articulo,sum(cantidad) as entrada')
            ->where('tipo', 'entrada')
            ->groupBy('cod_articulo')
            ->get();
        $salidas = DB::table('tbl_registros')
            ->selectRaw('cod_articulo,sum(cantidad) as salida')
            ->where('tipo', 'salida')
            ->groupBy('cod_articulo')
            ->get();
        $restaInventario = 0;
        $totalInventario = [];



        for ($i = 0; $i < count($entradas); $i++) {
            for ($j = 0; $j < count($salidas); $j++) {
                if ($entradas[$i]->cod_articulo == $salidas[$j]->cod_articulo) {
                    $restaInventario = $entradas[$i]->entrada - $salidas[$j]->salida;
                }
            }
            if ($restaInventario < 0) {
                continue;
            }
            $infoArticulo = DB::table('tbl_articulos')
                ->selectRaw('tipo_articulo as tipo,descripcion_articulo as descripcion')
                ->where('cod_articulo', $entradas[$i]->cod_articulo)->get();

            array_push($totalInventario, [
                "codigo" => $entradas[$i]->cod_articulo,
                "tipoArticulo" => $infoArticulo[0]->tipo,
                "descArticulo" => $infoArticulo[0]->descripcion,
                "cantidad" => $restaInventario
            ]);
        }

        return $totalInventario;
    }
}
