<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'tiendas';
    protected $primaryKey = 'tienda_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('name', 'documento', 'phone', 'email', 'estado', 'municipio', 'direccion', 'path_imagen');           

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 

	// Relación de Tienda con User
    public function user()
    {
        // 1 tienda pertenece a un user.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\User');
    }

    // Relación de Tienda con Producto
    public function productos()
    {
        // 1 Tienda puede tener muchos productos.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Producto');
    }

    // Relación de Tienda con Visita
    public function visitas()
    {
        // 1 Tienda puede tener muchos Visita.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Visita');
    }
}
