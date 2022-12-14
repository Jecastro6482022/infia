<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
   
    public function create()
    {
        return view('categorias.registrar_categoria');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_categoria'=>'required',
            'nombre'=>'required|max:50'
        ]); 
        // Getting values from the blade template form
        $categoria = new categorias([
            'id_categoria' => $request->get('id_categoria'),
            'nombre' => $request->get('nombre')
        ]);
        
        if($categoria->save()):
            return redirect()->route('categorias.index')->with('Guardado', ' Se registro el categoria '.$request->nombre);
        endif;
        
        
    }
    // Retorno de tablas y selact
    public function index(categorias $categoriaesModel)
    {   
          $categorias= $categoriaesModel::all();
        return view('categorias.categoria', compact('categorias'));
    }
    public function show($id)
    {
        //
    }

    public function edit($categoriaEdit)
    {   
        $id = $categoriaEdit;
        $categoria = categorias::find($id); 
        return view('categorias.edit_categoria',compact('categoria','id'));
      
    }

    public function update(Request $request,$id)
    {   
        $request->validate([
            'id_categoria'=>'required',
            'nombre'=>'required|max:50'
        ]); 

        $categorias = categorias::find($id);
        $categorias->id_categoria = $request->get('id_categoria');
        $categorias->nombre =  $request->get('nombre');
        $categorias->save();
 
        return redirect()->route('categorias.index')->with('Actualizado', 'categoria Actualizado.');
        
}
    public function destroy($id)
    {
         $categorias = categorias::find($id);
        $categorias->delete();
        return redirect()->route('categorias.index')->with('destroy', ' categoria con id '. $id .' Eliminado.');
    }
}
