<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Google_Client;
use Google_Service_YouTube;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['video_name','video_title', 'user_id', 'genre_id', 'summary'];
 
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    public static function video($request)
    {
        // Googleへの接続情報のインスタンスを作成と設定
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        
        // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
        $youtube = new Google_Service_YouTube($client);

        // 必要情報を引数に持たせ、listSearchで検索して動画一覧を取得
        $items = $youtube->videos->listVideos("snippet",array('id' => $request->video_name));

        // 動画タイトル取得
        $video_title = $items[0]->snippet->title;
        \Log::info($video_title); // ログ出力
        $param = [
            "video_name" => $request->video_name,
            "video_title" => $video_title,
            "user_id" => $request->user_id,
            "genre_id" => $request->genre_id,
            "summary" => $request->summary,
        ];
        $video = Video::create($param);
        return $video;
    }

    public static function video_put($request, $id)
    {
        $param = [
            "video_title" => $request->video_title,
            "genre_id" => $request->genre_id,
            "summary" => $request->summary,
        ];
        $video = Video::where('id', '=', $id)->update($param);
        return $video;
    }

    public static function video_allget($videos)
    {
        $snippets_data = array();

        // Googleへの接続情報のインスタンスを作成と設定
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        
        // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
        $youtube = new Google_Service_YouTube($client);

        foreach ($videos as $video) {
            // 必要情報を引数に持たせ、listSearchで検索して動画一覧を取得
            $items = $youtube->videos->listVideos("snippet",array('id' => $video->video_name));

            $param = [
                "title" => $items[0]->snippet->title,
                "thumbnails" => $items[0]->snippet->thumbnails->high,
            ];

            array_push($snippets_data, $param);
        }

        return $snippets_data;
    }

    public static function video_get($video_name)
    {
        // Googleへの接続情報のインスタンスを作成と設定
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        
        // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
        $youtube = new Google_Service_YouTube($client);

        // 必要情報を引数に持たせ、listSearchで検索して動画一覧を取得
        $items = $youtube->videos->listVideos("snippet",array('id' => $video_name));

        // 動画タイトル取得
        $title = $items[0]->snippet->title;

        return $title;
    }

}
