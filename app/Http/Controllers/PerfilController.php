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

class PerfilController extends Controller
{
    //Metodo para obtener todos los perfiles registrados en la tabla perfil
    public function GetAllPerfiles()
    {
    	$perfiles = Perfil::all();
    	return $perfiles;
    }

    //Metodo para agregar un nuevo Rol
    public function PostAddPerfil(Request $request)
    {
    	$perfiles = Perfil::create($request->all());
    	return $perfiles;
    }

    //Metodo para buscar un Rol por su id
    public function GetPerfilId($id){
    	$perfiles = Perfil::find($id);
    	return $perfiles;
    }

    //Metodo para editar un Rol por su id
    public function EditPerfilId($id, Request $request){
    	$perfiles = $this->GetPerfilId($id);
    	$perfiles->fill($request->all())->save();
    	return $perfiles;
    }

    //Metodo para eliminar un Rol por su id
    public function DeletePerfilId($id){
    	$perfiles = $this->GetPerfilId($id);
    	$perfiles->delete();
    	return $perfiles;
    }
}
