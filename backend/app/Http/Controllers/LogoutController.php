<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function post(RegistrationStoreRequest $request)
    {
        $user = User::registration($request);
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }
}
