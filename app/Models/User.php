<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //Nombre de la tabla en MySQL
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('username', 'password', 'rol_id', 'perfil_id', 'tienda_id', 'api_token');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 


	// Relación de User con Perfil
    public function perfil()
    {
        // 1 User tiene un Perfil.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasOne('App\Models\Perfil');
    }

    // Relación de User con Roles
    public function rol()
    {
        // 1 User tiene un Rol.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasOne('App\Models\Rol');
    }

    // Relación de User con Tienda
    public function tienda()
    {
        // 1 User puede tener una Tienda.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasOne('App\Models\Tienda');
    }
}
