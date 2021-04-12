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

class UserController extends Controller
{
	//Metodo para obtener todos los usuarios registrados en la tabla User
    public function GetAllUser()
    {
    	$users = User::all();
    	return $users;
    }

    //Metodo para verifiar si existe el username
    public function ComprobarUsername($username)
    {
        $ExisteUsername = DB::table('users')->where('username',$username)->first();
        return $ExisteUsername;
    }

    //Metodo para agregar un nuevo usuario con su Rol
    //Utilizado solo por Administradores
    public function PostAddUser(Request $request){

        // Comprobamos que recibimos todos los campos.
        if (!$request->input('username') || !$request->input('password') || !$request->input('rol'))
        {
            // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos para procesar el registro.'])],422);
        }

        // $username = $request->input('username');
        // $ExisteUsername = DB::table('users')->where('username',$username)->first();

        if ($this->ComprobarUsername($request->input('username'))) {
            return response()->json(['errors'=>array(['code'=>409,'message'=>'El nombre de usuario se encuentra en uso.'])],409);
        }

        if ($request->input('rol') == 'Administrador') {
            $rolId = 1; 
        }

        if ($request->input('rol') == 'Store') {
            $rolId = 2; 
        }

        if ($request->input('rol') == 'User') {
            $rolId = 3; 
        }

        $NewUser = [
            'username' => $request->input('username'),
            'password'=> Hash::make($request->input('password')),   //Cifrado de la contraseña abc123
            'rol_id' => $rolId
        ];

        $user = User::create($NewUser);

    	return $user;
    }

    //Metodo para buscar un usuario por su id
    public function GetUserId($id){
    	$user = User::find($id);
    	return $user;
    }

    //Metodo para editar un usuario por su id
    public function EditUserId($id, Request $request){
    	$user = $this->GetUserId($id);
    	$user->fill($request->all())->save();
    	return $user;
    }

    //Metodo para eliminar un usuario por su id
    public function DeleteUserId($id){
    	$user = $this->GetUserId($id);
    	$user->delete();
    	return $user;
    }      

    //Metodo para agregar un nuevo usuario Perfil y Rol
    public function PostNewUserPerfil(Request $request)
    {
        // Comprobamos que recibimos todos los campos.
        if (!$request->input('name') || !$request->input('documento') || !$request->input('fecha_nac') || !$request->input('email') || !$request->input('estado') || !$request->input('municipio') || !$request->input('direccion') || !$request->input('username') || !$request->input('password') || !$request->input('rol'))
        {
            // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos para procesar el registro.'])],422);
        }

        if ($this->ComprobarUsername($request->input('username'))) {
            return response()->json(['errors'=>array(['code'=>409,'message'=>'El nombre de usuario se encuentra en uso.'])],409);
        }

        // if ($request->input('rol') == 'Administrador') {
        //     $rolId = 1; 
        // }

        // if ($request->input('rol') == 'Store') {
        //     $rolId = 2; 
        // }

        if ($request->input('rol') == 'User') {
            $rolId = 3; 
        }

        $NewPerfil = [
            'name' => $request->input('name'),
            'documento' => $request->input('documento'),
            'fecha_nac' => $request->input('fecha_nac'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'estado' => $request->input('estado'),
            'municipio' => $request->input('municipio'),
            'direccion' => $request->input('direccion'),
        ];

        $perfiles = Perfil::create($NewPerfil);


        $NewUser = [
            'username' => $request->input('username'),
            //'password' => $request->input('password'),
            'password'=> Hash::make($request->input('password')),   //Cifrado de la contraseña abc123
            'rol_id' => $rolId,
            'perfil_id' => $perfiles->perfil_id,
            //'tienda_id' => true,
        ];
        //return $NewUser;
        $user = User::create($NewUser);

        $rol = Rol::find($user->rol_id);

        $DataUser = [
            'user_id'=> $user->user_id,
            'username' => $user->username,
            'password' => $user->password,
            'rol' => $rol,
            'perfil' => $perfiles
        ];

        return response()->json($DataUser);


        //$perfiles = Perfil::create($request->all());

        //return response()->json(array(
            //'peril' => $perfiles,
            //'user' => $user));

        //return $perfiles;
    }      

    public function PostNewTienda(Request $request)
    {
        // Comprobamos que recibimos todos los campos.
        if (!$request->input('name') || !$request->input('documento') || !$request->input('email') || !$request->input('estado') || !$request->input('municipio') || !$request->input('direccion') || !$request->input('phone'))
        {
            // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos para procesar el registro.'])],422);
        }

        $input = $request->all();
        if ($request->has('path_imagen'))
            $input['path_imagen'] = $this->cargarFoto($request->path_imagen);

        //Se guarda la informaion de la tienda
        $NewTienda = [
            'name' => $request->input('name'),
            'documento' => $request->input('documento'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'estado' => $request->input('estado'),
            'municipio' => $request->input('municipio'),
            'direccion' => $request->input('direccion'),
            'path_imagen' => $input['path_imagen']
        ];

        $tienda = Tienda::create($NewTienda);

        //Se busca la informacion del usuario al que pertenece la tienda creada
        $user = $this->GetUserId($request->input('user_id'));

        if ($user) {
            $user->tienda_id = $tienda->tienda_id;
        }

        $user->save();

        $rol = Rol::find($user->rol_id);

        $DataUser = [
            'user_id'=> $user->user_id,
            'username' => $user->username,
            'password' => $user->password,
            'rol' => $rol,
            'tienda' => $tienda
        ];

        return response()->json($DataUser);

        //return response()->json(['status'=>'ok','data'=>$tienda],200);

        // $NewUser = [
        //     'username' => $request->input('username'),
        //     //'password' => $request->input('password'),
        //     'password'=> Hash::make($request->input('password')),   //Cifrado de la contraseña abc123
        //     'rol_id' => $rolId,
        //     'perfil_id' => $perfiles->perfil_id,
        //     //'tienda_id' => true,
        // ];
        // //return $NewUser;
        // $user = User::create($NewUser);


        //$perfiles = Perfil::create($request->all());

        //return response()->json(array(
            //'peril' => $perfiles,
            //'user' => $user));

        //return $tienda;
    }  

    private function cargarFoto($file)
    {
        $nombreArchivo = time() . "." . $file->getClientOriginalExtension();
        $file->move(base_path('/public/fotografias'), $nombreArchivo);
        return $nombreArchivo;
    }

    //Metodo para agregar un nuevo usuario en la tabla User con su Perfil y Rol
    // public function PostNewUser(Request $request)
    // {
    //     // Comprobamos que recibimos todos los campos.
    //     if (!$request->input('name') || !$request->input('documento') || !$request->input('fecha_nac') || !$request->input('email') || !$request->input('estado') || !$request->input('municipio') || !$request->input('direccion') || !$request->input('username') || !$request->input('password') || !$request->input('rol'))
    //     {
    //         // NO estamos recibiendo los campos necesarios. Devolvemos error.
    //         return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos para procesar el registro.'])],422);
    //     }

    //     if ($request->input('rol') == 'Administrador') {
    //         $rolId = 1; 
    //     }

    //     if ($request->input('rol') == 'Store') {
    //         $rolId = 2; 
    //     }

    //     if ($request->input('rol') == 'User') {
    //         $rolId = 3; 
    //     }

    //     $NewPerfil = [
    //         'name' => $request->input('name'),
    //         'documento' => $request->input('documento'),
    //         'fecha_nac' => $request->input('fecha_nac'),
    //         'phone' => $request->input('phone'),
    //         'email' => $request->input('email'),
    //         'estado' => $request->input('estado'),
    //         'municipio' => $request->input('municipio'),
    //         'direccion' => $request->input('direccion'),
    //     ];

    //     $perfiles = Perfil::create($NewPerfil);


    //     $NewUser = [
    //         'username' => $request->input('username'),
    //         //'password' => $request->input('password'),
    //         'password'=> Hash::make($request->input('password')),   //Cifrado de la contraseña abc123
    //         'rol_id' => $rolId,
    //         'perfil_id' => $perfiles->perfil_id,
    //         //'tienda_id' => true,
    //     ];
    //     //return $NewUser;
    //     $user = User::create($NewUser);


    //     //$perfiles = Perfil::create($request->all());

    //     //return response()->json(array(
    //         //'peril' => $perfiles,
    //         //'user' => $user));

    //     return $perfiles;
    // }  
}
