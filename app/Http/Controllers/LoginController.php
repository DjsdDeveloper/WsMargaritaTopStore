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
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        //Se validan los campos de entrada
        if (!$request->input('username') || !$request->input('password'))
        {
            // NO estamos recibiendo los campos necesarios. Devolvemos error.
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos para procesar el registro.'])],422);
        }

        $username = $request->input('username');
        $password = $request->input('password');

        // //Se obtienen los datos del usuario por su username y su password
        // $user = DB::table('users')->where('username',$username)->where('password',$password)->first();

        //Se obtienen los datos del usuario por su username unico
        $user = DB::table('users')->where('username',$username)->first();

        //Se verifica si existe un usuario con ese username y en dado caso si las contraseñas con Hash son iguales
        if ($user && Hash::check( $password, $user->password)) 
        {
	        //Se obtiene la informacion del Rol y su Perfil
	        $rol = Rol::find($user->rol_id);
	        $perfil = Perfil::find($user->perfil_id);

         //    $user->api_token = Str::random(length: 150);
         //    $user->save();

	        // //Se arma un Objeto con la informacion a devolver
	        // $DataUser = [
	        //     'user_id'=> $user->user_id,
	        //     'username' => $user->username,
	        //     'password' => $user->password,
         //        'api_token' => $user->api_token,
	        //     'rol' => $rol,
	        //     'perfil' => $perfil
	        // ];

            //Se agrega el token de sesion al usuario logueado en la tabla USer
            $token = Str::random(length: 150);
            $user = DB::table('users')->where('username',$username)->update(['api_token' => $token]);
            $user = DB::table('users')->where('username',$username)->first();

	        //NOTA: Esta consulta devuelve uns lista de coincidencias segun un parametro
	        //$user = DB::table('users')->where('rol_id',1)->get();

	        //Se retorna un Json con la informacion
	        return response()->json(['api_token'=>$user->api_token]);
		}
		else 
		{
		    return response()->json(['errors'=>array(['code'=>404,'message'=>'No existe el usuario.'])],404);
		}

		

        // //Si la consulta devuelva vacio o null, envia mensaje de error
        // if (!$user) {
        //     return response()->json(['errors'=>array(['code'=>401,'message'=>'No existe el usuario.'])],422);
        // }
    }

    public function logout()
    {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();

        return response()->json(['Success'=>array(['code'=>200,'message'=>'Success logout'])],200);
    }
}
