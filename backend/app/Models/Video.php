<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['video_id', 'genre_id', 'summary'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public static function video($request)
    {
        $param = [
            "video_id" => $request->video_id,
            "genre_id" => $request->genre_id,
            "summary" => $request->summary,
        ];
        $video = Video::create($param);
        return $video;
    }

    public static function video_put($request, $id)
    {
        $param = [
            "video_id" => $request->video_id,
            "genre_id" => $request->genre_id,
            "summary" => $request->summary,
        ];
        $video = Video::where('id', '=', $id)->update($param);
        return $video;
    }
}
