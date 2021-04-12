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

class ProductoController extends Controller
{
    //Metodo para obtener todos los productos registrados en la tabla productos
    public function GetAllProductos()
    {
    	$productos = Producto::all();
    	return $productos;
    }

    //Metodo para obtener productos paginados de 20 en 20
    public function GetPaginationProductos()
    {
    	$productos=Cache::remember('cacheproductos',15/60,function()
        {
            return Producto::simplePaginate(20);  // Paginamos cada 10 elementos.

        });

        return response()->json(['status'=>'ok', 'siguiente'=>$productos->nextPageUrl(),'anterior'=>$productos->previousPageUrl(),'data'=>$productos->items()],200);
    }

    //Metodo para obtener productos random paginados de 20 en 20
    public function GetRandomProductos()
    {
    	// $productos = Producto::all();
    	// return $productos;
    }

    //Metodo para obtener productos por Categoria de 20 en 20
    public function GetProductosCategoria()
    {
    	// $productos = Producto::all();
    	// return $productos;
    }

    //Metodo para obtener productos por Tienda de 20 en 20
    public function GetProductosTienda()
    {
    	// $productos = Producto::all();
    	// return $productos;
    }

    //Metodo para obtener productos con Descuento de 20 en 20
    public function GetProductosDescuento()
    {
    	// $productos = Producto::all();
    	// return $productos;
    }

    //Metodo para obtener productos por Busqueda de 20 en 20
    public function GetProductosBuscado()
    {
    	// $productos = Producto::all();
    	// return $productos;
    }

    //Metodo para obtener productos por Tienda y Categoria de 20 en 20
    public function GetProductosBuscadoCategoria()
    {
    	// $productos = Producto::all();
    	// return $productos;
    }

    //Metodo para agregar un nuevo producto
    public function PostAddProducto(Request $request){
    	// $user = User::create($request->all());
    	// return $user;
    }
}
