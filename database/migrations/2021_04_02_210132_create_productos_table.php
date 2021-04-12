<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('producto_id');
            $table->string('name');
            $table->string('descripcion');
            $table->float('price_dolar');
            $table->float('price_bs');
            $table->integer('stock');
            $table->unsignedInteger('tienda_id');
            $table->foreign('tienda_id')->references('tienda_id')->on('tiendas');
            $table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')->references('categoria_id')->on('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
