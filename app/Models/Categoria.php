<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'categorias';
    protected $primaryKey = 'categoria_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('name');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 

	// Relación de categoria con producto
    public function productos()
    {
        // 1 categoria tiene muchos productos.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Producto');
    }
}
