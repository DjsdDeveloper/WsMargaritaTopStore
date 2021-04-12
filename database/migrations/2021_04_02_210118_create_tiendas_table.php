<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('tiendas', function (Blueprint $table) {
            $table->increments('tienda_id');
            $table->string('name');
            $table->string('documento');
            $table->string('phone');
            $table->string('email');
            $table->string('estado');
            $table->string('municipio');
            $table->string('direccion');
            $table->string('path_imagen')->nullable();
            $table->float('tasa')->nullable();
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
        Schema::dropIfExists('tiendas');
    }
}
