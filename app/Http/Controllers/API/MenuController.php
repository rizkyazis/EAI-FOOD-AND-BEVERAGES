<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuIngredients;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        try{
            $menu = Menu::all();

            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'menu' => $menu
            ]);
        }catch (QueryException $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'menu' => []
            ]);
        }
    }

    public function detail($id){
        try{
            $menu = Menu::find($id);
            $host = request()->getHttpHost();
            $menu->image = $host.'/images/menu/'.$menu->image;
            $menu->ingredients = $menu->ingredients;
            $menu->category_id = Category::find($menu->category_id);
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'menu' => [$menu]
            ]);
        }catch (QueryException $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'menu' => []
            ]);
        }
    }
}
