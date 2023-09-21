<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::all();
    }

    public function updateStock(Request $request)
    {
        $jsonData = $request->json()->all();
        $menuId = $jsonData["menuId"];
        $updateQuantity = $jsonData["updateQuantity"];
        
        $menu = Menu::where("menu_id", "=", $menuId)->first();
        $menu->stock = $updateQuantity;
        $menu->save();
    }
}
