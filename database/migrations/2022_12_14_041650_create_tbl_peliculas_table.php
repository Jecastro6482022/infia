|1 <?php

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
            Schema::create('peliculas', function (Blueprint $table) {

                $table->id();
                $table->integer('id_pelicula');
                $table->unsignedBigInteger('id_autor')->unsigned();
                $table->unsignedBigInteger('id_categoria')->unsigned();
                $table->string('nombre', 120);
                $table->date('fecha_lanzamiento');
                $table->string('productora');
            });
            Schema::table('peliculas', function(Blueprint $table)
            {
                $table->foreign('id_autor')->references('id')->on('autores');
                $table->foreign('id_categoria')->references('id')->on('categorias');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('peliculas');
        }
    };
