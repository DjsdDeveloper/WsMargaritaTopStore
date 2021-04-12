<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'transacciones';
    protected $primaryKey = 'transaccion_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('cantidad', 'referencia', 'total', 'perfil_id', 'producto_id');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];

	// Relación de Transaccion con Perfil
    public function perfil()
    {
        // 1 Transaccion pertenece a un Perfil.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Perfil');
    } 

    // Relación de Transaccion con Producto
    public function troducto()
    {
        // 1 Transaccion puede tener un Producto.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasOne('App\Models\Producto');
    }
}
