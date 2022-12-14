<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\autores;
use Illuminate\Http\Request;

class AutoresController extends Controller
{
   
    public function create()
    {
        return view('autores.registrar_autor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_autor'=>'required',
            'nombre'=>'required|max:50'
        ]); 
        // Getting values from the blade template form
        $autor = new autores([
            'id_autor' => $request->get('id_autor'),
            'nombre' => $request->get('nombre')
        ]);
        
        if($autor->save()):
            return redirect()->route('autores.index')->with('Guardado', ' Se registro el autor '.$request->nombre);
        endif;
        
        
    }
    // Retorno de tablas y selact
    public function index(autores $autoresModel)
    {   
          $autores= $autoresModel::all();
        return view('autores.autor', compact('autores'));
    }
    public function show($id)
    {
        //
    }

    public function edit($autorEdit)
    {   
        $id = $autorEdit;
        $autor = autores::find($id); 
        return view('autores.edit_autor',compact('autor','id'));
      
    }

    public function update(Request $request,$id)
    {   
        $request->validate([
            'id_autor'=>'required',
            'nombre'=>'required|max:50'
        ]); 

        $autores = autores::find($id);
        $autores->id_autor = $request->get('id_autor');
        $autores->nombre =  $request->get('nombre');
        $autores->save();
 
        return redirect()->route('autores.index')->with('Actualizado', 'Autor Actualizado.');
        
}
    public function destroy($id)
    {
         $autores = autores::find($id);
        $autores->delete();
        return redirect()->route('autores.index')->with('destroy', ' Autor con id '. $id .' Eliminado.');
    }
}
