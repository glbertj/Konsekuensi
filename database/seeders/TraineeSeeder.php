<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TraineeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Insert a user
       // Retrieve the user's UUID
        $userId = DB::table('users')->where('email', 'stevenliementha@gmail.com')->value('id');
        $faker = Faker::create();
        echo $userId;

       // Insert trainee with the corresponding user_id
       DB::table('trainees')->insert([
           'uuid' => $userId,
           'kode_trainee' => 104,
           'status' => 'active',
           'contact' => '085361882049',
           'tanggal_lahir' => '2005-12-08',
           'alamat' => 'Jl. Budi Raya No.21, RT.1/RW.5, Kb. Jeruk, Kec. Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530 Provinsi: Jakarta',
           'image' => 'image/1703827535.jpg',
           'created_at' => now(),
            'updated_at' => now()
       ]);

       $userId = DB::table('users')->where('email', 'darwinjohan@gmail.com')->value('id');

       // Insert trainee with the corresponding user_id
       DB::table('trainees')->insert([
           'uuid' => $userId,
           'kode_trainee' => 42,
           'status' => 'Inactive',
           'contact' => '081315392876',
           'tanggal_lahir' => '2005-09-08',
           'alamat' => 'Darwin Gatau Kemana',
           'image' => 'image/1701523097.jpg',
           'created_at' => now(),
            'updated_at' => now()

       ]);


    }
}
