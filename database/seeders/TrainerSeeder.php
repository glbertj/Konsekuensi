<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve the user's UUID
        $userId = DB::table('users')->where('email', 'feryfernandi@gmail.com')->value('id');

        // Insert trainer with the corresponding user_id
        DB::table('trainers')->insert([

            'inisial' => 'FF 23-1',
            'jabatan' => 'Junior Laboratory Assistant',
            'uuid' => $userId,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
