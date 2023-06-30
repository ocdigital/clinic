<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $user = Auth::user();
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
