<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Busqueda extends Model
{
     // Nombre de la tabla en MySQL
    protected $table = 'busquedas';
    protected $primaryKey = 'busqueda_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('name', 'perfil_id');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];	

    // Relación de Busqueda con Perfil
    public function perfil()
    {
        // 1 Busqueda pertenece a um Perfil.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Perfil');
    }
}
