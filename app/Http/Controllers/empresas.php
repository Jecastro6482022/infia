<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tbl_empresas;
use App\Models\tbl_usuarios;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class empresas extends Controller
{
    public function exportPdf()
    {
        $empresas = tbl_empresas::get();
        $pdf = PDF::loadView('pdf.empresas', compact('empresas'))->setPaper('a4', 'landscape');
        return $pdf->download('empresas.pdf');
    }
    public function printPdf()
    {
        $empresas = tbl_empresas::get();
        $pdf = PDF::loadView('pdf.empresas', compact('empresas'))->setPaper('a4', 'landscape');
        return $pdf->stream('empresas.pdf');
    }
    public function create()
    {
        $usuarios_view = tbl_usuarios::join('tbl_roles as r', 'tbl_usuarios.cod_rol', '=', 'r.cod_rol')
            ->select('tbl_usuarios.id_user', 'tbl_usuarios.nom_user', 'tbl_usuarios.apellidos_user', 'r.nom_rol')
            ->where('r.nom_rol', '=', 'Cliente')
            ->orWhere('r.nom_rol', '=', 'Proveedor')
            ->get();
        return view('Empresas.registrar_empresa', compact('usuarios_view'));
    }
    public function store(Request $request)
    {
        $nit = tbl_empresas::select('nit_empresa')
            ->where('nit_empresa', '=', $request->nit)
            ->exists();
        $email = tbl_empresas::select('email_empresa')
            ->where('email_empresa', '=', $request->e_mail)
            ->exists();

        if ($nit || $email) {
            if ($nit && $email) {
                return redirect()->route('Empresas.registrar_empresa')->with('error', 'La empresa ya existe');
            }
            if ($nit) {
                return redirect()->route('Empresas.registrar_empresa')->with('error', 'El nit ' . $request->nit . ' ya existe');
            }
            if ($email) {
                return redirect()->route('Empresas.registrar_empresa')->with('error', 'El email ' . $request->e_mail . ' ya existe');
            }
        } else {

            $request->validate([
                'nit' => 'required|max:10',
                'nombre' => 'required|max:20',
                'telefono' => 'required|digits_between:5,10|integer',
                'direccion' => 'required|max:30',
                'e_mail' => 'required|max:30|email',
            ]);
            $empresas = new tbl_empresas();
            $empresas->nit_empresa = $request->nit;
            $empresas->nom_empresa = $request->nombre;
            $empresas->tel_empresa = $request->telefono;
            $empresas->direccion_empresa = $request->direccion;
            $empresas->email_empresa = $request->e_mail;
            $empresas->id_user = $request->id_user;
            $empresas->save();
            return redirect()->route('Empresas.index')->with('guardado', 'La Empresa a sido guardada con exito');;
        }
    }
    // Retorno de tablas y selact
    public function index()
    {
        $empresas_view = tbl_empresas::leftJoin('tbl_usuarios as u', 'tbl_empresas.id_user', '=', 'u.id_user')
            ->leftJoin('tbl_roles as r', 'u.cod_rol', '=', 'r.cod_rol')
            ->select(
                'tbl_empresas.id',
                'tbl_empresas.nit_empresa',
                'tbl_empresas.nom_empresa',
                'tbl_empresas.tel_empresa',
                'tbl_empresas.direccion_empresa',
                'tbl_empresas.email_empresa',
                'tbl_empresas.id_user',
                'u.nom_user',
                'u.apellidos_user',
                'r.nom_rol'
            )->orderBy('nit_empresa', 'asc')
            ->get();

        return view('Empresas.empresas', compact('empresas_view'));
    }
    public function show($id)
    {
        //
    }

    public function index2()
    {
        $usuarios_view = tbl_usuarios::join('tbl_roles as r', 'tbl_usuarios.cod_rol', '=', 'r.cod_rol')
            ->select('tbl_usuarios.id_user', 'tbl_usuarios.nom_user', 'tbl_usuarios.apellidos_user', 'r.nom_rol')
            ->where('r.nom_rol', '=', 'Cliente')
            ->orWhere('r.nom_rol', '=', 'Proveedor')
            ->get();
        return view('Empresa.registrar_empresa', compact('usuarios_view'));
    }

    public function edit($empresa)
    {
        $usuarios_view = tbl_usuarios::all();
        $empresa = tbl_empresas::find($empresa);
        return view('Empresas.editar_empresa', compact('empresa', 'usuarios_view'));
    }

    public function update(Request $request,tbl_empresas $empresas)
    {   
        
        

        $empre = tbl_empresas::select('nit_empresa', 'email_empresa')
            ->where('id', '!=', $request->id)
            ->get();
        // 987456321 jecatro648@misena.edu.co
        $cont = 0;
        for ($i = 0; $i < count($empre); $i++) {
             if ($request->nit == $empre[$i]->nit_empresa|| $request->e_mail == $empre[$i]->email_empresa) {

                if ($request->nit == $empre[$i]->nit_empresa && $request->e_mail == $empre[$i]->email_empresa) {
                    $info =  'El nit y el email ya estan en uso.';
                    return redirect()->route('Empresas.index')->with('error', $info);
                    break;
                    exit();
                }
                if ($request->nit == $empre[$i]->nit_empresa) {
                    $cont ++;
                  
                }
                if ($request->e_mail == $empre[$i]->email_empresa) {
                    $info = 'El email ' . $request->e_mail . 'ya está en uso.';
                    return redirect()->route('Empresas.index')->with('error', $info);
                    break;
                    exit();
                }
            } 
        }

        if ($cont > 0) {
            $info = 'El nit ' . $request->nit . ' ya está en uso.';
                    return redirect()->route('Empresas.index')->with('error', $info);
                    exit(); 
        }else{

        $empresas= tbl_empresas::find($request->id);
        $request->validate([
            'nit' => 'required|max:10',
            'nombre' => 'required|max:20',
            'telefono' => 'required|digits_between:5,10|integer',
            'direccion' => 'required|max:30',
            'e_mail' => 'required|max:30|email',
        ]);
        $empresas->nit_empresa = $request->nit;
        $empresas->nom_empresa = $request->nombre;
        $empresas->tel_empresa = $request->telefono;
        $empresas->direccion_empresa = $request->direccion;
        $empresas->email_empresa = $request->e_mail;
        $empresas->id_user = $request->id_user;
        $empresas->save();
        return redirect()->route('Empresas.index')->with('actualizado', 'Usuario actualizado');
        return view('Articulos.editar_articulo', compact('articulo'));
    }
}
    public function destroy($id)
    {
        $empresa = tbl_empresas::find($id);
        $empresa->delete(); // Easy right?

        return redirect('Empresas')->with('destroy', 'Eliminado con exito');  // -> resources/views/stocks/index.blade.php
    }
}
