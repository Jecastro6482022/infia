<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'autores',
            'categorias',
        ]);

        $this->call(autoresseedr::class);
        $this->call(categoriasseedr::class);
        
    }

    protected function truncateTables(array $tables){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }       
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
