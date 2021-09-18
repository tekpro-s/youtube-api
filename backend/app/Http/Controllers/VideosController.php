<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Requests\VideoStoreRequest;
use Google_Client;
use Google_Service_YouTube;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::with('genre', 'likes')->get();
        $snippets_data = array();

        // Googleへの接続情報のインスタンスを作成と設定
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        
        // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
        $youtube = new Google_Service_YouTube($client);

        foreach ($videos as $video) {
            // 必要情報を引数に持たせ、listSearchで検索して動画一覧を取得
            $items = $youtube->videos->listVideos("snippet",array('id' => $video->video_id));

            // 連想配列だと扱いづらいのでcollection化して処理
            $snippets = collect($items->getItems())->pluck('snippet')->all();

            array_push($snippets_data, $snippets);
        }

        if ($videos) {
            return response()->json([
                'message' => 'Videos got successfully',
                'data' => $videos,
                'snippets' => $snippets_data
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }

    public function get($video_id)
    {
        $video = Video::with(['genre', 'likes'])->where('id', $video_id)->first();

        // Googleへの接続情報のインスタンスを作成と設定
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));

        // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
        $youtube = new Google_Service_YouTube($client);

        // 必要情報を引数に持たせ、listSearchで検索して動画一覧を取得
        $items = $youtube->videos->listVideos("snippet",array('id' => $video->video_id));
        
        // 連想配列だと扱いづらいのでcollection化して処理
        $snippets = collect($items->getItems())->pluck('snippet')->all();

        if ($video) {
            return response()->json([
                'message' => 'Video got successfully',
                'data' => $video,
                'snippets' => $snippets
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
