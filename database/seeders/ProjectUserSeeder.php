<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->where('email', 'stevenliementha@gmail.com')->value('id');
        DB::table('project_user')->insert([
            'user_id' => $userId,
            'project_id' => 1,
            'list_id' =>1,
            'status' =>true,
            'created_at' => now(),
             'updated_at' => now()
        ]);

        DB::table('project_user')->insert([
            'user_id' => $userId,
            'project_id' => 1,
            'list_id' =>2,
            'status' => false,
            'created_at' => now(),
             'updated_at' => now()
        ]);

        DB::table('project_user')->insert([
            'user_id' => $userId,
            'project_id' => 1,
            'list_id' =>3,
            'status' => false,
            'created_at' => now(),
             'updated_at' => now()
        ]);

        DB::table('project_user')->insert([
            'user_id' => $userId,
            'project_id' => 2,
            'list_id' =>4,
            'status' =>true,
            'created_at' => now(),
             'updated_at' => now()
        ]);
        DB::table('project_user')->insert([
            'user_id' => $userId,
            'project_id' => 2,
            'list_id' =>5,
            'status' => false,
            'created_at' => now(),
             'updated_at' => now()
        ]);

    }
}
