<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function createQR(Request $request)
    {
        $jsonData = $request->json()->all();
        $tableNumber = $jsonData["table_number"];
        $tokenNumber = rand(1, 100000);

        $existingToken = Token::where('table_number', $tableNumber)->first();

        if ($existingToken) {
            $existingToken->token = $tokenNumber;
            $existingToken->save();
            return $existingToken->token;
        } else {
            $token = new Token();
            $token->table_number = $tableNumber;
            $token->token = $tokenNumber;
            $token->save();
            return $token->token;
        }
    }

    public function deleteToken(Request $request)
    {
        $jsonData = $request->json()->all();
        $tableNumber = $jsonData["table_number"];
        Token::where('table_number', $tableNumber)->delete();

        return "deleted token(table_number = $tableNumber)";
    }

    public function getToken(Request $request)
    // トークンを返す
    // ただし、なかった場合0を返す
    {
        $jsonData = $request->json()->all();
        $tableNumber = $jsonData["table_number"];
        $target = Token::where('table_number', $tableNumber)->first();
        if ($target) {
            return $target->token;
        } else {
            return 0;
        }
    }
}
