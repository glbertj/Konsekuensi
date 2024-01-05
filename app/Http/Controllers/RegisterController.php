<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Faker\Factory as Faker;
use App\Models\Users;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\List_Table;
use App\Models\Project_Users;
use App\Models\Project_Table;
use Illuminate\Support\Str;



class RegisterController extends Controller
{
    public function roleregister()
	{
		return view('auth/roleregister');
	}



    public function createTrainee(Request $req){
        // rules

        // $rules = [
        //     'email' => 'required|email|unique:mysql.konse.users,email',
        //     'password' => 'required|min:8',
        //     'confirmpassword' => 'required|same:password',
        //     'nama' => 'required',
        //     'binusian' => 'required',
        //     'jurusan' => 'required',
        //     'contact' => 'required',
        //     'alamat' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'kodetrainee' => 'required',
        //     'tanggallahir' => 'required|date',
        //     'status' => 'required'
        // ];

        // echo ($req->image);
        // validate
        // $validator = Validator::make($req->all(), $rules);
        // dd($validator);
        // // if error
        // dd($req->roles);
        Session::put('mysession', [
            'role' => $req->roles,
        ]);
        // if ($validator->fails()) {
        //     // $roles = Session::get('mysession')['role'];
        //     // dd($roles);

        //     return back()->with('roles',$req->roles)->withErrors($validator)->withInput();
        // }

        //image
        $file = $req->file('image');
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('image'),$imageName);
        $imagePath = 'image/' . $imageName;

        // create uuid
        $uuid = Str::uuid();

        // Save to account
        $account = new Users([
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'nama_lengkap' => $req->nama,
            'role' => 'trainee',
            'binusian' => $req->binusian,
            'jurusan' => $req->jurusan,
            'uuid' => $uuid
        ]);

        $account->save();


        // Save to trainee
        $trainee = new Trainee([
            'contact' => $req->contact,
            'alamat' => $req->alamat,
            'status' => $req->status,
            'kode_trainee' => $req->kodetrainee,
            'image' => $imagePath,
            'tanggal_lahir' => $req->tanggallahir,
            'uuid' => $account->id
        ]);

        $trainee->save();
        // dd($uuid);

        $projecttable = Project_Table::all();
        $listtable = List_Table::all();
        foreach($projecttable as $project){
            foreach($listtable as $list){
                if ($list->project_id == $project->id){
                    $projectuser = new Project_Users([
                        'user_id' => $account->id,
                        'project_id' => $project->id,
                        'status'=> false,
                        'list_id' =>$list->id,
                        'created_at'=>now(),
                        'updated_at' => now()
                    ]);
                    $projectuser->save();
                }
            }
        }


        return view('auth.login');
    }

    public function createTrainer(Request $req){
        //rules
        $rules = [
            'email' => 'required|email|unique:mysql.konse.users,email',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password',
            'nama' => 'required',
            'binusian' => 'required',
            'jurusan' => 'required',
            'jabatan' => 'required',
            'initial' => 'required',
        ];


        //validate
        $validator = Validator::make($req->all(), $rules);
        Session::put('mysession', [
            'role' => $req->roles,
        ]);
        dd(Session::get('mysession'));

        //if error
        if ($validator->fails()) {
            return back()->with('role', $req->roles)->withErrors($validator)->withInput();

        }

        // create uuid
        $uuid = Str::uuid();

        // Save to account
        $account = new Users([
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'nama_lengkap' => $req->nama,
            'role' => 'trainer',
            'binusian' => $req->binusian,
            'jurusan' => $req->jurusan,
            'uuid' => $uuid
        ]);

        $account->save();

        // Save to trainee
        $trainer = new Trainer([
            'jabatan' => $req->jabatan,
            'inisial' => $req->initial,
            'uuid' => $account->id
        ]);

        $trainer->save();
        return redirect()->route('login');
    }

    public function chooseRole(Request $request)
    {
        $role = $request->input('role');
        // Session::put('mysession', [
        //     'role' => $request->input('role'),
        // ]);
        if (Session::has('mysession.role')) {
            $rolepls = Session::get('mysession.role');
        }
        // dd($rolepls);
        if($role == "trainee" || $rolepls == "trainee"){
            return view('auth/register', ['role' => $role]);
        }else if ($role == "trainer"|| $rolepls == "trainer"){

            return view('auth/registertrainer', ['role' => $role]);
        }
    }

}
