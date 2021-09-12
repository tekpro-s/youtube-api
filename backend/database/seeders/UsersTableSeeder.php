<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'taro',
            'email' => 'example@gmail.com',
            'password' => '$2y$10$lREw0dPoPtl5QV0OErwdeeSeO8zM4wYcCbIjDc8SG1X7PRmbOR3bK',
            'role_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'administrator',
            'email' => 'administrator@gmail.com',
            'password' => '$2y$10$lREw0dPoPtl5QV0OErwdeeSeO8zM4wYcCbIjDc8SG1X7PRmbOR3bK',
            'role_id' => '2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('users')->insert($param);
    }
}
