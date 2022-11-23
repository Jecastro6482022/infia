<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_registros', function (Blueprint $table) {
            $table->integer('cod_registro',10);
            $table->String('tipo', 20);
            $table->Integer('cantidad');
            $table->String('causal', 100);
            $table->integer('num_factura')->nullable();
            $table->integer('cod_articulo')->nullable();
            $table->timestamps();
        });
        Schema::table('tbl_registros', function (Blueprint $table) {
            $table->foreign('num_factura')->references('id')->on('tbl_facturas')->onDelete('cascade');
            $table->foreign('cod_articulo')->references('cod_articulo')->on('tbl_articulos')->onDelete('set null');

        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_registros');
    }
};
