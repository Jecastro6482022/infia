<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tbl_usuarios;
use App\Models\tbl_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class usuarios extends Controller
{
    public function login(Request $request)
    {
        $usuarios = tbl_usuarios::get();
        $credentials = $request->validate([
            'email_user' => 'required|email|string',
            'contraseña_user' => 'required|string'
        ]);
        if (Auth::attempt($credentials) == ($usuarios)) {
            return route('main');
        }
        return route('login');
    }

    public function exportPdf()
    {
        $usuarios = tbl_usuarios::get();
        $pdf = PDF::loadView('pdf.usuarios', compact('usuarios'))->setPaper('a4', 'landscape');
        return $pdf->download('usuarios.pdf');
    }
    public function printPdf()
    {
        $usuarios = tbl_usuarios::get();
        $pdf = PDF::loadView('pdf.usuarios', compact('usuarios'))->setPaper('a4', 'landscape');
        return $pdf->stream('usuarios.pdf');
    }

    public function store(Request $request)
    {
        $user = DB::table('tbl_usuarios')
            ->select('id_user')
            ->where('id_user', '=', $request->id)
            ->exists();
        $email = DB::table('tbl_usuarios')
            ->select('email_user')
            ->where('email_user', '=', $request->email)
            ->exists();

        if ($user || $email) {
            if ($user && $email) {
                return redirect()->route('post_reg_usuario')->with('error', 'El usuario ya existe');
            }
            if ($user) {
                return redirect()->route('post_reg_usuario')->with('error', 'El id ' . $request->id . ' ya existe');
            }
            if ($email) {
                return redirect()->route('post_reg_usuario')->with('error', 'El email ' . $request->email . ' ya existe');
            }
        } else {

            $request->validate([

                'email' => 'required|max:30|email',
                'id' => 'required|max:10',
                'email' => 'required|max:30|email',
                'contraseña' => 'required|max:20|min:5',
                'nombres' => 'required|max:50',
                'apellidos' => 'required|max:50',
                'fecha' => 'required|max:50|date',
                'telefono' => 'required|max:10',
                'direccion' => 'required|max:20',
                'rol' => 'required|max:20',
            ]);

            $usuarios = new tbl_usuarios();
            $usuarios->cedula = $request->cedula;
            $usuarios->email_user = $request->email;
            $usuarios->contraseña_user = $request->contraseña;
            $usuarios->nom_user = $request->nombres;
            $usuarios->apellidos_user = $request->apellidos;
            $usuarios->fecha_ingreso = $request->fecha;
            $usuarios->telefono_user = $request->telefono;
            $usuarios->direccion_user = $request->direccion;
            $usuarios->cod_rol = $request->rol;
            $usuarios->save();
            return redirect()->route('post_reg_usuario')->with('guardado', 'Tarea creada correctamente');
        }
    }
    public function index()
    {

        $usuarios = tbl_usuarios::leftJoin('tbl_roles as r', 'tbl_usuarios.cod_rol', '=', 'r.cod_rol')
            ->select('tbl_usuarios.*', 'r.nom_rol')->orderBy('id_user', 'asc')
            ->get();
        return view('usuarios.usuarios', compact('usuarios'));
    }
    public function index2()
    {
        $roles = tbl_roles::all();
        return view('usuarios.registrar_usuario', compact('roles'));
    }



    public function edit(tbl_usuarios $usuario)
    {
        $roles = tbl_roles::all();
        return view('usuarios.editar_usuario', compact('usuario', 'roles'));
    }




    public function update(Request $request, tbl_usuarios $usuario)
    {

        $user = $usuario::select('cedula', 'email_user')
            ->where('id_user', '!=', $request->id_user)
            ->get();
        // 987456321 jecatro648@misena.edu.co

        for ($i = 0; $i < count(array($user)); $i++) {
            if ($request->cedula == $user[$i]->cedula || $request->email == $user[$i]->email_user) {
                $info =  'La cedúla y el email ya estan en uso.';
                if ($request->cedula == $user[$i]->cedula && $request->email == $user[$i]->email_user) {
                    $info =  'La cedúla y el email ya estan en uso.';
                    return redirect()->route('ver_usuario')->with('error', $info);
                    break;
                    die();
                }
                if ($request->cedula == $user[$i]->cedula) {
                    $info = 'La cédula ' . $request->cedula . ' ya está en uso.';
                    return redirect()->route('ver_usuario')->with('error', $info);
                    break;
                    die();
                }
                if ($request->email == $user[$i]->email_user) {
                    $info = 'El email ' . $request->email . 'ya está en uso.';
                    return redirect()->route('ver_usuario')->with('error', $info);
                    break;
                    die();
                }
                return redirect()->route('ver_usuario')->with('error', $info);
                break;
                die();
            }
        }

        $request->validate([
            'cedula' => 'required|max:10',
            'email' => 'required|max:30|email',
            'contraseña' => 'required|max:20',
            'nombres' => 'required|max:50',
            'apellidos' => 'required|max:50',
            'fecha' => 'required|max:50|date',
            'telefono' => 'required|max:10',
            'direccion' => 'required|max:20',
            'rol' => 'required|max:20',
        ]);


        $usuario->cedula = $request->cedula;
        $usuario->email_user = $request->email;
        $usuario->contraseña_user = $request->contraseña;
        $usuario->nom_user = $request->nombres;
        $usuario->apellidos_user = $request->apellidos;
        $usuario->fecha_ingreso = $request->fecha;
        $usuario->telefono_user = $request->telefono;
        $usuario->direccion_user = $request->direccion;
        $usuario->cod_rol = $request->rol;
        $usuario->save();
        session()->flash('actualizado', 'El usuario a sido editado con exito');
        return redirect()->route('ver_usuario')->with('actualizado', $user[0]->cedula);
        return view('usuarios.editar_usuario', compact('usuario'));
    }

    public function destroy(tbl_usuarios $usuario)
    {
        $usuario->delete();

        return back()->with('destroy', 'El usuario a sido eliminado correctamente');
    }
}
