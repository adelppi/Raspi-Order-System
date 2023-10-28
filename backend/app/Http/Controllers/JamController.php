<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use Illuminate\Http\Request;

class JamController extends Controller
{
    public function getJamComment(Request $request){
        
    }
    public function addJamComment(Request $request)
    {
        $jsonData = $request->json()->all();

        $table_number = $jsonData["table_number"];
        $jamComment = $jsonData["comment"];

        $jam = new Jam();
        $jam->table_number = $table_number;
        $jam->comment = $jamComment;
        $jam->save();
        return $jam;
    }
    public function deleteJamComment(Request $request)
    {
        $jsonData = $request->json()->all();
        $tableNumber = $jsonData["table_number"];
        Jam::where('table_number', $tableNumber)->delete();

        return "deleted comment(table_number = $tableNumber)";
    }
}
