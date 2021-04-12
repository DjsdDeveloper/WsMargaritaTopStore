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

class RolesController extends Controller
{
    //Metodo para obtener todos los Roles registrados en la tabla roles
    public function GetAllRoles()
    {
        $roles = Rol::all();
        return $roles;
    }
    
    //Metodo para agregar un nuevo Rol
    public function PostAddRol(Request $request)
    {
        // //Validaciones tipo Laravel
        // $this->validate($request, [
        //     'rol' => 'required|unique|max:255',
        //     'item_name' => 'required|max:255',
        //     'sku_no' => 'required|alpha_num',
        //     'price' => 'required|numeric',
        // ]);

        $roles = Rol::create($request->all());
        return $roles;
        //return $request->input('rol');
    }

    //Metodo para buscar un Rol por su id
    public function GetRolId($id){
        $roles = Rol::find($id);
        return $roles;
    }

    //Metodo para editar un Rol por su id
    public function EditRolId($id, Request $request){
        $roles = $this->GetRolId($id);
        $roles->fill($request->all())->save();
        return $roles;
    }

    //Metodo para eliminar un Rol por su id
    public function DeleteRolId($id){
        $roles = $this->GetRolId($id);
        $roles->delete();
        return $roles;
    }
}
