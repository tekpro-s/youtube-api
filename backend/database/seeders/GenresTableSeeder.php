<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'イラスト',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('genres')->insert($param);

        $param = [
            'name' => 'お金',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('genres')->insert($param);
    }
}
