<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuIngredients;
use App\Models\Order;
use App\Models\OrderMenu;
use Faker\Provider\DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportEmployee()
    {
        try {
            $order = Order::all();
            $orderMenu = OrderMenu::where('status', 'Finish')->get();
            $waiter_id = [];
            $chef_id = [];
            $result = [];

            foreach ($order as $item) {
                if (!(in_array($item->waiter_id, $waiter_id))) {
                    array_push($waiter_id, $item->waiter_id);
                }
            }

            foreach ($orderMenu as $item) {
                if (!(in_array($item->chef_id, $chef_id))) {
                    array_push($chef_id, $item->chef_id);
                }
            }

            for ($i = 0; $i < count($waiter_id); $i++) {
                $waiter = Order::where('waiter_id', $waiter_id[$i])->get();
                $dates = [];
                $attendance = 0;
                foreach ($waiter as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $waiter_id[$i],
                    'role' => 'waiter',
                    'work' => count($waiter),
                    'attendance' => $attendance,
                    'dates' => $dates,
                ]);
            }

            for ($i = 0; $i < count($chef_id); $i++) {
                $chef = OrderMenu::where('status', 'Finish')->where('chef_id', $chef_id[$i])->get();
                $dates = [];
                $attendance = 0;
                foreach ($chef as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $waiter_id[$i],
                    'role' => 'chef',
                    'work' => count($chef),
                    'attendance' => $attendance,
                    'dates' => $dates,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'employee' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'employee' => []
            ]);
        }
    }

    public function reportEmployeeById($id)
    {
        try {
            $order_waiter = Order::where('status', 'Finish')->where('waiter_id', $id)->get();
            $order_chef = OrderMenu::where('status', 'Finish')->where('chef_id', $id)->get();
            $result = [];
            $dates = [];
            $attendance = 0;
            if (!count($order_chef) == 0) {
                foreach ($order_chef as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $id,
                    'role' => 'chef',
                    'work' => count($order_chef),
                    'attendance' => $attendance,
                    'dates' => $dates,
                ]);
            } elseif (!count($order_waiter) == 0) {
                foreach ($order_waiter as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $id,
                    'role' => 'waiter',
                    'work' => count($order_waiter),
                    'attendance' => $attendance,
                    'dates' => $dates,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found',
                    'employee' => []
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'employee' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'employee' => []
            ]);
        }
    }


    public function reportEmployeeBetweenDate(Request $request)
    {
        try {
            $from = $request->from . ' 00:00:00';
            $to = $request->to . ' 23:59:59';
            $diffDate = date_diff((date_create($request->from)), (date_create($request->to)));

            $order = Order::whereBetween('created_at', [$from, $to])->get();
            $orderMenu = OrderMenu::where('status', 'Finish')->whereBetween('created_at', [$from, $to])->get();
            $waiter_id = [];
            $chef_id = [];
            $result = [];

            foreach ($order as $item) {
                if (!(in_array($item->waiter_id, $waiter_id))) {
                    array_push($waiter_id, $item->waiter_id);
                }
            }

            foreach ($orderMenu as $item) {
                if (!(in_array($item->chef_id, $chef_id))) {
                    array_push($chef_id, $item->chef_id);
                }
            }

            for ($i = 0; $i < count($waiter_id); $i++) {
                $waiter = Order::where('waiter_id', $waiter_id[$i])->whereBetween('created_at', [$from, $to])->get();
                $dates = [];
                $attendance = 0;
                foreach ($waiter as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $waiter_id[$i],
                    'role' => 'waiter',
                    'work' => count($waiter),
                    'attendance' => $attendance,
                    'period' => ($diffDate->format("%a") + 1) . ' Days',
                    'dates' => $dates,
                ]);
            }

            for ($i = 0; $i < count($chef_id); $i++) {
                $chef = OrderMenu::where('status', 'Finish')->where('chef_id', $chef_id[$i])->whereBetween('created_at', [$from, $to])->get();
                $dates = [];
                $attendance = 0;
                foreach ($chef as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $waiter_id[$i],
                    'role' => 'chef',
                    'work' => count($chef),
                    'attendance' => $attendance,
                    'dates' => $dates,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'employee' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'employee' => []
            ]);
        }
    }

    public function reportEmployeeByIdBetweenDate(Request $request, $id)
    {
        try {
            $from = $request->from . ' 00:00:00';
            $to = $request->to . ' 23:59:59';
            $diffDate = date_diff((date_create($request->from)), (date_create($request->to)));
            $order_waiter = Order::where('status', 'Finish')->where('waiter_id', $id)->whereBetween('updated_at', [$from, $to])->get();
            $order_chef = OrderMenu::where('status', 'Finish')->where('chef_id', $id)->whereBetween('updated_at', [$from, $to])->get();
            $result = [];
            $dates = [];
            $attendance = 0;
            if (!count($order_chef) == 0) {
                foreach ($order_chef as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $id,
                    'role' => 'chef',
                    'work' => count($order_chef),
                    'period' => ($diffDate->format("%a") + 1) . ' Days',
                    'attendance' => $attendance,
                    'dates' => $dates,
                ]);
            } elseif (!count($order_waiter) == 0) {
                foreach ($order_waiter as $item) {
                    $date = $item->created_at->format('d/m/Y');
                    if (!(in_array($date, $dates))) {
                        array_push($dates, $date);
                        $attendance++;
                    }
                }
                array_push($result, [
                    'employee_id' => $id,
                    'role' => 'waiter',
                    'work' => count($order_waiter),
                    'period' => ($diffDate->format("%a") + 1) . ' Days',
                    'attendance' => $attendance,
                    'dates' => $dates,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found',
                    'employee' => []
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'employee' => $result
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'employee' => []
            ]);
        }
    }

    public function reportIncome()
    {
        try {
            $order = Order::where('status', 'Finish')->get();
            $result = [];
            $total = 0;
            foreach ($order as $item) {
                $totalPriceOrder = 0;
                foreach ($item->menu as $menu) {
                    $quantity = $menu->quantity;
                    $price = Menu::find($menu->menu_id);
                    $menuPrice = $quantity * $price->price;
                    $totalPriceOrder = $totalPriceOrder + $menuPrice;
                }
                $total = $total + $totalPriceOrder;
                array_push($result, [
                    'id' => $item->id,
                    'income' => $totalPriceOrder,
                    'division' => 'F&B',
                    'date' => $item->updated_at,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'income' => $result,
                'total' => $total
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'income' => []
            ]);
        }
    }

    public function reportIncomeByIdOrder($id)
    {
        try {
            $order = Order::find($id);
            $result = [];
            $total = 0;
            $totalPriceOrder = 0;
            if($order==null){
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found',
                    'income' => []
                ]);
            }
            foreach ($order->menu as $menu) {
                $quantity = $menu->quantity;
                $price = Menu::find($menu->menu_id);
                $menuPrice = $quantity * $price->price;
                $totalPriceOrder = $totalPriceOrder + $menuPrice;
            }
            $total = $total + $totalPriceOrder;
            array_push($result, [
                'id' => $order->id,
                'income' => $totalPriceOrder,
                'division' => 'F&B',
                'date' => $order->updated_at,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'income' => $result,
                'total' => $total
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'income' => []
            ]);
        }
    }

    public function reportIncomeBetweenDate(Request $request)
    {
        try {
            $from = $request->from . ' 00:00:00';
            $to = $request->to . ' 23:59:59';
            $diffDate = date_diff((date_create($request->from)), (date_create($request->to)));
            $order = Order::where('status', 'Finish')->whereBetween('created_at', [$from, $to])->get();
            $result = [];
            $total = 0;
            foreach ($order as $item) {
                $totalPriceOrder = 0;
                foreach ($item->menu as $menu) {
                    $quantity = $menu->quantity;
                    $price = Menu::find($menu->menu_id);
                    $menuPrice = $quantity * $price->price;
                    $totalPriceOrder = $totalPriceOrder + $menuPrice;
                }
                $total = $total + $totalPriceOrder;
                array_push($result, [
                    'id' => $item->id,
                    'income' => $totalPriceOrder,
                    'division' => 'F&B',
                    'date' => $item->updated_at,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'income' => $result,
                'period' => ($diffDate->format("%a") + 1) . ' Days',
                'total' => $total
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'income' => []
            ]);
        }
    }

    public function reportIncomeDate(Request $request)
    {
        try {
            $order = Order::where('status', 'Finish')->whereDate('updated_at', $request->date)->get();
            $result = [];
            $total = 0;
            if (count($order) == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found',
                    'income' => []
                ]);
            }
            foreach ($order as $item) {
                $totalPriceOrder = 0;
                foreach ($item->menu as $menu) {
                    $quantity = $menu->quantity;
                    $price = Menu::find($menu->menu_id);
                    $menuPrice = $quantity * $price->price;
                    $totalPriceOrder = $totalPriceOrder + $menuPrice;
                }
                $total = $total + $totalPriceOrder;
                array_push($result, [
                    'id' => $item->id,
                    'income' => $totalPriceOrder,
                    'division' => 'F&B',
                    'date' => $item->updated_at,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'income' => $result,
                'total' => $total
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'income' => []
            ]);
        }
    }
}
