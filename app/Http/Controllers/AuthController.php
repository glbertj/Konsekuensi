<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Trainee;
use App\Models\Trainer;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    function loginPage(){
        return view('auth.login');
    }

    public function login(Request $req){

        $credentials = $req->only('email', 'password');

        if ($req->remember) {
            Cookie::queue('myCookie', $req->email, 60);
        }

        if (Auth::attempt($credentials, true)) { // Remember Token
            // Authentication was successful
            // Store necessary user information in session or retrieve more data from the database if needed
            $user = Auth::user();

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

            $now = now()->timezone('Asia/Jakarta');

            $projectsToDelete = DB::table('project__tables')
                ->where('end_date', '<', $now)
                ->get();

            foreach ($projectsToDelete as $project) {
                DB::table('project_user')->where('project_id', $project->id)->delete();
                DB::table('list__tables')->where('project_id', $project->id)->delete();
                DB::table('project__tables')->where('id', $project->id)->delete();
            }
            return redirect()->route('sced');
        } else {
            return redirect()->back()->withInput()->withErrors(['login' => 'Invalid email or password']);
        }
    }

    public function sced(){
        try {
            // Get deadlines from the 'project_user' table for the current user
            $isinotif = DB::table('project__tables')->get();

            // Collect deadlines for which notifications need to be shown
            $deadlines = [];
            foreach ($isinotif as $record) {
                $notificationTimeDifference = now()->diffInSeconds($record->end_date);
                if ($notificationTimeDifference > 0) {
                    $deadlines[] = [
                        'deadline' => $record->end_date,
                        'task_name' => $record->title
                    ];
                }
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error getting deadlines: ' . $e->getMessage()], 500);
        }

        return redirect()->route('buletin');
    }

    public function logout(){
        Auth::logout();
        return view('auth.login');
    }

    public function adminPage(){
        return view('admin');
    }
}
