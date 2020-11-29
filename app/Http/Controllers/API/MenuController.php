<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
            $menu->ingredients;
            $menu->category;

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
