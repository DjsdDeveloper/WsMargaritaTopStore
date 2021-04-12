<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'roles';
    protected $primaryKey = 'rol_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('rol');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 


	// Relación de Rol con User
    public function users()
    {
        // 1 rol pertenece a varios user.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsToMany('App\Models\User');
    }
}
