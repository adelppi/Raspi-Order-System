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
        // JSONデータを取得
        $jsonData = $request->json()->all();
        // 注文をデータベースに登録
        $order = new Order;
        $order->table_number = $jsonData["table_number"];
        $order->save();
        
        // 成功応答を返す（必要に応じてカスタマイズ）
        return $jsonData;
    }
}
