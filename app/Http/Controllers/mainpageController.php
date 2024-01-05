<?php

namespace App\Http\Controllers;

use App\Models\bBoard;
use Illuminate\Http\Request;
use App\Models\Project_Table;
use App\Models\Project_Users;
use App\Models\List_Table;
use App\Models\Trainee;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class mainpageController extends Controller
{
    public function index($projectId = null){
        $now = now()->timezone('Asia/Jakarta');

        $projectsToDelete = DB::table('project__tables')
            ->where('end_date', '<', $now)
            ->get();


        foreach ($projectsToDelete as $project) {
            DB::table('project_user')->where('project_id', $project->id)->delete();
            DB::table('list__tables')->where('project_id', $project->id)->delete();
            DB::table('project__tables')->where('id', $project->id)->delete();
        }
        
        if ($projectId == null) {
            $leaderboard = DB::table('project_user')
                ->select(
                    'project__tables.id as project_id',
                    'project__tables.title as project_title',
                    'list__tables.id as list_id',
                    'list__tables.list as list_title',
                    'trainees.uuid as trainee_uuid',
                    'trainees.kode_trainee as kode',
                    'trainees.status as trainee_status',
                    'list__tables.score',
                    'project_user.user_id as userid',
                    'project_user.status as status',
                    'users.nama_lengkap as name',
                )
                ->join('list__tables', 'project_user.list_id', '=', 'list__tables.id')
                ->join('trainees','project_user.user_id', '=', 'trainees.uuid')
                ->join('project__tables', 'project_user.project_id', '=', 'project__tables.id')
                ->join('users', 'project_user.user_id', '=', 'users.id')
                ->orderBy('trainees.kode_trainee')
                ->get();

            $leaderboard1 = DB::table('project_user')
                ->select(
                    'project__tables.id as project_id',
                    'project__tables.title as project_title',
                    'list__tables.id as list_id',
                    'list__tables.list as list_title',
                    'trainees.uuid as trainee_uuid',
                    'trainees.kode_trainee as kode',
                    'trainees.status as trainee_status',
                    'list__tables.score',
                    'project_user.user_id as userid',
                    'project_user.status as status',
                    'users.nama_lengkap as name',
                )
                ->join('list__tables', 'project_user.list_id', '=', 'list__tables.id')
                ->join('trainees','project_user.user_id', '=', 'trainees.uuid')
                ->join('project__tables', 'project_user.project_id', '=', 'project__tables.id')
                ->join('users', 'project_user.user_id', '=', 'users.id')
                ->orderBy('trainees.kode_trainee')
                ->get();
            // dd($leaderboard);
            $projectId = 0;
        } else {

            $leaderboard = DB::table('project_user')
                ->select(
                    'project__tables.id as project_id',
                    'project__tables.title as project_title',
                    'list__tables.id as list_id',
                    'list__tables.list as list_title',
                    'trainees.uuid as trainee_uuid',
                    'trainees.kode_trainee as kode',
                    'trainees.status as trainee_status',
                    'list__tables.score',
                    'project_user.user_id as userid',
                    'project_user.status as status',
                    'users.nama_lengkap as name',
                )
                ->join('list__tables', 'project_user.list_id', '=', 'list__tables.id')
                ->join('trainees','project_user.user_id', '=', 'trainees.uuid')
                ->join('project__tables', 'project_user.project_id', '=', 'project__tables.id')
                ->join('users', 'project_user.user_id', '=', 'users.id')
                ->orderBy('trainees.kode_trainee')
                ->get();

            $leaderboard1 = DB::table('project_user')
                ->select(
                    'project__tables.id as project_id',
                    'project__tables.title as project_title',
                    'list__tables.id as list_id',
                    'list__tables.list as list_title',
                    'trainees.uuid as trainee_uuid',
                    'trainees.kode_trainee as kode',
                    'trainees.status as trainee_status',
                    'list__tables.score',
                    'project_user.user_id as userid',
                    'project_user.status as status',
                    'users.nama_lengkap as name',
                )
                ->where('project_user.project_id','=',$projectId)
                ->join('list__tables', 'project_user.list_id', '=', 'list__tables.id')
                ->join('trainees','project_user.user_id', '=', 'trainees.uuid')
                ->join('project__tables', 'project_user.project_id', '=', 'project__tables.id')
                ->join('users', 'project_user.user_id', '=', 'users.id')
                ->orderBy('trainees.kode_trainee')
                ->get();
                $projecttitle = $leaderboard1->first()->project_title;

        }

        $trainees = Trainee::all();

        // return view('leader.leaderboard', compact('leaderboard','leaderboard1','trainee','projecttitle','projectId'));
        return view("mainpage",["marque"=> bBoard::all()],compact('leaderboard1','trainees'));
    }
}
