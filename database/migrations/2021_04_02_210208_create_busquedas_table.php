<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusquedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('busquedas', function (Blueprint $table) {
            $table->increments('busqueda_id');
            $table->string('name');
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('perfil_id')->on('perfiles');
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
        Schema::dropIfExists('busquedas');
    }
}
