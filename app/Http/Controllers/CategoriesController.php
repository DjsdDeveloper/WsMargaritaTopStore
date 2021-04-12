<?php 
namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return response()->json($categories, 200);
    }


    public function getCategories($id)
    {
        $categoria = Categories::find($id);
        if($categoria)
        {
            return response()->json($categoria, 200);
        }

        return response()->json(["Categoria no encontrado"], 404);

    }

    public function createCategories(Request $request)
    {
        $categoria = new Categories;  
        $categoria->CategoryName = $request->CategoryName;
        $categoria->Description = $request->Description;
        $categoria->save();
        return response()->json($categoria);  
    }

    public function updateCategories(Request $request,$id)
     { 

        $categoria= Categories::find($id);
            
        $categoria->CategoryName = $request->CategoryName;
        $categoria->Description = $request->Description;
        $categoria->save();
        return response()->json($categoria);
     }

     public function destroyCategories($id)
     {
        $categoria = Categories::find($id);
        $categoria->delete();
         return response()->json('La categoria fue eliminada');
     }
}