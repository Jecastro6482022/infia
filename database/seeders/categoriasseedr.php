<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriasseedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'id_categoria'=>'1',
            'nombre'=>'acción',
        ]);
        DB::table('categorias')->insert([
            'id_categoria'=>'2',
            'nombre'=>'terror',
        ]);
        DB::table('categorias')->insert([
            'id_categoria'=>'3',
            'nombre'=>'prueba',
           
        ]);
    }
}