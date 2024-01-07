<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Users;
use App\Models\Trainee;
use App\Models\Trainer;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function edittrainer(){

        return view('edittrainer');
    }

    public function traineedetail(){
        return view('traineedetail');
    }

    public function edittrainee(){
        $user = Users::where('id', Session::get('mysession')['uuid'])->first();
        $trainee = Trainee::where('uuid', $user->id)->first();
        return view('edittrainee',compact('user','trainee'));
    }

    public function editpassview(){
        return view('editpassword');
    }

    public function editpass(Request $req){

        $rules = [
            'email' => 'required',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password',
        ];

        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = Users::where('email', $req->email)->first();
        if($user){

            $user->password = bcrypt($req->password);
            $user->save();
            return redirect()->route('login');
        }

        return redirect()->back()->with('change_password_failed', 'Change Password Failed')->withInput();

    }

    public function edittraineedata(Request $req){

        $file = $req->file('image');
        $user = Users::where('id', Session::get('mysession')['uuid'])->first();

        $trainee = Trainee::where('uuid', $user->id)->first();
        $user->updated_at = now();
        $trainee->updated_at = now();

        // dd($file);
        if ($file != null){
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('image'),$imageName);
            unlink($trainee->image);
            Storage::delete('public/'.$trainee->image);
            $imageName = 'image/'.$imageName;
            $trainee->image = $imageName;
        }else {
            $trainee->image = $trainee->image;
        }

        Session::put('mysession', [
            'email' => $user->email,
            'name' => $user->nama_lengkap,
            'uuid' => $user->id,
            'role' => $user->role,
            'image' => $trainee->image,
            'binusian' => $user->binusian,
            'jurusan' => $user->jurusan,
            'kode' => $trainee->kode_trainee,
            'dob' => $trainee->tanggal_lahir,
            'alamat' => $trainee->alamat,
            'contact' => $trainee->contact
        ]);

        $data = [
            'contact' => $req->contact,
            'alamat' => $req->alamat
        ];

        DB::table('trainees')->where('uuid',$user->id)->update($data);

        return redirect()->back()->with('change_password_success', 'Change Password Succesfully')->withInput();
    }

    public function edittrainerdata(Request $req){
        $user = Users::where('id', Session::get('mysession')['uuid'])->first();
        $trainer = Trainer::where('uuid', $user->id)->first();
        $user->nama_lengkap = $req->nama != null? $req->nama:$user->nama_lengkap;
        $user->jurusan = $req->jurusan != null? $req->jurusan:$user->jurusan;
        $user->binusian = $req->binusian != null? $req->binusian:$user->binusian;
        $user->updated_at = now();
        $trainer->inisial = $req->inisial != null? $req->inisial:$trainer->inisial;
        $trainer->jabatan = $req->jabatan != null? $req->jabatan:$trainer->jabatan;
        $trainer->updated_at = now();
        if ($user->role == "trainee admin" || $user->role == "trainee"){
            $trainee = Trainee::where('uuid', $user->id)->first();
            Session::put('mysession', [
                'email' => $user->email,
                'name' => $user->nama_lengkap,
                'uuid' => $user->id,
                'role' => $user->role,
                'image' => $trainee->image,
                'binusian' => $user->binusian,
                'jurusan' => $user->jurusan,
                'kode' => $trainee->kode_trainee,
                'dob' => $trainee->tanggal_lahir,
                'alamat' => $trainee->alamat,
                'contact' => $trainee->contact
            ]);
        }else if($user->role == "trainer"){
            $trainer = Trainer::where('uuid', $user->id)->first();
            Session::put('mysession', [
                'email' => $user->email,
                'name' => $user->nama_lengkap,
                'uuid' => $user->id,
                'role' => $user->role,
                'inisial' =>$trainer->inisial,
                'jabatan' => $trainer->jabatan,
            ]);
        }

        $trainer->save();
        $user->save();

        return redirect()->back()->with('change_password_success', 'Change Password Succesfully')->withInput();
    }
}
