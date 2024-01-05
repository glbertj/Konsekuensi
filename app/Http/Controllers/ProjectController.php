<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Trainee;
use App\Models\Project_Users;
use App\Models\Project_Table;
use App\Models\List_Table;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function backtomodal (Request $req){
        $now = now()->timezone('Asia/Jakarta');

        $projectsToDelete = DB::table('project__tables')
            ->where('end_date', '<', $now)
            ->get();


        foreach ($projectsToDelete as $project) {
            DB::table('project_user')->where('project_id', $project->id)->delete();
            DB::table('list__tables')->where('project_id', $project->id)->delete();
            DB::table('project__tables')->where('id', $project->id)->delete();
        }
        $aku = $req->kokgada;
        $users = Trainee::where('uuid', Session::get('mysession')['uuid'])->first();
        $project_user = Project_Users::where('user_id', $users->uuid)->get();
        $projectIds = $project_user->pluck('project_id')->toArray();
        $project_table = Project_Table::whereIn('id', $projectIds)->get();
        $aku = is_array($aku) ? $aku : [$aku];
        $list = List_Table::whereIn('project_id', $aku)->get();
        return view('component.Modal',compact('users','project_user','project_table','list','aku'));
    }

    public function updateStatus(Request $req){
        $now = now()->timezone('Asia/Jakarta');

        $projectsToDelete = DB::table('project__tables')
            ->where('end_date', '<', $now)
            ->get();


        foreach ($projectsToDelete as $project) {
            DB::table('project_user')->where('project_id', $project->id)->delete();
            DB::table('list__tables')->where('project_id', $project->id)->delete();
            DB::table('project__tables')->where('id', $project->id)->delete();
        }

        for ($i = $req->i;$i<=$req->countall;$i++){
            $concat = 'checks' . $i;
            if($req->$concat == null){
                $projectus = Project_Users::where('project_id', $req->proid)
                ->where('user_id', Session::get('mysession')['uuid'])
                ->where('list_id', $i)
                ->update(['status' => false]);
            }else if($req->$concat == "on"){
                $projectus = Project_Users::where('project_id', $req->proid)
                ->where('user_id', Session::get('mysession')['uuid'])
                ->where('list_id', $i)
                ->update(['status' => true]);
            }
        }

        return redirect()->route('project');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $users = Trainee::where('uuid', Session::get('mysession')['uuid'])->first();
        // dd(Session::get('mysession')['uuid']);
        $project_user = Project_Users::where('user_id', $users->uuid)->get();

        $projectIds = $project_user->pluck('project_id')->toArray();

        $project_table = Project_Table::whereIn('id', $projectIds)->get();

        $projectTableIds = $project_table->pluck('id')->toArray();

        $list = List_Table::whereIn('project_id', $projectTableIds)->get();
        $aku = 1;

        return view('ProjectList',compact('users','project_user','project_table','list','aku'));

    }

    public function backtomodal1 (Request $req){

        $now = now()->timezone('Asia/Jakarta');

        $projectsToDelete = DB::table('project__tables')
            ->where('end_date', '<', $now)
            ->get();


        foreach ($projectsToDelete as $project) {
            DB::table('project_user')->where('project_id', $project->id)->delete();
            DB::table('list__tables')->where('project_id', $project->id)->delete();
            DB::table('project__tables')->where('id', $project->id)->delete();
        }

        $aku = $req->kokgada;
        $users = Trainee::get()->first();
        $project_user = Project_Users::where('user_id', $users->uuid)->get();
        $projectIds = $project_user->pluck('project_id')->toArray();
        $project_table = Project_Table::whereIn('id', $projectIds)->get();
        $aku = is_array($aku) ? $aku : [$aku];
        $list = List_Table::whereIn('project_id', $aku)->get();
        return view('component.Modal',compact('users','project_user','project_table','list','aku'));
    }

    public function index1()
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
        $users = Trainee::get()->first();
        // dd($users);
        // dd(Session::get('mysession')['uuid']);
        $project_user = Project_Users::where('user_id', $users->uuid)->get();

        $projectIds = $project_user->pluck('project_id')->toArray();

        $project_table = Project_Table::whereIn('id', $projectIds)->get();

        $projectTableIds = $project_table->pluck('id')->toArray();

        $list = List_Table::whereIn('project_id', $projectTableIds)->get();
        $aku = 1;

        return view('ProjectList',compact('users','project_user','project_table','list','aku'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
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

        // Validate the request data
        $rules = ([
            'name' => 'required|string|max:255',
            'deadline' => 'required|date'
        ]);

        $validator = Validator::make($req->all(), $rules);
        // // if error
        if ($validator->fails()) {
            // dd($validator);
            return back()->withErrors($validator)->withInput();
        }

        $project_tables = new Project_Table([
            'title' => $req->name,
            'started_date' => now(),
            'end_date' => $req->deadline,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $project_tables->save();

        $listIds = [];

        for($i = 1;$i<=$req->count;$i++){
            $concat1 = 'task'.$i;
            $concat2 = 'desc'.$i;
            $concat3 = 'score'.$i;
            // dd($req->task2);
            if(!($req->$concat1 == null &&$req->$concat2 == null &&$req->$concat3 == null )){
                $list = new List_Table([
                    'project_id' => $project_tables->id,
                    'list' => $req->$concat1,
                    'desc' => $req->$concat2,
                    'score' => $req->$concat3,
                    'created_at' => now()
                ]);
                $list->save();
                $listIds[] = $list->id;
            }

        }

        // dd($listIds);
        $trainees = Trainee::all();
        foreach ($trainees as $trainee){
            // dd($trainee);
            foreach($listIds as $ids){
                // dd($trainee);
                // dd($trainee->uuid);
                $projectuser = new Project_Users ([

                    'user_id' => $trainee->uuid,
                    'project_id' => $project_tables->id,
                    'status' => false,
                    'list_id' => $ids,
                ]);
                // dd($projectuser);
                $projectuser ->save();
            }
        }

        // Redirect or return a response
        return redirect()->route('project');
    }

    public function editproject(Request $req){
        $rules = ([
            'name' => 'required|string|max:255',
            'deadline' => ['required', 'date', 'after_or_equal:today']
        ]);

        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // dd($req);
        $project_tables =Project_Table::find($req->id);
        // dd($project_tables);
        $project_tables->title = $req->name? $req->name:$project_tables->title;
        $project_tables->end_date = $req->deadline? $req->deadline:$project_tables->end_date;
        // $project_tables->save();

        $listIds = [];
        $count = $req->count;
        $hitung = 1;
        $listidpertama = $req->listidpertama;
        // dd($req);

        while ($hitung <= $count) {
            $concat1 = 'task' . $hitung;
            $concat2 = 'desc' . $hitung;
            $concat3 = 'score' . $hitung;

            // Assuming $req->listidpertama is the project_id
            $project_tables = Project_Table::find($req->listidpertama);

            if ($listidpertama != $req->listidterakhir+1) {
                $list = List_Table::find($listidpertama);

                // Update the existing list if it exists
                if ($list) {
                    $list->list = $req->$concat1 ?: $list->list;
                    $list->desc = $req->$concat2 ?: $list->desc;
                    $list->score = $req->$concat3 ?: $list->score;
                    $list->save();
                    $listIds[] = $list->id;
                }
            } else {
                // dd($req);
                if (!($req->$concat1 == null && $req->$concat2 == null && $req->$concat3 == null)) {
                    $list = new List_Table([
                        'project_id' => $project_tables->id,
                        'list' => $req->$concat1,
                        'desc' => $req->$concat2,
                        'score' => $req->$concat3,
                        'created_at' => now()
                    ]);
                    $list->save();
                    $listIds[] = $list->id;
                }
            }
            $listidpertama ++;
            $hitung++;
        }
        // dd($listIds);

        $trainees = Trainee::all();
        // echo('sdaads');
        $listidpertama = $req->listidpertama;
        foreach ($trainees as $trainee){
            foreach($listIds as $ids){
                // dd($ids);
                // dd($trainee->uuid);
                $projectuser = Project_Users::where('user_id',$trainee->uuid)->where('list_id',$ids)
                ->where('project_id',$req->id)->get();
                // dd($projectuser);
                if($projectuser->isEmpty()){

                    $projectuser = new Project_Users ([
                        'user_id' => $trainee->uuid,
                        'project_id' => $req->id,
                        'status' => false,
                        'list_id' => $ids,
                    ]);
                    // dd($projectuser);
                    $projectuser ->save();
                }
            }
        }
        session()->flash('success', 'Updated successfully');
        return redirect()->route('project');
    }

    public function edit(Request $req){

        // dd($req);
        $now = now()->timezone('Asia/Jakarta');

        $projectsToDelete = DB::table('project__tables')
            ->where('end_date', '<', $now)
            ->get();


        foreach ($projectsToDelete as $project) {
            DB::table('project_user')->where('project_id', $project->id)->delete();
            DB::table('list__tables')->where('project_id', $project->id)->delete();
            DB::table('project__tables')->where('id', $project->id)->delete();
        }
        
        $count = $req->counting;
        $id = $req->id;
        // dd($req->counting);
        $projectIds = is_array($req->id) ? $req->id : [$req->id];
        $projectuser = Project_Users::whereIn('project_id', $projectIds)->get();
        $lists = List_Table::whereIn('project_id', $projectIds)->get();
        $table = Project_Table::whereIn('id', $projectIds)->get();
        return view('component.Edit',compact('projectuser','lists','table','id','count'));
    }

    public function destroy(Request $req)
    {
        // dd($req->id);
        $idArray = explode(',', $req->id);
        Project_Users::whereIn('project_id', $idArray)->delete();
        List_Table::whereIn('project_id', $idArray)->delete();
        Project_Table::whereIn('id', $idArray)->delete();
        session()->flash('success', 'Deleted successfully');

        // Optionally, you can redirect or return a response
        return redirect()->back();
    }
}
