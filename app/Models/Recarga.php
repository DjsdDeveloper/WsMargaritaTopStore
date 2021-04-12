<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recarga extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'recargas';
    protected $primaryKey = 'recarga_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('tipo', 'banco_emisor', 'referencia', 'monto', 'fecha', 'perfil_id');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];	

    // Relación de Recarga con Perfil
    public function perfil()
    {
        // 1 Recarga pertenece a um Perfil.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Perfil');
    }
}
