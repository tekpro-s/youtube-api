<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'video_id', 'content', 'evaluation'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public static function comment($request, $video_id)
    {
        $param = [
            "video_id" => $video_id,
            "user_id" => $request->user_id,
            "content" => $request->content,
        ];
        $comment = Comment::create($param);

        return $comment;
    }

    public static function comment_put($request, $video_id)
    {
        $param = [
            "content" => $request->content,
        ];
        $comment = Comment::where('id', '=', $request->comment_id)->where('video_id', $video_id)->update($param);

        return $comment;
    }
}
