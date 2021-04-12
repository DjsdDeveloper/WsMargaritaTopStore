<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'visitas';
    protected $primaryKey = 'visita_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('perfil_id', 'tienda_id');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];		

    // Relación de Visita con Perfil
    public function perfil()
    {
        // 1 Visita pertenece a um Perfil.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Perfil');
    }

    // Relación de Visita con Tienda
    public function tienda()
    {
        // 1 Visita pertenece a una Tienda.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Tienda');
    }
}
