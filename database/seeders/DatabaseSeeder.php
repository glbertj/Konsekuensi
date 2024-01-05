<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(TraineeSeeder::class);
        $this->call(TrainerSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ListTableSeeder::class);
        $this->call(ProjectUserSeeder::class);
    }
}
