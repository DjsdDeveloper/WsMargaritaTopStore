<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('rol_id')->unsigned();
            $table->foreign('rol_id')->references('rol_id')->on('roles'); 
            $table->unsignedInteger('perfil_id')->nullable();
            $table->foreign('perfil_id')->references('perfil_id')->on('perfiles'); 
            $table->unsignedInteger('tienda_id')->nullable();
            $table->foreign('tienda_id')->references('tienda_id')->on('tiendas');           
            $table->rememberToken();
            $table->timestamps();
            $table->string('api_token')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
