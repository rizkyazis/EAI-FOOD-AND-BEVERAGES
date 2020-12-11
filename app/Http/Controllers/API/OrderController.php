<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMenu;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $order = Order::all();
            $result = [];

            foreach ($order as $item) {
                $menu = [];
                foreach ($item->menu as $menuItem) {
                    $detail = Menu::find($menuItem->menu_id);
                    $orderMenu = [
                        'id' => $menuItem->id,
                        'order_id' => $menuItem->order_id,
                        'chef_nik'=>$menuItem->chef_nik,
                        'quantity' => $menuItem->quantity,
                        'status'=> $menuItem->status,
                        'menu' => $detail,];
                    array_push($menu, $orderMenu);

                }
                array_push($result, [
                    'id' => $item->id,
                    'customer_id' => $item->customer_id,
                    'waiter_nik' => $item->waiter_nik,
                    'status' => $item->status,
                    'menu' => $menu
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'order' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'order' => []
            ]);
        }
    }

    public function orderWaiting()
    {
        try {
            $order = Order::where('status', "Waiting")->get();
            $result = [];

            foreach ($order as $item) {
                $menu = [];
                foreach ($item->menu as $menuItem) {
                    $detail = Menu::find($menuItem->menu_id);
                    $orderMenu = [
                        'id' => $menuItem->id,
                        'order_id' => $menuItem->order_id,
                        'quantity' => $menuItem->quantity,
                        'status'=> $menuItem->status,
                        'menu' => $detail,];
                    array_push($menu, $orderMenu);

                }
                array_push($result, [
                    'id' => $item->id,
                    'customer_id' => $item->customer_id,
                    'waiter_nik' => $item->waiter_nik,
                    'status' => $item->status,
                    'menu' => $menu
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'order' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'order' => []
            ]);
        }
    }

    public function orderFinished()
    {
        try {
            $order = Order::where('status', "Finish")->get();
            $result = [];

            foreach ($order as $item) {
                $menu = [];
                foreach ($item->menu as $menuItem) {
                    $detail = Menu::find($menuItem->menu_id);
                    $orderMenu = [
                        'id' => $menuItem->id,
                        'order_id' => $menuItem->order_id,
                        'chef_nik'=>$menuItem->chef_nik,
                        'quantity' => $menuItem->quantity,
                        'status'=> $menuItem->status,
                        'menu' => $detail,];
                    array_push($menu, $orderMenu);

                }
                array_push($result, [
                    'id' => $item->id,
                    'customer_id' => $item->customer_id,
                    'waiter_nik' => $item->waiter_nik,
                    'status' => $item->status,
                    'menu' => $menu
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'order' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'order' => []
            ]);
        }
    }

    public function detail($id)
    {
        try {
            $item = Order::find($id);
            $menu = [];
            foreach ($item->menu as $menuItem) {
                $detail = Menu::find($menuItem->menu_id);
                $orderMenu = [
                    'id' => $menuItem->id,
                    'order_id' => $menuItem->order_id,
                    'quantity' => $menuItem->quantity,
                    'status'=> $menuItem->status,
                    'menu' => $detail,
                ];
                array_push($menu, $orderMenu);
            }
            $result = [
                'id' => $item->id,
                'customer_id' => $item->customer_id,
                'waiter_nik' => $item->waiter_nik,
                'status' => $item->status,
                'menu' => $menu
            ];
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'order' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'order' => []
            ]);
        }
    }

    public function order(Request $request)
    {
        $rules = [
            'customer_id' => 'required|numeric',
            'waiter_nik' => 'required|numeric',
            'menu_id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ];

        $message = [
            'customer_id.required' => 'Customer id cannot be empty',
            'customer_id.numeric' => 'Customer id format should be numeric',
            'waiter_nik.required' => 'Waiter id cannot be empty',
            'waiter_nik.numeric' => 'Waiter id format should be numeric',
            'menu_id.required' => 'Menu id cannot be empty',
            'menu_id.numeric' => 'Menu id format should be numeric',
            'quantity.required' => 'Quantity cannot be empty',
            'quantity.numeric' => 'Quantity format should be numeric',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $order = Order::where('customer_id', $request->customer_id)->where('waiter_nik', $request->waiter_nik)->where('status', 'Waiting')->first();

        if ($order == null) {
            $order = new Order();
            $order->customer_id = $request->customer_id;
            $order->waiter_nik = $request->waiter_nik;
            $order->save();
        }

        $menu = new OrderMenu();
        $menu->order_id = $order->id;
        $menu->menu_id = $request->menu_id;
        $menu->quantity = $request->quantity;
        $menu->save();

        return response()->json([
            'status' => true,
            'message' => 'Success order '
        ]);
    }

    public function finishMenu(Request $request, $id){
        $rules = [
            'chef_nik' => 'required|numeric',
        ];

        $message = [
            'chef_nik.required' => 'Chef id cannot be empty',
            'chef_nik.numeric' => 'Chef id format should be numeric',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $orderMenu = OrderMenu::find($id);
        $orderMenu->status = 'Finish';
        $idOrder = $orderMenu->order_id;
        $orderMenu->chef_nik = $request->chef_nik;
        $orderMenu->save();

        $order = Order::find($idOrder);

        foreach ($order->menu as $menu){
            if($menu->status == 'Waiting'){
                return response()->json([
                    'status' => true,
                    'message' => 'Success update order '
                ]);
            }
        }

        $order->status = 'Finish';
        $order->save();

        return response()->json([
            'status' => true,
            'message' => 'Success update order / All order finished'
        ]);

    }

    public function deleteOrder($id){
        $order = Order::find($id);
        if ($order->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Success delete order '
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed delete order'
        ]);
    }

    public function deleteMenuOrder($id){
        $order = OrderMenu::find($id);
        if ($order->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Success delete menu order '
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed delete menu order'
        ]);
    }

}
