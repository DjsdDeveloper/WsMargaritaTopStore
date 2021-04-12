<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Nombre de la tabla en MySQL
    protected $table = 'productos';
    protected $primaryKey = 'producto_id';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable = array('name', 'descripcion', 'price_dolar', 'price_bs', 'stock', 'tienda_id', 'categoria_id');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 

    // Relación de Producto con Tienda
    public function tienda()
    {
        // 1 producto pertenece a una tienda.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Tienda');
    }

    // Relación de Producto con Categoria
    public function categoria()
    {
        // 1 producto pertenece a una categoria.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsTo('App\Models\Categoria');
    }

    // Relación de Producto con Imagen
    public function imagenes()
    {
        // 1 Producto tiene muchas imagenes.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->hasMany('App\Models\Imagen');
    }    

    // Relación de Producto con Transaccion
    public function transacciones()
    {
        // 1 Producto puede estar en muchas Transacciones.
        // $this hace referencia al objeto que tengamos en ese momento de Avión.
        return $this->belongsToMany('App\Models\Transaccion');
    }
}
