<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'imagenes';
    protected $primaryKey = 'imagen_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('path', 'producto_id');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 

	// Relación de Imagen con Producto
    public function producto()
    {
        // 1 imagen pertenece a un producto.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Producto');
    }
}
