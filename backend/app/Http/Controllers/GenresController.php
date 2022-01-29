<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenresController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        if ($genres) {
            return response()->json([
                'message' => 'Genres got successfully',
                'data' => $genres
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
