<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::with('area', 'genre', 'likes')->get();

        if ($videos) {
            return response()->json([
                'message' => 'Videos got successfully',
                'data' => $videos
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }

    public function get($video_id)
    {
        $video = Video::with(['area', 'genre', 'likes', 'comments' => function ($query) {
            $query->orderBy('comments.created_at', 'desc');
            $query->with('user:id,name');
        }])->where('id', $video_id)->first();

        if ($video) {
            return response()->json([
                'message' => 'Video got successfully',
                'data' => $video,
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }

    public function post(VideoStoreRequest $request)
    {
        $video = Video::video($request);
        return response()->json([
            'message' => 'Video created successfully',
            'data' => $video
        ], 201);
    }

    public function put(VideoStoreRequest $request, $id)
    {
        $video = Video::video_put($request, $id);
        return response()->json([
            'message' => 'Video updated successfully',
            'data' => $video
        ], 201);
    }

    public function delete(Request $request, $id)
    {
        Video::where('id', $id)->delete();
        return response()->json([
            'message' => 'Video deleted successfully',
        ], 200);
    }
}
