<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('visitas', function (Blueprint $table) {
            $table->increments('visita_id');
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('perfil_id')->on('perfiles');
            $table->unsignedInteger('tienda_id');
            $table->foreign('tienda_id')->references('tienda_id')->on('tiendas');
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
        Schema::dropIfExists('visitas');
    }
}
