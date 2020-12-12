<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuIngredients;
use App\Models\Order;
use App\Models\OrderMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function menuindex(){
        $data = Menu::all();
        return view('admin/menu',compact('data'));
    }

    public function createMenuIndex(){
        $category = Category::all();
        $data=  Http::get("https://warehouse-eai.herokuapp.com/api/barang?filter=makanan")->json();
        return view('admin/menu-add',['data'=>$data['data'],'category'=>$category]);
    }

    public function createMenu(Request $request){
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

        if($validator->fails()){
            return back()->withErrors($validator)->withInput($request->all());
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

        return redirect(route('admin.menu.index'))->with('success','Success created new menu');
    }

    public function editMenuIndex($id){
        $category = Category::all();
        $data=  Http::get("https://warehouse-eai.herokuapp.com/api/barang?filter=makanan")->json();
        $menu = Menu::find($id);
        return view('admin/menu-edit',['data'=>$data['data'],'category'=>$category,'menu'=>$menu]);
    }

    public function editMenu(Request $request, $id){
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

        if($validator->fails()){
            return back()->withErrors($validator)->withInput($request->all());
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

        return redirect(route('admin.menu.index'))->with('success','Success update menu');
    }

    public function deleteMenu($id){
        $menu = Menu::find($id);
        $menu->delete();

        return redirect(route('admin.menu.index'))->with('success','Success delete menu');
    }

    public function orderIndex(){
        $data=  Order::all();
        return view('admin/order',['data'=>$data]);
    }

    public function createOrderIndex(){
        $customer =  Http::get("https://tubes-eai.herokuapp.com/api/users")->json();
        $employee= Http::get("https://hrapi-hotel.herokuapp.com/Karyawan/getAll")->json();
        $menu = Menu::all();
        return view('admin/order-add',['customer'=>$customer['data'],'employee'=>$employee,'menu'=>$menu]);
    }

    public function createOrder(Request $request){
        $rules = [
            'customer_id' => 'required',
            'waiter_id' => 'required',
            'menu_id' => 'required',
            'quantity' => 'required|numeric',
        ];

        $message = [
            'customer_id.required' => 'Customer id cannot be empty',
            'waiter_id.required' => 'Waiter id cannot be empty',
            'menu_id.required' => 'Menu id cannot be empty',
            'quantity.required' => 'Quantity cannot be empty',
            'quantity.numeric' => 'Quantity format should be numeric',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withInput($request->all())->with('error','Failed add order');
        }

        $order = Order::where('customer_id', $request->customer_id)->where('waiter_id', $request->waiter_id)->where('status', 'Waiting')->first();

        if ($order == null) {
            $order = new Order();
            $order->customer_id = $request->customer_id;
            $order->waiter_id = $request->waiter_id;
            $order->save();
        }

        $menu = new OrderMenu();
        $menu->order_id = $order->id;
        $menu->menu_id = $request->menu_id;
        $menu->quantity = $request->quantity;
        $menu->save();

        $ingredient = MenuIngredients::where('menu_id',$request->menu_id)->get();

        foreach ($ingredient as $item){
            Http::put("https://warehouse-eai.herokuapp.com/api/barang/bahan-makanan/$item->ingredient_id",['total_ambil'=>$item->quantity]);
        }

        return back()->withInput($request->all())->with('success','Success add order');
    }

    public function detailOrder($id){
        $order = Order::find($id);
        $employee= Http::get("https://hrapi-hotel.herokuapp.com/Karyawan/getAll")->json();
        return view('admin/order-detail',['order'=>$order,'employee'=>$employee]);
    }

    public function updateMenuOrder(Request $request,$id){
        $rules = [
            'chef_id' => 'required',
            'status' => 'required',
        ];

        $message = [
            'chef_id.required' => 'Chef id cannot be empty',
            'status.required' => 'Status cannot be empty',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withInput($request->all())->with('error','Failed update menu order');
        }

        $orderMenu = OrderMenu::find($id);
        $orderMenu->status = $request->status;
        $idOrder = $orderMenu->order_id;
        $orderMenu->chef_id = $request->chef_id;
        $orderMenu->save();

        $order = Order::find($idOrder);

        foreach ($order->menu as $menu){
            if($menu->status == 'Waiting'){
                return back()->withInput($request->all())->with('success','Success update menu order');
            }
        }

        $order->status = 'Finish';
        $order->save();

        return back()->withInput($request->all())->with('success','Success update menu order');
    }

    public function deleteMenuOrder($id){
        $menu = OrderMenu::find($id);
        $menu->delete();

        return back()->with('success','Success add order');
    }

    public function deleteOrder($id){
        $menu = Order::find($id);
        $menu->delete();

        return redirect(route('admin.order.index'))->with('success','Success add order');
    }

    public function categoryIndex(){
        $category = Category::all();

        return view('admin/category',compact('category'));
    }
}
