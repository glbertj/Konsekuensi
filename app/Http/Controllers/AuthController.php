<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\Project_Table;
use App\Models\List_Table;
use App\Models\Project_Users;
use Carbon\Carbon;
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

                // Add other data you want to store in the session
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
                // Add other data you want to store in the session
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
        // $isinotif = DB::table('project__tables')->get();
        // foreach ($isinotif as $record) {
        //     dd($record);
        //     // $this->scheduleNotificationForDeadline($record->end_date);
        // }


        // Redirect to the next page with the user data
        return redirect()->route('sced');
        // return redirect()->route('home')->with('user', $user);
    } else {
        // Authentication failed
        // dd('Login Failed', $credentials);
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
                        'task_name' => $record->title, // Add any other necessary information
                    ];
                }
            }

            // return response()->json(['success' => true, 'deadlines' => $deadlines]);
        } catch (\Exception $e) {
            \Log::error('Error getting deadlines: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error getting deadlines: ' . $e->getMessage()], 500);
        }

        return redirect()->route('buletin');
    }
    private function scheduleNotificationForDeadline($deadline)
    {
        try {
            // Calculate time difference and schedule notification logic here

            // Example code for demonstration purposes (please adjust based on your requirements)
            $notificationTimeDifference = now()->diffInSeconds($deadline);

            if ($notificationTimeDifference > 0) {
                // Schedule notification logic here
                // You might use Laravel's notification system or an external service like Pusher

                // Example: Send a Laravel notification (you need to define a notification class)
                $notification = new AuthController($data);
                \Notification::send(Auth::user(), $notification);

                // Log or do something with the scheduled notification

                // Optional: You can store this information in the database
                // Update the 'project_user' table or any other table with the notification status
                // DB::table('project_user')->where('user_id', Auth::user()->id)->update(['notification_scheduled' => true]);
            }
        } catch (\Exception $e) {
            // Handle the exception, log, or perform any necessary actions
            \Log::error('Error scheduling notification for deadline ' . $deadline . ': ' . $e->getMessage());
        }
    }


    public function logout(){
        Auth::logout();
        return view('auth.login');
    }

    public function adminPage(){
        return view('admin');
    }
}
