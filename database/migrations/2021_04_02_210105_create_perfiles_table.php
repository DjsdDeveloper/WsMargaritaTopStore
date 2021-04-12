<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('perfiles', function (Blueprint $table) {
            $table->increments('perfil_id');
            $table->string('name');
            $table->string('documento');
            $table->string('fecha_nac');
            $table->string('phone');
            $table->string('email');
            $table->string('estado');
            $table->string('municipio');
            $table->string('direccion');
            $table->string('path_imagen')->nullable();
            $table->float('saldo')->nullable();
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
        Schema::dropIfExists('perfiles');
    }
}
