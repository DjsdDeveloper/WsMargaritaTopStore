<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('recargas', function (Blueprint $table) {
            $table->increments('recarga_id');
            $table->string('tipo');
            $table->string('banco_emisor');
            $table->string('referencia');
            $table->float('monto');
            $table->string('fecha');
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
        Schema::dropIfExists('recargas');
    }
}
