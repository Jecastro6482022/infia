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
        Schema::create('tbl_facturas', function (Blueprint $table) {
            $table->integer('id',10);
            $table->integer('num_factura');
            $table->integer('id_total')->nullable();
            $table->date('fecha');
            $table->String('tipo_factura', 20);
            $table->double('valor_unitario');
            $table->double('cantidad');
            $table->String('descripcion', 150);
            $table->integer('cod_articulo');
            $table->integer('nit_empresa')->nullable();
            $table->integer('id_user')->nullable();
            $table->timestamps();
        });
        Schema::table('tbl_facturas', function (Blueprint $table) {
            $table->foreign('id_total')->references('id')->on('tbl_totalfactura')->onDelete('cascade');
            $table->foreign('cod_articulo')->references('cod_articulo')->on('tbl_articulos')->onDelete('cascade');
            $table->foreign('nit_empresa')->references('nit_empresa')->on('tbl_empresas')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('tbl_usuarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_facturas');
    }
};
