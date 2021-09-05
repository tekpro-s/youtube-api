<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function get($user_id)
    {
        $user = User::with('role')->where('id', $user_id)->get();
        if ($user) {
            return response()->json([
                'message' => 'User got successfully',
                'data' => $user
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
