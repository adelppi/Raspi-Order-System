<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function test($table_id)
    {
        dd($table_id);
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

    public function orderStatus()
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
}
