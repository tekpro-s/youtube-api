<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'video_name' => 'ZdCZDL9NPwY',
            'video_title' => '【忙しい人向け】かんたんにできる！絵の１０分トレーニングDAY1　You can do it easily! 10 minutes training of pictures DAY1',
            'user_id' => '1',
            'genre_id' => '1',
            'summary' => 'テスト',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('videos')->insert($param);

        $param = [
            'video_name' => 'v-Ej9EIlfoc',
            'video_title' => '初心者が挫折しないための簡単クロッキーLV.1',
            'user_id' => '1',
            'genre_id' => '1',
            'summary' => 'テスト2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('videos')->insert($param);
    }
}
