<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tbl_facturas;
use App\Models\tbl_empresas;
use App\Models\tbl_usuarios;
use App\Models\tbl_articulos;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class facturas extends Controller
{
    public function exportPdf()
    {
        $facturas = tbl_facturas::get();
        $pdf = PDF::loadView('pdf.facturas', compact('facturas'))->setPaper('a4', 'landscape');
        return $pdf->download('facturas.pdf');
    }
    public function printPdf()
    {
        $facturas = tbl_facturas::get();
        $pdf = PDF::loadView('pdf.facturas', compact('facturas'))->setPaper('a4', 'landscape');
        return $pdf->stream('facturas.pdf');
    }
    
    public function printFactura(tbl_facturas $factura){
        $facturas = tbl_empresas::all();
        $pdf = PDF::loadView('pdf.facturas', compact('facturas'))->setPaper('a4', 'landscape');
    }

    public function store(Request $request)
    {
        $request->validate([
            'valor_unitario' => 'required|digits_between:1,20|integer',
            'cantidad' => 'required|digits_between:1,20|integer',
            'iva' => 'required|digits_between:1,3|integer',
            'descripcion' => 'required|max:150|string',
            'id_user' => 'required_if:nit_empresa,null'
        ]);

        $subtotal = ($request->cantidad) * ($request->valor_unitario);
        $iva = ($subtotal * ($request->iva))/100;
        $total = $subtotal + $iva;

        $facturas = new tbl_facturas();
        $facturas->fecha = $request->fecha;
        $facturas->tipo_factura = $request->tipo_factura;
        $facturas->valor_unitario = $request->valor_unitario;
        $facturas->cantidad = $request->cantidad;
        $facturas->sub_total = $subtotal;
        $facturas->iva = $iva;
        $facturas->total = $total;
        $facturas->descripcion = $request->descripcion;
        $facturas->cod_articulo = $request->cod_articulo;
        $facturas->nit_empresa = $request->nit_empresa;
        $facturas->id_user = $request->id_user;
        $facturas->save();
        session()->flash('guardado', 'La Factura a sido Registrada con exito');
        return redirect()->route('reg_factura');
    }

    public function index()
    {
        $facturas = tbl_facturas::join('tbl_articulos as art', 'tbl_facturas.cod_articulo', '=', 'art.cod_articulo')
        ->join('tbl_usuarios as user', 'tbl_facturas.id_user', '=', 'user.id_user')
        // ->join('tbl_empresas as emp', 'tbl_facturas.nit_empresa', '=', 'emp.nit_empresa')
        ->select('tbl_facturas.*','art.nom_articulo','user.nom_user')
        ->get();
        // $facturas = tbl_facturas::join();
        return view('Facturas.facturas', compact('facturas'));
    }
    public function index_reg()
    {
        $empresas_view = tbl_empresas::all();
        $usuarios_view = tbl_usuarios::all();
        $articulos_view = tbl_articulos::all();
        return view('Facturas.registrar_factura', compact('empresas_view', 'usuarios_view', 'articulos_view'));
    }
    public function edit(tbl_facturas $factura)
    {
        $empresas_view = tbl_empresas::all();
        $usuarios_view = tbl_usuarios::all();
        $articulos_view = tbl_articulos::all();
        return view('Facturas.editar_factura', compact('factura', 'empresas_view', 'usuarios_view', 'articulos_view'));
    }

    public function update(Request $request, tbl_facturas $factura)
    {
        $request->validate([
            'valor_unitario' => 'required|digits_between:1,10|integer',
            'cantidad' => 'required|digits_between:1,10|integer',
            'iva' => 'required|digits_between:1,3|integer',
            'descripcion' => 'required|max:150|string'
        ]);

        $subtotal = ($request->cantidad) * ($request->valor_unitario);
        $iva = $subtotal * ($request->iva);
        $total = $subtotal + $iva;

        $facturas = new tbl_facturas();
        $facturas->fecha = $request->fecha;
        $facturas->tipo_factura = $request->tipo_factura;
        $facturas->valor_unitario = $request->valor_unitario;
        $facturas->cantidad = $request->cantidad;
        $facturas->sub_total = $subtotal;
        $facturas->iva = $iva;
        $facturas->total = $total;
        $facturas->descripcion = $request->descripcion;
        $facturas->cod_articulo = $request->cod_articulo;
        $facturas->nit_empresa = $request->nit_empresa;
        $facturas->id_user = $request->nit_empresa;
        $facturas->save();
        session()->flash('actualizado', 'La Factura a sido actualizada con exito');

        $empresas_view = tbl_empresas::all();
        $usuarios_view = tbl_usuarios::all();
        $articulos_view = tbl_articulos::all();
        return view('Facturas.editar_factura', compact('empresas_view', 'usuarios_view', 'articulos_view'));
    }
}
