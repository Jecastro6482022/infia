<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\peliculas;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{

    public function create()
    {
        return view('peliculas.registrar_pelicula');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelicula' => 'required',
            'id_categoria' => 'required',
            'id_autor' => 'required',
            'nombre' => 'required',
            'fecha' => 'required',
            'productora' => 'required|max:50'
        ]);
        // Getting values from the blade template form
        $pelicula = new peliculas([
            'id_pelicula' => $request->get('id_pelicula'),
            'id_categoria' => $request->get('id_categoria'),
            'id_autor' => $request->get('id_autor'),
            'nombre' => $request->get('nombre'),
            'fecha_lanzamiento' => $request->get('fecha'),
            'productora' => $request->get('productora'),
        ]);
        try {

            $pelicula->save();
            return redirect()->route('peliculas.index')->with('Guardado', ' Se registro el pelicula ' . $request->nombre);          
          } catch (\Exception $e) {
          
            return redirect()->route('peliculas.create')->with('Error', 'no se pudo registrar la pelicula, asegurese de que el id de la categoria o autor existan.');          

          }

        
    }
    // Retorno de tablas y selact
    public function index(peliculas $peliculasModel)
    {
        $peliculas = $peliculasModel::all();
        return view('peliculas.pelicula', compact('peliculas'));
    }
    public function show($id)
    {
        //
    }

    public function edit($peliculaEdit)
    {
        $id = $peliculaEdit;
        $pelicula = peliculas::find($id);
        return view('peliculas.edit_pelicula', compact('pelicula', 'id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pelicula' => 'required',
            'id_categoria' => 'required',
            'id_autor' => 'required',
            'nombre' => 'required|max:50',
            'fecha' => 'required|max:50',
            'nombre' => 'required|max:50',
        ]);

        $peliculas = peliculas::find($id);
        $peliculas->id_pelicula = $request->get('id_pelicula');
        $peliculas->id_categoria = $request->get('id_categoria');
        $peliculas->id_autor = $request->get('id_autor');
        $peliculas->nombre =  $request->get('nombre');
        $peliculas->fecha_lanzamiento =  $request->get('fecha');
        $peliculas->productora =  $request->get('productora');
        $peliculas->save();

        return redirect()->route('peliculas.index')->with('Actualizado', 'pelicula Actualizado.');
    }
    public function destroy($id)
    {
        $peliculas = peliculas::find($id);
        $peliculas->delete();
        return redirect()->route('peliculas.index')->with('destroy', ' pelicula con id ' . $id . ' Eliminado.');
    }
}
