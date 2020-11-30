<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuIngredients;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(){
        try{
            $menu = Menu::all();
            $host = request()->getHttpHost();
            $result = [];

            foreach ($menu as $item){
                array_push($result,[
                    'id'=>$item->id,
                    'name'=>$item->name,
                    'image'=>$host.'/images/menu/'.$item->image,
                    'type'=>$item->type,
                    'price'=>$item->price
                    ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'menu' => $result
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

    public function menuByCategory($id){
        try{
            $menu = Menu::where('category_id',$id)->get();
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

    public function create(Request $request){
        $rules = [
            'name' => 'required|unique:menus|max:150',
            'description' => 'required|',
            'price'=>'',
            'image'=>'',
            'category_id'
        ];

        $message = [
            'id.required' => 'Id not selected',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $category = Category::find($request->id);
        $name = $category->name;
        if ($category->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Success delete category ' .$name
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed delete category'
        ]);
    }
}
