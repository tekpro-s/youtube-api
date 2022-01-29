<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function post(Request $request, $video_id)
    {
        $comment = Comment::comment($request, $video_id);
        return response()->json([
            'message' => 'Comment created successfully',
            'data' => $comment
        ], 201);
    }

    public function put(Request $request, $video_id)
    {
        $comment = Comment::comment_put($request, $video_id);
        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => $comment
        ], 201);
    }
    
    public function delete(Request $request, $video_id)
    {
        Comment::where('id', $request->comment_id)->where('video_id', $video_id)->delete();
        return response()->json([
            'message' => 'Comment deleted successfully',
        ], 200);
    }
}
