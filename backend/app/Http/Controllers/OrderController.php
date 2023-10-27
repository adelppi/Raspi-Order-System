<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function clearAllOrders()
    {
        Order::truncate();
        return "cleared all orders";
    }

    public function doneServing(Request $request)
    {
        $jsonData = $request->json()->all();
        $tableNumber = $jsonData["table_number"];

        $data = Order::where('table_number', $tableNumber)
            ->select('menu_id', Order::raw('COUNT(*) as quantity'))
            ->groupBy('menu_id')
            ->get();

        $menuIdAndQuantities = [];
        foreach ($data as $row) {
            $menuIdAndQuantities[$row->menu_id] = $row->quantity;
        }

        foreach ($menuIdAndQuantities as $menuId => $consumedStock) {
            $menu = Menu::where('menu_id', $menuId)->first();
            $newStock = $menu["stock"] - $consumedStock;
            $menu->update(['stock' => $newStock]);
        }

        Order::where('table_number', $tableNumber)->delete();
        return $menu;
    }

    public function createOrder(Request $request)
    {
        $jsonData = $request->json()->all();

        $tableNumber = $jsonData["table_number"];
        $order_items = $jsonData["order_items"];


        foreach ($order_items as $item) {
            $order = new Order;
            $order->table_number = $tableNumber;
            $order->menu_id = $item;
            $order->save();
        }


        return $jsonData;
    }

    public function orderStatusSorted()
    {
        $data = Order::select('table_number', 'menu_id')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('table_number', 'menu_id')
            ->get();

        $jsonData = [];

        foreach ($data as $item) {
            $tableNumber = $item->table_number;
            $menuId = $item->menu_id;
            $count = $item->count;

            if (!isset($jsonData[$tableNumber])) {
                $jsonData[$tableNumber] = [];
            }

            $jsonData[$tableNumber][$menuId] = $count;
        }

        return $jsonData;
    }

    public function orderStatus()
    {
        $data = Order::select('table_number', 'menu_id', 'created_at')
            ->groupBy('table_number', 'menu_id', 'created_at')
            ->selectRaw('table_number, menu_id, count(*) as count')
            ->orderBy('created_at', 'asc')
            ->get();

        $result = [];

        foreach ($data as $row) {
            $tableNumber = $row->table_number;
            $menuId = $row->menu_id;
            $count = $row->count;

            if (!isset($result[$tableNumber])) {
                $result[$tableNumber] = [];
            }

            $result[$tableNumber][$menuId] = $count;
        }

        $finalResult = [];
        foreach ($result as $tableNumber => $menuCounts) {
            $formattedData = [$tableNumber => $menuCounts];
            $finalResult[] = $formattedData;
        }
        return $finalResult;
    }
}
