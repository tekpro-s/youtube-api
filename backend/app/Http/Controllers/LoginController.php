<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $is_checked = Hash::check($request->password, $user->password);
        if ($is_checked) {
            return response()->json([
                'auth' => true,
                'user' => $user
            ], 201);
        } else {
            return response()->json(['auth' => false], 401);
        }
    }
}
