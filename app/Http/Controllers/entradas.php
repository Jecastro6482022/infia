<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbl_registros;
use App\Models\tbl_facturas;
use App\Models\tbl_articulos;
use App\Models\tbl_inventarios;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\FrameDecorator\Table;
use Illuminate\Support\Facades\DB;

class entradas extends Controller
{
    public function exportPdf()
    {
        $entradas = tbl_registros::get();
        $pdf = PDF::loadView('pdf.entradas', compact('entradas'))->setPaper('a4', 'landscape');
        return $pdf->download('entradas.pdf');
    }
    public function printPdf()
    {
        $entradas = tbl_registros::get();
        $pdf = PDF::loadView('pdf.entradas', compact('entradas'))->setPaper('a4', 'landscape');
        return $pdf->stream('entradas.pdf');
    }

    public function store(Request $request)
    {
        /* El validate funciona, pero los datos que se estan enviando no cumplen    */
        $request->validate([
            'cod_articulo' => 'required|max:10',
            'tipo' => 'max:30',
            'cantidad' => 'required|max:20',
            'causal' => 'required|max:50',
            'num_factura' => 'max:50',
        ]);


        if ($request->causal == "Factura de compra - Materia prima o insumos" && $request->num_factura == "Seleccione una factura") {
            return redirect()->route('post_reg_entrada')->with('error', 'Debe seleccionar un numero de factura');
        } elseif ($request->causal == "Factura de compra - Materia prima o insumos" && is_null($request->num_factura)) {
            return redirect()->route('post_reg_entrada')->with('error', 'Debe seleccionar un numero de factura');
        }

        if ($request->num_factura == "Seleccione una factura") {
            return redirect()->route('post_reg_entrada')->with('error', 'Dejo algún campo sin seleccionar');
        }

        $entradas = new tbl_registros();
        $entradas->cod_articulo = $request->cod_articulo;
        $entradas->tipo = "Entrada";
        $entradas->cantidad = $request->cantidad;
        $entradas->causal = $request->causal;
        $entradas->num_factura = $request->num_factura;
        if ($entradas->save()) :
            $this->updateOrInsertInventory($request->cod_articulo, $request->cantidad);
            return redirect()->route('post_reg_entrada')->with('guardado', 'El registro de entrada se realizo con exito');
        endif;
    }

    public function index()
    {

        $entradas = tbl_registros::leftJoin('tbl_articulos as a', 'tbl_registros.cod_articulo', '=', 'a.cod_articulo')
            ->select('tbl_registros.*', 'descripcion_articulo')
            ->where('tipo', '=', 'Entrada')->get();
        return view('entradas.entradas', compact('entradas'));
    }

    public function index2()
    {
        $articulos_view = tbl_articulos::all();
        $facturas_view = tbl_facturas::all();
        return view('entradas.registrar_entrada', compact('articulos_view', 'facturas_view'));
    }

    private function updateOrInsertInventory($id, $cantidadEntrada)
    {   //Valida si ya existe un registro en inventario
        $bool = DB::table('tbl_inventarios')
            ->where('cod_articulo', $id)->exists();
        //Si el articulo ya existe en el inventario lo actualiza
        if ($bool) :
            //Selecciona la cantidad actual de un articulo 
            $cantidadActual =  DB::table('tbl_inventarios')
                ->select('existencias')
                ->where('cod_articulo', '=', $id)->get();
            //Suma la cantidad actual del inventario con la cantidad que se está registrando en la entrada
            $total = $cantidadActual[0]->existencias + $cantidadEntrada;
            //Inserta o actualiza en la tabla de inventarios dependiendo si el codigo de articulo existe
            DB::table('tbl_inventarios')->where('cod_articulo', $id)
                ->update(['existencias' => $total]);
        //si no existe el registro del articulo en el inventario lo crea     
        else :
            $nomnbreArticulo = tbl_articulos::select('nom_articulo')
                ->where('cod_articulo', '=', $id)->get();
            DB::table('tbl_inventarios')->upsert(
                [
                    ['cod_articulo' => $id, 'nom_articulo' => $nomnbreArticulo[0]->nom_articulo, 'existencias' => $cantidadEntrada],
                ],
                ['cod_articulo'],
                ['existencias']
            );
        endif;
    }
}
