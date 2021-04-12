<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// $router->get('/categories', 'CategoriesController@index');
// $router->get('/categories/{id}', 'CategoriesController@getCategories');
// $router->post('/categories', 'CategoriesController@createCategories');
// $router->put('/categories/{id}', 'CategoriesController@updateCategories');
// $router->delete('/categories/{id}', 'CategoriesController@destroyCategories');

// $router->post('users', 'UserController@PostAddUser')->name('AddUser');

//--------------------------------------LOGIN---------------------------------------------------//
	//Login por username y password
	$router->post('/login', 'LoginController@login');

//-------------------------------------END LOGIN------------------------------------------------//

//--------------------------------------USERS---------------------------------------------------//
	//Agrega un nuevo usuario con su perfil y su rol
	$router->post('/users/perfil', 'UserController@PostNewUserPerfil');

	//Agrega un nuevo usuario en la tabla User
	//NOTA: Utilizada solo por Administradores. Se registra solo username, password y rol del usuario
	$router->post('/users', 'UserController@PostAddUser');
//-------------------------------------END USERS------------------------------------------------//



//Las rutas dentro de este Group necesitan el token, es decir, necesitan estar logueados para poder accederlas
$router->group(['middleware' => 'auth'], function () use ($router) 
{
	//------------------------------------------ROLE------------------------------------------------//
		//Obtiene todos los roles registrados en la tabla Rol
		$router->get('/rol', 'RolesController@GetAllRoles');		

		//Agrega un nuevo usuario en la tabla User
		$router->post('/rol', 'RolesController@PostAddRol');

		//Buscar un usuario por su id en la tabla User
		$router->get('/rol/{id}', 'RolesController@GetRolId');

		//Editar un usuario por su id en la tabla User
		$router->put('/rol/{id}', 'RolesController@EditRolId');

		//Eliminr un usuario por su id en la tabla User
		$router->delete('/rol/delete/{id}', 'RolesController@DeleteRolId');
	//---------------------------------------END ROLES----------------------------------------------//

	//--------------------------------------USERS---------------------------------------------------//
		//Obtiene la informacion del usuario Autenticado segun su token
		$router->get('/user/authenticate', function () use ($router) {
			return auth()->user();
		});

		//Obtiene todos los usuarios registrados en la tabla User
		$router->get('/users', 'UserController@GetAllUser');

		//Buscar un usuario por su id en la tabla User
		$router->get('/users/{id}', 'UserController@GetUserId');

		//Editar un usuario por su id en la tabla User
		$router->put('/users/{id}', 'UserController@EditUserId');

		//Eliminr un usuario por su id en la tabla User
		$router->delete('/users/delete/{id}', 'UserController@DeleteUserId');

		// //Agrega un nuevo usuario en la tabla User con su Perfil y Rol
		// $router->post('/users/new', 'UserController@PostNewUser');

		//Agrega la informacion de la tienda de un usuario (tienda) registrado pues solo se encuentra guardado sus credenciales
		$router->post('/users/tienda', 'UserController@PostNewTienda');
	//-------------------------------------END USERS------------------------------------------------//

	//------------------------------------------PERFIL----------------------------------------------//
		//Obtiene todos los roles registrados en la tabla Rol
		$router->get('/perfil', 'PerfilController@GetAllPerfiles');

		//Agrega un nuevo usuario en la tabla User
		$router->post('/perfil', 'PerfilController@PostAddPerfil');

		//Buscar un usuario por su id en la tabla User
		$router->get('/perfil/{id}', 'PerfilController@GetPerfilId');

		//Editar un usuario por su id en la tabla User
		$router->put('/perfil/{id}', 'PerfilController@EditPerfilId');

		//Eliminr un usuario por su id en la tabla User
		$router->delete('/perfil/delete/{id}', 'PerfilController@DeletePerfilId');
	//---------------------------------------END PERFIL---------------------------------------------//

	//------------------------------------------TIENDA----------------------------------------------//
		//Obtiene todos los roles registrados en la tabla Rol
		$router->get('/tienda', 'TiendaController@GetAllTiendas');

		//Agrega un nuevo usuario en la tabla User
		$router->post('/tienda', 'TiendaController@PostAddTienda');

		//Buscar un usuario por su id en la tabla User
		$router->get('/tienda/{id}', 'TiendaController@GetTiendaId');

		//Metodo para buscar un Tienda y mostrar su imagen
		$router->get('/tienda/imagen/{id}', 'TiendaController@GetImagenTienda');

		//Editar un usuario por su id en la tabla User
		$router->put('/tienda/{id}', 'TiendaController@EditTiendaId');

		//Eliminr un usuario por su id en la tabla User
		$router->delete('/tienda/delete/{id}', 'TiendaController@DeleteTiendaId');
	//---------------------------------------END TIENDA---------------------------------------------//
	
	//------------------------------------------PRODUCTOS-------------------------------------------//
		//Obtiene todos los productos
		$router->get('/productos', 'ProductoController@GetAllProductos');

		//Obtiene una lista de productos paginados
		$router->get('/productos', 'ProductoController@GetPaginationProductos');

		// //Agrega un nuevo usuario en la tabla User
		// $router->post('/productos', 'ProductoController@PostAddPerfil')->name('AddPerfil');

		// //Buscar un usuario por su id en la tabla User
		// $router->get('/productos/{id}', 'ProductoController@GetPerfilId')->name('SearchPerfil');

		// //Editar un usuario por su id en la tabla User
		// $router->put('/productos/{id}', 'ProductoController@EditPerfilId')->name('EditPerfil');

		// //Eliminr un usuario por su id en la tabla User
		// $router->delete('/productos/delete/{id}', 'ProductoController@DeletePerfilId')->name('DeletePerfil');
	//---------------------------------------END ROLES----------------------------------------------//

	//--------------------------------------------LOGOUT--------------------------------------------//
		//Utilizada para cerrar la sesion, es decir, eliminar el token
		$router->post('/logout', 'LoginController@logout');

	//---------------------------------------END LOGOUT---------------------------------------------//

});