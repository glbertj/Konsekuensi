<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project_Table;
use App\Models\Project_Users;
use App\Models\List_Table;
use App\Models\Trainee;
use App\Models\Users;
use Illuminate\Support\Facades\DB;


class LeaderboardController extends Controller
{


    public function show($projectId = null,$projecttitle = null)
{
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

    $trainee = Trainee::all();

    return view('leader.leaderboard', compact('leaderboard','leaderboard1','trainee','projecttitle','projectId'));
}




}


// if ($projectId == null) {
    //     $leaderboard = DB::table('project__tables')
    //         ->select(
    //             'project__tables.id as project_id',
    //             'project__tables.title as project_title',
    //             'list__tables.id as list_id',
    //             'list__tables.list as list_title',
    //             'trainees.uuid as trainee_uuid',
    //             'trainees.kode_trainee as kode',
    //             'trainees.status as trainee_status',
    //             'list__tables.score',
    //             'users.nama_lengkap as name',
    //             'project_user.status as project_user_status'
    //         )
    //         ->join('list__tables', 'project__tables.id', '=', 'list__tables.project_id')
    //         ->join('list__tables.project_id', '=', 'project_user.project_id')
    //         ->join('trainees', 'project_user.user_id', '=', 'trainees.uuid')
    //         ->join('users', 'trainees.uuid', '=', 'users.id')
    //         ->orderBy('project__tables.id')
    //         ->orderBy('list__tables.score', 'desc')
    //         ->get();
    //     dd($leaderboard);
    // } else {
    //     $leaderboard = DB::table('project__tables')
    //         ->select(
    //             'project__tables.id as project_id',
    //             'project__tables.title as project_title',
    //             'list__tables.id as list_id',
    //             'list__tables.list as list_title',
    //             'trainees.uuid as trainee_uuid',
    //             'trainees.kode_trainee as kode',
    //             'trainees.status as trainee_status',
    //             'list__tables.score',
    //             'users.nama_lengkap as name',
    //             'project_user.status as project_user_status'
    //         )
    //         ->join('list__tables', 'project__tables.id', '=', 'list__tables.project_id')
    //         ->leftJoin('project_user', function ($join) use ($projectId) {
    //             $join->on('list__tables.project_id', '=', 'project_user.project_id')
    //                  ->where('list__tables.project_id', '=', $projectId);
    //         })
    //         ->join('trainees', 'project_user.user_id', '=', 'trainees.uuid')
    //         ->join('users', 'trainees.uuid', '=', 'users.id')
    //         ->orderBy('project__tables.id')
    //         ->orderBy('list__tables.score', 'desc')
    //         ->distinct()
    //         ->get();
    //     // dd($leaderboard);
    // }


        // $projects = Project_Users::all();

        // if (!$project) {
        //     abort(404, 'Project not found');
        // }

        // $tasks = $project->task()->get();
        // $trainees = $project->trainees()->withPivot('project_score')->orderBy('project_score', 'desc')->get();

        // $scores = Trainee::join('task_trainee', 'trainees.uuid', '=', 'task_trainee.trainee_uuid')
        //         ->join('tasks', 'task_trainee.task_uuid', '=', 'tasks.uuid')
        //         ->select('trainees.uuid as trainee_uuid', 'tasks.uuid as task_uuid', 'task_trainee.score')
        //         ->orderBy('score', 'desc')
        //         ->get();
        // // Pass the data to the view
