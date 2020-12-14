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
                'menu' => $menu
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
            'price' => 'required|numeric',
            'type' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|numeric',
            'ingredient_id.*' => 'required',
            'quantity.*'=> 'required|numeric',
        ];

        $message = [
            'name.required' => 'Category cannot be empty',
            'name.unique' => 'Category already exist',
            'name.max' => 'Category cannot be more than :max character',
            'description.required' => 'Description cannot be empty',
            'price.required' => 'Price cannot be empty',
            'price.numeric'=> 'Price format should be numeric',
            'type.required' => 'type cannot be empty',
            'image.required' => 'Image cannot be empty',
            'image.image'=> 'File must be image',
            'image.mimes'=> 'Image format must be : jpg, png, jpeg, gif, svg',
            'image.max' => 'Max image size 2MB',
            'category_id.required' => 'Category id cannot be empty',
            'category_id.numeric'=> 'Category ID format should be numeric',
            'ingredient_id.required'=> 'Ingredient cannot be empty',
            'quantity.required'=> 'Quantity cannot be empty',
            'quantity.numeric'=> 'Quantity format should be numeric',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/menu'), $imageName);
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->image = $imageName;
        $menu->description =$request->description;
        $menu->price = $request->price;
        $menu->type = $request->type;
        $menu->category_id = $request->category_id;
        $menu->save();



        for($i =0;$i<count($request->ingredient_id);$i++){
            $ingredient = new MenuIngredients();
            $ingredient->menu_id = $menu->id;
            $ingredient->ingredient_id = $request->ingredient_id[$i];
            $ingredient->quantity = $request->quantity[$i];
            $ingredient->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Success create menu '.$request->name
        ]);

    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        $name = $menu->name;
        if ($menu->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Success delete menu ' .$name
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed delete menu'
        ]);

    }

    public function update(Request $request,$id)
    {
        $rules = [
            'name' => 'required|max:150',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|numeric',
            'ingredient_id.*' => 'required',
            'quantity.*'=> 'required|numeric',
        ];

        $message = [
            'name.required' => 'Category cannot be empty',
            'name.max' => 'Category cannot be more than :max character',
            'description.required' => 'Description cannot be empty',
            'price.required' => 'Price cannot be empty',
            'price.numeric'=> 'Price format should be numeric',
            'type.required' => 'type cannot be empty',
            'image.image'=> 'File must be image',
            'image.mimes'=> 'Image format must be : jpg, png, jpeg, gif, svg',
            'image.max' => 'Max image size 2MB',
            'category_id.required' => 'Category id cannot be empty',
            'category_id.numeric'=> 'Category ID format should be numeric',
            'ingredient_id.required'=> 'Ingredient cannot be empty',
            'quantity.required'=> 'Quantity cannot be empty',
            'quantity.numeric'=> 'Quantity format should be numeric',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->description =$request->description;
        $menu->price = $request->price;
        $menu->type = $request->type;
        $menu->category_id = $request->category_id;

        if($request->image != '') {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $menu->image = $imageName;
        }
        $menu->save();

        MenuIngredients::where('menu_id',$id)->delete();

        for($i =0;$i<count($request->ingredient_id);$i++){
            $ingredient = new MenuIngredients();
            $ingredient->menu_id = $id;
            $ingredient->ingredient_id = $request->ingredient_id[$i];
            $ingredient->quantity = $request->quantity[$i];
            $ingredient->save();
        }


        return response()->json([
            'status' => true,
            'message' => 'Success update menu '.$request->name
        ]);
    }
}
