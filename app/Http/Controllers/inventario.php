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

        $inventario = tbl_inventarios::all();

        return view('inventarios.inventarios', compact('inventario'));
    }

   }
