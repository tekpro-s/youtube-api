<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'video_id'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public static function like($request, $video_id)
    {

        $param = [
            "video_id" => $video_id,
            "user_id" => $request->user_id,
        ];
        $like = Like::create($param);
        return $like;
    }


}
