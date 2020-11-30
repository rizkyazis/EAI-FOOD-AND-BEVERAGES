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
    //fungsi buat render view
    public function show(){
        //ngambil menu dari database
        $menu = Menu::all();
        //kirim data menu ke file viewnya
        return view('menu', ['menu' => $menu]);// Buat manggil view
    }

    public function index()
    {
        try {
            $menu = Menu::all();
            $host = request()->getHttpHost();
            $result = [];

            foreach ($menu as $item) {
                array_push($result, [
                    'id' => $item->id,
                    'name' => $item->name,
                    'image' => $host . '/images/menu/' . $item->image,
                    'type' => $item->type,
                    'price' => $item->price
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'menu' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'menu' => []
            ]);
        }
    }

    public function detail($id)
    {
        try {
            $menu = Menu::find($id);
            $host = request()->getHttpHost();
            $menu->image = $host . '/images/menu/' . $menu->image;
            $menu->ingredients = $menu->ingredients;
            $menu->category_id = Category::find($menu->category_id);
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'menu' => [$menu]
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'menu' => []
            ]);
        }
    }

    public function menuByCategory($id)
    {
        try {
            $menu = Menu::where('category_id', $id)->get();
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'menu' => [$menu]
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'menu' => []
            ]);
        }
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|unique:menus|max:150',
            'description' => 'required',
            'price' => 'required|number',
            'image' => 'required|mimes:png,jpeg,jpg|max:2048',
            'category_id' => 'required|number'
        ];

        $message = [
            'name.required' => 'Category cannot be empty',
            'name.unique' => 'Category already exist',
            'name.max' => 'Category cannot be more than :max character',
            'description.required' => 'Description cannot be empty',
            'price.required' => 'Price cannot be empty',
            'price.number' => 'Price format should be in number',
            'image.required' => 'Image cannot be empty',
            'image.mimes' => 'Image format should be png, jpeg, jpg',
            'image.max' => 'Max image size 2MB',
            'category_id.required' => 'Category id cannot be empty',
            'category_id.number' => 'Category should be in number',
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
                'message' => 'Success delete category ' . $name
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed delete category'
        ]);
    }
}
