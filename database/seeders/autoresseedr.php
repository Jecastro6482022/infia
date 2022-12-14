<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class autoresseedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('autores')->insert([
            'id_autor'=>'13',
            'nombre'=>'David Yates',
        ]);
        DB::table('autores')->insert([
            'id_autor'=>'22',
            'nombre'=>'Chris Colombus ',
        ]);
        DB::table('autores')->insert([
            'id_autor'=>'31',
            'nombre'=>'Alfonso Cuarón',
           
        ]);
    }
}