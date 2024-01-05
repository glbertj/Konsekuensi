<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project__tables')->insert([
            'id' => 1,
            'title' => "hadeh sumpah capek aku",
            'started_date' => now(),
             'end_date' => now(),
             'created_at' =>now(),
             'updated_at' =>now()
        ]);
        DB::table('project__tables')->insert([
            'id' => 2,
            'title' => "list ke dua sih..",
            'started_date' => now(),
             'end_date' => now(),
             'created_at' =>now()->addMinutes(1),
             'updated_at' =>now()
        ]);
    }
}
