<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Insert a user
        DB::table('users')->insert([
            'id' => $faker->uuid,
            'email' => 'stevenliementha@gmail.com',
            'password' => bcrypt('admin123'),
            'nama_lengkap' => 'Steven Liementha',
            'binusian' => 27,
            'jurusan' => 'Computer Science',
            'role' => 'trainee admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => $faker->uuid,
            'email' => 'darwinjohan@gmail.com',
            'password' => bcrypt('darwin123'),
            'nama_lengkap' => 'Darwin Johan',
            'binusian' => 27,
            'jurusan' => 'Computer Science',
            'role' => 'trainee',
            'created_at' => now(),
            'updated_at' => now()

        ]);

        DB::table('users')->insert([
            'id' => $faker->uuid,
            'email' => 'feryfernandi@gmail.com',
            'password' => bcrypt('fery1234'),
            'nama_lengkap' => 'Fery Fernandi',
            'binusian' => 26,
            'jurusan' => 'Computer Science',
            'role' => 'trainer',
            'created_at' => now(),
            'updated_at' => now()
        ]);




    }
}
