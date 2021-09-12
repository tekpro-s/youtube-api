<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '利用者',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('roles')->insert($param);

        $param = [
            'name' => '管理者',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('roles')->insert($param);
    }
}
