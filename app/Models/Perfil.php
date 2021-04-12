<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
	// Nombre de la tabla en MySQL
    protected $table = 'perfiles';
    protected $primaryKey = 'perfil_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('name', 'documento', 'fecha_nac', 'phone', 'email', 'estado', 'municipio', 'direccion', 'path_imagen', 'saldo');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 


	 // Relación de Perfil con User
    public function user()
    {
        // 1 perfil pertenece a un user.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\User');
    }

    // Relación de Perfil con Transaccion
    public function transacciones()
    {
        // 1 Perfil puede tener muchas Transacciones.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Transaccion');
    }

    // Relación de Perfil con Busqueda
    public function busquedas()
    {
        // 1 Perfil puede tener muchas Busquedas.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Busqueda');
    }

    // Relación de Perfil con Recarga
    public function recargas()
    {
        // 1 Perfil puede tener muchas Recarga.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Recarga');
    }

    // Relación de Perfil con Visitas
    public function visitas()
    {
        // 1 Perfil puede tener muchas Visitas.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Visita');
    }
}
