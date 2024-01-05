<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $project = DB::table('project_tables')->where('id', 1)->value('id');
        DB::table('list__tables')->insert([
            'id' => 1,
            'project_id' =>1,
            'list'=> "konse",
            'score' =>10,
            'desc' => "Kerjakan nanti",
        ]);

        DB::table('list__tables')->insert([
            'id' => 2,
            'project_id' =>1,
            'list'=> "bp",
            'score' =>20,
            'desc' => "Kerjakan skrg",
        ]);


        DB::table('list__tables')->insert([
            'id' => 3,
            'project_id' =>1,
            'list'=> "bp",
            'score' =>30,
            'desc' => "Kerjakan dlu",
        ]);

        DB::table('list__tables')->insert([
            'id' => 4,
            'project_id' =>2,
            'list'=> "sdadsa",
            'score' =>40,
            'desc' => "Kerjaan slesai",
        ]);
        
        DB::table('list__tables')->insert([
            'id' => 5,
            'project_id' =>2,
            'list'=> "wkkwkwk",
            'score' =>50,
            'desc' => "hadeh",
        ]);
    }
}
