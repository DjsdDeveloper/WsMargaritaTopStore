<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('transacciones', function (Blueprint $table) {
            $table->increments('transaccion_id');
            $table->integer('cantidad');
            $table->string('referencia');
            $table->float('total');    
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('perfil_id')->on('perfiles');
            $table->unsignedInteger('producto_id');
            $table->foreign('producto_id')->references('producto_id')->on('productos');
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
        Schema::dropIfExists('transacciones');
    }
}
