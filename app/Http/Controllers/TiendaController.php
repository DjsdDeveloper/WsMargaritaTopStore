<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Rol;
use App\Models\Perfil;
use App\Models\Busqueda;
use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Producto;
use App\Models\Recarga;
use App\Models\Tienda;
use App\Models\Transaccion;
use App\Models\Visita;
use DB;

class TiendaController extends Controller
{
    //Metodo para obtener todas las tiendas registrados en la tabla tienda
    public function GetAllTiendas()
    {
    	$tiendas = Tienda::all();
    	return $tiendas;
    }

    //Metodo para agregar una nueva Tienda
    public function PostAddTienda(Request $request)
    {
    	$tienda = Tienda::create($request->all());
    	return $tienda;
    }

    //Metodo para buscar un Tienda y mostrar su imagen
    public function GetImagenTienda($id){
        $tienda = Tienda::find($id);
        $imagen = url("/fotografias/{$tienda->path_imagen}");

        return response()->json(['path_imagen'=>$imagen]);
    }

    //Metodo para buscar un Tienda por su id
    public function GetTiendaId($id){
    	$tienda = Tienda::find($id);
    	return $tienda;
    }

    //Metodo para editar una Tienda por su id
    public function EditTiendaId($id, Request $request){
    	$tienda = $this->GetTiendaId($id);
    	$tienda->fill($request->all())->save();
    	return $tienda;
    }

    //Metodo para eliminar una Tienda por su id
    public function DeleteTiendaId($id){
    	$tienda = $this->GetTiendaId($id);
    	$tienda->delete();
    	return $tienda;
    }
}
